<x-app-layout title="Grade Levels">
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
            Grade Levels
        </h1>
    </x-slot>
        <x-mine.datas :$datas index="{{route('gradeLevels.all')}}">
            <x-mine.crud>
                <x-mine.bg-container>
                    <x-mine.card-container>
                        <x-mine.cdp pdfUrl=" "/>
                        <x-mine.search url="{{route('gradeLevels.index')}}"/>
                        <x-mine.table>
                            <x-mine.table-multi-del-sel url="{{route('gradeLevels.index')}}">
                                <x-mine.clean-table>
                                    <x-slot name="thead">
                                        <th scope="col" class="px-6 py-3"><input type="checkbox" :checked="toDelete.items.length == datas?.length  && datas.length != 0" @click="selectAll()"></th>
                                        <x-mine.th-cell col="name">
                                            name
                                        </x-mine.th-cell>
                                        <x-mine.th-cell col="department_name">
                                            department
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
                                    <x-mine.td-cell txt="data.department_name"/>
                                    <x-mine.td-cell txt="data.created_at"/>
                                    <x-slot name="action">
                                        <x-mine.td-action/>
                                    </x-slot>
                                </x-mine.clean-table>
                            </x-mine.table-multi-del-sel>
                        </x-mine.table>
                    </x-mine.card-container>
                </x-mine.bg-container>

                @php
                    $title="add grade level";
                    $subtitle="Add a grade level for the school.";
                    $form ="addGradeLevel";
                    $inputs = ['name', 'department_id'];
                @endphp
                <x-mine.modal open="openAdd">
                    <x-mine.form-modal :title="$title" :subtitle="$subtitle" :form="$form"
                    :inputs="$inputs" url="{{route('gradeLevels.store')}}">
                        <x-mine.input title="grade level name"/>
                        <x-mine.select-input name="{{$inputs[1]}}" title="Department" :$options/>
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
                    $subtitle="Update a grade level of the school.";
                    $form ="updateGradeLevel";
                @endphp
                <x-mine.modal open="openEdit">
                    <x-mine.form-modal :title="$title" :subtitle="$subtitle" :form="$form" :inputs="$inputs" url="{{route('gradeLevels.index')}}/${toEdit.id}">
                        <x-mine.input title="grade level name" value="toEdit.name" class="capitalize"/>
                        <x-mine.select-input name="{{$inputs[1]}}" title="Department" :$options selected="toEdit.department_id" />
                        <x-slot name="buttons">
                            <x-mine.submit-button class="justify-end">
                                <x-mine.button type="submit" class="border-transparent border text-white bg-green-600 focus:ring-green-600 hover:bg-green-500 focus:bg-green-500 active:bg-green-700">
                                    {{$title}}
                                </x-mine.button>
                            </x-mine.submit-button>
                        </x-slot>
                    </x-mine.form-modal>
                </x-mine.modal>
            </x-mine.crud>
        </x-mine.datas>
</x-app-layout>
