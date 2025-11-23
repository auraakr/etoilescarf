<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h1>Form edit produk</h1>
                <form action="{{ route('products.update', $product->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $product->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="original_price">Harga</label>
                        <input type="number" class="form-control" id="original_price" name="original_price"
                            value="{{ $product->original_price }}" required>
                    </div>
                    <div class="form-group">
                        <label for="id_category">Harga</label>
                        <select name="id_category">
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $product->id_category == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn mt-3 btn-primary">Update product</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>