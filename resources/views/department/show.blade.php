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
                :addForm="addGradeLevel"
                :inputs="['name', 'department_id', 'show']"
                :addRoute="route('departments.createFor', $info->id)"
                :dellAllRoute="route('gradeLevels.destroyAll')"
                :dellOneRoute="route('departments.createFor', $info->id)"
                :updateTitle="'update grade level'"
                :updateSub="'Update a department of the school.'"
                :updateForm="'updateGradeLevel'"
                :updateRoute="route('departments.createFor', $info->id)"
            >>
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
                <x-slot>
                    <x-mine.card-container class="p-5 sm:p-9">
                        <x-mine.cdp/>
                        <x-mine.search url="{{route('departments.show', $info->id)}}"/>
                        <x-mine.table>
                            {{-- <x-mine.table-multi-del-sel url="{{route('gradeLevels.index')}}"> --}}
                                <x-mine.clean-table>
                                    <x-slot name="thead">
                                        <th scope="col" class="px-6 py-3"><input type="checkbox" :checked="toDelete.items.length == datas?.length  && datas.length != 0" @click="selectAll()"></th>
                                        <x-mine.th-cell col="name">
                                            name
                                        </x-mine.th-cell>
                                        <x-mine.th-cell col="created_at">
                                            created on
                                        </x-mine.th-cell>
                                        <th scope="col" class="px-6 py-3"></th>
                                    </x-slot>
                                    <td class="px-6 py-3"><input type="checkbox" :checked="toDelete.items.includes(data.id)" @click="addDelete(data.id)"></td>
                                    <x-mine.td-cell-primary>
                                        <a :href="`${index}/${data.id}`" x-text="data.name" ></a>
                                    </x-mine.td-cell-primary>
                                    <x-mine.td-cell txt="data.created_at"/>
                                    <x-slot name="action">
                                        <x-mine.td-action/>
                                    </x-slot>
                                </x-mine.clean-table>
                            {{-- </x-mine.table-multi-del-sel> --}}
                        </x-mine.table>
                    </x-mine.card-container>
                    @php
                    $title="add grade level";
                    $subtitle="Add a grade level for the school.";
                    $form="addGradeLevel";
                    $inputs=['name', 'department_id', 'show'];
                    @endphp
                    <x-mine.modal open="openAdd">
                        <x-mine.form-modal :title="$title" :subtitle="$subtitle" :form="$form"
                        :inputs="$inputs" url="{{route('departments.createFor', $info->id)}}">
                            <x-mine.input title="grade level name"/>
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
                        <x-mine.form-modal :title="$title" :subtitle="$subtitle" :form="$form" :inputs="$inputs" url="{{route('departments.createFor', $info->id)}}/${toEdit.id}">
                            <x-mine.input title="grade level name" value="toEdit.name" class="capitalize"/>
                            <x-slot name="buttons">
                                <x-mine.submit-button class="justify-end">
                                    <x-mine.button type="submit" class="border-transparent border text-white bg-green-600 focus:ring-green-600 hover:bg-green-500 focus:bg-green-500 active:bg-green-700">
                                        {{$title}}
                                    </x-mine.button>
                                </x-mine.submit-button>
                            </x-slot>
                        </x-mine.form-modal>
                    </x-mine.modal>
                </x-mine.bg-container>
            </x-mine.crud>
        </x-mine.datas>
</x-app-layout>
