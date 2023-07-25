<x-app-layout title="Departments">
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            Department
        </h1>
    </x-slot>
    <x-mine.crud-table-container :$datas url="{{route('departments.index')}}">
        <x-mine.bg-container>
            <x-mine.card-container>
                <x-mine.cdp pdfUrl=" "/>
            </x-mine.card-container>
            <x-mine.card-container>
                <x-mine.search/>
                <x-mine.table/>
            </x-mine.card-container>
        </x-mine.bg-container>
    </x-mine.crud-table-container>
</x-app-layout>
