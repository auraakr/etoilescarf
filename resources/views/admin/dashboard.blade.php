<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Toko') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Bagian 1: Ringkasan Metrik (KPI Cards) --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                
                {{-- Card 1: Total Pendapatan --}}
                <div class="bg-white overflow-hidden shadow-md rounded-lg p-6 border-l-4 border-blue-500">
                    <p class="text-sm font-medium text-gray-500">Total Pendapatan (7 Hari)</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">
                        Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                    </p>
                    <p class="text-xs mt-2 @if($revenueChangePercent > 0) text-green-500 @elseif($revenueChangePercent < 0) text-red-500 @else text-gray-500 @endif">
                        {{ $revenueChangePercent > 0 ? '+' : '' }}{{ $revenueChangePercent }}% vs Periode Lalu
                    </p>
                </div>

                {{-- Card 2: Total Transaksi --}}
                <div class="bg-white overflow-hidden shadow-md rounded-lg p-6 border-l-4 border-green-500">
                    <p class="text-sm font-medium text-gray-500">Total Transaksi (7 Hari)</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">
                        {{ number_format($totalTransactions, 0, ',', '.') }}
                    </p>
                    <p class="text-xs mt-2 text-gray-400">Pesanan Paid/Selesai</p>
                </div>

                {{-- Card 3: Rata-rata Nilai Pesanan (AOV) --}}
                <div class="bg-white overflow-hidden shadow-md rounded-lg p-6 border-l-4 border-yellow-500">
                    <p class="text-sm font-medium text-gray-500">Rata-rata Nilai Pesanan</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">
                        Rp {{ number_format($avgOrderValue, 0, ',', '.') }}
                    </p>
                    <p class="text-xs mt-2 text-gray-400">Rata-rata setiap pesanan</p>
                </div>

                {{-- Card 4: Total Produk Terjual --}}
                <div class="bg-white overflow-hidden shadow-md rounded-lg p-6 border-l-4 border-red-500">
                    <p class="text-sm font-medium text-gray-500">Total Unit Terjual (7 Hari)</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">
                        {{ number_format($totalItemsSold, 0, ',', '.') }}
                    </p>
                    <p class="text-xs mt-2 text-gray-400">Total unit produk</p>
                </div>
            </div>

            {{-- Bagian 2: Area Grafik (Canvas) --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                
                {{-- Grafik 1 (Kolom 1-2): Tren Pendapatan (Line Chart) --}}
                <div class="lg:col-span-2 bg-white overflow-hidden shadow-md rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">Tren Pendapatan 7 Hari Terakhir</h3>
                    {{-- CANVASH CHART.JS --}}
                    <canvas id="revenueChart" class="w-full h-80"></canvas>
                </div>

                {{-- Grafik 2 (Kolom 3): Distribusi Status Transaksi (Doughnut Chart) --}}
                <div class="lg:col-span-1 bg-white overflow-hidden shadow-md rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">Distribusi Status Pesanan</h3>
                    {{-- CANVASH CHART.JS --}}
                    <canvas id="statusChart" class="w-full h-80"></canvas>
                </div>
            </div>

            {{-- Bagian 3: Tabel Data (Produk Terlaris & Stok Kritis) --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                
                {{-- Tabel 1: Produk Terlaris --}}
                <div class="bg-white overflow-hidden shadow-md rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4 text-gray-800">5 Produk Terlaris (Berdasarkan Unit)</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Produk</th>
                                        <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Terjual</th>
                                        <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Pendapatan</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($topProducts as $product)
                                        <tr>
                                            <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">{{ $product->name }}</td>
                                            <td class="px-4 py-2 whitespace-nowrap text-sm text-right text-gray-700">{{ number_format($product->sold) }}</td>
                                            <td class="px-4 py-2 whitespace-nowrap text-sm text-right text-green-600">Rp {{ number_format($product->revenue, 0, ',', '.') }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="3" class="px-4 py-4 text-center text-sm text-gray-500">Belum ada data produk terjual.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Tabel 2: Stok Kritis --}}
                <div class="bg-white overflow-hidden shadow-md rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4 text-red-700">Peringatan Stok Kritis (Stok &lt; 10)</h3>
                        <ul class="divide-y divide-gray-200">
                            @forelse ($lowStockProducts as $product)
                                <li class="py-3 flex justify-between items-center">
                                    <span class="text-sm font-medium text-gray-900">{{ $product->name }}</span>
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                        Sisa: {{ $product->stock }}
                                    </span>
                                </li>
                            @empty
                                <li class="py-3 text-sm text-gray-500">Semua stok produk dalam batas aman.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

            </div>

        </div>
    </div>
    
    {{-- Implementasi JavaScript Chart.js --}}
    @push('scripts')
    <script>
        // 1. DATA UNTUK TREND PENDAPATAN (Line Chart)
        
        // Data diubah dari PHP (JSON) ke variabel JavaScript
        const revenueData = @json($revenueTrend);
        const revenueLabels = revenueData.map(item => item.date);
        const revenueAmounts = revenueData.map(item => item.amount);

        new Chart(document.getElementById('revenueChart'), {
            type: 'line',
            data: {
                labels: revenueLabels,
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: revenueAmounts,
                    borderColor: 'rgb(59, 130, 246)', // Blue-500
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    tension: 0.3, // Membuat garis sedikit melengkung
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Tanggal'
                        }
                    }
                }
            }
        });
        
        // 2. DATA UNTUK DISTRIBUSI STATUS (Doughnut Chart)
        
        const statusData = @json($statusDistribution);
        const statusLabels = statusData.map(item => item.status.charAt(0).toUpperCase() + item.status.slice(1));
        const statusCounts = statusData.map(item => item.count);
        
        new Chart(document.getElementById('statusChart'), {
            type: 'doughnut',
            data: {
                labels: statusLabels,
                datasets: [{
                    label: 'Jumlah Pesanan',
                    data: statusCounts,
                    backgroundColor: [
                        '#f59e0b', // Pending (Amber)
                        '#3b82f6', // Processing (Blue)
                        '#10b981', // Delivered (Green)
                        '#ef4444', // Cancelled (Red)
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });
    </script>
    @endpush
</x-app-layout>