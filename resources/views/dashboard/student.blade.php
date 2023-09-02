<x-app-layout title="Dashboard">
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
            Dashboard
        </h1>
    </x-slot>
        <x-mine.bg-container>
            <x-mine.card-container>
                <x-mine.table>
                    <x-mine.clean-table>
                        <x-slot name="thead">
                            <th scope="col" class="px-6 py-3"><input type="checkbox" :checked="toDelete.items.length == datas?.length  && datas.length != 0" @click="selectAll()"></th>
                            <x-mine.th-cell col="name">
                                name
                            </x-mine.th-cell>
                            <x-mine.th-cell col="created_at">
                                created on
                            </x-mine.th-cell>
                            <th scope="col" class="px-6 py-3"></th>
                        </x-slot>
                        <td class="px-6 py-3"><input type="checkbox" :checked="toDelete.items.includes(data.id)" @click="addDelete(data.id)"></td>
                        <x-mine.td-cell-primary>
                            <a :href="`${index}/${data.id}`" x-text="data.name" ></a>
                        </x-mine.td-cell-primary>
                        <x-slot name="action">
                            <x-mine.td-action/>
                        </x-slot>
                    </x-mine.clean-table>
                </x-mine.table>
            </x-mine.card-container>
        </x-mine.bg-container>

</x-app-layout>
