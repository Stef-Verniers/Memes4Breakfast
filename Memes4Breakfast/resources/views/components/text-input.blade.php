@props([
    'disabled' => false,
    'required' => true
])

<label for="{{ $name }}" {!! $attributes->merge(['class' => 'block text-gray-400 text-sm pl-2 mt-10']) !!}>{{ $slot }}</label>
<input  {{ $disabled ? 'disabled' : '' }} 
        {{ $required ? 'required' : '' }} 
        {!! $attributes->merge(['class' => 'text-black border-t-0 border-x-0 border-b-2']) !!} name="{{ $name }}"
>
