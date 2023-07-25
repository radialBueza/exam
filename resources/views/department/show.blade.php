<x-app-layout :title="$data->name">
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            {{$data->name}}
        </h1>
    </x-slot>
</x-app-layout>
