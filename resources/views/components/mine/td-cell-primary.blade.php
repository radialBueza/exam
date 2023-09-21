@props(['isLink' => true])
@php
    $class = ($isLink) ? 'px-6 py-4 font-medium text-gray-900 whitespace-nowrap capitalize hover:underline hover:text-gray-700' : 'px-6 py-4 font-medium text-gray-900 whitespace-nowrap capitalize'
@endphp
<td class="{{$class}}">
    {{$slot}}
</td>
