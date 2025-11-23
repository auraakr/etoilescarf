<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <a class="btn btn-sm btn-success" href={{ route('products.create') }}>Tambah Produk</a>
                <table class="min-w-full divide-y divide-gray-200">
                    <tr>
                        <th class="px-6 py-3 bg-gray-0 text-left text-xs font0medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 bg-gray-0 text-left text-xs font0medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 bg-gray-0 text-left text-xs font0medium text-gray-500 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 bg-gray-0 text-left text-xs font0medium text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                    @foreach ( $products as $product )
                    <tr>
                        <td class="px-6 py-3 whitespace-nowrap">{{ $product->name }}</td>
                        <td class="px-6 py-3 whitespace-nowrap">{{ $product->original_price }}</td>
                        <td class="px-6 py-3 whitespace-nowrap">{{ $product->category->name ?? '-' }}</td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr> 
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
