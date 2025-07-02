<x-app-layout title="Exam | {{$info->name}}">
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
            Exam | {{$info->name}}
        </h1>
    </x-slot>
        <x-mine.datas :$datas index="{{url('exams/questions/')}}">
            <x-mine.crud
                :search="route('exams.show', $info->id)"
                :addTitle="'Add questions'"
                :addSub="'Add a question to ' . $info->name . '.'"
                :addForm="'addQuestion'"
                :inputs="['question', 'question_file', 'a', 'a_file', 'b', 'b_file', 'c', 'c_file', 'd', 'd_file', 'correct_answer']"
                :addRoute="route('exams.createFor', $info->id)"
                :dellAllRoute="route('questions.destroyAll')"
                :dellOneRoute="route('questions.index')"
                :updateTitle="'Update question'"
                :updateSub="'Update a question of' . $info->name . '.'"
                :updateForm="'updateQuestion'"
                :updateRoute="route('exams.createFor', $info->id)"
            >
                <x-slot name="head">
                    <x-mine.card-container class="mb-4 sm:mb-6 p-5 sm:p-9">
                        <div class="flex justify-between pb-2 border-b-2" x-data="{
                            info: {{Js::from($info)}},
                            async activate() {
                                const res = await fetch('{{route('exams.activate', $info->id)}}', {
                                    method: 'PUT',
                                    headers: {
                                        'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content,
                                        'Accept': 'application/json'
                                    },
                                    credentials: 'include'
                                })

                                if(res.status == 200) {
                                    this.info.is_active = !this.info.is_active
                                }
                            }
                        }">
                            <div>
                                <h2 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
                                    {{$info->name}}
                                </h2>
                                <p class="font-light text-xs capitalize"><span class="font-medium">Author: </span>{{$info->user->name}}</p>
                            </div>

                            <x-mine.button do="activate()" class="text-white border border-transparent focus:ring-transparent">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="inline-block w-5 h-5 mr-1" :class="info.is_active ? 'fill-green-600':'fill-slate-400'">
                                    <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" />
                                </svg>
                                <span :class="info.is_active ? 'text-green-600':'text-slate-400'">Activate</span>
                            </x-mine.button>
                        </div>
                        <p class="my-2 font-semibold">Description:</p>
                        <p x-text="info.description"></p>
                    </x-mine.card-container>
                </x-slot>
                <x-slot name="thead">
                    <x-mine.th-cell col="question">
                        question
                    </x-mine.th-cell>
                    <x-mine.th-cell col="question_file">
                        question image
                    </x-mine.th-cell>
                </x-slot>
                <x-slot name="table">
                    <x-mine.td-cell-primary class="max-w-xl text-ellipsis overflow-hidden">
                        <a :href="`${index}/${data.id}?page=${curPage}`" x-text="data.question" ></a>
                    </x-mine.td-cell-primary>
                    <td class="px-6 py-4">
                        <template x-if="data.question_file === null">
                            <img src="{{ Vite::asset('resources/images/no-img.png')}}" alt="No Image" class="object-contain h-20 max-w-full">
                        </template>
                        <template x-if="data.question_file">
                            <a :href="`${index}/${data.id}?page=${curPage}`">
                                <img :src="`{{asset('storage/')}}/${data.question_file}`" alt="Question Image" class="object-contain h-20 max-w-full">
                            </a>
                        </template>
                    </td>
                </x-slot>
                <x-slot name="addModal">
                    <fieldset>
                        <x-mine.text-area-input name="question" title="Question"/>
                        <div>
                            <label for="question_file" class="sr-only">Question File</label>
                            <input id="question_file" name="question_file" type="file" class="text-xs block w-full px-3 py-2 mt-1 text-gray-600 bg-white border border-gray-200 rounded-md"
                                :class="error.question_file?.msg && 'border-red-800 ring-1 ring-red-800 focus:ring-red-800 focus:border-red-800'"
                            >
                            <div x-show="error.question_file?.msg" x-text="error.question_file?.msg" class="text-red-800 text-sm font-semibold my-2"></div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <x-mine.input name="a" title="Option A"/>
                        <div>
                            <label for="a_file" class="sr-only">Option A File</label>
                            <input id="a_file" name="a_file" type="file" class="text-xs block w-full px-3 py-2 mt-1 text-gray-600 bg-white border border-gray-200 rounded-md"
                                :class="error.a_file?.msg && 'border-red-800 ring-1 ring-red-800 focus:ring-red-800 focus:border-red-800'"
                            >
                            <div x-show="error.a_file?.msg" x-text="error.a_file?.msg" class="text-red-800 text-sm font-semibold my-2"></div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <x-mine.input name="b" title="Option B"/>
                        <div>
                            <label for="b_file" class="sr-only">Option B File</label>
                            <input id="b_file" name="b_file" type="file" class="text-xs block w-full px-3 py-2 mt-1 text-gray-600 bg-white border border-gray-200 rounded-md"
                                :class="error.b_file?.msg && 'border-red-800 ring-1 ring-red-800 focus:ring-red-800 focus:border-red-800'"
                            >
                            <div x-show="error.b_file?.msg" x-text="error.b_file?.msg" class="text-red-800 text-sm font-semibold my-2"></div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <x-mine.input name="c" title="Option C"/>
                        <div>
                            <label for="c_file" class="sr-only">Option C File</label>
                            <input id="c_file" name="c_file" type="file" class="text-xs block w-full px-3 py-2 mt-1 text-gray-600 bg-white border border-gray-200 rounded-md"
                                :class="error.c_file?.msg && 'border-red-800 ring-1 ring-red-800 focus:ring-red-800 focus:border-red-800'"
                            >
                            <div x-show="error.c_file?.msg" x-text="error.c_file?.msg" class="text-red-800 text-sm font-semibold my-2"></div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <x-mine.input name="d" title="Option D"/>
                        <div>
                            <label for="d_file" class="sr-only">Option D File</label>
                            <input id="d_file" name="d_file" type="file" class="text-xs block w-full px-3 py-2 mt-1 text-gray-600 bg-white border border-gray-200 rounded-md"
                                :class="error.d_file?.msg && 'border-red-800 ring-1 ring-red-800 focus:ring-red-800 focus:border-red-800'"
                            >
                            <div x-show="error.d_file?.msg" x-text="error.d_file?.msg" class="text-red-800 text-sm font-semibold my-2"></div>
                        </div>
                    </fieldset>
                    <x-mine.select-input name="correct_answer" title="Correct Answer" :$options/>
                </x-slot>
                <x-slot name="upModal">
                    <fieldset>
                        <x-mine.text-area-input name="question" title="Question" value="toEdit.question"/>
                        <div>
                            <label for="question_file" class="sr-only">Question File</label>

                            <input id="question_file" name="question_file" type="file" class="text-xs block w-full px-3 py-2 mt-1 text-gray-600 bg-white border border-gray-200 rounded-md"
                                :class="error.question_file?.msg && 'border-red-800 ring-1 ring-red-800 focus:ring-red-800 focus:border-red-800'"
                            >
                            <div x-show="error.question_file?.msg" x-text="error.question_file?.msg" class="text-red-800 text-sm font-semibold my-2"></div>
                            <template x-if="toEdit.question_file">
                                <img :src="`{{asset('storage/')}}/${toEdit.question_file}`" alt="Question Image" class="object-contain h-20 max-w-full">
                            </template>
                            <input type="hidden" name="has_question_file" :value="(toEdit.question_file) ? 'true':'false'">
                        </div>
                    </fieldset>
                    <fieldset>
                        <x-mine.input name="a" title="Option A" value="toEdit.a"/>
                        <div>
                            <label for="a_file" class="sr-only">Option A File</label>

                            <input id="a_file" name="a_file" type="file" class="text-xs block w-full px-3 py-2 mt-1 text-gray-600 bg-white border border-gray-200 rounded-md"
                                :class="error.a_file?.msg && 'border-red-800 ring-1 ring-red-800 focus:ring-red-800 focus:border-red-800'"
                            >
                            <div x-show="error.a_file?.msg" x-text="error.a_file?.msg" class="text-red-800 text-sm font-semibold my-2"></div>
                            <template x-if="toEdit.a_file">
                                <img :src="`{{asset('storage/')}}/${toEdit.a_file}`" alt="Question Image" class="object-contain h-20 max-w-full">
                            </template>
                            <input type="hidden" name="has_a_file" :value="(toEdit.a_file) ? 'true':'false'">
                        </div>
                    </fieldset>
                    <fieldset>
                        <x-mine.input name="b" title="Option B" value="toEdit.b"/>
                        <div>
                            <label for="b_file" class="sr-only">Option B File</label>

                            <input id="b_file" name="b_file" type="file" class="text-xs block w-full px-3 py-2 mt-1 text-gray-600 bg-white border border-gray-200 rounded-md"
                                :class="error.b_file?.msg && 'border-red-800 ring-1 ring-red-800 focus:ring-red-800 focus:border-red-800'"
                            >
                            <div x-show="error.b_file?.msg" x-text="error.b_file?.msg" class="text-red-800 text-sm font-semibold my-2"></div>
                            <template x-if="toEdit.b_file">
                                <img :src="`{{asset('storage/')}}/${toEdit.b_file}`" alt="Question Image" class="object-contain h-20 max-w-full">
                            </template>
                            <input type="hidden" name="has_b_file" :value="(toEdit.b_file) ? 'true':'false'">

                        </div>
                    </fieldset>
                    <fieldset>
                        <x-mine.input name="c" title="Option C" value="toEdit.c"/>
                        <div>
                            <label for="c_file" class="sr-only">Option C File</label>

                            <input id="c_file" name="c_file" type="file" class="text-xs block w-full px-3 py-2 mt-1 text-gray-600 bg-white border border-gray-200 rounded-md"
                                :class="error.c_file?.msg && 'border-red-800 ring-1 ring-red-800 focus:ring-red-800 focus:border-red-800'"
                            >
                            <div x-show="error.c_file?.msg" x-text="error.c_file?.msg" class="text-red-800 text-sm font-semibold my-2"></div>
                            <template x-if="toEdit.c_file">
                                <img :src="`{{asset('storage/')}}/${toEdit.c_file}`" alt="Question Image" class="object-contain h-20 max-w-full">
                            </template>
                            <input type="hidden" name="has_c_file" :value="(toEdit.c_file) ? 'true':'false'">

                        </div>
                    </fieldset>

                    <fieldset>
                        <x-mine.input name="d" title="Option D" value="toEdit.d"/>
                        <div>
                            <label for="d_file" class="sr-only">Option D File</label>

                            <input id="d_file" name="d_file" type="file" class="text-xs block w-full px-3 py-2 mt-1 text-gray-600 bg-white border border-gray-200 rounded-md"
                                :class="error.d_file?.msg && 'border-red-800 ring-1 ring-red-800 focus:ring-red-800 focus:border-red-800'"
                            >
                            <div x-show="error.d_file?.msg" x-text="error.d_file?.msg" class="text-red-800 text-sm font-semibold my-2"></div>
                            <template x-if="toEdit.d_file">
                                <img :src="`{{asset('storage/')}}/${toEdit.d_file}`" alt="Question Image" class="object-contain h-20 max-w-full">
                            </template>
                            <input type="hidden" name="has_d_file" :value="(toEdit.d_file) ? 'true':'false'">

                        </div>
                    </fieldset>
                    <x-mine.select-input name="correct_answer" title="Correct Answer" :$options selected="toEdit.correct_answer"/>
                </x-slot>
            </x-mine.crud>
        </x-mine.datas>
</x-app-layout>
