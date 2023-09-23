<x-app-layout title="Dashboard">
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
            Dashboard
        </h1>
    </x-slot>
    <x-mine.datas :$datas index="{{url('examResult/')}}">
        <x-mine.bg-container>
                <x-mine.card-container class="p-5 sm:p-9">
                    <x-mine.table>
                        <x-mine.clean-table>
                            <x-slot name="thead">
                                <x-mine.th-cell col="name">
                                    name
                                </x-mine.th-cell>
                                <x-mine.th-cell col="subject_name">
                                    subject
                                </x-mine.th-cell>
                                <x-mine.th-cell col="grade_level_name">
                                    Grade Level
                                </x-mine.th-cell>
                            </x-slot>
                            <x-mine.td-cell-primary>
                                <a :href="`${index}/${data.id}`" x-text="data.name" ></a>
                            </x-mine.td-cell-primary>
                            <x-mine.td-cell txt="data.subject_name"/>
                            <x-mine.td-cell txt="data.grade_level_name"/>
                        </x-mine.clean-table>
                    </x-mine.table>
                </x-mine.card-container>
        </x-mine.bg-container>
    </x-mine.datas>
</x-app-layout>
