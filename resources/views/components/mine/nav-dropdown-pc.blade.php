@props(['active'])


@php
$classes = ($active ?? false)
            ? 'px-1 pt-1 h-full inline-flex items-center border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'px-1 pt-1 h-full inline-flex items-center border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp


    <button @click="open = !open" @mouseenter="open = true" @mouseleave="open = false" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>
