<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users Management') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-5">
            <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-sm">
                <x-table>
                    <x-slot:header>
                        <th class="px-6 py-3 font-medium">ID</th>
                        <th class="px-6 py-3 font-medium">Nama</th>
                        <th class="px-6 py-3 font-medium">Email</th>
                        <th class="px-6 py-3 font-medium">Action</th>
                    </x-slot:head>

                    @foreach ($users as $user)
                        <tr class="bg-neutral-primary-soft border-b border-default hover:bg-neutral-secondary-medium">
                            <td class="px-6 py-3">{{ $user->id }}</td>
                            <td class="px-6 py-3">{{ $user->email }}</td>
                            <td class="px-6 py-3">{{ $user->email }}</td>
                        </tr>
                    @endforeach
                </x-table>
                <!-- <table class="min-w-full divide-y divide-gray-200">
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
                </table> -->
            </div>
        </div>
    </div>
</x-app-layout>
