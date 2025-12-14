<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Http\Request;

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
        $products = Product::where('availability', true)->get();
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
            $price = $product->isOnSale() ? $product->sale_price : $product->original_price;
            $itemSubtotal = $price * $item['quantity'];
            
            $items[] = [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'quantity' => $item['quantity'],
                'price' => $price,
                'subtotal' => $itemSubtotal,
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
        $products = Product::where('availability', true)->get();
        $transaction->load('items');
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
}