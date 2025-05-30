@props(['txt', 'cap' => true])

@php
    if ($cap) {
        $class = "px-6 py-3 capitalize";
    }else {
        $class = "px-6 py-3";
    }
@endphp

<td scope="col" class="{{$class}}" x-text="{{$txt}}">

</td>
