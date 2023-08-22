<x-app-layout title="Exam">
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
            Exam
        </h1>
    </x-slot>
        <x-mine.datas :$datas index="{{route('exams.all')}}">
            <x-mine.crud>
                <x-mine.bg-container>
                    <x-mine.card-container>
                        <x-mine.cdp pdfUrl=" "/>
                        <x-mine.search url="{{route('exams.index')}}"/>
                        <x-mine.table>
                            <x-mine.table-multi-del-sel url="{{route('exams.index')}}">
                                <x-mine.clean-table>
                                    <x-slot name="thead">
                                        <th scope="col" class="px-6 py-3"><input type="checkbox" :checked="toDelete.items.length == datas?.length" @click="selectAll()"></th>
                                        <x-mine.th-cell col="name">
                                            name
                                        </x-mine.th-cell>
                                        <x-mine.th-cell col="grade_level_name">
                                            grade level
                                        </x-mine.th-cell>
                                        <x-mine.th-cell col="subject_name">
                                            subject
                                        </x-mine.th-cell>
                                        <x-mine.th-cell col="description">
                                            description
                                        </x-mine.th-cell>
                                        <x-mine.th-cell col="user_name">
                                            Created By
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
                                    <x-mine.td-cell txt="data.subject_name"/>
                                    <x-mine.td-cell txt="data.description"/>
                                    <x-mine.td-cell txt="data.user_name"/>
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
                    $title="Add Exam";
                    $subtitle="add a exam for the school.";
                    $form ="addExam";
                @endphp
                <x-mine.modal open="openAdd">
                    <x-mine.form-modal :title="$title" :subtitle="$subtitle" :form="$form" url="{{route('exams.store')}}"
                    >
                        <x-mine.text-input title="exam name"/>
                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
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
                    <x-mine.delete-modal delUrl="{{route('exams.destroyAll')}}"/>
                </x-mine.modal>
                @php
                    $title="Update Exam";
                    $subtitle="Update a exam of the school.";
                    $form="updateExam";
                @endphp
                <x-mine.modal open="openEdit">
                    <x-mine.form-modal :title="$title" :subtitle="$subtitle" :form="$form" method="PUT" url="{{route('exams.index')}}/${toEdit.id}">
                        <x-mine.text-input title="exam name" class="capitalize" value="toEdit.name"/>
                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
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
