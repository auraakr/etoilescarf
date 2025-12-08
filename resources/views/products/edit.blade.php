<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-5">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-sm p-3">
                <form action="{{ route('products.update', $product->id) }}" method="POST" class="max-w-sm">
                    @csrf
                    @method('PUT')

                    <!-- Nama Produk -->
                    <div class="mb-5">
                        <label for="name" class="block mb-2.5 text-sm font-medium text-heading">Nama Produk</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ $product->name }}"
                            class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                            placeholder="Masukkan nama produk"
                            required />
                    </div>

                    <div class="form-group">
                        <label for="main_image">Thumbnail</label>
                        <input type="file" class="form-control" id="main_image" name="main_image" required>
                    </div>

                    <!-- Harga -->
                    <div class="mb-5">
                        <label for="original_price" class="block mb-2.5 text-sm font-medium text-heading">Harga Produk</label>
                        <input
                            type="number"
                            id="original_price"
                            name="original_price"
                            value="{{ $product->original_price }}"
                            class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                            placeholder="Masukkan harga"
                            required />
                    </div>

                    <!-- Kategori -->
                    <div class="mb-5">
                        <label for="id_category" class="block mb-2.5 text-sm font-medium text-heading">Kategori Produk</label>
                        <select
                            id="id_category"
                            name="id_category"
                            class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                            required>
                            <option value="">Pilih Kategori</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $product->id_category == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit"
                        class="text-body box-border border border-default-medium hover:bg-blue-600 hover:text-blue-50 focus:ring-3 focus:ring-blue-100 shadow-xs hover:font-medium rounded text-sm px-4 py-2.5 focus:outline-none">
                        Update Produk
                    </button>
                </form>

                <!-- <form action="{{ route('products.update', $product->id) }}" method="post">
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
                </form> -->
            </div>
        </div>
    </div>
</x-app-layout>