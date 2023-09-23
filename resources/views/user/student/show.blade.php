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
                async retake() {
                    const res = await fetch(`{{route('retake')}}/${this.user.id}`, {
                        method: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content,
                            'Accept': 'application/json'
                        }
                    })

                    if (res.status == 201 ) {
                        const result = await res.json()
                        datas = result.data
                        sort()
                        return
                    }
                }
            }">
                <div class="flex justify-between items-center pb-2 border-b-2">
                    <h2 class="font-semibold text-2xl text-gray-800 leading-tight capitalize" x-text="user.name"></h2>
                    @if (Auth::user()->account_type == 'admin')
                    <x-mine.button do="retake()" class="text-slate-600 border border-transparent focus:ring-transparent">
                        Re-Take Survey
                    </x-mine.button>
                    @endif
                </div>
                <table class="text-sm mt-2">
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
                    <tr>
                        <td class="font-semibold px-1 py-0.5">
                            Email:
                        </td>
                        <td x-text="user.email" class="px-1 py-0.5">

                        </td>
                    </tr>
                </table>
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
                            {{-- <div class="relative" x-data=x-show> --}}
                                @if (Auth::user()->account_type == 'admin')
                                <x-mine.search url="{{route('users.show', $user->id)}}"/>
                                @else
                                <x-mine.search url="{{route('myStudents.show', $user->id)}}"/>
                                @endif
                                <x-mine.table>
                                    <x-mine.clean-table>
                                        <x-slot name="thead">
                                            {{-- <th scope="col" class="px-6 py-3"></th> --}}
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
                                        {{-- <th scope="col" class="px-6 py-3"></th> --}}
                                        <x-mine.td-cell-primary>
                                            <a :href="`${index}/${data.id}`" x-text="data.exam_name" ></a>
                                        </x-mine.td-cell-primary>
                                        <x-mine.td-cell txt="data.subject"/>
                                        <x-mine.td-cell txt="data.score"/>
                                        <x-mine.td-cell txt="data.percent"/>
                                        <x-mine.td-cell txt="data.grade"/>
                                    </x-mine.clean-table>
                                </x-mine.table>
                            {{-- </div> --}}
                    </x-mine.datas>
                </div>
                <div x-cloak x-show="pages[1]">
                    <x-mine.datas :datas="$surveys">
                        <x-mine.table :pageSize="15">
                            <x-mine.clean-table :paginate="false">
                                <x-slot name="thead">
                                    {{-- <th scope="col" class="px-6 py-3"></th> --}}
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
                                {{-- <th scope="col" class="px-6 py-3"></th> --}}
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
                            </x-mine.clean-table>
                        </x-mine.table>
                    </x-mine.datas>
                </div>
            </div>
        </x-mine.card-container>
    </x-mine.bg-container>
</x-app-layout>
