@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center px-2 py-1.5 text-body text-gray-900 rounded-base hover:text-blue-500 group'
            : 'flex items-center px-2 py-1.5 text-body text-gray-500 rounded-base hover:text-blue-500 group';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
