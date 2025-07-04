<x-app-layout title="Departments">
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
            Departments
        </h1>
    </x-slot>
        <x-mine.datas :$datas index="{{route('departments.all')}}">
            <x-mine.crud
                :search="route('departments.index')"
                :addTitle="'Add Department'"
                :addSub="'add a department for the school.'"
                :addForm="'addDept'"
                :addRoute="route('departments.store')"
                :dellAllRoute="route('departments.destroyAll')"
                :dellOneRoute="route('departments.index')"
                :updateTitle="'Update Department'"
                :updateSub="'Update a department of the school.'"
                :updateForm="'updateDept'"
                :updateRoute="route('departments.index')"
            >
                <x-slot name="thead">
                    <x-mine.th-cell col="name">
                        name
                    </x-mine.th-cell>
                    <x-mine.th-cell col="created_at">
                        created on
                    </x-mine.th-cell>
                </x-slot>
                <x-slot name="table">
                    <x-mine.td-cell-primary>
                        <a :href="`${index}/${data.id}?page=${curPage}`" x-text="data.name" ></a>
                    </x-mine.td-cell-primary>
                    <x-mine.td-cell txt="data.created_at"/>
                </x-slot>
                <x-slot name="addModal">
                    <x-mine.input title="department name"/>
                </x-slot>

                <x-slot name="upModal">
                    <x-mine.input title="department name" class="capitalize" value="toEdit.name"/>
                </x-slot>
            </x-mine.crud>
        </x-mine.datas>
</x-app-layout>
