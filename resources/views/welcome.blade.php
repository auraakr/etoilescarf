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
        <nav class="bg-neutral-primary fixed w-full z-20 top-0 start-0 border-b border-default">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <img src="https://flowbite.com/docs/images/logo.svg" class="h-7" alt="Flowbite Logo" />
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
                            <a href="{{ url('/dashboard') }}" class="block py-2 px-3 text-white bg-brand rounded md:bg-transparent md:text-fg-brand md:p-0" aria-current="page">Dashboard</a>
                        </li>
                        @else
                        <li>
                            <a href="{{ route('login') }}" class="block py-2 px-3 text-heading rounded hover:bg-neutral-tertiary md:hover:bg-transparent md:border-0 md:hover:text-fg-brand md:p-0 md:dark:hover:bg-transparent">Login</a>
                        </li>
                        @if (Route::has('register'))
                        <li>
                            <a href="{{ route('register') }}" class="block py-2 px-3 text-heading rounded hover:bg-neutral-tertiary md:hover:bg-transparent md:border-0 md:hover:text-fg-brand md:p-0 md:dark:hover:bg-transparent">Register</a>
                        </li>
                        @endif
                    @endauth
                    </ul>
                </div>
            </div>
        </nav>
    @endif
    </header>

    <main class="mt-6">

    </main>

    <footer class="py-16 text-center text-sm text-black">
    </footer>
</body>

</html>