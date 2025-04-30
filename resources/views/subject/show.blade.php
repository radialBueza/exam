<x-app-layout title="Exams | {{$info->name}}">
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
            Exams | {{$info->name}}
        </h1>
    </x-slot>
        <x-mine.datas :$datas index="{{route('users.all')}}">
            <x-mine.bg-container>
                <x-mine.card-container class="mb-4 sm:mb-6 p-5 sm:p-9">
                    <div>
                        <p class="text-xs font-thin text-slate-400 capitalize">{{$parent->name}}/</p>
                        <h2 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
                            {{$info->name}}
                        </h2>
                        <p class="font-light text-xs capitalize"><span class="font-medium">Advisor:</span>
                        @isset($advisor)
                            {{$advisor->name}}
                        @else
                            {{'N/A'}}
                        @endisset
                        </p>
                    </div>
                </x-mine.card-container>
                <x-mine.card-container class="p-5 sm:p-9">
                    <x-mine.search :url="route('sections.show', $info->id)"/>
                    <x-mine.table>
                        <x-slot name="thead">
                            <x-mine.th-cell col="name">
                                name
                            </x-mine.th-cell>
                            <x-mine.th-cell col="created_at">
                                registered on
                            </x-mine.th-cell>
                        </x-slot>
                        <x-mine.td-cell-primary>
                            <a :href="`${index}/${data.id}`" x-text="data.name" ></a>
                        </x-mine.td-cell-primary>
                        <x-mine.td-cell txt="data.created_at"/>
                    </x-mine.table>
                </x-mine.card-container>
            </x-mine.bg-container>
        </x-mine.datas>
</x-app-layout>
