<x-app-layout title="Sections">
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
            Sections
        </h1>
    </x-slot>
    <x-mine.bg-container>
        <x-mine.crud-table-container :$datas url="{{route('sections.index')}}" index="{{route('sections.all')}}">
            <x-mine.card-container>
                <x-mine.cdp pdfUrl=" "/>
                <x-mine.search/>
                {{-- <x-mine.table>
                    <x-slot name="thead">
                        <x-mine.th-cell col="name">
                            name
                        </x-mine.th-cell>
                        <x-mine.th-cell col="grade_level_name">
                            grade level
                        </x-mine.th-cell>
                        <x-mine.th-cell col="created_at">
                            created
                        </x-mine.th-cell>
                    </x-slot>
                    <x-mine.td-cell-primary>
                        <a :href="`${index}/${data.id}`" x-text="data.name" ></a>
                    </x-mine.td-cell-primary>
                    <x-mine.td-cell txt="data.grade_level_name"/>
                </x-mine.table> --}}
                <x-mine.table>
                    <x-mine.table-multi-del-sel>
                        <x-mine.clean-table>
                            <x-slot name="thead">
                                <th scope="col" class="px-6 py-3"><input type="checkbox" :checked="toDelete.items.length == datas?.length" @click="selectAll()"></th>
                                <x-mine.th-cell col="name">
                                    name
                                </x-mine.th-cell>
                                <x-mine.th-cell col="grade_level_name">
                                    grade level
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
                            <x-mine.td-cell txt="data.grade_level_name"/>
                            <x-slot name="action">
                                <x-mine.td-action/>
                            </x-slot>
                        </x-mine.clean-table>
                    </x-mine.table-multi-del-sel>
                </x-mine.table>
                <x-mine.loading condition="!datas"/>
            </x-mine.card-container>
            @php
                $title="add section";
                $subtitle="Add a section for the school.";
                $form ="addSection";
                $inputs = ['name', 'grade_level_id'];
            @endphp
            <x-mine.modal open="openAdd">
                <x-mine.form-modal :title="$title" :subtitle="$subtitle" :form="$form"
                :inputs="$inputs">
                    <x-mine.text-input title="Section name"/>
                    <x-mine.select-input name="{{$inputs[1]}}" title="Grade Level" :$options/>
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
                <x-mine.form-modal :title="$title" :subtitle="$subtitle" :form="$form" :inputs="$inputs" method="PUT" url="{{route('sections.index')}}/${toEdit.id}">
                    <x-mine.text-input title="section name" value="toEdit.name" class="capitalize"/>
                    <x-mine.select-input name="{{$inputs[1]}}" title="Grade Level" :$options selected="toEdit.grade_level_id" />
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
