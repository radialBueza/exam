<x-app-layout title="Exam Results">
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
            Exam Results
        </h1>
    </x-slot>
        <x-mine.datas :$datas index="{{route('examAttempt.all')}}">
            <x-mine.bg-container>
                <x-mine.card-container class="p-5 sm:p-9">
                    <x-mine.search url="{{route('examAttempt.index')}}"/>
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
                            <a :href="`${index}/${data.id}?page=${curPage}`" x-text="data.exam_name" ></a>
                        </x-mine.td-cell-primary>
                        <x-mine.td-cell txt="data.subject"/>
                        <x-mine.td-cell txt="data.score"/>
                        <x-mine.td-cell txt="data.percent"/>
                        <x-mine.td-cell txt="data.grade"/>
                    </x-mine.table>
                </x-mine.card-container>
            </x-mine.bg-container>
        </x-mine.datas>
</x-app-layout>
