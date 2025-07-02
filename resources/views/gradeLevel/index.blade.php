<x-app-layout title="Grade Levels">
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
            Grade Levels
        </h1>
    </x-slot>
        <x-mine.datas :$datas index="{{route('gradeLevels.all')}}">
            <x-mine.crud
                :search="route('gradeLevels.index')"
                :addTitle="'add grade level'"
                :addSub="'Add a grade level for the school.'"
                :addForm="'addGradeLevel'"
                :inputs="['name', 'department_id']"
                :addRoute="route('gradeLevels.store')"
                :dellAllRoute="route('gradeLevels.destroyAll')"
                :dellOneRoute="route('gradeLevels.index')"
                :updateTitle="'update grade level'"
                :updateSub="'Update a grade level of the school.'"
                :updateForm="'updateGradeLevel'"
                :updateRoute="route('gradeLevels.index')"
            >
                <x-slot name="thead">
                    <x-mine.th-cell col="name">
                        name
                    </x-mine.th-cell>
                    <x-mine.th-cell col="department_name">
                        department
                    </x-mine.th-cell>
                    <x-mine.th-cell col="created_at">
                        created on
                    </x-mine.th-cell>
                </x-slot>
                <x-slot name="table">
                    <x-mine.td-cell-primary>
                        <a :href="`${index}/${data.id}?page=${curPage}`" x-text="data.name" ></a>
                    </x-mine.td-cell-primary>
                    <x-mine.td-cell txt="data.department_name"/>
                    <x-mine.td-cell txt="data.created_at"/>
                </x-slot>
                <x-slot name="addModal">
                    <x-mine.input title="grade level name"/>
                    <x-mine.select-input name="department_id" title="Department" :$options/>
                </x-slot>

                <x-slot name="upModal">
                    <x-mine.input title="grade level name" value="toEdit.name" class="capitalize"/>
                    <x-mine.select-input name="department_id" title="Department" :$options selected="toEdit.department_id" />
                </x-slot>
            </x-mine.crud>
        </x-mine.datas>
</x-app-layout>
