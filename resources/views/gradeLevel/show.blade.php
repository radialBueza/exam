<x-app-layout title="Grade Level | {{$info->name}}">
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
            Grade Level | {{$info->name}}
        </h1>
    </x-slot>
        <x-mine.datas :$datas index="{{route('sections.all')}}">
            <x-mine.crud
                :search="route('gradeLevels.show', $info->id)"
                :addTitle="'add section'"
                :addSub="'Add a section for the school.'"
                :addForm="'addSection'"
                {{-- :inputs="['name']" --}}
                :addRoute="route('gradeLevels.createFor', $info->id)"
                :dellAllRoute="route('sections.destroyAll')"
                :dellOneRoute="route('sections.index')"
                :updateTitle="'update section'"
                :updateSub="'Update a department of the school.'"
                :updateForm="'updateSection'"
                :updateRoute="route('gradeLevels.createFor', $info->id)"
            >
                <x-slot name="head">
                    <x-mine.card-container class="mb-4 sm:mb-6 p-5 sm:p-9">
                        <div>
                            <p class="text-xs font-thin text-slate-400 capitalize">{{$parent->name}}/</p>
                            <h2 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
                                {{$info->name}}
                            </h2>
                        </div>
                    </x-mine.card-container>
                </x-slot>
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
                    <x-mine.input title="section name"/>
                </x-slot>
                <x-slot name="upModal">
                    <x-mine.input title="section name" value="toEdit.name" class="capitalize"/>
                </x-slot>
            </x-mine.crud>
        </x-mine.datas>
</x-app-layout>
