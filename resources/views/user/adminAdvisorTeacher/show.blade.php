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
            }">
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight capitalize pb-2 border-b-2" x-text="user.name"></h2>
                <table class="text-sm mt-2">
                    <tr>
                        <td class="font-semibold px-1 py-0.5">
                            Username:
                        </td>
                        <td x-text="user.username" class="px-1 py-0.5">

                        </td>
                    </tr>
                    @if ($user->account_type == 'admin' || $user->account_type == 'advisor')

                    <tr>
                        <td class="font-semibold px-1 py-0.5">
                            Section:
                        </td>
                        <td x-text="user.section" class="px-1 py-0.5 capitalize">

                        </td>
                    </tr>
                    <tr>
                        <td class="font-semibold px-1 py-0.5">
                            Department:
                        </td>
                        <td x-text="user.department" class="px-1 py-0.5 capitalize">

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
                    {{-- <tr>
                        <td class="font-semibold px-1 py-0.5">
                            Email:
                        </td>
                        <td x-text="user.email" class="px-1 py-0.5">

                        </td>
                    </tr> --}}
                </table>
                <div x-data="{
                        openReset: false,
                        resetForm: true,
                        resetSuccess: false,
                        resetUrl: '{{route('user.reset', ['user' => $user->id])}}',
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
                                this.resetSuccess = true
                                {{-- user --}}
                            }
                        }
                    }"
                    class="flex flex-row justify-end items-center justify-items-end">
                    <x-mine.button do="openReset = true" class="text-slate-600 border border-transparent focus:ring-transparent">
                        Reset Username/Password
                    </x-mine.button>
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
            </div>
        </x-mine.card-container>
        <x-mine.card-container class="p-5 sm:p-9">
            <div x-data="{
                @if ($user->account_type == 'admin' || $user->account_type == 'advisor')
                pages: [true, false],
                examResult() {
                    this.pages[0] = true;
                    this.pages[1] = false
                },
                surveyResult() {
                    this.pages[0] = false
                    this.pages[1] = true
                }
                @endif
            }">
                @if ($user->account_type == 'admin' || $user->account_type == 'advisor')
                <div class="flex justify-center items-center gap-2">
                    <x-mine.button do="examResult" class="text-sky-600 border-2 border-sky-600 focus:ring-sky-600">
                        Exams
                    </x-mine.button>
                    <x-mine.button do="surveyResult" class="text-sky-600 border-2 border-sky-600 focus:ring-sky-600">
                        Students
                    </x-mine.button>
                </div>
                @endif

                @if ($user->account_type == 'admin' || $user->account_type == 'advisor')
                <div x-cloak x-show="pages[0]">
                @endif
                    <x-mine.datas :$datas index="{{route('exams.all')}}">
                                <x-mine.search url="{{route('users.show', ['user' => $user->id, 'type' => 'exams'])}}"/>
                                <x-mine.table>
                                    <x-slot name="thead">
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
                                        <x-mine.th-cell col="created_at">
                                            created
                                        </x-mine.th-cell>
                                    </x-slot>
                                    <x-mine.td-cell-primary>
                                        <a :href="`${index}/${data.id}`" x-text="data.name" ></a>
                                    </x-mine.td-cell-primary>
                                    <x-mine.td-cell txt="data.grade_level_name"/>
                                    <x-mine.td-cell txt="data.subject_name"/>
                                    <x-mine.td-cell txt="data.description"/>
                                    <x-mine.td-cell txt="data.created_at"/>
                                </x-mine.table>
                    </x-mine.datas>
                @if ($user->account_type == 'admin' || $user->account_type == 'advisor')
                </div>
                <div x-cloak x-show="pages[1]">
                    <x-mine.datas :datas="$students" index="{{route('users.all')}}">
                        <x-mine.search url="{{route('users.show', ['user' => $user->id, 'type' => 'students'])}}"/>
                        <x-mine.table>
                            <x-slot name="thead">
                                <x-mine.th-cell col="name">
                                    Name
                                </x-mine.th-cell>
                                <x-mine.th-cell col="email">
                                    E-mail
                                </x-mine.th-cell>
                                <x-mine.th-cell col="birthday">
                                    Birthday
                                </x-mine.th-cell>
                            </x-slot>
                            <x-mine.td-cell-primary :isLink="false">
                                <p x-text="data.name"></p>
                            </x-mine.td-cell-primary>
                            <td scope="col" class="px-6 py-3" x-text="data.email"></td>
                            <x-mine.td-cell txt="data.birthday"/>
                        </x-mine.table>
                    </x-mine.datas>
                    </div>
                </div>
                @endif
        </x-mine.card-container>
    </x-mine.bg-container>
</x-app-layout>
