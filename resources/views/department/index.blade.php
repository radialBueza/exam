<x-app-layout title="Departments">
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
            Departments
        </h1>
    </x-slot>
        <x-mine.datas :$datas index="{{route('departments.all')}}">
            <x-mine.crud>
                <x-mine.bg-container>
                    <x-mine.card-container class="p-5 sm:p-9">
                        <x-mine.cdp/>
                        <x-mine.search url="{{route('departments.index')}}"/>
                        <x-mine.table>
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
                        </x-mine.table>
                    </x-mine.card-container>
                    @php
                    $title="Add Department";
                    $subtitle="add a department for the school.";
                    $form ="addDept";
                    @endphp
                    <x-mine.modal open="openAdd">
                        <x-mine.form-modal :title="$title" :subtitle="$subtitle" :form="$form" url="{{route('departments.store')}}"
                        >
                            <x-mine.input title="department name"/>
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
                        <x-mine.delete-modal delUrl="{{route('departments.destroyAll')}}"/>
                    </x-mine.modal>
                    <x-mine.modal open="openOneDel">
                        <x-mine.delete-one-modal delUrl="{{route('departments.index')}}"/>
                    </x-mine.modal>
                    @php
                        $title="Update Department";
                        $subtitle="Update a department of the school.";
                        $form="updateDept";
                    @endphp
                    <x-mine.modal open="openEdit">
                        <x-mine.form-modal :title="$title" :subtitle="$subtitle" :form="$form" url="{{route('departments.index')}}/${toEdit.id}">
                            <x-mine.input title="department name" class="capitalize" value="toEdit.name"/>
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
