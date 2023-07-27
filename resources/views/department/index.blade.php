<x-app-layout title="Departments">
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            Department
        </h1>
    </x-slot>
    {{-- alpine dive to get data and for other components to works --}}
    <x-mine.crud-table-container :$datas url="{{route('departments.index')}}">
        {{-- main content --}}
        <x-mine.bg-container>
            {{-- add and delete --}}
            <x-mine.card-container>
                <x-mine.cdp pdfUrl=" "/>
            </x-mine.card-container>
            {{-- table and search bar --}}
            <x-mine.card-container>
                <x-mine.search/>
                <x-mine.table>
                    <x-slot name="thead">
                        <x-mine.th-cell col="name">
                            name
                        </x-mine.th-cell>
                        <x-mine.th-cell col="created_at">
                            created
                        </x-mine.th-cell>
                    </x-slot>
                    <x-mine.td-cell-primary>
                        <a :href="`${url}/${data.id}`" x-text="data.name" ></a>
                    </x-mine.td-cell-primary>
                </x-mine.table>
                <x-mine.loading condition="!datas"/>
            </x-mine.card-container>
        </x-mine.bg-container>
        {{-- Pop up to add data --}}
        <x-mine.modal open="openAdd">
            <x-mine.form-modal title="add department" subtitle="Add a department for the school." form="addDept" :inputs="[
                'name' => [
                    'length' => true,
                    'required' => true
                ]
            ]">
                <x-mine.text-input title="department name"/>
                <x-slot name="button">
                    <x-mine.button type="submit" class="border-transparent border text-white bg-green-600 focus:ring-green-600 hover:bg-green-500 focus:bg-green-500 active:bg-green-700">
                        Add Department
                    </x-mine.button>
                </x-slot>
            </x-mine.form-modal>
        </x-mine.modal>
        <x-mine.modal open="openDel">
        </x-mine.modal>
    </x-mine.crud-table-container>
</x-app-layout>
