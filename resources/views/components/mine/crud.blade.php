<div x-data="{
    openAdd: false,
    openDel: false,
    openEdit: false,
    toEdit: {},
    toDelete: { items: []},

    edit(id) {
        const getIndex = (el) => el.id == id
        let index = this.datas.findIndex(getIndex)
        this.toEdit = this.datas[index]
        this.openEdit = true
        return
    }
}">
    {{$slot}}
</div>
