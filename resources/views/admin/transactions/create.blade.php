<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Transaction') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('admin.transactions.store') }}" method="POST" id="transactionForm">
                    @csrf

                    <!-- Customer Information -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-4">Customer Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Customer Name *</label>
                                <input type="text" name="customer_name" value="{{ old('customer_name') }}" required
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('customer_name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" name="customer_email" value="{{ old('customer_email') }}"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('customer_email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Phone *</label>
                                <input type="text" name="customer_phone" value="{{ old('customer_phone') }}" required
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('customer_phone')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Payment Method</label>
                                <select name="payment_method" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">Select Payment Method</option>
                                    <option value="bank_transfer">Bank Transfer</option>
                                    <option value="cod">Cash on Delivery</option>
                                    <option value="e_wallet">E-Wallet</option>
                                </select>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Address *</label>
                                <textarea name="customer_address" rows="3" required
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('customer_address') }}</textarea>
                                @error('customer_address')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="mb-8">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Order Items</h3>
                            <button type="button" onclick="addItem()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-sm">
                                + Add Item
                            </button>
                        </div>

                        <div id="itemsContainer">
                            <!-- Items will be added here dynamically -->
                        </div>

                        @error('items')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Order Summary -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-4">Order Summary</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex justify-between mb-2">
                                <span>Subtotal:</span>
                                <span id="subtotalDisplay" class="font-semibold">Rp 0</span>
                            </div>
                            <div class="flex justify-between mb-2">
                                <label>Shipping Cost:</label>
                                <input type="number" name="shipping_cost" value="0" min="0" step="1000" 
                                    class="w-32 text-right border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    onchange="updateTotal()">
                            </div>
                            <div class="border-t pt-2 flex justify-between text-lg font-bold">
                                <span>Total:</span>
                                <span id="totalDisplay">Rp 0</span>
                            </div>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div class="mb-8">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                        <textarea name="notes" rows="3"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('notes') }}</textarea>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end gap-4">
                        <a href="{{ route('admin.transactions.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                            Cancel
                        </a>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Create Transaction
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        const products = @json($products);
        let itemCount = 0;

        function addItem() {
            const container = document.getElementById('itemsContainer');
            const itemDiv = document.createElement('div');
            itemDiv.className = 'bg-gray-50 p-4 rounded-lg mb-4';
            itemDiv.id = `item-${itemCount}`;
            
            itemDiv.innerHTML = `
                <div class="flex gap-4 items-start">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Product</label>
                        <select name="items[${itemCount}][product_id]" required onchange="updateItemPrice(${itemCount})"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">Select Product</option>
                            ${products.map(p => `<option value="${p.id}" data-price="${p.sale_price || p.original_price}">${p.name} - Rp ${formatNumber(p.sale_price || p.original_price)}</option>`).join('')}
                        </select>
                    </div>
                    <div class="w-32">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
                        <input type="number" name="items[${itemCount}][quantity]" value="1" min="1" required
                            onchange="updateTotal()"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div class="w-40">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Price</label>
                        <input type="text" id="price-${itemCount}" readonly
                            class="w-full bg-gray-100 border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div class="pt-8">
                        <button type="button" onclick="removeItem(${itemCount})" class="text-red-600 hover:text-red-800">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                </div>
            `;
            
            container.appendChild(itemDiv);
            itemCount++;
        }

        function removeItem(index) {
            document.getElementById(`item-${index}`).remove();
            updateTotal();
        }

        function updateItemPrice(index) {
            const select = document.querySelector(`select[name="items[${index}][product_id]"]`);
            const option = select.options[select.selectedIndex];
            const price = option.getAttribute('data-price') || 0;
            document.getElementById(`price-${index}`).value = 'Rp ' + formatNumber(price);
            updateTotal();
        }

        function updateTotal() {
            let subtotal = 0;
            
            document.querySelectorAll('[name^="items["]').forEach((input, index) => {
                if (input.name.includes('[product_id]')) {
                    const itemIndex = input.name.match(/\d+/)[0];
                    const select = input;
                    const option = select.options[select.selectedIndex];
                    const price = parseFloat(option.getAttribute('data-price') || 0);
                    const quantity = parseInt(document.querySelector(`[name="items[${itemIndex}][quantity]"]`)?.value || 0);
                    subtotal += price * quantity;
                }
            });

            const shipping = parseFloat(document.querySelector('[name="shipping_cost"]')?.value || 0);
            const total = subtotal + shipping;

            document.getElementById('subtotalDisplay').textContent = 'Rp ' + formatNumber(subtotal);
            document.getElementById('totalDisplay').textContent = 'Rp ' + formatNumber(total);
        }

        function formatNumber(num) {
            return new Intl.NumberFormat('id-ID').format(num);
        }

        // Add first item on page load
        addItem();
    </script>
    @endpush
</x-app-layout>