<x-app-layout title="{{$user->account_type}}: {{$user->name}}">
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
            {{$user->account_type}}
        </h1>
    </x-slot>
        <x-mine.datas :$datas index="{{route('exams.all')}}">
            <x-mine.bg-container>
                <x-mine.card-container class="mb-4 sm:mb-6 p-5 sm:p-9">
                    <div x-data="{
                        user: {{Js::from($user)}},
                    }">
                        {{-- <div class="flex justify-between items-center pb-2 border-b-2"> --}}
                        <h2 class="font-semibold text-2xl text-gray-800 leading-tight capitalize pb-2 border-b-2" x-text="user.name"></h2>
                        {{-- </div> --}}
                        <table class="text-sm mt-2">
                            <tr>
                                <td class="font-semibold px-1 py-0.5">
                                    Birthday:
                                </td>
                                <td x-text="user.birthday" class="px-1 py-0.5 capitalize">

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
                    <x-mine.search url="{{route('users.show', $user->id)}}"/>
                    <x-mine.table>
                        <x-mine.clean-table>
                            <x-slot name="thead">
                                {{-- <th scope="col" class="px-6 py-3"></th> --}}
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
                            {{-- <th scope="col" class="px-6 py-3"></th> --}}
                            <x-mine.td-cell-primary>
                                <a :href="`${index}/${data.id}`" x-text="data.name" ></a>
                            </x-mine.td-cell-primary>
                            <x-mine.td-cell txt="data.grade_level_name"/>
                            <x-mine.td-cell txt="data.subject_name"/>
                            <x-mine.td-cell txt="data.description"/>
                            <x-mine.td-cell txt="data.created_at"/>
                        </x-mine.clean-table>
                    </x-mine.table>
                </x-mine.card-container>
            </x-mine.bg-container>
        </x-mine.datas>
</x-app-layout>
