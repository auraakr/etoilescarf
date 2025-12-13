<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{ route('admin.users.store') }}" method="POST" class="p-8">
                    @csrf

                    {{-- Alert Error --}}
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

                    <div class="grid grid-cols-1 gap-6">
                        <!-- Name -->
                        <div class="relative z-0 w-full group">
                            <x-input id="name" type="text" name="name" :value="old('name')" required autofocus />
                            <x-label for="name" value="{{ __('Name') }}" />
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="relative z-0 w-full group">
                            <x-input id="email" type="email" name="email" :value="old('email')" required />
                            <x-label for="email" value="{{ __('Email') }}" />
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="relative z-0 w-full group">
                            <x-input id="password" type="password" name="password" required />
                            <x-label for="password" value="{{ __('Password') }}" />
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="relative z-0 w-full group">
                            <x-input id="password_confirmation" type="password" name="password_confirmation" required />
                            <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                        </div>

                        <div class="relative z-0 w-full group">
                            <x-select 
                                id="role" 
                                name="role" 
                                :options="$roles"
                                :selected="old('role', '')"
                                placeholder="Pilih Role"
                                required
                            />
                            <x-label for="role" value="{{ __('Role') }}" />
                            @error('role')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6 gap-4">
                        <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-gray-900">
                            Cancel
                        </a>
                        <button type="submit" class="text-body box-border border border-default-medium hover:bg-blue-600 hover:text-blue-50 focus:ring-4 focus:ring-blue-600 shadow-xs font-medium rounded text-sm px-4 py-2.5 focus:outline-none">
                            Tambah user
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>