<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Transaksi') }} - {{ $transaction->order_number }}
        </h2>
    </x-slot>

    <div class="py-6">
        {{-- Success Message --}}
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="font-semibold">{{ session('success') }}</span>
            </div>
        @endif

        <div class="max-w-7xl mx-auto px-6">
            <div class="bg-white overflow-hidden shadow-xl rounded">
                <form action="{{ route('admin.transactions.update', $transaction) }}" method="POST" class="p-8">
                    @csrf
                    @method('PUT')

                    {{-- Alert untuk error umum --}}
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 rounded-lg">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <h3 class="font-semibold">Terdapat beberapa kesalahan:</h3>
                            </div>
                            <ul class="list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Customer Information --}}
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-4 text-gray-800">Informasi Customer</h3>
                        <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-x-12 lg:gap-y-4">
                            <!-- Customer Name -->
                            <div class="relative z-0 w-full mb-3 group">
                                <x-input 
                                    id="customer_name" 
                                    type="text" 
                                    name="customer_name" 
                                    :value="old('customer_name', $transaction->customer_name)" 
                                    required 
                                />
                                <x-label for="customer_name" value="{{ __('Nama customer') }}" />
                            </div>

                            <!-- Customer Email -->
                            <div class="relative z-0 w-full mb-3 group">
                                <x-input 
                                    id="customer_email" 
                                    type="email" 
                                    name="customer_email" 
                                    :value="old('customer_email', $transaction->customer_email)"
                                />
                                <x-label for="customer_email" value="{{ __('Email customer') }}" />
                            </div>

                            <!-- Customer Phone -->
                            <div class="relative z-0 w-full mb-3 group">
                                <x-input 
                                    id="customer_phone" 
                                    type="text" 
                                    name="customer_phone" 
                                    :value="old('customer_phone', $transaction->customer_phone)" 
                                    required 
                                />
                                <x-label for="customer_phone" value="{{ __('Nomor telepon') }}" />
                            </div>

                            <!-- Payment Method -->
                            <div class="relative z-0 w-full mb-3 group">
                                <x-select 
                                    id="payment_method" 
                                    name="payment_method" 
                                    placeholder="Pilih metode pembayaran"
                                    :options="[
                                        'bank_transfer' => 'Bank Transfer',
                                        'cod' => 'Cash on Delivery',
                                        'e_wallet' => 'E-Wallet'
                                    ]"
                                    :selected="old('payment_method', $transaction->payment_method)"
                                />
                                <x-label for="payment_method" value="{{ __('Metode pembayaran') }}" />
                            </div>

                            <!-- Customer Address -->
                            <div class="col-span-2 relative z-0 w-full mb-3 group">
                                <x-textarea 
                                    id="customer_address"
                                    name="customer_address"
                                    :value="old('customer_address', $transaction->customer_address)"
                                    required
                                />
                                <x-label for="customer_address" value="{{ __('Alamat lengkap') }}" />
                            </div>
                        </div>
                    </div>

                    {{-- Order Status --}}
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-4 text-gray-800">Status Pesanan</h3>
                        <div class="grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-x-12 lg:gap-y-4">
                            <!-- Order Status -->
                            <div class="relative z-0 w-full mb-3 group">
                                <x-select 
                                    id="status" 
                                    name="status" 
                                    placeholder="Pilih status"
                                    :options="[
                                        'pending' => 'Pending',
                                        'processing' => 'Processing',
                                        'shipped' => 'Shipped',
                                        'delivered' => 'Delivered',
                                        'cancelled' => 'Cancelled'
                                    ]"
                                    :selected="old('status', $transaction->status)"
                                    required
                                />
                                <x-label for="status" value="{{ __('Status pesanan') }}" />
                            </div>

                            <!-- Payment Status -->
                            <div class="relative z-0 w-full mb-3 group">
                                <x-select 
                                    id="payment_status" 
                                    name="payment_status" 
                                    placeholder="Pilih status pembayaran"
                                    :options="[
                                        'unpaid' => 'Unpaid',
                                        'paid' => 'Paid',
                                        'refunded' => 'Refunded'
                                    ]"
                                    :selected="old('payment_status', $transaction->payment_status)"
                                    required
                                />
                                <x-label for="payment_status" value="{{ __('Status pembayaran') }}" />
                            </div>

                            <!-- Shipping Cost -->
                            <div class="relative z-0 w-full mb-3 group">
                                <x-input 
                                    id="shipping_cost"
                                    type="number" 
                                    name="shipping_cost" 
                                    :value="old('shipping_cost', $transaction->shipping_cost)" 
                                    min="0" 
                                    step="1000"
                                    required
                                />
                                <x-label for="shipping_cost" value="{{ __('Biaya pengiriman') }}" />
                            </div>
                        </div>
                    </div>

                    {{-- Order Items (Read-only) --}}
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-4 text-gray-800">Item Pesanan</h3>
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <p class="text-sm text-gray-600 mb-4">
                                <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                                Catatan: Untuk mengubah item pesanan, silakan buat transaksi baru.
                            </p>
                            
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($transaction->items as $item)
                                            <tr>
                                                <td class="px-4 py-3">
                                                    <div class="flex items-center">
                                                        @if($item->product && $item->product->main_image)
                                                            <img src="{{ asset('storage/' . $item->product->main_image) }}" 
                                                                 alt="{{ $item->product_name }}" 
                                                                 class="w-10 h-10 object-cover rounded mr-3">
                                                        @endif
                                                        <div class="text-sm font-medium text-gray-900">{{ $item->product_name }}</div>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3 text-right text-sm text-gray-900">
                                                    Rp {{ number_format($item->price, 0, ',', '.') }}
                                                </td>
                                                <td class="px-4 py-3 text-center text-sm text-gray-900">
                                                    {{ $item->quantity }}
                                                </td>
                                                <td class="px-4 py-3 text-right text-sm font-medium text-gray-900">
                                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="bg-gray-50">
                                        <tr>
                                            <td colspan="3" class="px-4 py-3 text-right text-sm font-semibold text-gray-700">
                                                Subtotal:
                                            </td>
                                            <td class="px-4 py-3 text-right text-sm font-semibold text-gray-900">
                                                Rp {{ number_format($transaction->subtotal, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="px-4 py-3 text-right text-sm font-semibold text-gray-700">
                                                Biaya Pengiriman:
                                            </td>
                                            <td class="px-4 py-3 text-right text-sm font-semibold text-gray-900">
                                                Rp {{ number_format($transaction->shipping_cost, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="px-4 py-3 text-right text-sm font-bold text-gray-900">
                                                Total:
                                            </td>
                                            <td class="px-4 py-3 text-right text-lg font-bold text-blue-600">
                                                Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Notes --}}
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-4 text-gray-800">Catatan (Opsional)</h3>
                        <div class="relative z-0 w-full mb-3 group">
                            <x-textarea 
                                id="notes"
                                name="notes"
                                :value="old('notes', $transaction->notes)"
                            />
                            <x-label for="notes" value="{{ __('Catatan tambahan') }}" />
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex justify-end gap-4">
                        <a href="{{ route('admin.transactions.show', $transaction) }}" class="text-gray-700 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:ring-gray-300 font-medium rounded text-sm px-4 py-2.5 focus:outline-none">
                            Batal
                        </a>
                        <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded text-sm px-4 py-2.5 focus:outline-none">
                            Update Transaksi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>