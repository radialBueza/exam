@props([
    'search',
    'addTitle',
    'addSub',
    'addForm',
    'addRoute',
    'inputs' => ['name'],
    'dellAllRoute',
    'dellOneRoute',
    'updateTitle',
    'updateSub',
    'updateForm',
    'updateRoute',
])

<div x-data="{
    openAdd: false,
    openDel: false,
    openEdit: false,
    openOneDel: false,
    oneDel: 0,
    toEdit: {},
    toDelete: { items: []},

    edit(id) {
        const getIndex = (el) => el.id == id
        let index = datas.findIndex(getIndex)
        this.toEdit = datas[index]
        this.openEdit = true
        return
    },

    addDelete(id) {
        const exist = (ele) => ele == id
        const result = this.toDelete.items.findIndex(exist)

        {{-- value is not in toDelete. add to delete --}}
        if (result < 0) {
            this.toDelete.items.push(id)

            return
        }

        {{-- value is in toDelete. remove in delete --}}
        this.toDelete.items.splice(result, 1)
        return
    },

    {{-- Add all item to delete --}}
    selectAll() {
        if(this.toDelete.items.length >= datas.length) {
            this.toDelete.items = []
            return
        }
        for (let data of datas) {
            if (this.toDelete.items.includes(data.id)) {
                continue;
            }
            this.toDelete.items.push(data.id)
        }
    },

    {{-- delete one item --}}
    async destroy(id) {
        this.oneDel = id
        this.openOneDel = true
    },
}">
    @isset($head)
        {{$head}}
    @endisset
    <x-mine.bg-container>
        <x-mine.card-container class="p-5 sm:p-9">
            <x-mine.cdp/>
            <x-mine.search :url="$search"/>
            <x-mine.table>
                <x-slot name="thead">
                    {{$thead}}
                </x-slot>
                {{$table}}
                <x-slot name="action">
                    {{$action}}
                </x-slot>
            </x-mine.table>
        </x-mine.card-container>
        <x-mine.modal open="openAdd">
            <x-mine.form-modal :title="$addTitle" :subtitle="$addSub" :form="$addForm" :$inputs :url="$addRoute">
                {{$addModal}}
                <x-slot name="buttons">
                    <x-mine.submit-button class="justify-end">
                        <x-mine.button type="submit" class="border-transparent border text-white bg-green-600 focus:ring-green-600 hover:bg-green-500 focus:bg-green-500 active:bg-green-700">
                            {{$addTitle}}
                        </x-mine.button>
                    </x-mine.submit-button>
                </x-slot>
            </x-mine.form-modal>
        </x-mine.modal>
        <x-mine.modal open="openDel">
            <x-mine.delete-modal :delUrl="$dellAllRoute"/>
        </x-mine.modal>
        <x-mine.modal open="openOneDel">
            <x-mine.delete-one-modal :delUrl="$dellOneRoute"/>
        </x-mine.modal>
        <x-mine.modal open="openEdit">
            <x-mine.form-modal :title="$updateTitle" :subtitle="$updateSub" :form="$updateForm" :$inputs :url="$updateRoute">
                {{$upModal}}
                <x-slot name="buttons">
                    <x-mine.submit-button class="justify-end">
                        <x-mine.button type="submit" class="border-transparent border text-white bg-green-600 focus:ring-green-600 hover:bg-green-500 focus:bg-green-500 active:bg-green-700">
                            {{$updateTitle}}
                        </x-mine.button>
                    </x-mine.submit-button>
                </x-slot>
            </x-mine.form-modal>
        </x-mine.modal>
    </x-mine.bg-container>
</div>
