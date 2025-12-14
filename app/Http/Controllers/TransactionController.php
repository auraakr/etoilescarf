<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('items')
            ->latest()
            ->paginate(15);

        return view('admin.transactions.index', compact('transactions'));
    }

    public function create()
    {
        $products = Product::where('availability', true)
            ->get()
            ->map(function($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->isOnSale() ? $product->sale_price : $product->original_price,
                    'image' => $product->main_image,
                    'availability' => $product->availability
                ];
            })
            ->values() // Convert ke indexed array
            ->toArray(); // PENTING: Convert ke array
            
        return view('admin.transactions.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'nullable|email',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string',
            'shipping_cost' => 'required|numeric|min:0',
            'payment_method' => 'nullable|string',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $subtotal = 0;
        $items = [];

        foreach ($validated['items'] as $item) {
            $product = Product::findOrFail($item['product_id']);
            
            // Cek availability
            if (!$product->availability) {
                return back()->withErrors([
                    'items' => "Product {$product->name} is not available."
                ])->withInput();
            }
            
            // Hitung harga (pakai sale price jika ada)
            $price = $product->isOnSale() ? $product->sale_price : $product->original_price;
            $itemSubtotal = $price * $item['quantity'];
            
            $items[] = [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'quantity' => $item['quantity'],
                'price' => $price,
                'item_subtotal' => $itemSubtotal,
            ];
            
            $subtotal += $itemSubtotal;
        }

        $transaction = Transaction::create([
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'customer_address' => $validated['customer_address'],
            'subtotal' => $subtotal,
            'shipping_cost' => $validated['shipping_cost'],
            'total_amount' => $subtotal + $validated['shipping_cost'],
            'payment_method' => $validated['payment_method'],
            'notes' => $validated['notes'],
        ]);

        $transaction->items()->createMany($items);

        return redirect()->route('admin.transactions.show', $transaction)
            ->with('success', 'Transaction created successfully!');
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('items.product');
        return view('admin.transactions.show', compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        // Ambil products untuk dropdown (kalau mau edit items)
        $products = Product::where('availability', true)
            ->with('category')
            ->get();
            
        $transaction->load('items.product');
        
        return view('admin.transactions.edit', compact('transaction', 'products'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'nullable|email',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string',
            'shipping_cost' => 'required|numeric|min:0',
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
            'payment_status' => 'required|in:unpaid,paid,refunded',
            'payment_method' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        // Update timestamps based on status
        if ($validated['payment_status'] === 'paid' && !$transaction->paid_at) {
            $validated['paid_at'] = now();
        }
        if ($validated['status'] === 'shipped' && !$transaction->shipped_at) {
            $validated['shipped_at'] = now();
        }
        if ($validated['status'] === 'delivered' && !$transaction->delivered_at) {
            $validated['delivered_at'] = now();
        }

        // Recalculate total if shipping cost changed
        $validated['total_amount'] = $transaction->subtotal + $validated['shipping_cost'];

        $transaction->update($validated);

        return redirect()->route('admin.transactions.show', $transaction)
            ->with('success', 'Transaction updated successfully!');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('admin.transactions.index')
            ->with('success', 'Transaction deleted successfully!');
    }

    public function dashboard()
    {
        // --- 1. Definisi Periode Waktu ---
        $endDate = now();
        $startDate = now()->subDays(7); // 7 Hari Terakhir
        $prevStartDate = now()->subDays(14); // 7 Hari Sebelumnya
        
        // --- 2. Mengambil Data Transaksi PAID (Selesai/Dibayar) ---
        $currentTransactions = Transaction::where('payment_status', 'paid')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();
            
        $previousTransactions = Transaction::where('payment_status', 'paid')
            ->whereBetween('created_at', [$prevStartDate, $startDate])
            ->get();
            
        // --- 3. Perhitungan KPI Utama ---
        
        // A. Pendapatan
        $totalRevenue = $currentTransactions->sum('total_amount');
        $prevRevenue = $previousTransactions->sum('total_amount');
        
        // B. Transaksi
        $totalTransactions = $currentTransactions->count();
        $prevTransactions = $previousTransactions->count();
        
        // C. Rata-rata Nilai Pesanan (AOV)
        $avgOrderValue = $totalTransactions > 0 ? $totalRevenue / $totalTransactions : 0;
        
        // D. Persentase Perubahan Pendapatan
        $revenueChangePercent = 0;
        if ($prevRevenue > 0) {
            $revenueChangePercent = (($totalRevenue - $prevRevenue) / $prevRevenue) * 100;
        } elseif ($totalRevenue > 0) {
            $revenueChangePercent = 100;
        }

        // E. Total Unit Terjual
        $totalItemsSold = DB::table('transaction_items')
            ->join('transactions', 'transaction_items.transaction_id', '=', 'transactions.id')
            ->where('transactions.payment_status', 'paid')
            ->whereBetween('transactions.created_at', [$startDate, $endDate])
            ->sum('quantity');

        // --- 4. Data Tren untuk Grafik (Revenue Trend) ---
        $revenueTrend = Transaction::select(
            DB::raw('DATE(created_at) as date'), 
            DB::raw('SUM(total_amount) as amount')
        )
        ->where('payment_status', 'paid')
        ->whereBetween('created_at', [$startDate, $endDate])
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();
        
        // --- 5. Data Performa Produk ---

        // F. Produk Terlaris (Top 5)
        $topProducts = DB::table('transaction_items')
            ->select(
                'product_name as name', 
                DB::raw('SUM(quantity) as sold'), 
                DB::raw('SUM(item_subtotal) as revenue')
            )
            ->join('transactions', 'transaction_items.transaction_id', '=', 'transactions.id')
            ->where('transactions.payment_status', 'paid')
            ->groupBy('product_name')
            ->orderBy('sold', 'desc')
            ->limit(5)
            ->get();

        // G. Distribusi Status Transaksi
        $statusDistribution = Transaction::select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->get();


        // --- 6. Data Stok Kritis (Asumsi ada field 'stock' di Product Model) ---
        // Asumsi batas stok kritis adalah 10
        $lowStockProducts = Product::where('stock', '<', 10)
            ->where('availability', true)
            ->select('name', 'stock')
            ->orderBy('stock', 'asc')
            ->limit(5)
            ->get();


        return view('admin.dashboard', [
            'totalRevenue' => $totalRevenue,
            'totalTransactions' => $totalTransactions,
            'avgOrderValue' => $avgOrderValue,
            'revenueChangePercent' => round($revenueChangePercent, 2),
            'totalItemsSold' => $totalItemsSold,
            
            'revenueTrend' => $revenueTrend,
            'topProducts' => $topProducts,
            'lowStockProducts' => $lowStockProducts,
            'statusDistribution' => $statusDistribution,
        ]);
    }
}