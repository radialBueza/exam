@props(['datas', 'url'])

<div x-data="{
    {{-- retrieve data --}}
    datas: {{ Js::from($datas)}},
    url: new URL('{{$url}}'),
    openAdd: false,
    openDel: false,
    openEdit: false,
    toEdit: 0,
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
        const index = (el) => el.id == id
        this.toEdit = this.datas.findIndex(index)
        this.openEdit = true
        console.log(this.toEdit)
        return
    }
}">
    {{$slot}}
</div>
