@props(['maxWidth' => '7xl'])

@php
    switch ($maxWidth) {
        case '7xl':
            $maxWidth = "max-w-7xl";
            break;
        case '6xl':
            $maxWidth = "max-w-6x";
            break;
        case '5xl':
            $maxWidth = "max-w-5xl";
            break;
        case '4xl':
            $maxWidth = "max-w-4xl";
            break;
        case '3xl':
            $maxWidth = "max-w-3xl";
            break;
        case '2xl':
            $maxWidth = "max-w-2xl";
            break;
        case 'xl':
            $maxWidth = "max-w-xl";
            break;
    }
@endphp

<div {{$attributes->merge(['class' => 'mx-auto sm:px-6 lg:px-8 ' . $maxWidth])}}>
    {{$slot}}
</div>
