<x-app-layout title="Department | {{$info->name}}">
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
            Department | {{$info->name}}
        </h1>
    </x-slot>
    <x-mine.bg-container>
        <x-mine.crud-table-container :$datas url="{{route('gradeLevels.index')}}" index="{{route('gradeLevels.all')}}">
            <x-mine.bg-container>
                <x-mine.card-container class="mb-6">
                    <div>
                        <h2 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
                            {{$info->name}}
                        </h2>
                        <p class="font-light text-xs"><span class="font-medium">Administrator:</span>
                        @if (empty($admin))
                            {{'N/A'}}
                        @else
                            {{$admin->name}}
                        @endif
                        </p>
                    </div>
                </x-mine.card-container>
                <x-mine.card-container>
                    <x-mine.cdp pdfUrl=" "/>
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
                            <a :href="`${index}/${data.id}`" x-text="data.name" ></a>
                        </x-mine.td-cell-primary>
                    </x-mine.table>
                    <x-mine.loading condition="!datas"/>
                </x-mine.card-container>
            </x-mine.bg-container>
            @php
                $title="add grade level";
                $subtitle="Add a grade level for the school.";
                $form="addGradeLevel";
                $inputs=['name', 'department_id', 'show'];
            @endphp
            <x-mine.modal open="openAdd">
                <x-mine.form-modal :title="$title" :subtitle="$subtitle" :form="$form"
                :inputs="$inputs">
                    <x-mine.text-input title="grade level name"/>
                    <input type="hidden" name="{{$inputs[1]}}" id="{{$inputs[1]}}" value="{{$info->id}}">
                    <input type="hidden" name="{{$inputs[2]}}" id="{{$inputs[2]}}" value="true">
                    <x-slot name="buttons">
                        <x-mine.submit-button class="justify-end">
                            <x-mine.button type="submit" class="border-transparent border text-white bg-green-600 focus:ring-green-600 hover:bg-green-500 focus:bg-green-500 active:bg-green-700">
                                {{$title}}
                            </x-mine.button>
                        </x-mine.submit-button>
                    </x-slot>
                </x-mine.form-modal>
            </x-mine.modal>
            <x-mine.modal open="openDel">
                <x-mine.delete-modal delUrl="{{route('gradeLevels.destroyAll')}}"/>
            </x-mine.modal>
            @php
                $title="update grade level";
                $subtitle="Update a department of the school.";
                $form="updateGradeLevel";
            @endphp
            <x-mine.modal open="openEdit">
                <x-mine.form-modal :title="$title" :subtitle="$subtitle" :form="$form" :inputs="$inputs" method="PUT" url="{{route('departments.index')}}/${toEdit.id}">
                    <x-mine.text-input title="grade level name" value="toEdit.name" class="capitalize"/>
                    <input type="hidden" name="{{$inputs[1]}}" id="{{$inputs[1]}}" value="{{$info->id}}">
                    <input type="hidden" name="{{$inputs[2]}}" id="{{$inputs[2]}}" value="true">
                    <x-slot name="buttons">
                        <x-mine.submit-button class="justify-end">
                            <x-mine.button type="submit" class="border-transparent border text-white bg-green-600 focus:ring-green-600 hover:bg-green-500 focus:bg-green-500 active:bg-green-700">
                                {{$title}}
                            </x-mine.button>
                        </x-mine.submit-button>
                    </x-slot>
                </x-mine.form-modal>
            </x-mine.modal>
        </x-mine.crud-table-container>
    </x-mine.bg-container>
</x-app-layout>
