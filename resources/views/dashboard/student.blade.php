<x-app-layout title="Dashboard">
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
            Dashboard
        </h1>
    </x-slot>
    <x-mine.datas :$datas>
        <div x-data="{
            openStart: false,
            toOpen: {},
            start(id) {
                const getIndex = (el) => el.id == id
                let index = this.datas.findIndex(getIndex)
                this.toOpen = this.datas[index]
                this.openStart = true
                return
            }
        }">
            <x-mine.bg-container>
                <x-mine.card-container class="p-5 sm:p-9 mb-4 sm:mb-6">
                    <div class="flex flex-col justify-center space-y-2">
                        <div class="flex items-center gap-2">
                            <h2 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">{{auth()->user()->name}}</h2>
                            <span class="text-xs ml-1 text-gray-100 border rounded-xl px-1.5 capitalize bg-gray-600">{{auth()->user()->account_type}}</span>
                        </div>
                        <p class="text-xs capitalize">section: {{auth()->user()->section->name}}</p>
                    </div>
                </x-mine.card-container>
                <x-mine.card-container class="p-5 sm:p-9">
                    <div class="pb-4 mb-4 text-xl font-medium border-b-2">Available Examination</div>
                    <x-mine.table>
                            <x-slot name="thead">
                                <x-mine.th-cell col="name">
                                    name
                                </x-mine.th-cell>
                                <x-mine.th-cell col="subject_name">
                                    subject
                                </x-mine.th-cell>
                                <th scope="col" class="px-6 py-3"></th>
                            </x-slot>
                            <x-mine.td-cell-primary :isLink="false">
                                <p x-text="data.name" ></p>
                            </x-mine.td-cell-primary>
                            <x-mine.td-cell txt="data.subject_name"/>
                            <td scope="col"class="px-6 py-4">
                                <div class="flex justify-center items-center">
                                    <x-mine.button do="start(data.id)" class="text-white whitespace-nowrap border border-transparent bg-green-600 focus:ring-green-600 hover:bg-green-500 focus:bg-green-500 active:bg-green-700">Go to Exam</x-mine.button>
                                </div>
                            </td>
                    </x-mine.table>
                </x-mine.card-container>
                <x-mine.modal open="openStart" maxWidth="2xl">
                    <div class="flex items-center justify-between pb-4">
                        <h3 class="text-xl font-medium text-gray-800 " x-text="toOpen.name"></h3>
                        <button @click="openStart = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                    </div>
                    <div class="mx-auto grid grid-cols-3 capitalize w-11/12 border-t">
                        <div class="border-b text-sm font-semibold px-1 py-2">Description: </div>
                        <div x-text="toOpen.description" class="border-b text-sm col-span-2 px-1 py-2"></div>
                        <div class="border-b text-sm font-semibold px-1 py-2">Subject: </div>
                        <div x-text="toOpen.subject_name" class="border-b text-sm col-span-2 px-1 py-2"></div>
                        <div class="border-b text-sm font-semibold px-1 py-2">Author: </div>
                        <div x-text="toOpen.user_name" class="border-b text-sm col-span-2 px-1 py-2"></div>
                        <div class="border-b text-sm font-semibold px-1 py-2">Numer of Questions: </div>
                        <div x-text="toOpen.num_of_questions" class="border-b text-sm col-span-2 px-1 py-2"></div>
                        <div class="border-b text-sm font-semibold px-1 py-2">Time Limit: </div>
                        <div x-text="toOpen.time_limit" class="border-b text-sm col-span-2 px-1 py-2"></div>
                    </div>
                    <div class="pt-4 flex justify-end">
                        <x-mine.link-button href="{{url('takeExam')}}/${toOpen.id}" class="whitespace-nowrap border-transparent bg-green-600 focus:ring-green-600 hover:bg-green-500 focus:bg-green-500 active:bg-green-700">
                            Start Exam
                        </x-mine.link-button>
                    </div>
                </x-mine.modal>
            </x-mine.bg-container>
        </div>
    </x-mine.datas>

</x-app-layout>
