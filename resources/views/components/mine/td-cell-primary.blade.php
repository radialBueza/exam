@props(['isLink' => true])
{{-- @php
    $class = ($isLink) ? 'text-ellipsis max-w-36 px-6 py-4 font-medium text-gray-900 whitespace-nowrap capitalize hover:underline hover:text-gray-700' : 'text-ellipsis max-w-36 px-6 py-4 font-medium text-gray-900 whitespace-nowrap capitalize'
@endphp --}}
{{-- <td class="{{$class}}">
    {{$slot}}
</td> --}}
@php
    $class = ($isLink) ? 'text-ellipsis overflow-hidden px-6 py-4 font-medium text-gray-900 whitespace-nowrap capitalize hover:underline hover:text-gray-700' : 'text-ellipsis overflow-hidden px-6 py-4 font-medium text-gray-900 whitespace-nowrap capitalize'
@endphp
<td {{ $attributes->merge(['class' => "{$class}"])}}>
    {{$slot}}
</td>
