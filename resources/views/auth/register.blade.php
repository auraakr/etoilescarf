<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" class="max-w-md mx-auto">
            @csrf

            <div class="relative z-0 w-full mb-5 group">
                <x-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-label for="name" value="{{ __('Name') }}" />
            </div>

            <div class="relative z-0 w-full mb-5 group">
                <x-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-label for="email" value="{{ __('Email') }}" />
            </div>

            <div class="relative z-0 w-full mb-5 group">
                <x-input id="password" type="password" name="password" required autocomplete="new-password" />
                <x-label for="password" value="{{ __('Password') }}" />
            </div>

            <div class="relative z-0 w-full mb-5 group">
                <x-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
