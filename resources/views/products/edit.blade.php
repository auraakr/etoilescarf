<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Produk') }} - {{ $product->name }}
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
                
                {{-- PERUBAHAN UTAMA: ACTION & METHOD --}}
                <form action="{{ route('products.update', $product->id) }}" method="post" class="p-8" enctype="multipart/form-data">
                    @csrf
                    {{-- Tambahkan method PATCH/PUT untuk operasi update di Laravel --}}
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
                    
                    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-x-12 lg:gap-y-4">
                        
                        {{-- Tampilkan foto produk saat ini untuk referensi --}}
                        <div class="col-span-2 mb-4">
                            <h3 class="font-semibold text-gray-700 mb-2">Foto Produk Saat Ini:</h3>
                            @if($product->main_image)
                                <img src="{{ Storage::url($product->main_image) }}" alt="{{ $product->name }}" class="w-32 h-32 object-cover rounded-lg border">
                                <p class="text-sm text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah foto.</p>
                            @else
                                <p class="text-sm text-red-500">Tidak ada foto produk saat ini.</p>
                                <img src="{{ asset('images/no-image.png') }}" alt="No image" class="w-32 h-32 object-cover rounded-lg border">
                            @endif
                        </div>

                        <div class="col-span-2 relative z-0 w-full mb-3 group">
                            <x-file-input 
                                id="main_image"
                                name="main_image"
                                accept="image/*"
                                label="Upload foto produk BARU"
                                hint="PNG, JPG (MAX. 2MB)"
                            />
                        </div>

                        <div class="relative z-0 w-full mb-3 group">
                            {{-- PERUBAHAN: :selected diisi dengan $product->id_category atau old('id_category') --}}
                            <x-select 
                                id="id_category" 
                                name="id_category" 
                                :options="$categories->pluck('name', 'id')->toArray()" 
                                :selected="old('id_category', $product->id_category)" 
                                placeholder="Pilih Kategori"
                            />
                            <x-label for="id_category" value="{{ __('Kategori produk') }}" />
                        </div>

                        <div class="relative z-0 w-full mb-3 group">
                            {{-- PERUBAHAN: :value diisi dengan $product->name atau old('name') --}}
                            <x-input id="name" type="text" name="name" :value="old('name', $product->name)" required />
                            <x-label for="name" value="{{ __('Nama produk') }}" />
                        </div>

                        <div class="row-span-3 relative z-0 w-full mb-3 group">
                            {{-- PERUBAHAN: Textarea diisi dengan $product->description atau old('description') --}}
                            <x-textarea 
                                id="description"
                                name="description"
                                :value="old('description', $product->description)"
                            />
                            <x-label for="description" value="{{ __('Deskripsi produk') }}" />
                        </div>

                        <div class="relative z-0 w-full mb-3 group">
                            {{-- PERUBAHAN: :value diisi dengan $product->original_price atau old('original_price') --}}
                            <x-input 
                                id="original_price" 
                                type="number" 
                                name="original_price" 
                                :value="old('original_price', $product->original_price)"
                                step="0.01"
                                required 
                            />
                            <x-label for="original_price" value="{{ __('Harga produk') }}" />
                        </div>

                        <div class="relative z-0 w-full mb-3 group">
                            {{-- PERUBAHAN: :value diisi dengan $product->size atau old('size') --}}
                            <x-input 
                                id="size" 
                                type="text" 
                                name="size" 
                                :value="old('size', $product->size)"
                            />
                            <x-label for="size" value="{{ __('Size') }}" />
                        </div>

                        <div class="relative z-0 w-full mb-3 group">
                            {{-- PERUBAHAN: :value diisi dengan $product->material atau old('material') --}}
                            <x-input 
                                id="material" 
                                type="text" 
                                name="material" 
                                :value="old('material', $product->material)"
                            />
                            <x-label for="material" value="{{ __('Material') }}" />
                        </div>

                        <div class="relative z-0 w-full mb-3 group">
                            {{-- PERUBAHAN: :selected diisi dengan $product->availability atau old('availability') --}}
                            <x-select 
                                id="availability" 
                                name="availability" 
                                placeholder="Choose an option"
                                :options="[
                                    '1' => 'Yes',
                                    '0' => 'No'
                                ]"
                                :selected="old('availability', $product->availability)" 
                            />
                            <x-label for="availability" value="{{ __('Availability') }}" />
                        </div>

                        <div class="relative z-0 w-full mb-3 group">
                            {{-- PERUBAHAN: :selected diisi dengan $product->is_featured atau old('is_featured') --}}
                            <x-select 
                                id="is_featured" 
                                name="is_featured" 
                                placeholder="Choose an option"
                                :options="[
                                    '1' => 'Yes',
                                    '0' => 'No'
                                ]"
                                :selected="old('is_featured', $product->is_featured)" 
                            />
                            <x-label for="is_featured" value="{{ __('Is featured?') }}" />
                        </div>

                        <div class="relative z-0 w-full mb-3 group">
                            {{-- PERUBAHAN: :selected diisi dengan $product->is_on_sale atau old('is_on_sale') --}}
                            <x-select 
                                id="is_on_sale" 
                                name="is_on_sale" 
                                placeholder="Choose an option"
                                :options="[
                                    '1' => 'Yes',
                                    '0' => 'No'
                                ]"
                                :selected="old('is_on_sale', $product->is_on_sale)" 
                            />
                            <x-label for="is_on_sale" value="{{ __('Is on sale?') }}" />
                        </div>

                        <div class="relative z-0 w-full mb-3 group">
                            {{-- PERUBAHAN: :value diisi dengan $product->sale_price atau old('sale_price') --}}
                            <x-input 
                                id="sale_price" 
                                type="number" 
                                name="sale_price" 
                                :value="old('sale_price', $product->sale_price)"
                                step="0.01"
                            />
                            <x-label for="sale_price" value="{{ __('Harga sale') }}" />
                        </div>

                        <div class="relative z-0 w-full mb-3 group">
                            {{-- PERUBAHAN: :value diisi dengan $product->sale_start_date atau old('sale_start_date') --}}
                            <x-date-picker 
                                id="sale_start_date"
                                name="sale_start_date"
                                :value="old('sale_start_date', $product->sale_start_date ? \Carbon\Carbon::parse($product->sale_start_date)->format('Y-m-d') : null)"
                            />
                            <x-label for="sale_start_date" value="{{ __('Sale start date') }}" />
                        </div>

                        <div class="relative z-0 w-full mb-3 group">
                            {{-- PERUBAHAN: :value diisi dengan $product->sale_end_date atau old('sale_end_date') --}}
                            <x-date-picker 
                                id="sale_end_date"
                                name="sale_end_date"
                                :value="old('sale_end_date', $product->sale_end_date ? \Carbon\Carbon::parse($product->sale_end_date)->format('Y-m-d') : null)"
                            />
                            <x-label for="sale_end_date" value="{{ __('Sale end date') }}" />
                        </div>
                    </div>

                    <button type="submit" class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 shadow-xs font-medium rounded text-sm px-4 py-2.5 focus:outline-none mt-4">
                        Update Produk
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>