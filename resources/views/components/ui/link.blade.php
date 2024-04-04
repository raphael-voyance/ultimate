@props(['active', 'label' => '', 'href'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-200 hover:text-gray-200 focus:outline-none focus:border-gray-200 focus:text-gray-200 transition duration-150 ease-in-out cursor-default'
            : 'inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-400 hover:text-gray-200 hover:border-gray-300 focus:outline-none focus:text-gray-200 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes, 'href' => $href]) }}>
    {{ $label }}
</a>
