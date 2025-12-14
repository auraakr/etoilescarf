<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Transaksi') }}
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
                <form action="{{ route('admin.transactions.store') }}" method="POST" class="p-8" id="transactionForm">
                    @csrf

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
                                    :value="old('customer_name')" 
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
                                    :value="old('customer_email')"
                                />
                                <x-label for="customer_email" value="{{ __('Email customer') }}" />
                            </div>

                            <!-- Customer Phone -->
                            <div class="relative z-0 w-full mb-3 group">
                                <x-input 
                                    id="customer_phone" 
                                    type="text" 
                                    name="customer_phone" 
                                    :value="old('customer_phone')" 
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
                                    :selected="old('payment_method', '')"
                                />
                                <x-label for="payment_method" value="{{ __('Metode pembayaran') }}" />
                            </div>

                            <!-- Customer Address -->
                            <div class="col-span-2 relative z-0 w-full mb-3 group">
                                <x-textarea 
                                    id="customer_address"
                                    name="customer_address"
                                    :value="old('customer_address')"
                                    required
                                />
                                <x-label for="customer_address" value="{{ __('Alamat lengkap') }}" />
                            </div>
                        </div>
                    </div>

                    {{-- Order Items --}}
                    <div class="mb-8">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Item Pesanan</h3>
                            <button 
                                type="button" 
                                onclick="addItem()" 
                                class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded text-sm px-4 py-2.5 focus:outline-none flex items-center gap-2"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Tambah Item
                            </button>
                        </div>

                        <div id="itemsContainer" class="space-y-4">
                            <!-- Items will be added here dynamically -->
                        </div>

                        @error('items')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Order Summary --}}
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-4 text-gray-800">Ringkasan Pesanan</h3>
                        <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                            <div class="space-y-3">
                                <div class="flex justify-between text-gray-700">
                                    <span>Subtotal:</span>
                                    <span id="subtotalDisplay" class="font-semibold">Rp 0</span>
                                </div>
                                <div class="flex justify-between items-center text-gray-700">
                                    <label>Biaya Pengiriman:</label>
                                    <div class="relative z-0 group w-48">
                                        <x-input 
                                            id="shipping_cost"
                                            type="number" 
                                            name="shipping_cost" 
                                            value="{{ old('shipping_cost', 0) }}" 
                                            min="0" 
                                            step="1000"
                                            onchange="updateTotal()"
                                            class="text-right"
                                        />
                                    </div>
                                </div>
                                <div class="border-t pt-3 flex justify-between text-lg font-bold text-gray-900">
                                    <span>Total:</span>
                                    <span id="totalDisplay" class="text-blue-600">Rp 0</span>
                                </div>
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
                                :value="old('notes')"
                            />
                            <x-label for="notes" value="{{ __('Catatan tambahan') }}" />
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex justify-end gap-4">
                        <a href="{{ route('admin.transactions.index') }}" class="text-gray-700 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:ring-gray-300 font-medium rounded text-sm px-4 py-2.5 focus:outline-none">
                            Batal
                        </a>
                        <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded text-sm px-4 py-2.5 focus:outline-none">
                            Buat Transaksi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Data produk dari Controller
        const availableProducts = @json($products);
        let itemIndex = 0;
        
        // Helper untuk memformat angka menjadi Rupiah
        function formatRupiah(number) {
            return 'Rp ' + new Intl.NumberFormat('id-ID').format(number);
        }

        // Template HTML untuk item baru
        function createItemHTML(index, productId = '', quantity = 1) {
            let productOptions = '<option value="">Pilih Produk</option>';
            availableProducts.forEach(p => {
                const selected = p.id == productId ? 'selected' : '';
                const price = formatRupiah(p.price);
                productOptions += `<option value="${p.id}" data-price="${p.price}" ${selected}>${p.name} - ${price}</option>`;
            });

            return `
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 item-row bg-gray-50 p-4 rounded-lg border border-gray-200 relative" data-index="${index}">
                    <div class="md:col-span-5 relative z-0 w-full group">
                        <select 
                            name="items[${index}][product_id]" 
                            onchange="updateItemPrice(${index})" 
                            required 
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        >
                            ${productOptions}
                        </select>
                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Produk
                        </label>
                        <div id="preview-${index}" class="mt-2 hidden">
                            <img src="" alt="Product" class="w-16 h-16 object-cover rounded border">
                        </div>
                    </div>

                    <div class="md:col-span-2 relative z-0 w-full group">
                        <input 
                            type="number" 
                            name="items[${index}][quantity]" 
                            value="${quantity}" 
                            min="1" 
                            onchange="updateTotal()"
                            required
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        />
                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Qty
                        </label>
                    </div>

                    <div class="md:col-span-3 relative z-0 w-full group">
                        <input 
                            type="text" 
                            id="price-${index}" 
                            readonly
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 peer cursor-not-allowed"
                            placeholder="Rp 0"
                        />
                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0]">
                            Harga
                        </label>
                        <input type="hidden" name="items[${index}][price_hidden]" id="price-hidden-${index}" value="0">
                    </div>

                    <div class="md:col-span-2 flex justify-end items-center">
                        <button 
                            type="button" 
                            onclick="removeItem(${index})" 
                            class="text-red-600 hover:text-red-800 p-2 rounded hover:bg-red-50"
                            title="Hapus item"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                </div>
            `;
        }

        // Fungsi untuk menambah item baru
        function addItem() {
            const container = document.getElementById('itemsContainer');
            const div = document.createElement('div');
            div.innerHTML = createItemHTML(itemIndex);
            container.appendChild(div.firstElementChild);
            itemIndex++;
        }

        // Fungsi untuk menghapus item
        function removeItem(index) {
            const element = document.querySelector(`.item-row[data-index="${index}"]`);
            if (element) {
                element.remove();
                updateTotal();
            }
        }

        // Fungsi untuk mengupdate harga saat produk dipilih
        function updateItemPrice(index) {
            const select = document.querySelector(`.item-row[data-index="${index}"] select`);
            const option = select.options[select.selectedIndex];
            const price = parseFloat(option.getAttribute('data-price')) || 0;
            const image = option.getAttribute('data-image') || '';
            
            document.getElementById(`price-${index}`).value = formatRupiah(price);
            document.getElementById(`price-hidden-${index}`).value = price;
            
            // Show product image preview
            const preview = document.getElementById(`preview-${index}`);
            if (image) {
                preview.classList.remove('hidden');
                preview.querySelector('img').src = `/storage/${image}`;
            } else {
                preview.classList.add('hidden');
            }
            
            updateTotal();
        }

        // Fungsi untuk menghitung total keseluruhan
        function updateTotal() {
            let subtotal = 0;
            
            document.querySelectorAll('.item-row').forEach(row => {
                const index = row.getAttribute('data-index');
                const select = row.querySelector('select');
                const option = select.options[select.selectedIndex];
                const price = parseFloat(option.getAttribute('data-price')) || 0;
                const quantity = parseInt(row.querySelector('input[type="number"]').value) || 0;
                
                subtotal += price * quantity;
            });

            const shippingCost = parseFloat(document.getElementById('shipping_cost').value) || 0;
            const totalAmount = subtotal + shippingCost;
            
            document.getElementById('subtotalDisplay').textContent = formatRupiah(subtotal);
            document.getElementById('totalDisplay').textContent = formatRupiah(totalAmount);
        }

        // Inisialisasi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            // Tambahkan item pertama
            addItem();
        });
    </script>
</x-app-layout>