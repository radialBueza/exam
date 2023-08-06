<x-app-layout title="Subject">
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
            Subject
        </h1>
    </x-slot>
    <x-mine.bg-container>
        <x-mine.crud-table-container :$datas url="{{route('subjects.index')}}" index="{{route('subjects.all')}}">
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
            <x-mine.modal open="openAdd">
                <x-mine.form-modal title="add subject" subtitle="Add a subject for the school." form="addSubject"
                :inputs="[
                        'name' => ['required', 'length'],
                    ]">
                    <x-mine.text-input title="Subject name"/>
                </x-mine.form-modal>
            </x-mine.modal>
            <x-mine.modal open="openDel">
                <x-mine.delete-modal delUrl="{{route('subjects.destroyAll')}}"/>
            </x-mine.modal>
            <x-mine.modal open="openEdit">
                <x-mine.form-modal title="update subject" subtitle="Update a subject of the school." form="updateSubject" :inputs="[
                    'name' => ['length', 'required'],
                ]" method="PUT" url="{{route('subjects.index')}}/${toEdit.id}">
                    <x-mine.text-input title="section name" value="datas[toEdit].name" class="capitalize"/>
                </x-mine.form-modal>
            </x-mine.modal>
        </x-mine.crud-table-container>
    </x-mine.bg-container>
</x-app-layout>
