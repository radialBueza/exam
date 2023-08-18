<div
    x-data = "{
    pageSize: 10,
    curPage: 1,

    get entryStart() {
        return this.pageSize * this.curPage - 9
    },
    get entryEnd() {
        if((this.curPage * this.pageSize) >= datas.length) return datas.length
        return this.curPage * this.pageSize
    },

    nextPage() {
        if((this.curPage * this.pageSize) < datas.length) this.curPage++
    },
    prevPage() {
        if( this.curPage > 1) this.curPage--;
    },
    get pagedDatas() {
        if(datas) {
            return datas.filter((row, index) => {
                let start = (this.curPage-1)*this.pageSize
                let end = this.curPage*this.pageSize
                if(index >= start && index < end) return true
            })
        } else return [];
    },
}" x-show="datas" class="overflow-x-auto pb-2">
    {{$slot}}
</div>
