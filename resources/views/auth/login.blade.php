<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}" class="max-w-md mx-auto">
            @csrf

            <div class="relative z-0 w-full mb-5 group">
                <x-input id="floating_email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-label for="floating_email" value="{{ __('Email') }}" />
            </div>

            <div class="relative z-0 w-full mb-5 group">
                <x-input id="floating_password" type="password" name="password" required autocomplete="current-password" />
                <x-label for="floating_password" value="{{ __('Password') }}" />
            </div>

            <div class="relative z-0 w-full mb-5 group">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="relative z-0 w-full mb-5 group">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ms-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
