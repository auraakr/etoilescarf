<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Produk') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-6">
            <div class="bg-white overflow-hidden shadow-xl rounded">
                <form action="{{ route('products.store') }}" method="post" class="p-8">
                    @csrf

                    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-x-12 lg:gap-y-4">
                        <!-- image field -->
                        <div class="row-span-4 relative z-0 w-full mb-5 group">
                            <x-file-input 
                                id="photo"
                                name="photo"
                                accept="image/*"
                                label="Upload foto"
                                hint="PNG, JPG (MAX. 2MB)"
                            />
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <x-select id="category_id" name="category_id" :options="$categories->pluck('name', 'id')->toArray()" :selected="old('category_id')"/>
                            <x-label for="category_id" value="{{ __('Kategori produk') }}" />
                        </div>
                        <!-- nama -->
                        <div class="relative z-0 w-full mb-5 group">
                            <x-input id="name" type="text" name="name" :value="old('name')" required />
                            <x-label for="name" value="{{ __('Nama produk') }}" />
                        </div>
                        <div class="row-span-2 relative z-0 w-full mb-5 group">
                            <x-textarea 
                                id="description"
                                name="description"
                            />
                            <x-label for="description" value="{{ __('Deskripsi produk') }}" />
                        </div>
                        
                        <!-- harga -->
                        <div class="relative z-0 w-full mb-5 group">
                            <x-input id="original_price" type="number" name="original_price" required />
                            <x-label for="original_price" value="{{ __('Harga produk') }}" />
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <x-input id="name" type="number" name="name" required />
                            <x-label for="name" value="{{ __('Size') }}" />
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <x-select id="availability" name="availability" placeholder="Choose an option"
                                :options="[
                                    '1' => 'Yes',
                                    '0' => 'No'
                                ]"
                            />
                            <x-label for="availability" value="{{ __('Availability') }}" />
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <x-select id="is_feature" name="is_feature" placeholder="Choose an option"
                                :options="[
                                    '1' => 'Yes',
                                    '0' => 'No'
                                ]"
                            />
                            <x-label for="is_feature" value="{{ __('Is feature?') }}" />
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <x-input id="sale_price" type="number" name="sale_price" required />
                            <x-label for="sale_price" value="{{ __('Harga sale') }}" />
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <x-select id="is_on_sale" name="is_on_sale" placeholder="Choose an option"
                                :options="[
                                    '1' => 'Yes',
                                    '0' => 'No'
                                ]"
                            />
                            <x-label for="is_on_sale" value="{{ __('Is on sale?') }}" />
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <x-date-picker 
                                id="sale_start_date"
                                name="sale_start_date"
                                required
                            />
                            <x-label for="sale_start_date" value="{{ __('Sale start date') }}" />
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <x-date-picker 
                                id="sale_end_date"
                                name="sale_end_date"
                                required
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