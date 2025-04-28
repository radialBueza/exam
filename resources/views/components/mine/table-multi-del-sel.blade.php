{{-- @props(['url']) --}}
<div x-data="{
    {{-- add or remove items to be deleted --}}

    addDelete(id) {
        const exist = (ele) => ele == id
        const result = toDelete.items.findIndex(exist)

        {{-- value is not in toDelete. add to delete --}}
        if (result < 0) {
            toDelete.items.push(id)

            return
        }

        {{-- value is in toDelete. remove in delete --}}
        toDelete.items.splice(result, 1)
        return
    },

    {{-- Add all item to delete --}}
    selectAll() {
        if(toDelete.items.length >= datas.length) {
            toDelete.items = []
            return
        }
        for (let data of datas) {
            if (toDelete.items.includes(data.id)) {
                continue;
            }
            toDelete.items.push(data.id)
        }
    },

    {{-- delete one item --}}
    async destroy(id) {
        oneDel = id
        openOneDel = true
        console.log(oneDel)
    },
}">
    {{$slot}}
</div>
