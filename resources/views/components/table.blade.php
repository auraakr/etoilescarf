<!-- Source - https://stackoverflow.com/a
Posted by Alex
Retrieved 2025-12-01, License - CC BY-SA 4.0 -->

@props(['header'])

<div class="relative overflow-x-auto">
    <table {{ $attributes->merge(['class' => "w-full text-sm text-left rtl:text-right text-body"]) }}>
        <thead class="text-sm text-body bg-gray-200 border-b border-default-medium text-gray-500">
            <tr>
                {{ $header }}
            </tr>
        </thead>

        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>
