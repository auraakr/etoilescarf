<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h1 class="text-2xl">Tabel User</h1>
                <table class="min-w-full divide-y divide-gray-200">
                    <tr>
                        <th class="px-6 py-3 bg-gray-0 text-left text-xs font0medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 bg-gray-0 text-left text-xs font0medium text-gray-500 uppercase tracking-wider">Email</th>
                    </tr>
                    @foreach ( $users as $user )
                    <tr>
                        <td class="px-6 py-3 whitespace-nowrap">{{ $user->name }}</td>
                        <td class="px-6 py-3 whitespace-nowrap">{{ $user->email }}</td>
                    </tr> 
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
