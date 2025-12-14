<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,200..800&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="bg-primary">
    <header class="">
        @if (Route::has('login'))
            <nav id="navbar" class="bg-primary fixed w-full z-20 top-0 start-0 flex flex-wrap items-center justify-between mx-auto p-4 lg:px-16">
                <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <!-- <img src="https://flowbite.com/docs/images/logo.svg" class="h-7" alt="Etoile Scarf Logo" /> -->
                    <span class="self-center text-xl font-semibold whitespace-nowrap">Etoile Scarf</span>
                </a>
                <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-body rounded-base md:hidden hover:bg-neutral-secondary-soft hover:text-heading focus:outline-none focus:ring-2 focus:ring-neutral-tertiary" aria-controls="navbar-default" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14" />
                    </svg>
                </button>
                <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                    <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 gap-4 md:gap-0 border border-default rounded-base bg-neutral-secondary-soft md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-neutral-primary">
                        @auth
                            <li>
                                <a href="{{ url('/admin/dashboard') }}" class="block py-2 px-3 text-white bg-brand rounded md:bg-transparent md:text-fg-brand md:p-0" aria-current="page">Dashboard</a>
                            </li>
                        @endauth
                        <li>
                            <a href="https://shopee.co.id/hijab_etoilescarf" target="_blank" class="md:hidden flex justify-center gap-2 items-center shadow-xl text-sm bg-gray-50 backdrop-blur-md lg:font-semibold isolation-auto border-gray-50 before:absolute before:w-full before:transition-all before:duration-700 before:hover:w-full before:-left-full before:hover:left-0 before:rounded-full before:bg-orange-500 hover:text-slate-50 before:-z-10 before:aspect-square before:hover:scale-150 before:hover:duration-700 relative z-10 px-4 py-1.5 overflow-hidden border-2 rounded-sm group">
                                VISIT SHOPEE
                                <svg class="w-8 h-8 justify-end group-hover:rotate-90 group-hover:bg-gray-50 text-gray-50 ease-linear duration-300 rounded-sm border border-gray-700 group-hover:border-none p-2 rotate-45" viewBox="0 0 16 19" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7 18C7 18.5523 7.44772 19 8 19C8.55228 19 9 18.5523 9 18H7ZM8.70711 0.292893C8.31658 -0.0976311 7.68342 -0.0976311 7.29289 0.292893L0.928932 6.65685C0.538408 7.04738 0.538408 7.68054 0.928932 8.07107C1.31946 8.46159 1.95262 8.46159 2.34315 8.07107L8 2.41421L13.6569 8.07107C14.0474 8.46159 14.6805 8.46159 15.0711 8.07107C15.4616 7.68054 15.4616 7.04738 15.0711 6.65685L8.70711 0.292893ZM9 18L9 1H7L7 18H9Z" class="fill-gray-800 group-hover:fill-gray-800"></path>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- From Uiverse.io by nathAd17 --> 
                <a href="https://shopee.co.id/hijab_etoilescarf" target="_blank" class="hidden md:flex justify-center gap-2 items-center shadow-xl text-sm bg-gray-50 backdrop-blur-md lg:font-semibold isolation-auto border-gray-50 before:absolute before:w-full before:transition-all before:duration-700 before:hover:w-full before:-left-full before:hover:left-0 before:rounded-sm before:bg-orange-500 hover:text-slate-50 before:-z-10 before:aspect-square before:hover:scale-150 before:hover:duration-700 relative z-10 px-4 py-1.5 overflow-hidden border-2 rounded-sm group">
                    VISIT SHOPEE
                    <svg class="w-8 h-8 justify-end group-hover:rotate-90 group-hover:bg-gray-50 text-gray-50 ease-linear duration-300 rounded-full border border-gray-700 group-hover:border-none p-2 rotate-45" viewBox="0 0 16 19" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 18C7 18.5523 7.44772 19 8 19C8.55228 19 9 18.5523 9 18H7ZM8.70711 0.292893C8.31658 -0.0976311 7.68342 -0.0976311 7.29289 0.292893L0.928932 6.65685C0.538408 7.04738 0.538408 7.68054 0.928932 8.07107C1.31946 8.46159 1.95262 8.46159 2.34315 8.07107L8 2.41421L13.6569 8.07107C14.0474 8.46159 14.6805 8.46159 15.0711 8.07107C15.4616 7.68054 15.4616 7.04738 15.0711 6.65685L8.70711 0.292893ZM9 18L9 1H7L7 18H9Z" class="fill-gray-800 group-hover:fill-gray-800"></path>
                    </svg>
                </a>

            </nav>
        @endif
    </header>

    <div class="mt-10 md:mt-20 px-16 py-10">
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Product Info -->
            <div class="flex flex-col justify-between">
                <div class="">
                    <h1 class="text-2xl font-heading font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
                    @if($product->category)
                        <p class="text-gray-600 mb-4">{{ $product->category->name }}</p>
                    @endif
                    <!-- Availability -->
                    @if($product->availability)
                        <span class="inline-flex items-center text-green-600">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            In Stock
                        </span>
                    @else
                        <span class="inline-flex items-center text-red-600">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            Out of Stock
                        </span>
                    @endif
                </div>

                <!-- Price -->
                <div class="mb-6">
                    @if($product->isOnSale())
                        <div class="flex items-baseline gap-3">
                            <span class="text-3xl font-bold text-red-600">
                                Rp {{ number_format($product->sale_price, 0, ',', '.') }}
                            </span>
                            <span class="text-xl text-gray-500 line-through">
                                Rp {{ number_format($product->original_price, 0, ',', '.') }}
                            </span>
                            <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                                {{ $product->getDiscountPercentage() }}% OFF
                            </span>
                        </div>
                    @else
                        <span class="text-3xl font-bold text-gray-900">
                            Rp {{ number_format($product->original_price, 0, ',', '.') }}
                        </span>
                    @endif

                    <!-- Description -->
                    @if($product->description)
                        <div class="my-6">
                            <h3 class="text-lg font-semibold mb-2">Tentang produk</h3>
                            <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
                        </div>
                    @endif
                </div>

                <div class="">
                    <h3 class="text-lg font-semibold mb-2">Kontak</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 items-center text-center gap-2">
                        @if($product->availability)
                            <a href="https://wa.me/6285956069603" class="w-full hover:text-white px-4 py-3 rounded-sm hover:bg-green-600 border border-green-600 transition-colors font-medium text-base">
                                Whatsapp
                            </a>
                            <a href="https://shopee.co.id/hijab_etoilescarf" class="w-full hover:text-white px-4 py-3 rounded-sm hover:bg-orange-600 border border-orange-600 transition-colors font-medium text-base">
                                Shopee
                            </a>
                            <a href="" class="w-full hover:text-white px-4 py-3 rounded-sm hover:bg-gray-900 border border-gray-900 transition-colors font-medium text-base">
                                Telepon
                            </a>
                        @else
                            <a href="tel:+6285956069603" class="w-full bg-gray-400 text-white px-4 py-3 rounded-sm cursor-not-allowed font-medium text-base" disabled>
                                Out of Stock
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Product Image -->
            <div>
                @if($product->main_image)
                    <img src="{{ asset('storage/' . $product->main_image) }}" 
                            alt="{{ $product->name }}" 
                            class="w-full h-[75vh] object-cover rounded-sm">
                @else
                    <img src="images/no_image.jpg" 
                            alt="no-image" 
                            class="w-full h-[75vh] object-cover rounded-sm">
                @endif
            </div>
        </div>
    </div>
</body>
</html>