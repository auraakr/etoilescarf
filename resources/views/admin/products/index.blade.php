<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold font-heading text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
        <a href="{{ route('admin.products.create') }}" class="text-body box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium rounded text-sm px-4 py-2.5 focus:outline-none">Tambah produk</a>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-5">
            {{-- Success Message --}}
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-semibold">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Error Message --}}
            @if (session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 rounded-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-semibold">{{ session('error') }}</span>
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <x-table>
                    <x-slot:header>
                        <th class="px-6 py-3">ID</th>
                        <th class="px-6 py-3">Image</th>
                        <th class="px-6 py-3">Nama</th>
                        <th class="px-6 py-3">Harga</th>
                        <th class="px-6 py-3">Kategori</th>
                        <th class="px-6 py-3">Size</th>
                        <th class="px-6 py-3">Is On Sale</th>
                        <th class="px-6 py-3">Harga Sale</th>
                        <th class="px-6 py-3">Sale Start Date</th>
                        <th class="px-6 py-3">Sale End Date</th>
                        <th class="px-6 py-3">Stock</th>
                        <th class="px-6 py-3">Availability</th>
                        <th class="px-6 py-3">Is Feature</th>
                        <th class="px-6 py-3">Action</th>
                    </x-slot:header>

                    @forelse ($products as $product)
                        <tr class="bg-neutral-primary-soft border-b border-default hover:bg-neutral-secondary-medium hover:bg-gray-50">
                            <td class="px-6 py-3">{{ $product->id }}</td>
                            <td class="px-6 py-3">
                                @if($product->main_image)
                                    <img src="{{ Storage::url($product->main_image) }}" alt="{{ $product->name }}">
                                @else
                                    <img src="{{ asset('images/no_image.jpg') }}" alt="No image">
                                @endif
                            </td>
                            <td class="px-6 py-3">{{ $product->name }}</td>
                            <td class="px-6 py-3">{{ $product->original_price }}</td>
                            <td class="px-6 py-3">{{ $product->category->name }}</td>
                            <td class="px-6 py-3">{{ $product->size }}</td>
                            <td class="px-6 py-3">{{ $product->is_on_sale }}</td>
                            <td class="px-6 py-3">{{ $product->sale_price }}</td>
                            <td class="px-6 py-3">{{ $product->sale_start_date }}</td>
                            <td class="px-6 py-3">{{ $product->sale_end_date }}</td>
                            <td class="px-6 py-3">{{ $product->stock }}</td>
                            <td class="px-6 py-3">{{ $product->availability }}</td>
                            <td class="px-6 py-3">{{ $product->is_featured }}</td>
                            <td class="px-6 py-3">
                                <div class="inline-flex rounded-base shadow-xs -space-x-px" role="group">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="inline-flex items-center text-body bg-neutral-primary-soft border border-default hover:bg-orange-50 hover:text-orange-600 focus:ring-3 focus:ring-orange-100 font-medium leading-5 rounded-s-base text-sm px-3 py-2 focus:outline-none">
                                        <svg class="w-4 h-4 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="post" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center text-body bg-neutral-primary-soft border border-default hover:bg-red-50 hover:text-red-600 focus:ring-3 focus:ring-red-100 font-medium leading-5 rounded-e-base text-sm px-3 py-2 focus:outline-none">
                                            <svg class="w-4 h-4 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                No categories found.
                            </td>
                        </tr>
                    @endforelse
                </x-table>
            </div>
        </div>
    </div>
</x-app-layout>
