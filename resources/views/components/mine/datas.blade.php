{{-- @props(['datas', 'url', 'index']) --}}
@props(['datas', 'index'])


<div x-data="{
    {{-- retrieve data --}}
    datas: {{$datas}},
    {{-- url: new URL('{{$url}}'), --}}
    index: new URL('{{$index}}'),
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
}">
    {{$slot}}
</div>
