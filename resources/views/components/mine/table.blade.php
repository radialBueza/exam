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
        const delUrl = url + '/' + id

        const res = await fetch(delUrl, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content,
                'Accept': 'application/json'
            }
        })

        if (res.status == 200) {
            datas = datas.filter(data => data.id != id)
        }
    },
}" x-show="datas" class="overflow-x-auto pb-2">
    <template x-cloack x-if="datas">
        <div class="text-xs font-light text-slate-400 pl-4"> <span x-text="entryStart"></span> - <span x-text="entryEnd"></span> of <span x-text="datas.length"></span></div>
    </template>
        <table class="w-full table-auto text-sm text-left text-gray-500 mb-4">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <tr class="border-b bg-gray-100">
                    <th scope="col" class="px-6 py-3"><input type="checkbox" :checked="toDelete.items.length == datas?.length" @click="selectAll()"></th>
                    {{$thead}}
                    <th scope="col" class="px-6 py-3"></th>
                </tr>
            <thead>
            <tbody>
                <template x-cloak x-for="data in pagedDatas" :key="data.id" >
                    <tr class="bg-white border-b">
                        <td class="px-6 py-3"><input type="checkbox" :checked="toDelete.items.includes(data.id)" @click="addDelete(data.id)"></td>
                        {{$slot}}
                        <td x-text="(new Date(data.created_at)).toLocaleString()" class="px-6 py-4"></td>
                        <td class="px-6 py-4 flex justify-center items-center space-x-2">
                            <div class="inline-flex justify-start items-center gap-2">
                                <x-mine.button do="edit(data.id)" class="text-white border border-transparent bg-green-600 focus:ring-green-600 hover:bg-green-500 focus:bg-green-500 active:bg-green-700">Edit</x-mine.button>
                                <x-mine.button do="destroy(data.id)" class="text-white border border-transparent bg-red-600 focus:ring-red-600 hover:bg-red-500 focus:bg-red-500 active:bg-red-700">Delete</x-mine.button>
                            </div>
                        </td>
                    </tr>
                </template>
            </tbody>
    </table>
    <div class="flex justify-center items-center space-x-2">
        <x-mine.button do="prevPage" class="text-black border-2 border-black focus:ring-black">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                <path fill-rule="evenodd" d="M7.72 12.53a.75.75 0 010-1.06l7.5-7.5a.75.75 0 111.06 1.06L9.31 12l6.97 6.97a.75.75 0 11-1.06 1.06l-7.5-7.5z" clip-rule="evenodd" />
            </svg>
        </x-mine.button>
        <x-mine.button do="nextPage" class="text-black border-2 border-black focus:ring-black">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                <path fill-rule="evenodd" d="M16.28 11.47a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 011.06-1.06l7.5 7.5z" clip-rule="evenodd" />
            </svg>
        </x-mine.button>

    </div>
</div>
