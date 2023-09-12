<x-app-layout title="Test">
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
            Test
        </h1>
    </x-slot>
    <x-mine.bg-container>
        <x-mine.card-container class="p-5 sm:p-9">
            {{$score}}
        </x-mine.card-container>

    </x-mine.bg-container>
</x-app-layout>
