<x-app-layout title="Administrators">
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
            Administrators
        </h1>
    </x-slot>
    <x-mine.bg-container>
        <x-mine.crud-table-container :$datas url="{{route('admins.index')}}" index="{{route('admins.all')}}">
            <x-mine.card-container>
                <x-mine.cdp pdfUrl=" "/>
                <x-mine.search/>
                <x-mine.table>
                    <x-slot name="thead">
                        <x-mine.th-cell col="name">
                            name
                        </x-mine.th-cell>
                        <x-mine.th-cell col="created_at">
                            Registered On
                        </x-mine.th-cell>
                    </x-slot>
                    <x-mine.td-cell-primary>
                        <a :href="`${index}/${data.id}`" x-text="data.name" ></a>
                    </x-mine.td-cell-primary>
                </x-mine.table>
                <x-mine.loading condition="!datas"/>
            </x-mine.card-container>
            <x-mine.modal open="openAdd">
                <x-mine.form-modal title="Create Admin Account" subtitle="Add a admin account for the school." form="addAdmin"
                :inputs="[
                    'name' => ['length', 'required'],
                    'department_id' => ['required'],
                    // 'section_id' => [''],
                    // 'subject_id' => ['']
                ]">
                    <x-mine.text-input title="department name"/>
                    <x-mine.select-input name="department_id" title="Department" :$options/>


                </x-mine.form-modal>
            </x-mine.modal>
            <x-mine.modal open="openDel">
                <x-mine.delete-modal delUrl="{{route('departments.destroyAll')}}"/>
            </x-mine.modal>
            <x-mine.modal open="openEdit">
                <x-mine.form-modal title="update department" subtitle="Update a department of the school." form="updateDept" :inputs="[
                    'name' => ['length', 'required']
                ]" method="PUT" resCode="200" url="{{route('departments.index')}}/toEdit.id}">
                    <x-mine.text-input title="department name" class="capitalize"/>
                </x-mine.form-modal>
            </x-mine.modal>
        </x-mine.crud-table-container>
    </x-mine.bg-container>
</x-app-layout>
