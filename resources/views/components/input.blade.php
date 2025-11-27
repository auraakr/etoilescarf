@props(['disabled' => false])

<input placeholder=" " {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block py-2.5 px-0 w-full text-sm text-heading bg-transparent border-0 border-b-2 border-default-medium appearance-none focus:outline-none focus:ring-0 focus:border-brand peer']) !!}>
