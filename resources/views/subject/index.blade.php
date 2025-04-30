<x-app-layout title="Subjects">
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
            Subjects
        </h1>
    </x-slot>
        <x-mine.datas :$datas  index="{{route('subjects.all')}}">
            <x-mine.crud
            :search="route('subjects.index')"
            :addTitle="'Add subject'"
            :addSub="'add a subject for the school.'"
            :addForm="'addSubject'"
            :addRoute="route('subjects.store')"
            :dellAllRoute="route('subjects.destroyAll')"
            :dellOneRoute="route('subjects.index')"
            :updateTitle="'Update subject'"
            :updateSub="'Update a subject of the school.'"
            :updateForm="'updateSubject'"
            :updateRoute="route('subjects.index')"
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
                    {{-- <a :href="`${index}/${data.id}`" x-text="data.name" ></a> --}}
                    <p x-text="data.name" ></p>
                </x-mine.td-cell-primary>
                <x-mine.td-cell txt="data.created_at"/>
            </x-slot>
            <x-slot name="addModal">
                <x-mine.input title="subject name"/>
            </x-slot>

            <x-slot name="upModal">
                <x-mine.input title="section name" value="toEdit.name" class="capitalize"/>
            </x-slot>
            </x-mine.crud>
        </x-mine.datas>
</x-app-layout>
