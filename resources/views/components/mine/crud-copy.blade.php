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
    {{$slot}}
</div>
