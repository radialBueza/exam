<x-app-layout title="Exam | {{$info->name}}">
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
            Exam | {{$info->name}}
        </h1>
    </x-slot>
        <x-mine.datas :$datas index="{{route('questions.all')}}">
            <x-mine.crud>
                <div x-data="{
                    info: {{Js::from($info)}}
                }">
                    <x-mine.bg-container>
                        {{-- Name and Activate --}}
                        <x-mine.card-container class="mb-4 sm:mb-6">
                            <div class="flex justify-between pb-2 border-b-2">
                                <h2 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
                                    {{$info->name}}
                                </h2>
                                <x-mine.button>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="inline-block w-5 h-5 mr-1" :class="info.is_active ? 'fill-green-600':'fill-slate-400'">
                                        <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" />
                                    </svg>
                                    <span :class="info.is_active ? 'text-green-600':'text-slate-400'">Activate</span>
                                </x-mine.button>
                            </div>
                            <p class="my-2 font-semibold">Description:</p>
                            <p x-text="info.description"></p>
                        </x-mine.card-container>
                        {{-- Info --}}
                        {{-- <x-mine.card-container class="mb-4 sm:mb-6">
                            <div class="flex justify-between pb-4 border-b-2">
                                <h3 class="font-semibold text-xl text-gray-800 leading-tight">Information</h3>
                                <x-mine.button class="text-green-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 fill-green-600 mr-1">
                                        <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                    </svg>
                                    Edit
                                </x-mine.button>
                            </div>
                            <div class="flex flex-col py-1">
                                <div class="capitalize p-2">
                                    <span class="font-semibold">Author: </span><span x-text="info.user_name"></span>
                                </div>
                                <div class="capitalize p-2">
                                    <span class="font-semibold">Grade Level: </span><span x-text="info.grade_level_name"></span>
                                </div>
                                <div class="capitalize p-2">
                                    <span class="font-semibold">Subject: </span><span x-text="info.subject_name"></span>
                                </div>
                                <div class="capitalize p-2 text-justify">
                                    <span class="font-semibold">Description: </span><span x-text="info.description" class="normal-case"></span>
                                </div>
                                <div class="capitalize p-2">
                                    <span class="font-semibold">Number of Questions: </span><span x-text="info.num_of_questions"></span>
                                </div>
                                <div class="capitalize p-2">
                                    <span class="font-semibold">Time Limit: </span><span x-text="info.time_limit"></span>
                                </div>
                            </div>
                        </x-mine.card-container> --}}
                        {{-- table --}}
                        <x-mine.card-container>
                            <x-mine.cdp pdfUrl=" "/>
                            <x-mine.search url="{{route('exams.show', $info->id)}}"/>
                            <x-mine.table>
                                <x-mine.table-multi-del-sel url="{{route('questions.index')}}">
                                    <x-mine.clean-table>
                                        <x-slot name="thead">
                                            <th scope="col" class="px-6 py-3"><input type="checkbox" :checked="toDelete.items.length == datas?.length" @click="selectAll()"></th>
                                            <x-mine.th-cell col="question">
                                                question
                                            </x-mine.th-cell>
                                            <x-mine.th-cell col="a">
                                                Option A
                                            </x-mine.th-cell>
                                            <x-mine.th-cell col="b">
                                                Option B
                                            </x-mine.th-cell>
                                            <x-mine.th-cell col="c">
                                                Option C
                                            </x-mine.th-cell>
                                            <x-mine.th-cell col="d">
                                                Option D
                                            </x-mine.th-cell>
                                            <x-mine.th-cell col="correct_answer">
                                                correct answer
                                            </x-mine.th-cell>
                                            <x-mine.th-cell col="created_at">
                                                created on
                                            </x-mine.th-cell>
                                            <th scope="col" class="px-6 py-3"></th>
                                        </x-slot>
                                        {{-- table body --}}
                                        <td class="px-6 py-3"><input type="checkbox" :checked="toDelete.items.includes(data.id)" @click="addDelete(data.id)"></td>
                                        <x-mine.td-cell-primary>
                                            <a :href="`${index}/${data.id}`" x-text="data.question" ></a>
                                        </x-mine.td-cell-primary>
                                        <x-mine.td-cell txt="data.a"/>
                                        <x-mine.td-cell txt="data.b"/>
                                        <x-mine.td-cell txt="data.c"/>
                                        <x-mine.td-cell txt="data.d"/>
                                        <x-mine.td-cell txt="data.correct_answer"/>
                                        <x-slot name="action">
                                            <x-mine.td-action/>
                                        </x-slot>
                                    </x-mine.clean-table>
                                </x-mine.table-multi-del-sel>
                            </x-mine.table>
                        </x-mine.card-container>
                    </x-mine.bg-container>
                    @php
                        $title="add questions";
                        $subtitle="Add a question to {$info->name}";
                        $form="addQuestion";
                        $inputs=['question', 'question_file', 'a', 'a_file', 'b', 'b_file', 'c', 'c_file', 'd', 'd_file', 'correct_answer'];
                    @endphp
                    <x-mine.modal open="openAdd" :withFile="true">
                        <template x-if="Object.keys(datas).length >= Number(info.num_of_questions)">
                            <div role="not allowed" class="flex flex-col justify-center items-center gap-2 m-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 fill-red-600">
                                    <path fill-rule="evenodd" d="M6.72 5.66l11.62 11.62A8.25 8.25 0 006.72 5.66zm10.56 12.68L5.66 6.72a8.25 8.25 0 0011.62 11.62zM5.105 5.106c3.807-3.808 9.98-3.808 13.788 0 3.808 3.807 3.808 9.98 0 13.788-3.807 3.808-9.98 3.808-13.788 0-3.808-3.807-3.808-9.98 0-13.788z" clip-rule="evenodd" />
                                </svg>
                                <p class="text-xl font-medium text-red-800">You have reach maximum amount of questions</p>
                                <div class="flex justify-between gap-2">
                                    <x-mine.button do="openAdd = false" class="text-white border border-transparent bg-red-600 focus:ring-red-600 hover:bg-red-500 focus:bg-red-500 active:bg-red-700">Close</x-mine.button>
                                </div>
                            </div>
                        </template>
                        <template x-cloak x-if="Object.keys(datas).length < Number(info.num_of_questions)">
                            <x-mine.form-modal :title="$title" :subtitle="$subtitle" :form="$form"
                            :inputs="$inputs" url="{{route('exams.createFor', $info->id)}}" :withFile="true">
                                <fieldset>
                                    <x-mine.text-area-input name="{{$inputs[0]}}" title="Question"/>
                                    <div>
                                        <label for="{{$inputs[1]}}" class="sr-only">Question File</label>

                                        <input id="{{$inputs[1]}}" name="{{$inputs[1]}}" type="file" class="text-xs block w-full px-3 py-2 mt-1 text-gray-600 bg-white border border-gray-200 rounded-md"
                                            :class="error.{{$inputs[1]}}?.msg && 'border-red-800 ring-1 ring-red-800 focus:ring-red-800 focus:border-red-800'"
                                        >
                                        <div x-show="error.{{$inputs[1]}}?.msg" x-text="error.{{$inputs[1]}}?.msg" class="text-red-800 text-sm font-semibold my-2"></div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <x-mine.input name="{{$inputs[2]}}" title="Option A"/>
                                    <div>
                                        <label for="{{$inputs[3]}}" class="sr-only">Option A File</label>

                                        <input id="{{$inputs[3]}}" name="{{$inputs[3]}}" type="file" class="text-xs block w-full px-3 py-2 mt-1 text-gray-600 bg-white border border-gray-200 rounded-md"
                                            :class="error.{{$inputs[3]}}?.msg && 'border-red-800 ring-1 ring-red-800 focus:ring-red-800 focus:border-red-800'"
                                        >
                                        <div x-show="error.{{$inputs[3]}}?.msg" x-text="error.{{$inputs[3]}}?.msg" class="text-red-800 text-sm font-semibold my-2"></div>
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <x-mine.input name="{{$inputs[4]}}" title="Option B"/>
                                    <div>
                                        <label for="{{$inputs[5]}}" class="sr-only">Option B File</label>

                                        <input id="{{$inputs[5]}}" name="{{$inputs[5]}}" type="file" class="text-xs block w-full px-3 py-2 mt-1 text-gray-600 bg-white border border-gray-200 rounded-md"
                                            :class="error.{{$inputs[5]}}?.msg && 'border-red-800 ring-1 ring-red-800 focus:ring-red-800 focus:border-red-800'"
                                        >
                                        <div x-show="error.{{$inputs[5]}}?.msg" x-text="error.{{$inputs[5]}}?.msg" class="text-red-800 text-sm font-semibold my-2"></div>
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <x-mine.input name="{{$inputs[6]}}" title="Option C"/>
                                    <div>
                                        <label for="{{$inputs[7]}}" class="sr-only">Option C File</label>

                                        <input id="{{$inputs[7]}}" name="{{$inputs[7]}}" type="file" class="text-xs block w-full px-3 py-2 mt-1 text-gray-600 bg-white border border-gray-200 rounded-md"
                                            :class="error.{{$inputs[7]}}?.msg && 'border-red-800 ring-1 ring-red-800 focus:ring-red-800 focus:border-red-800'"
                                        >
                                        <div x-show="error.{{$inputs[7]}}?.msg" x-text="error.{{$inputs[7]}}?.msg" class="text-red-800 text-sm font-semibold my-2"></div>
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <x-mine.input name="{{$inputs[8]}}" title="Option D"/>
                                    <div>
                                        <label for="{{$inputs[9]}}" class="sr-only">Option D File</label>

                                        <input id="{{$inputs[9]}}" name="{{$inputs[9]}}" type="file" class="text-xs block w-full px-3 py-2 mt-1 text-gray-600 bg-white border border-gray-200 rounded-md"
                                            :class="error.{{$inputs[9]}}?.msg && 'border-red-800 ring-1 ring-red-800 focus:ring-red-800 focus:border-red-800'"
                                        >
                                        <div x-show="error.{{$inputs[9]}}?.msg" x-text="error.{{$inputs[9]}}?.msg" class="text-red-800 text-sm font-semibold my-2"></div>
                                    </div>
                                </fieldset>
                                <x-mine.select-input name="{{$inputs[10]}}" title="Correct Answer" :$options/>
                                <x-slot name="buttons">
                                    <x-mine.submit-button class="justify-end">
                                        <x-mine.button type="submit" class="border-transparent border text-white bg-green-600 focus:ring-green-600 hover:bg-green-500 focus:bg-green-500 active:bg-green-700">
                                            {{$title}}
                                        </x-mine.button>
                                    </x-mine.submit-button>
                                </x-slot>
                            </x-mine.form-modal>
                        </template>

                    </x-mine.modal>
                    <x-mine.modal open="openDel">
                        <x-mine.delete-modal delUrl="{{route('questions.destroyAll')}}"/>
                    </x-mine.modal>
                    @php
                        $title="update grade level";
                        $subtitle="Update a department of the school.";
                        $form="updateGradeLevel";
                    @endphp
                    <x-mine.modal open="openEdit">
                        <x-mine.form-modal :title="$title" :subtitle="$subtitle" :form="$form" :inputs="$inputs" method="PUT" url="{{route('departments.createFor', $info->id)}}/${toEdit.id}">
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
                </div>
            </x-mine.crud>
        </x-mine.datas>
</x-app-layout>
