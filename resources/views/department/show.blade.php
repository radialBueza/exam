<x-app-layout title="Department | {{$info->name}}">
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
            Department | {{$info->name}}
        </h1>
    </x-slot>
        <x-mine.datas :$datas index="{{route('gradeLevels.all')}}">
            <x-mine.crud
                :search="route('departments.show', $info->id)"
                :addTitle="'add grade level'"
                :addSub="'Add a grade level for the school.'"
                :addForm="'addGradeLevel'"
                :addRoute="route('departments.createFor', $info->id)"
                :dellAllRoute="route('gradeLevels.destroyAll')"
                :dellOneRoute="route('gradeLevels.index')"
                :updateTitle="'update grade level'"
                :updateSub="'Update a department of the school.'"
                :updateForm="'updateGradeLevel'"
                :updateRoute="route('departments.createFor', $info->id)"
            >
                <x-slot name="head">
                    <x-mine.card-container class="mb-4 sm:mb-6 p-5 sm:p-9" >
                        <div>
                            <h2 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
                                {{$info->name}}
                            </h2>
                            <p class="font-light text-xs capitalize"><span class="font-medium">Administrator:</span>
                            @if (empty($admin))
                                {{'N/A'}}
                            @else
                                {{$admin->name}}
                            @endif
                            </p>
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
                    <x-mine.input title="grade level name"/>
                </x-slot>

                <x-slot name="upModal">
                    <x-mine.input title="grade level name" class="capitalize" value="toEdit.name"/>
                </x-slot>
            </x-mine.crud>
        </x-mine.datas>
</x-app-layout>
