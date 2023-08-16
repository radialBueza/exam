@props(['datas', 'url', 'index'])

<div x-data="{
    {{-- retrieve data --}}
    datas: {{$datas}},
    url: new URL('{{$url}}'),
    index: new URL('{{$index}}'),
    openAdd: false,
    openDel: false,
    openEdit: false,
    toEdit: [],
    toDelete: { items: []},
    sortCol: null,
    sortAsc: false,
    sort(col = '') {
        if (!col.length == 0) {
            this.sortCol = col;
        }

        if(this.sortCol === col) {
            this.sortAsc = !this.sortAsc;
        }

        this.datas.sort((a, b) => {
          if(a[this.sortCol] < b[this.sortCol]) return this.sortAsc?1:-1;
          if(a[this.sortCol] > b[this.sortCol]) return this.sortAsc?-1:1;
          return 0;
        });
    },

    {{-- Open Edit Modal --}}
    edit(id) {
        const getIndex = (el) => el.id == id
        let index = this.datas.findIndex(getIndex)
        this.toEdit = this.datas[index]
        this.openEdit = true
        console.log(this.toEdit.account_type)
        return
    }
}">
    {{$slot}}
</div>
