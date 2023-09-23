<x-app-layout title="My Students">
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
            My Students
        </h1>
    </x-slot>
        <x-mine.datas :$datas index="{{route('myStudent.all')}}">
            <x-mine.bg-container>
                <x-mine.card-container class="p-5 sm:p-9">
                    <x-mine.search url="{{route('myStudents.index')}}"/>
                    <x-mine.table>
                        <x-mine.clean-table>
                            <x-slot name="thead">
                                {{-- <th scope="col" class="px-6 py-3"></th> --}}
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
                            {{-- <th scope="col" class="px-6 py-3"></th> --}}

                            <x-mine.td-cell-primary>
                                <a :href="`${index}/${data.id}`" x-text="data.name"></a>
                            </x-mine.td-cell-primary>
                            <td scope="col" class="px-6 py-3" x-text="data.email"></td>
                            <x-mine.td-cell txt="data.birthday"/>
                        </x-mine.clean-table>
                    </x-mine.table>
                </x-mine.card-container>
            </x-mine.bg-container>
        </x-mine.datas>
</x-app-layout>
