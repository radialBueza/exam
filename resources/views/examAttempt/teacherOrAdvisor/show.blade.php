<x-app-layout title="Exam Results">
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
            Exam Results
        </h1>
    </x-slot>
        <x-mine.datas :$datas index="{{url('result/')}}">
            <x-mine.bg-container>
                <x-mine.card-container class="mb-4 sm:mb-6 p-5 sm:p-9">
                    <div class="flex flex-col gap-1">
                        <h2 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">{{$exam->name}}</h2>
                        <p class="font-light text-xs capitalize"><span class="font-medium">Grade Level: </span>
                        @isset($exam->grade_level_id)
                            {{$exam->gradeLevel->name}}
                        @endisset
                        </p>
                    </div>
                </x-mine.card-container>
                <x-mine.card-container class="p-5 sm:p-9">
                    <x-mine.search url="{{route('searchAllExams', $exam->id)}}"/>
                    <x-mine.table>
                        <x-mine.clean-table>
                            <x-slot name="thead">
                                <x-mine.th-cell col="user_name">
                                    Name
                                </x-mine.th-cell>
                                <x-mine.th-cell col="section">
                                    Section
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
                                <a :href="`${index}/${data.id}`" x-text="data.user_name" ></a>
                            </x-mine.td-cell-primary>
                            <x-mine.td-cell txt="data.section"/>
                            <x-mine.td-cell txt="data.score"/>
                            <x-mine.td-cell txt="data.percent"/>
                            <x-mine.td-cell txt="data.grade"/>

                        </x-mine.clean-table>
                    </x-mine.table>
                </x-mine.card-container>
            </x-mine.bg-container>
        </x-mine.datas>
</x-app-layout>
