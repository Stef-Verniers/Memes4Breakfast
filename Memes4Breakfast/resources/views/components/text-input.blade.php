@props([
    'disabled' => false,
    'required' => true
])

<input  {{ $disabled ? 'disabled' : '' }} 
        {{ $required ? 'required' : '' }} 
        {!! $attributes->merge(['class' => 'text-black border-t-0 border-x-0 border-b-2']) !!}
>
