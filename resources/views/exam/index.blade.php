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
                                        <th scope="col" class="px-6 py-3"><input type="checkbox" :checked="toDelete.items.length == datas?.length  && datas.length != 0" @click="selectAll()"></th>
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
                                            author
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
                                    <x-mine.td-cell txt="data.created_at"/>

                                {{-- <td scope="col" x-text="data.created_at" class="px-6 py-4"></td> --}}

                                    <x-slot name="action">
                                        <x-mine.td-action/>
                                    </x-slot>
                                </x-mine.clean-table>
                            </x-mine.table-multi-del-sel>
                        </x-mine.table>
                    </x-mine.card-container>
                </x-mine.bg-container>
                @php
                    $title="Add Exam";
                    $subtitle="add a exam for the school.";
                    $form ="addExam";
                    $inputs = ['name', 'subject_id', 'grade_level_id', 'description', 'num_of_questions', 'time_limit'];
                @endphp
                <x-mine.modal open="openAdd">
                    <x-mine.form-modal :title="$title" :subtitle="$subtitle" :form="$form" url="{{route('exams.store')}}"
                    :$inputs>
                        <x-mine.input title="exam name"/>
                        <x-mine.select-input name="{{$inputs[1]}}" title="Subject" :options="$subject"/>
                        <x-mine.select-input name="{{$inputs[2]}}" title="Grade Level" :options="$gradeLevel"/>
                        <x-mine.text-area-input name="{{$inputs[3]}}" title="exam description"/>
                        <x-mine.input name="{{$inputs[4]}}" title="Number of Question" type="number"/>
                        <x-mine.input name="{{$inputs[5]}}" title="Time limit (in minutes)" type="number"/>
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
                    <x-mine.form-modal :title="$title" :subtitle="$subtitle" :form="$form" url="{{route('exams.index')}}/${toEdit.id}"
                    :$inputs>
                        <x-mine.input title="exam name" class="capitalize" value="toEdit.name"/>
                        <x-mine.select-input name="{{$inputs[1]}}" title="Subject" :options="$subject" selected="toEdit.subject_id"/>
                        <x-mine.select-input name="{{$inputs[2]}}" title="Grade Level" :options="$gradeLevel" selected="toEdit.grade_level_id"/>
                        <x-mine.text-area-input name="{{$inputs[3]}}" title="exam description" value="toEdit.description"/>
                        <x-mine.input name="{{$inputs[4]}}" title="Number of Question" type="number" value="toEdit.num_of_questions"/>
                        <x-mine.input name="{{$inputs[5]}}" title="Time limit (in minutes)" type="number" value="toEdit.time_limit"/>
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
