<x-app-layout title="Departments">
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            Department
        </h1>
    </x-slot>
    {{-- alpine dive to get data and for other components to works --}}

        {{-- main content --}}
    <x-mine.bg-container>
        <x-mine.crud-table-container :$datas url="{{route('departments.index')}}">
            <x-mine.card-container>
                <x-mine.cdp pdfUrl=" "/>
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
            <x-mine.modal open="openAdd">
                <x-mine.form-modal title="add department" subtitle="Add a department for the school." form="addDept"
                :inputs="['name' => ['length', 'required']]" resCode="201">
                    <x-mine.text-input title="department name"/>
                </x-mine.form-modal>
            </x-mine.modal>
            <x-mine.modal open="openDel">
                <x-mine.delete-modal delUrl="{{route('departments.destroyAll')}}"/>
            </x-mine.modal>
            <x-mine.modal open="openEdit">
                <x-mine.form-modal title="update department" subtitle="Update a department of the school." form="updateDept" :inputs="[
                    'name' => ['length', 'required']
                ]" method="PUT" url="{{route('departments.index')}}/${datas[toEdit].id}">
                    <x-mine.text-input title="department name" value="datas[toEdit].name" class="capitalize"/>
                </x-mine.form-modal>
            </x-mine.modal>
        </x-mine.crud-table-container>
    </x-mine.bg-container>
        {{-- add data --}}
        {{-- <x-mine.modal open="openAdd">
            <x-mine.form-modal title="add department" subtitle="Add a department for the school." form="addDept"
            :inputs="['name' => ['length', 'required']]" resCode="201">
                <x-mine.text-input title="department name"/>
            </x-mine.form-modal>
        </x-mine.modal> --}}
        {{-- Delete many --}}
        {{-- <x-mine.modal open="openDel">
            <x-mine.delete-modal delUrl="{{route('departments.destroyAll')}}"/>
        </x-mine.modal> --}}
        {{-- update --}}
        {{-- <x-mine.modal open="openEdit">
            <x-mine.form-modal title="update department" subtitle="Update a department of the school." form="updateDept" :inputs="[
                'name' => ['length', 'required']
            ]" method="PUT" url="`{{route('departments.index')}}/${datas[toEdit].id}`">
                <x-mine.text-input title="department name" value="datas[toEdit].name" class="capitalize"/>
            </x-mine.form-modal>
        </x-mine.modal> --}}

</x-app-layout>


