<x-app-layout title="{{$user->account_type}}: {{$user->name}}">
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
            {{$user->account_type}}
        </h1>
    </x-slot>
    <x-mine.bg-container>
        <x-mine.card-container class="mb-4 sm:mb-6 p-5 sm:p-9">
            <div x-data="{
                user: {{Js::from($user)}},
                init() {
                    console.log(this.user)
                }
            }">
                <div class="flex justify-between items-center pb-2 border-b-2">
                    <h2 class="font-semibold text-2xl text-gray-800 leading-tight capitalize" x-text="user.name"></h2>
                </div>

                <table class="text-sm mt-2">
                    <tr>
                        <td class="font-semibold px-1 py-0.5">
                            Username:
                        </td>
                        <td x-text="user.username" class="px-1 py-0.5">

                        </td>
                    </tr>
                    @if (Auth::user()->account_type == 'admin')
                    <tr>
                        <td class="font-semibold px-1 py-0.5">
                            Section:
                        </td>
                        <td x-text="user.section" class="px-1 py-0.5 capitalize">

                        </td>
                    </tr>
                    <tr>
                        <td class="font-semibold px-1 py-0.5">
                            Advisor:
                        </td>
                        <td x-text="user.advisor" class="px-1 py-0.5 capitalize">

                        </td>
                    </tr>
                    @endif

                    <tr>
                        <td class="font-semibold px-1 py-0.5">
                            Birthday:
                        </td>
                        <td x-text="user.birthday" class="px-1 py-0.5 capitalize">

                        </td>
                    </tr>
                    <tr>
                        <td class="font-semibold px-1 py-0.5">
                            Gamer:
                        </td>
                        <td x-text="user.is_gamer" class="px-1 py-0.5 capitalize">

                        </td>
                    </tr>
                    {{-- <tr>
                        <td class="font-semibold px-1 py-0.5">
                            Email:
                        </td>
                        <td x-text="user.email" class="px-1 py-0.5">

                        </td>
                    </tr> --}}
                </table>
                    @if (Auth::user()->account_type == 'admin')
                        <div x-data="{
                            openRetake: false,
                            openReset: false,
                            retakeForm: true,
                            retakeSuccess: false,
                            resetForm: true,
                            resetSuccess: false,
                            url: '{{route('retakeOne', ['user' => $user->id])}}',
                            resetUrl: '{{route('user.reset', ['user' => $user->id])}}',
                            async retake() {
                                {{-- this.url += `/${user.id}` --}}
                                const res = await fetch(this.url, {
                                    method: 'PUT',
                                    headers: {
                                        'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content,
                                        'Accept': 'application/json'
                                    },
                                    credentials: 'include'
                                })
                                this.retakeForm = false
                                if(res.status == 200) {
                                    this.retakeSuccess = true
                                }
                            },
                            async reset() {
                                const res = await fetch(this.resetUrl, {
                                    method: 'PUT',
                                    headers: {
                                        'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content,
                                        'Accept': 'application/json'
                                    },
                                    credentials: 'include'
                                })
                                this.resetForm = false
                                if(res.status == 200) {
                                    const result = await res.json()

                                    user = result.user

                                    this.resetSuccess = true
                                    {{-- console.log(res.user) --}}
                                    {{-- user = res.user --}}
                                }
                            }
                        }" class="flex flex-row justify-end items-center justify-items-end">
                            <x-mine.button do="openRetake = true" class="text-slate-600 border border-transparent focus:ring-transparent">
                                Re-Take Survey
                            </x-mine.button>
                            <x-mine.button do="openReset = true" class="text-slate-600 border border-transparent focus:ring-transparent">
                                Reset Username/Password
                            </x-mine.button>
                            <x-mine.modal open="openRetake">
                                <div x-init="$watch('openRetake', (value) => {
                                    if (value == true) {
                                        retakeForm = true
                                        retakeSuccess = false
                                    }
                                })">
                                    <template x-cloak x-if="retakeForm">
                                        <div>
                                            <div class="flex flex-col items-center justify-center space-y-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 stroke-red-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                                </svg>
                                                <p class="text-xl font-medium text-red-500 text-center">Are you sure you want to make students retake survey?</p>
                                                <div class="flex items-center justify-between gap-2">
                                                    <x-mine.button do="retake()" class="text-white border border-transparent bg-green-600 focus:ring-green-600 hover:bg-green-500 focus:bg-green-500 active:bg-green-700">Confirm</x-mine.button>
                                                    <x-mine.button do="openRetake = false" class="text-white border border-transparent bg-red-600 focus:ring-red-600 hover:bg-red-500 focus:bg-red-500 active:bg-red-700">Cancel</x-mine.button>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                    <x-mine.loading condition="!retakeForm&&!retakeSuccess"/>

                                    <x-mine.success condition="retakeSuccess" txt="edited">
                                        <x-mine.button do="openRetake = false" class="text-white border border-transparent bg-red-600 focus:ring-red-600 hover:bg-red-500 focus:bg-red-500 active:bg-red-700">Close</x-mine.button>
                                    </x-mine.success>
                                </div>
                            </x-mine.modal>
                            <x-mine.modal open="openReset">
                                <div x-init="$watch('openReset', (value) => {
                                    if (value == true) {
                                        resetForm = true
                                        resetSuccess = false
                                    }
                                })">
                                    <template x-cloak x-if="resetForm">
                                        <div>
                                            <div class="flex flex-col items-center justify-center space-y-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 stroke-red-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                                </svg>
                                                <p class="text-xl font-medium text-red-500 text-center">Are you sure you want to reset the username and password?</p>
                                                <div class="flex items-center justify-between gap-2">
                                                    <x-mine.button do="reset()" class="text-white border border-transparent bg-green-600 focus:ring-green-600 hover:bg-green-500 focus:bg-green-500 active:bg-green-700">Confirm</x-mine.button>
                                                    <x-mine.button do="openReset = false" class="text-white border border-transparent bg-red-600 focus:ring-red-600 hover:bg-red-500 focus:bg-red-500 active:bg-red-700">Cancel</x-mine.button>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                    <x-mine.loading condition="!resetForm&&!resetSuccess"/>

                                    <x-mine.success condition="resetSuccess" txt="reseted username and password">
                                        <x-mine.button do="openReset = false" class="text-white border border-transparent bg-red-600 focus:ring-red-600 hover:bg-red-500 focus:bg-red-500 active:bg-red-700">Close</x-mine.button>
                                    </x-mine.success>
                                </div>
                            </x-mine.modal>
                        </div>
                    @endif
            </div>
        </x-mine.card-container>
        <x-mine.card-container class="p-5 sm:p-9">
            <div x-data="{
                pages: [true, false],
                examResult() {
                    this.pages[0] = true;
                    this.pages[1] = false
                },
                surveyResult() {
                    this.pages[0] = false
                    this.pages[1] = true
                }
            }">
                <div class="flex justify-center items-center gap-2">
                    <x-mine.button do="examResult" class="text-sky-600 border-2 border-sky-600 focus:ring-sky-600">
                        Exam Attempts
                    </x-mine.button>
                    <x-mine.button do="surveyResult" class="text-sky-600 border-2 border-sky-600 focus:ring-sky-600">
                        Survey Results
                    </x-mine.button>
                </div>
                <div x-cloak x-show="pages[0]">
                    <x-mine.datas :$datas index="{{url('result/')}}">
                                @if (Auth::user()->account_type == 'admin')
                                <x-mine.search url="{{route('users.show', $user->id)}}"/>
                                @else
                                <x-mine.search url="{{route('myStudents.show', $user->id)}}"/>
                                @endif
                                <x-mine.table>
                                    <x-slot name="thead">
                                        <x-mine.th-cell col="exam_name">
                                            Exam
                                        </x-mine.th-cell>
                                        <x-mine.th-cell col="subject">
                                            Subject
                                        </x-mine.th-cell>
                                        <x-mine.th-cell col="score">
                                            score
                                        </x-mine.th-cell>
                                        <x-mine.th-cell col="percent">
                                            percent
                                        </x-mine.th-cell>
                                        <x-mine.th-cell col="grade">
                                            grade
                                        </x-mine.th-cell>
                                    </x-slot>
                                    <x-mine.td-cell-primary>
                                        <a :href="`${index}/${data.id}`" x-text="data.exam_name"></a>
                                    </x-mine.td-cell-primary>
                                    <x-mine.td-cell txt="data.subject"/>
                                    <x-mine.td-cell txt="data.score"/>
                                    <x-mine.td-cell txt="data.percent"/>
                                    <x-mine.td-cell txt="data.grade"/>
                                </x-mine.table>
                    </x-mine.datas>
                </div>
                <div x-cloak x-show="pages[1]">
                    <x-mine.datas :datas="$surveys">
                        <x-mine.table :pageSize="15" :paginate="true">
                            <x-slot name="thead">
                                <x-mine.th-cell col="name">
                                    Name
                                </x-mine.th-cell>
                                <x-mine.th-cell col="a">
                                    0 mins/games
                                </x-mine.th-cell>
                                <x-mine.th-cell col="b">
                                    &lt; 1 hr/game
                                </x-mine.th-cell>
                                <x-mine.th-cell col="c">
                                    &lt; 2 hrs/games
                                </x-mine.th-cell>
                                <x-mine.th-cell col="d">
                                    &lt; 3 hrs/games
                                </x-mine.th-cell>
                                <x-mine.th-cell col="e">
                                    &lt; 4 hrs/games
                                </x-mine.th-cell>
                                <x-mine.th-cell col="f">
                                    &lt; 5 hrs/games
                                </x-mine.th-cell>
                                <x-mine.th-cell col="g">
                                    6 hrs/games &lt;
                                </x-mine.th-cell>
                            </x-slot>
                            <x-mine.td-cell-primary :isLink="false">
                                <p x-text="data.name"></p>
                            </x-mine.td-cell-primary>
                            <td scope="col" class="px-6 py-3">
                                <template x-cloak x-if="!data.a">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                        <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                    </svg>
                                </template>
                                <template x-cloak x-if="data.a">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                    </svg>
                                </template>
                            </td>
                            <td scope="col" class="px-6 py-3">
                                <template x-cloak x-if="!data.b">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                        <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                    </svg>
                                </template>
                                <template x-cloak x-if="data.b">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                    </svg>
                                </template>
                            </td>
                            <td scope="col" class="px-6 py-3">
                                <template x-cloak x-if="!data.c">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                        <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                    </svg>
                                </template>
                                <template x-cloak x-if="data.c">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                    </svg>
                                </template>
                            </td>
                            <td scope="col" class="px-6 py-3">
                                <template x-cloak x-if="!data.d">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                        <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                    </svg>
                                </template>
                                <template x-cloak x-if="data.d">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                    </svg>
                                </template>
                            </td>
                            <td scope="col" class="px-6 py-3">
                                <template x-cloak x-if="!data.e">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                        <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                    </svg>
                                </template>
                                <template x-cloak x-if="data.e">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                    </svg>
                                </template>
                            </td>
                            <td scope="col" class="px-6 py-3">
                                <template x-cloak x-if="!data.f">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                        <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                    </svg>
                                </template>
                                <template x-cloak x-if="data.f">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                    </svg>
                                </template>
                            </td>
                            <td scope="col" class="px-6 py-3">
                                <template x-cloak x-if="!data.g">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                        <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                    </svg>
                                </template>
                                <template x-cloak x-if="data.g">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                    </svg>
                                </template>
                            </td>
                        </x-mine.table>
                    </x-mine.datas>
                </div>
            </div>
        </x-mine.card-container>
    </x-mine.bg-container>
</x-app-layout>
