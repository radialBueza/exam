<x-app-layout title="Grade Level | {{$info->name}}">
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
            Grade Level | {{$info->name}}
        </h1>
    </x-slot>
        <x-mine.datas :$datas index="{{route('sections.all')}}">
            <x-mine.crud>
                <x-mine.bg-container>
                    <x-mine.card-container class="mb-6">
                        <div>
                            <p class="text-xs font-thin text-slate-400 capitalize">{{$parent->name}}/</p>
                            <h2 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
                                {{$info->name}}
                            </h2>
                        </div>
                    </x-mine.card-container>
                    <x-mine.card-container>
                        <x-mine.cdp pdfUrl=" "/>
                        <x-mine.search url="{{route('gradeLevels.show', $info->id)}}"/>
                        <x-mine.table>
                            <x-mine.table-multi-del-sel url="{{route('sections.index')}}">
                                <x-mine.clean-table>
                                    <x-slot name="thead">
                                        <th scope="col" class="px-6 py-3"><input type="checkbox" :checked="toDelete.items.length == datas?.length" @click="selectAll()"></th>
                                        <x-mine.th-cell col="name">
                                            name
                                        </x-mine.th-cell>
                                        <x-mine.th-cell col="created_at">
                                            created
                                        </x-mine.th-cell>
                                        <th scope="col" class="px-6 py-3"></th>
                                    </x-slot>
                                    <td class="px-6 py-3"><input type="checkbox" :checked="toDelete.items.includes(data.id)" @click="addDelete(data.id)"></td>
                                    <x-mine.td-cell-primary>
                                        <a :href="`${index}/${data.id}`" x-text="data.name" ></a>
                                    </x-mine.td-cell-primary>
                                    <x-slot name="action">
                                        <x-mine.td-action/>
                                    </x-slot>
                                </x-mine.clean-table>
                            </x-mine.table-multi-del-sel>
                        </x-mine.table>
                        <x-mine.loading condition="!datas"/>
                    </x-mine.card-container>
                </x-mine.bg-container>
                @php
                    $title="add section";
                    $subtitle="Add a section for the school.";
                    $form ="addSection";
                    $inputs = ['name', 'grade_level_id', 'show'];
                @endphp
                <x-mine.modal open="openAdd">
                    <x-mine.form-modal :title="$title" :subtitle="$subtitle" :form="$form"
                    :inputs="$inputs" url="{{route('gradeLevels.createFor', $info->id)}}">
                        <x-mine.text-input title="section name"/>
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
                    <x-mine.delete-modal delUrl="{{route('sections.destroyAll')}}"/>
                </x-mine.modal>
                @php
                    $title="update section";
                    $subtitle="update a section for the school.";
                    $form ="updateSection";
                @endphp
                <x-mine.modal open="openEdit">
                    <x-mine.form-modal :title="$title" :subtitle="$subtitle" :form="$form" :inputs="$inputs" method="PUT" url="{{route('gradeLevels.createFor', $info->id)}}/${toEdit.id}">
                        <x-mine.text-input title="section name" value="toEdit.name" class="capitalize"/>
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
