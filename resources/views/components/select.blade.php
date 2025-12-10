<select 
    id="{{ $id }}" 
    name="{{ $name }}"
    {{ $attributes->merge([
        'class' => 'block py-2.5 ps-0 w-full text-sm text-body bg-transparent border-0 border-b-2 border-default-medium appearance-none focus:outline-none focus:ring-0 focus:border-brand peer ' . $class
    ]) }}
    @if($required) required @endif
>
    @if($placeholder)
        <option value="" {{ !$selected ? 'selected' : '' }}>{{ $placeholder }}</option>
    @endif
    
    @foreach($options as $value => $label)
        <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>
            {{ $label }}
        </option>
    @endforeach
</select>