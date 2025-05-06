<x-app-layout title="Dashboard">
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
            Dashboard
        </h1>
    </x-slot>
    <x-mine.datas :$datas index="{{url('examResult/')}}">
        <x-mine.bg-container>
            <x-mine.card-container class="p-5 sm:p-9 mb-4 sm:mb-6">
                <div class="flex flex-col justify-center space-y-2">
                    <div class="flex items-center gap-2">
                        <h2 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">{{auth()->user()->name}}</h2>
                        <span class="text-xs ml-1 text-gray-100 border rounded-xl px-1.5 capitalize bg-gray-600">{{auth()->user()->account_type}}</span>
                    </div>
                    @if (auth()->user()->account_type == 'advisor')
                        <p class="text-xs capitalize">section: {{auth()->user()->section->name}}</p>
                    @endif
                </div>
            </x-mine.card-container>
            <x-mine.card-container class="p-5 sm:p-9">
                <div class="pb-4 mb-4 text-xl font-medium border-b-2">Examination Taken</div>
                <x-mine.table>
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
                </x-mine.table>
            </x-mine.card-container>
        </x-mine.bg-container>
    </x-mine.datas>
</x-app-layout>
