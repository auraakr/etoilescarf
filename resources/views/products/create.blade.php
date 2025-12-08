<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h1>Form tambah produk</h1>
                <form action="{{ route('products.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="main_image">Thumbnail</label>
                        <input type="file" class="form-control" id="main_image" name="main_image" required>
                    </div>
                    <div class="form-group">
                        <label for="original_price">Harga</label>
                        <input type="number" class="form-control" id="original_price" name="original_price" required>
                    </div>
                    <div class="form-group">
                        <label for="id_category">Harga</label>
                        <select name="id_category">
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Tambahkan produk</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>