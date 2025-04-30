<x-app-layout title="Sections">
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
            Sections
        </h1>
    </x-slot>
        <x-mine.datas :$datas index="{{route('sections.all')}}">
            <x-mine.crud
                :search="route('sections.index')"
                :addTitle="'add section'"
                :addSub="'add a section for the school.'"
                :addForm="'addSection'"
                :inputs="['name', 'grade_level_id']"
                :addRoute="route('sections.store')"
                :dellAllRoute="route('sections.destroyAll')"
                :dellOneRoute="route('sections.index')"
                :updateTitle="'Update section'"
                :updateSub="'update a section of the school.'"
                :updateForm="'updateSection'"
                :updateRoute="route('sections.index')"
            >
                <x-slot name="thead">
                    <x-mine.th-cell col="name">
                        name
                    </x-mine.th-cell>
                    <x-mine.th-cell col="grade_level_name">
                        grade level
                    </x-mine.th-cell>
                    <x-mine.th-cell col="created_at">
                        created on
                    </x-mine.th-cell>
                </x-slot>
                <x-slot name="table">
                    <x-mine.td-cell-primary>
                        <a :href="`${index}/${data.id}`" x-text="data.name" ></a>
                    </x-mine.td-cell-primary>
                    <x-mine.td-cell txt="data.grade_level_name"/>
                    <x-mine.td-cell txt="data.created_at"/>
                </x-slot>
                <x-slot name="addModal">
                    <x-mine.input title="Section name"/>
                    <x-mine.select-input name="grade_level_id" title="Grade Level" :$options/>
                </x-slot>
                <x-slot name="upModal">
                    <x-mine.input title="section name" value="toEdit.name" class="capitalize"/>
                    <x-mine.select-input name="grade_level_id" title="Grade Level" :$options selected="toEdit.grade_level_id"/>
                </x-slot>
            </x-mine.crud>
        </x-mine.datas>
</x-app-layout>
