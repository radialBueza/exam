<div
    x-data = "{
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
                    <th scope="col" class="px-6 py-3 hover:ring-1 hover:ring-gray-300 hover:bg-gray-300" @click="sort('name')">
                        Name
                        <template x-if="sortAsc">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-block w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75L12 3m0 0l3.75 3.75M12 3v18" />
                            </svg>
                        </template>
                        <template x-if="!sortAsc">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-block w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25L12 21m0 0l-3.75-3.75M12 21V3" />
                            </svg>
                        </template>
                    </th>
                    <th scope="col" class="px-6 py-3 hover:ring-1 hover:ring-gray-300 hover:bg-gray-300" @click="sort('created_at')">
                        Created
                        <template x-if="sortAsc">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-block w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75L12 3m0 0l3.75 3.75M12 3v18" />
                            </svg>
                        </template>
                        <template x-if="!sortAsc">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-block w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25L12 21m0 0l-3.75-3.75M12 21V3" />
                            </svg>
                        </template>
                    </th>
                    <th scope="col" class="px-6 py-3"></th>
                </tr>
            <thead>
            <tbody>
                <template x-cloak x-for="data in pagedDatas" :key="data.id" >
                    <tr class="bg-white border-b">
                        <td class="px-6 py-3"><input type="checkbox" :checked="toDelete.items.includes(data.id)" @click="addDelete(data.id)"></td>
                        {{-- <td x-text="data.name" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap capitalize "></td> --}}
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap capitalize hover:underline hover:text-gray-700"><a :href="`${url}/${data.id}`" x-text="data.name" ></a></td>
                        <td x-text="(new Date(data.created_at)).toLocaleString()" class="px-6 py-4"></td>
                        <td class="px-6 py-4 flex justify-center items-center space-x-2">
                            <div class="inline-flex justify-start items-center gap-1">
                                <button @click="edit(data.id)" class=" flex-1 bg-green-500 focus:ring-green-700 inline-flex items-center px-4 py-2 border-transparent rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">Edit</button>
                                <button @click="destroy(data.id)" class=" flex-1 bg-red-500 focus:ring-red-700 inline-flex items-center px-4 py-2 border-transparent rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">Delete</button>
                            </div>
                        </td>
                    </tr>
                </template>
            </tbody>
    </table>
    <div class="flex justify-center items-center space-x-2">
        <button @click="prevPage" class=" border-black border-2 focus:ring-black inline-flex items-center px-4 py-2 rounded-md font-semibold text-xs text-black tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                <path fill-rule="evenodd" d="M7.72 12.53a.75.75 0 010-1.06l7.5-7.5a.75.75 0 111.06 1.06L9.31 12l6.97 6.97a.75.75 0 11-1.06 1.06l-7.5-7.5z" clip-rule="evenodd" />
            </svg>
        </button>
        <button @click="nextPage" class=" border-black border-2 focus:ring-black inline-flex items-center px-4 py-2 rounded-md font-semibold text-xs text-black tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                <path fill-rule="evenodd" d="M16.28 11.47a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 011.06-1.06l7.5 7.5z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>
</div>
