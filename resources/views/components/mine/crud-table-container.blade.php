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
    pageSize: 10,
    curPage: 1,
    sortCol: null,
    sortAsc: false,
    get entryStart() {
        return this.pageSize * this.curPage - 9
    },
    get entryEnd() {
        if((this.curPage * this.pageSize) >= this.datas.length) return this.datas.length
        return this.curPage * this.pageSize
    },
    nextPage() {
        if((this.curPage * this.pageSize) < this.datas.length) this.curPage++
    },
    prevPage() {
        if( this.curPage > 1) this.curPage--;
    },
    get pagedDatas() {
        if(this.datas) {
            return this.datas.filter((row, index) => {
                let start = (this.curPage-1)*this.pageSize
                let end = this.curPage*this.pageSize
                if(index >= start && index < end) return true
            })
        } else return [];
    },
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
        return
    }
}">
    {{$slot}}
</div>
