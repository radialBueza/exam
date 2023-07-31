<x-app-layout title="Department | {{$info->name}}">
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            Department
        </h1>
    </x-slot>
    <x-mine.bg-container>
        <x-mine.crud-table-container :$datas url="{{route('gradeLevels.index')}}" index="{{route('gradeLevels.all')}}">
            <x-mine.bg-container>
                <x-mine.card-container class="mb-6">
                    <div>
                        <h2 class="font-semibold text-lg text-gray-800 leading-tight capitalize">
                            {{$info->name}}
                        </h2>
                        <p class="font-light text-xs"><span class="font-medium">Administrator:</span>
                        @if (empty($admin[0]))
                            {{'N/A'}}
                        @else
                            {{$admin[0]->name}}
                        @endif
                        </p>
                    </div>
                </x-mine.card-container>
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
                            <a :href="`${index}/${data.id}`" x-text="data.name" ></a>
                        </x-mine.td-cell-primary>
                    </x-mine.table>
                    <x-mine.loading condition="!datas"/>
                </x-mine.card-container>
            </x-mine.bg-container>
            <x-mine.modal open="openAdd">
                <x-mine.form-modal title="add grade level" subtitle="Add a grade level for the school." form="addGradeLevel"
                :inputs="[
                    'name' => ['length', 'required'],
                    'department_id' => ['required'],
                    'show' => ['required']
                ]">
                    <x-mine.text-input title="grade level name"/>
                    <input type="hidden" name="department_id" id="department_id" value="{{$info->id}}">
                    <input type="hidden" name="show" id="show" value="true">
                </x-mine.form-modal>
            </x-mine.modal>
            <x-mine.modal open="openDel">
                <x-mine.delete-modal delUrl="{{route('departments.destroyAll')}}"/>
            </x-mine.modal>
            <x-mine.modal open="openEdit">
                <x-mine.form-modal title="update grade level" subtitle="Update a department of the school." form="updateDept" :inputs="[
                    'name' => ['length', 'required'],
                    'department_id' => ['required'],
                    'show' => ['required']
                ]" method="PUT" url="{{route('departments.index')}}/${toEdit.id}">
                    <x-mine.text-input title="grade level name" value="datas[toEdit].name" class="capitalize"/>
                    <input type="hidden" name="department_id" id="department_id" value="{{$info->id}}">
                    <input type="hidden" name="show" id="show" value="true">
                </x-mine.form-modal>
            </x-mine.modal>
        </x-mine.crud-table-container>
    </x-mine.bg-container>
</x-app-layout>
