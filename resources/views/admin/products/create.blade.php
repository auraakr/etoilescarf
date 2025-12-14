<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Produk') }}
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
                <form action="{{ route('admin.products.store') }}" method="post" class="p-8" enctype="multipart/form-data">
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
                    
                    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-x-12 lg:gap-y-4">
                        <!-- image field -->
                        <div class="col-span-2 relative z-0 w-full mb-3 group">
                            <x-file-input 
                                id="main_image"
                                name="main_image"
                                accept="image/*"
                                label="Upload foto produk"
                                hint="PNG, JPG (MAX. 2MB)"
                            />
                        </div>

                        <!-- kategori -->
                        <div class="relative z-0 w-full mb-3 group">
                            <x-select 
                                id="id_category" 
                                name="id_category" 
                                :options="$categories->pluck('name', 'id')->toArray()" 
                                :selected="old('id_category')"
                                placeholder="Pilih Kategori"
                            />
                            <x-label for="id_category" value="{{ __('Kategori produk') }}" />
                        </div>

                        <!-- nama -->
                        <div class="relative z-0 w-full mb-3 group">
                            <x-input id="name" type="text" name="name" :value="old('name')" required />
                            <x-label for="name" value="{{ __('Nama produk') }}" />
                        </div>

                        <!-- deskripsi -->
                        <div class="row-span-3 relative z-0 w-full mb-3 group">
                            <x-textarea 
                                id="description"
                                name="description"
                                :value="old('description')"
                            />
                            <x-label for="description" value="{{ __('Deskripsi produk') }}" />
                        </div>

                        <!-- harga original -->
                        <div class="relative z-0 w-full mb-3 group">
                            <x-input 
                                id="original_price" 
                                type="number" 
                                name="original_price" 
                                :value="old('original_price')"
                                step="0.01"
                                required 
                            />
                            <x-label for="original_price" value="{{ __('Harga produk') }}" />
                        </div>

                        <!-- size -->
                        <div class="relative z-0 w-full mb-3 group">
                            <x-input 
                                id="size" 
                                type="text" 
                                name="size" 
                                :value="old('size')"
                            />
                            <x-label for="size" value="{{ __('Size') }}" />
                        </div>

                        <!-- material -->
                        <div class="relative z-0 w-full mb-3 group">
                            <x-input 
                                id="material" 
                                type="text" 
                                name="material" 
                                :value="old('material')"
                            />
                            <x-label for="material" value="{{ __('Material') }}" />
                        </div>

                        <div class="relative z-0 w-full mb-3 group">
                            <x-input 
                                id="stock" 
                                type="number" 
                                name="stock" 
                                :value="old('stock')"
                                required 
                                min="0"
                            />
                            <x-label for="stock" value="{{ __('Jumlah Stok') }}" />
                        </div>

                        <!-- availability -->
                        <div class="relative z-0 w-full mb-3 group">
                            <x-select 
                                id="availability" 
                                name="availability" 
                                placeholder="Choose an option"
                                :options="[
                                    '1' => 'Yes',
                                    '0' => 'No'
                                ]"
                                :selected="old('availability', '')"
                            />
                            <x-label for="availability" value="{{ __('Availability') }}" />
                        </div>

                        <!-- is_featured -->
                        <div class="relative z-0 w-full mb-3 group">
                            <x-select 
                                id="is_featured" 
                                name="is_featured" 
                                placeholder="Choose an option"
                                :options="[
                                    '1' => 'Yes',
                                    '0' => 'No'
                                ]"
                                :selected="old('is_featured', '')"
                            />
                            <x-label for="is_featured" value="{{ __('Is featured?') }}" />
                        </div>

                        <!-- is_on_sale -->
                        <div class="relative z-0 w-full mb-3 group">
                            <x-select 
                                id="is_on_sale" 
                                name="is_on_sale" 
                                placeholder="Choose an option"
                                :options="[
                                    '1' => 'Yes',
                                    '0' => 'No'
                                ]"
                                :selected="old('is_on_sale', '')"
                            />
                            <x-label for="is_on_sale" value="{{ __('Is on sale?') }}" />
                        </div>

                        <!-- sale_price -->
                        <div class="relative z-0 w-full mb-3 group">
                            <x-input 
                                id="sale_price" 
                                type="number" 
                                name="sale_price" 
                                :value="old('sale_price')"
                                step="0.01"
                            />
                            <x-label for="sale_price" value="{{ __('Harga sale') }}" />
                        </div>

                        <!-- sale_start_date -->
                        <div class="relative z-0 w-full mb-3 group">
                            <x-date-picker 
                                id="sale_start_date"
                                name="sale_start_date"
                                :value="old('sale_start_date')"
                            />
                            <x-label for="sale_start_date" value="{{ __('Sale start date') }}" />
                        </div>

                        <!-- sale_end_date -->
                        <div class="relative z-0 w-full mb-3 group">
                            <x-date-picker 
                                id="sale_end_date"
                                name="sale_end_date"
                                :value="old('sale_end_date')"
                            />
                            <x-label for="sale_end_date" value="{{ __('Sale end date') }}" />
                        </div>
                    </div>

                    <button type="submit" class="text-body box-border border border-default-medium hover:bg-blue-600 hover:text-blue-50 focus:ring-4 focus:ring-blue-600 shadow-xs font-medium rounded text-sm px-4 py-2.5 focus:outline-none">
                        Tambah produk
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>