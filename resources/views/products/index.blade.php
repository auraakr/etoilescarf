<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
        <a href="{{ route('products.create') }}" class="text-body box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium rounded text-sm px-4 py-2.5 focus:outline-none">Tambah produk</a>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-5">
            <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-sm">
                <x-table>
                    <x-slot:header>
                        <th class="px-6 py-3 font-medium">ID</th>
                        <th class="px-6 py-3 font-medium">Image</th>
                        <th class="px-6 py-3 font-medium">Nama</th>
                        <th class="px-6 py-3 font-medium">Harga</th>
                        <th class="px-6 py-3 font-medium">Kategori</th>
                        <th class="px-6 py-3 font-medium">Deskripsi</th>
                        <th class="px-6 py-3 font-medium">Size</th>
                        <th class="px-6 py-3 font-medium">Harga Sale</th>
                        <th class="px-6 py-3 font-medium">Is On Sale</th>
                        <th class="px-6 py-3 font-medium">Sale Start Date</th>
                        <th class="px-6 py-3 font-medium">Sale End Date</th>
                        <th class="px-6 py-3 font-medium">Availability</th>
                        <th class="px-6 py-3 font-medium">Is Feature</th>
                        <th class="px-6 py-3 font-medium">Action</th>
                    </x-slot:head>

                    @foreach ($products as $product)
                        <tr class="bg-neutral-primary-soft border-b border-default hover:bg-neutral-secondary-medium">
                            <td class="px-6 py-3">{{ $product->id }}</td>
                            <td class="px-6 py-3">{{ $product->main_image }}</td>
                            <td class="px-6 py-3">{{ $product->name }}</td>
                            <td class="px-6 py-3">{{ $product->original_price }}</td>
                            <td class="px-6 py-3">{{ $product->category->name }}</td>
                            <td class="px-6 py-3">{{ $product->description }}</td>
                            <td class="px-6 py-3">{{ $product->size }}</td>
                            <td class="px-6 py-3">{{ $product->sale_price }}</td>
                            <td class="px-6 py-3">{{ $product->is_on_sale }}</td>
                            <td class="px-6 py-3">{{ $product->sale_start_date }}</td>
                            <td class="px-6 py-3">{{ $product->sale_end_date }}</td>
                            <td class="px-6 py-3">{{ $product->availability }}</td>
                            <td class="px-6 py-3">{{ $product->is_featured }}</td>
                            <td class="px-6 py-3">
                                <div class="inline-flex rounded-base shadow-xs -space-x-px" role="group">
                                    <a href="{{ route('products.edit', $product->id) }}" class="inline-flex items-center text-body bg-neutral-primary-soft border border-default hover:bg-orange-50 hover:text-orange-600 focus:ring-3 focus:ring-orange-100 font-medium leading-5 rounded-s-base text-sm px-3 py-2 focus:outline-none">
                                        <svg class="w-4 h-4 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="post" class="inline">
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
                    @endforeach
                </x-table>
            </div>
        </div>
    </div>
</x-app-layout>
