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
                <x-mine.table>
                    <x-slot name="thead">
                        <x-mine.th-cell col="name">
                            name
                        </x-mine.th-cell>
                        <x-mine.th-cell col="created_at">
                            created
                        </x-mine.th-cell>
                    </x-slot>
                    <x-mine.td-cell-primary>
                        <a :href="`${url}/${data.id}`" x-text="data.name" ></a>
                    </x-mine.td-cell-primary>
                </x-mine.table>
                <x-mine.loading/>
            </x-mine.card-container>
        </x-mine.bg-container>
        <x-mine.modal open="openAdd">
            <mine-create-data>

            </mine-create-data>
        </x-mine.modal>

    </x-mine.crud-table-container>
</x-app-layout>
