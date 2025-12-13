<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Etoile Scarf | Your Premium Hijab</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

</head>

<body class="font-sans antialiased">
    <header class="">
        @if (Route::has('login'))
            <nav class="bg-neutral-primary-medium fixed w-full z-20 top-0 start-0 border-b border-default">
                <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                    <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                        <img src="https://flowbite.com/docs/images/logo.svg" class="h-7" alt="Etoile Scarf Logo" />
                        <span class="self-center text-xl text-heading font-semibold whitespace-nowrap">Etoile Scarf</span>
                    </a>
                    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-body rounded-base md:hidden hover:bg-neutral-secondary-soft hover:text-heading focus:outline-none focus:ring-2 focus:ring-neutral-tertiary" aria-controls="navbar-default" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14" />
                        </svg>
                    </button>
                    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                        <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-default rounded-base bg-neutral-secondary-soft md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-neutral-primary">
                            @auth
                                <li>
                                    <a href="{{ url('/admin/dashboard') }}" class="block py-2 px-3 text-white bg-brand rounded md:bg-transparent md:text-fg-brand md:p-0" aria-current="page">Dashboard</a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('login') }}" class="block py-2 px-3 text-heading rounded hover:bg-neutral-tertiary md:hover:bg-transparent md:border-0 md:hover:text-fg-brand md:p-0">Login</a>
                                </li>
                                @if (Route::has('register'))
                                    <li>
                                        <a href="{{ route('register') }}" class="block py-2 px-3 text-heading rounded hover:bg-neutral-tertiary md:hover:bg-transparent md:border-0 md:hover:text-fg-brand md:p-0">Register</a>
                                    </li>
                                @endif
                            @endauth
                        </ul>
                    </div>
                </div>
            </nav>
        @endif
    </header>

    <main class="mt-24">
        <!-- Hero Section -->
        <section class="bg-gradient-to-r from-purple-50 to-pink-50 py-20 px-3 md:px-16">
            <div class="max-w-screen-xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Elevate Your Style with Premium Hijabs
                </h1>
                <p class="text-lg text-gray-600 mb-8">
                    Discover our collection of elegant and comfortable hijabs
                </p>
                <a href="#products" class="inline-block bg-purple-600 text-white px-8 py-3 rounded-lg hover:bg-purple-700 transition">
                    Shop Now
                </a>
            </div>
        </section>

        <!-- Featured Products Section -->
        <section id="featured" class="flex flex-col items-center py-16 px-3 md:px-16">
            <div class="border border-purple-400 rounded-full px-4 py-2 bg-purple-400/30 backdrop-blur-md text-center text-purple-600"
                style="width: 150px;">
                <p class="text-xs font-bold">✨ Featured</p>
            </div>
            <h2 class="font-semibold text-3xl my-4 text-center text-gray-900">Featured Products</h2>
            <p class="text-gray-600 text-center max-w-2xl mb-8">
                Handpicked selection of our best-selling hijabs
            </p>

            <div class="product-list grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-8 max-w-screen-xl w-full">
                @forelse($featuredProducts as $product)
                    <a href="#" class="group">
                        <div class="product relative w-full h-[400px] overflow-hidden rounded-lg shadow-lg">
                            @if($product->main_image)
                                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110"
                                    style="background-image: url('{{ asset('storage/' . $product->main_image) }}');">
                                </div>
                            @else
                                <div class="absolute inset-0 bg-gray-200 flex items-center justify-center">
                                    <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif

                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-black/40"></div>

                            <!-- Badges -->
                            <div class="absolute top-4 left-4 z-10 flex flex-col gap-2">
                                @if($product->isOnSale())
                                    <span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                                        {{ $product->getDiscountPercentage() }}% OFF
                                    </span>
                                @endif
                                @if(!$product->availability)
                                    <span class="bg-gray-800 text-white px-3 py-1 rounded-full text-xs font-bold">
                                        Out of Stock
                                    </span>
                                @endif
                            </div>

                            <div class="relative z-10 flex flex-col justify-end h-full p-6 text-white">
                                <div class="flex items-center gap-2 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 256">
                                        <path d="M224,177.32V78.68a16,16,0,0,0-8.32-14l-88-49.5a16,16,0,0,0-15.36,0l-88,49.5a16,16,0,0,0-8.32,14v98.64a16,16,0,0,0,8.32,14l88,49.5a16,16,0,0,0,15.36,0l88-49.5A16,16,0,0,0,224,177.32Z"/>
                                    </svg>
                                    <p class="text-sm">{{ $product->category->name }}</p>
                                </div>
                                <div class="flex items-center justify-between gap-3">
                                    <div>
                                        <h3 class="text-2xl font-bold mb-1">{{ $product->name }}</h3>
                                        <div class="flex items-center gap-2">
                                            @if($product->isOnSale())
                                                <span class="line-through text-gray-300 text-sm">
                                                    Rp {{ number_format($product->original_price, 0, ',', '.') }}
                                                </span>
                                                <span class="text-xl font-bold text-yellow-400">
                                                    Rp {{ number_format($product->getFinalPrice(), 0, ',', '.') }}
                                                </span>
                                            @else
                                                <span class="text-xl font-bold">
                                                    Rp {{ number_format($product->getFinalPrice(), 0, ',', '.') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256">
                                        <path d="M200,64V168a8,8,0,0,1-16,0V83.31L69.66,197.66a8,8,0,0,1-11.32-11.32L172.69,72H88a8,8,0,0,1,0-16H192A8,8,0,0,1,200,64Z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-500 text-lg">No featured products available at the moment.</p>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- All Products Section -->
        <section id="products" class="flex flex-col items-center py-16 px-3 md:px-16 bg-gray-50">
            <div class="border border-blue-400 rounded-full px-4 py-2 bg-blue-400/30 backdrop-blur-md text-center text-blue-600"
                style="width: 150px;">
                <p class="text-xs font-bold">🛍️ Shop All</p>
            </div>
            <h2 class="font-semibold text-3xl my-4 text-center text-gray-900">Our Products</h2>
            <p class="text-gray-600 text-center max-w-2xl mb-8">
                Browse our complete collection of premium hijabs
            </p>

            <div class="product-list grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-8 max-w-screen-xl w-full">
                @forelse($products as $product)
                    <a href="#" class="group">
                        <div class="product bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 group-hover:scale-105">
                            <div class="relative w-full h-[300px] overflow-hidden">
                                @if($product->main_image)
                                    <img src="{{ asset('storage/' . $product->main_image) }}" 
                                        alt="{{ $product->name }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif

                                <!-- Badges -->
                                <div class="absolute top-3 right-3 flex flex-col gap-2">
                                    @if($product->isOnSale())
                                        <span class="bg-red-500 text-white px-2 py-1 rounded text-xs font-bold">
                                            -{{ $product->getDiscountPercentage() }}%
                                        </span>
                                    @endif
                                    @if(!$product->availability)
                                        <span class="bg-gray-800 text-white px-2 py-1 rounded text-xs font-bold">
                                            Sold Out
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="p-4">
                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">{{ $product->category->name }}</p>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $product->name }}</h3>
                                
                                <div class="flex items-center gap-2 mb-3">
                                    @if($product->isOnSale())
                                        <span class="line-through text-gray-400 text-sm">
                                            Rp {{ number_format($product->original_price, 0, ',', '.') }}
                                        </span>
                                        <span class="text-lg font-bold text-red-600">
                                            Rp {{ number_format($product->getFinalPrice(), 0, ',', '.') }}
                                        </span>
                                    @else
                                        <span class="text-lg font-bold text-gray-900">
                                            Rp {{ number_format($product->getFinalPrice(), 0, ',', '.') }}
                                        </span>
                                    @endif
                                </div>

                                @if($product->size || $product->material)
                                    <div class="flex gap-2 text-xs text-gray-500">
                                        @if($product->material)
                                            <span>{{ $product->material }}</span>
                                        @endif
                                        @if($product->size)
                                            <span>• {{ $product->size }}</span>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-4 text-center py-12">
                        <p class="text-gray-500 text-lg">No products available at the moment.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($products->hasPages())
                <div class="mt-12">
                    {{ $products->links() }}
                </div>
            @endif
        </section>
    </main>

    <footer class="py-16 text-center text-sm text-gray-600 bg-gray-100">
        <div class="max-w-screen-xl mx-auto px-4">
            <p class="mb-2 font-semibold text-gray-900">Etoile Scarf</p>
            <p>Your Premium Hijab Collection</p>
            <p class="mt-4">&copy; {{ date('Y') }} Etoile Scarf. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>