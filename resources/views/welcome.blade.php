<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Etoile Scarf | Your Premium Hijab</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,200..800&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

</head>

<body class="font-heading antialiased bg-primary">
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
                            <a class="font-light no-underline text-gray-600 hover:text-orange-600 hover:border-b hover:border-orange-600" href="#">Featured Products</a>
                        </li>
                        <li>
                            <a class="font-light no-underline text-gray-600 hover:text-orange-600 hover:border-b hover:border-orange-600" href="#">Arabian Collection</a>
                        </li>
                        <li>
                            <a class="font-light no-underline text-gray-600 hover:text-orange-600 hover:border-b hover:border-orange-600" href="#">SALE</a>
                        </li>
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

    <main class="">
        <!-- HERO -->
        <section id="hero" class="h-screen p-4 md:px-16">
            <img class="h-3/4 md:h-2/3 w-full object-cover object-center" src="images/hero2.jpg" alt="">
            <div class="grid lg:grid-cols-3 gap-2 lg:gap-0 items-center mt-2">
                <h1 class="col-span-2 text-5xl md:text-6xl xl:text-8xl">Elevate your style <br>with Premium Hijab</h1>
                <p class="text-base text-justify font-light"><i>About Us:</i><br>Etoile Scarf adalah destinasi hijab premium Anda, didirikan oleh Mia Higiawati untuk menghadirkan keanggunan dan kenyamanan tak tertandingi di setiap helaian. Kami hanya menyajikan yang terbaik.</p>
            </div>
        </section>

        <!-- FEATURED SECTION -->
        <section id="featured" class="px-4 py-32 md:p-20">
            <h1 class="text-5xl my-1">Featured Hijab</h1>
            <p></p>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-2 justify-between">
                @forelse($featuredProducts as $product)
                    <a href="{{ route('product.show', $product->slug) }}" class="group">
                        <div class="product relative w-full h-[400px] overflow-hidden rounded-sm">
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
                            <div class="absolute inset-0 bg-black/20"></div>

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
                        </div>
                    </a>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-500 text-lg">No featured products available at the moment.</p>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- WHY US -->
        <section id="why" class="bg-neutral-primary-medium">
            <div class="flex h-[400px]">
                <img class="w-2/3 object-cover" src="images/hero.jpg" alt="img why">
                <img class="w-1/3" src="images/whyus.jpg" alt="img why">
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 px-16 py-8">
                <div class="p-3 border border-gray-200 rounded-sm">
                    <div class="icon p-3 rounded-lg bg-blue-100 border border-blue-200" style="width: 45px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#0759c5" viewBox="0 0 256 256"><path d="M80.57,117A8,8,0,0,1,91,112.57l29,11.61V96a8,8,0,0,1,16,0v28.18l29-11.61A8,8,0,1,1,171,127.43l-30.31,12.12L158.4,163.2a8,8,0,1,1-12.8,9.6L128,149.33,110.4,172.8a8,8,0,1,1-12.8-9.6l17.74-23.65L85,127.43A8,8,0,0,1,80.57,117ZM224,56v56c0,52.72-25.52,84.67-46.93,102.19-23.06,18.86-46,25.27-47,25.53a8,8,0,0,1-4.2,0c-1-.26-23.91-6.67-47-25.53C57.52,196.67,32,164.72,32,112V56A16,16,0,0,1,48,40H208A16,16,0,0,1,224,56Zm-16,0L48,56l0,56c0,37.3,13.82,67.51,41.07,89.81A128.25,128.25,0,0,0,128,223.62a129.3,129.3,0,0,0,39.41-22.2C194.34,179.16,208,149.07,208,112Z"></path></svg>
                    </div>
                    <h2 class="font-oswald font-regular text-lg mt-3">Premium Material</h2>
                    <p>Material yang digunakan adalah bahan eksklusif.</p>
                </div>
                <div class="p-3 border border-gray-200 rounded-sm">
                    <div class="icon p-3 rounded-lg bg-orange-100 border border-orange-200" style="width: 45px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#B45309" viewBox="0 0 256 256"><path d="M223.45,40.07a8,8,0,0,0-7.52-7.52C139.8,28.08,78.82,51,52.82,94a87.09,87.09,0,0,0-12.76,49c.57,15.92,5.21,32,13.79,47.85l-19.51,19.5a8,8,0,0,0,11.32,11.32l19.5-19.51C81,210.73,97.09,215.37,113,215.94q1.67.06,3.33.06A86.93,86.93,0,0,0,162,203.18C205,177.18,227.93,116.21,223.45,40.07ZM153.75,189.5c-22.75,13.78-49.68,14-76.71.77l88.63-88.62a8,8,0,0,0-11.32-11.32L65.73,179c-13.19-27-13-54,.77-76.71,22.09-36.47,74.6-56.44,141.31-54.06C210.2,114.89,190.22,167.41,153.75,189.5Z"></path></svg>    
                    </div>
                    <h2 class="font-oswald font-regular text-lg mt-3">Founded 2022</h2>
                    <p>Warisan & Pengalaman.</p>
                </div>
                <div class="p-3 border border-gray-200 rounded-sm">
                    <div class="icon p-3 rounded-lg bg-green-100 border border-green-200" style="width: 45px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#15803D" viewBox="0 0 256 256"><path d="M246,98.73l-56-64A8,8,0,0,0,184,32H72a8,8,0,0,0-6,2.73l-56,64a8,8,0,0,0,.17,10.73l112,120a8,8,0,0,0,11.7,0l112-120A8,8,0,0,0,246,98.73ZM222.37,96H180L144,48h36.37ZM74.58,112l30.13,75.33L34.41,112Zm89.6,0L128,202.46,91.82,112ZM96,96l32-42.67L160,96Zm85.42,16h40.17l-70.3,75.33ZM75.63,48H112L76,96H33.63Z"></path></svg>    
                    </div>
                    <h2 class="font-oswald font-regular text-lg mt-3">Easy Care</h2>
                    <p>Perawatan mudah & tahan lama.</p>
                </div>
            </div>
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