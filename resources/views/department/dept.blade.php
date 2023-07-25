<x-app-layout title="Departments">
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            Department
        </h1>
    </x-slot>
    <div class="py-12" x-data = "{
        {{-- retrieve data --}}
        datas: {{ Js::from($datas)}},
        url: new URL('{{route('departments.index')}}'),
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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Buttons --}}
            <section class="p-5 sm:p-9 bg-white shadow sm:rounded-lg">
                <div class="max-x-xl">
                    <div class="flex justify-between">
                        <div class="inline-flex justify-start items-center gap-1">
                            <button @click="openAdd = !openAdd" class=" flex-1 bg-green-500 focus:ring-green-700 inline-flex items-center px-4 py-2 border-transparent rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">Add</button>
                            <button @click="openDel = !openDel" class=" flex-1 bg-red-500 focus:ring-red-700 inline-flex items-center px-4 py-2 border-transparent rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">Delete</button>
                        </div>
                        <div class="inline-flex justify-start items-center gap-1">
                            <a href="http://" target="_blank" rel="noopener noreferrer" class="bg-green-500 focus:ring-green-700 inline-flex items-center px-4 py-2 border-transparent rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">PDF</a>
                        </div>
                    </div>
                </div>
            </section>

            {{-- tables and search bar --}}
            <section class="p-4 sm:p-9 bg-white shadow sm:rounded-lg">
                    <div class="max-x-xl">
                        {{-- search bar --}}
                        <div x-data="{
                            searchTxt: '',
                            async search() {
                                this.datas = null
                                this.url.searchParams.set('search', this.searchTxt)


                                const res = await fetch(this.url)

                                const result = await res.json()

                                return this.datas = result
                            },
                        }">
                            <form action="" class="flex justify-center mb-8" @submit.prevent="search">
                                <label for="search" class="sr-only">Search</label>
                                <div class="flex border-0 rounded-full bg-gray-100 w-4/5 max-w-xl">
                                    <div class="relative w-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="absolute w-7 h-7 z-10 p-1 inset-y-2 left-2">
                                            <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                                        </svg>
                                        <input type="search" name="search" id="search" placeholder="Search..." class="placeholder:italic placeholder:text-slate-400 text-slate-600 w-full bg-gray-100 border border-gray-200 rounded-l-full pl-10 pr-2 py-2 focus:ring-1 focus:ring-red-600 focus:border-red-600" x-model="searchTxt">
                                    </div>
                                    <button type="submit" name="submit" class="px-4 font-semibold text-xs shadow-sm rounded-r-full p-1 border hover:bg-red-600 hover:outline-1 hover:ring-1 hover:ring-red-600 hover:z-10 hover:text-white">Search</button>
                                </div>
                            </form>
                        </div>


                        {{-- table --}}

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
                            }"
                            x-show="datas" class="overflow-x-auto pb-2">
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



                        {{-- loading image --}}
                        <template x-cloak x-if="!datas">
                            <div role="status" class="flex justify-center m-2">
                                <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin  fill-red-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                </svg>
                                <span class="sr-only">Loading...</span>
                            </div>
                        </template>
                    </div>
            </section>
        </div>
        {{-- Add Modal --}}
        <div
            x-data="{
                showForm: true,
                confirm: false,
                name: null,
                error: { msg:''},
                validate(e) {
                    {{-- this.name = e.target.value.replace(/\s+/g, ' ').trim().toLowerCase() --}}
                    this.name = e.target.value


                    if(this.name.length < 4) {
                        this.error.msg = 'Text must be longer than 4 characters'
                        return
                    }

                    if(this.name.length > 20) {
                        this.error.msg = 'Text must not be longer than 20 characters'

                        return
                    }
                    this.error.msg = ''

                    return
                },

                async sendData(form) {
                    if( !this.name ) {
                        this.error.msg = 'Department Name is required'
                        return
                    }

                    if(this.error.msg) {
                        return
                    }

                    this.showForm = false;
                    {{-- const data = {
                        name: this.name
                    } --}}

                    const inputForm = new FormData(form)
                    const input = new URLSearchParams(inputForm)

                    const res = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content,
                            {{-- 'Content-Type': 'application/json', --}}
                            'Accept': 'application/json'
                        },
                        body: input
                    })

                    if (res.status == 201) {
                        this.confirm = true
                        const result = await res.json()
                        this.datas = result.data
                        sort()
                        return
                    }

                    if (res.status == 422) {
                        this.showForm = true
                        const result = await res.json()

                        this.error.msg = result.errors.name[0]

                        return
                    }
                },

                again() {
                    this.showForm = true
                    this.error.msg = ''
                    this.confirm = false
                },
            }"
            x-cloak x-show="openAdd"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div
                class="bg-gray-100/75 flex justify-center items-start min-h-screen px-4 text-center sm:p-0"
                x-init="$watch('openAdd', (value) => {
                    if (value == true) {
                        showForm = true
                        error.msg = ''
                        confirm = false
                    }
                })"
            >

                <div
                    x-cloak x-show="openAdd" @click.outside="openAdd = false"
                    x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="inline-block w-full max-w-xl p-6 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl"
                >
                    <template x-cloak x-if="showForm">
                        <div>
                            <div class="flex items-center justify-between space-x-4">
                                <h3 class="text-xl font-medium text-gray-800 ">Add Department</h3>

                                <button @click="openAdd = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
                            </div>

                            <p class="mt-2 text-sm text-gray-500 ">
                                Add a department for the school.
                            </p>

                            {{-- <form class="mt-5" id="adddata" @submit.prevent="await sendData()"> --}}
                            <form class="mt-5" id="addData" @submit.prevent="await sendData($el)">
                                <div>
                                    <label for="name" class="block text-sm text-gray-700 capitalize">Department name</label>

                                    <input id="name" name="name" placeholder="Enter Depatment Name . . . " type="text" class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md"
                                        @keyup="validate" :class="error.msg && 'border-red-800 ring-1 ring-red-800 focus:ring-red-800 focus:border-red-800'"
                                    >

                                    <div x-show="error.msg" x-text="error.msg" class="text-red-800 text-sm font-semibold my-2">
                                    </div>

                                </div>

                                <div class="flex justify-end mt-6">
                                    <button type="submit" class="bg-green-500 focus:ring-green-700 inline-flex items-center px-4 py-2 border-transparent rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Add Department
                                    </button>
                                </div>
                            </form>
                        </div>
                    </template>

                    <template x-cloak x-if="!showForm&&!confirm">
                        <div role="status" class="flex justify-center m-2">
                            <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin  fill-red-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                    </template>

                    <template x-cloak x-if="confirm">
                        <div role="confirm" class="flex flex-col justify-center items-center gap-2 m-2">
                            <svg class="w-8 h-8 mr-2 text-gray-200 fill-green-600 animate-pulse" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" />
                            </svg>
                            <p class="text-xl font-medium text-green-800">Successfully created</p>
                            <div class="flex justify-between gap-2">
                                <button @click="again()" class="flex-1 bg-green-500 focus:ring-green-700 inline-flex items-center px-4 py-2 border-transparent rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">Add</button>
                                <button @click="openAdd = false" class="flex-1 bg-red-500 focus:ring-red-700 inline-flex items-center px-4 py-2 border-transparent rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">Close</button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
        {{-- Delete Modal --}}
        <div
            x-data="{
                showForm: true,
                confirm: false,
                delUrl: '{{route('departments.destroyAll')}}',
                async destroyAll() {
                    const res = await fetch(this.delUrl, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },

                        body: JSON.stringify(toDelete)
                    })

                    this.showForm = false

                    if (res.status == 200) {
                        datas = datas.filter(data => !toDelete.items.includes(data.id))

                        this.confirm = true
                    }

                },

                close() {
                    openDel = false
                    this.showForm = true
                    this.confirm = false
                }

            }"
            x-cloak x-show="openDel"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div
                class="bg-gray-100/75 flex justify-center items-start min-h-screen px-4 text-center sm:p-0"
                x-init="$watch('openDel', (value) => {
                    if (value == true) {
                        showForm = true
                        confirm = false
                    }
                })"
            >

                <div
                    x-cloak x-show="openDel" @click.outside="openDel = false"
                    x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="inline-block w-full max-w-xl p-6 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl"
                >
                    <template x-cloak x-if="showForm">
                        <div>
                            <div class="flex flex-col items-center justify-center space-y-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 stroke-red-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                </svg>
                                <p class="text-xl font-medium text-red-500">Delete Items?</p>
                                <div class="flex items-center justify-between gap-2">
                                    <button @click="destroyAll()" class="flex-1 bg-green-500 focus:ring-green-700 inline-flex items-center px-4 py-2 border-transparent rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">Confirm</button>
                                    <button @click="openDel = false" class="flex-1 bg-red-500 focus:ring-red-700 inline-flex items-center px-4 py-2 border-transparent rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">Cancel</button>
                                    {{-- <button @click="fuck">Delete</button> --}}
                                </div>
                            </div>
                        </div>
                    </template>

                    <template x-cloak x-if="!showForm&&!confirm">
                        <div role="status" class="flex justify-center m-2">
                            <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin  fill-red-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                    </template>

                    <template x-cloa x-if="confirm">
                        <div role="confirm" class="flex flex-col justify-center items-center gap-2 m-2">
                            <svg class="w-8 h-8 mr-2 text-gray-200 fill-green-600 animate-pulse" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" />
                            </svg>
                            <h3 class="text-xl font-medium text-green-800 ">Successfully Deleted</h3>
                            <div class="flex justify-center">
                                <button @click="openDel = false" class="flex-1 bg-green-500 focus:ring-green-700 inline-flex items-center px-4 py-2 border-transparent rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">Close</button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
        {{-- Edit Modal --}}
        <div
            x-data="{
                showForm: true,
                confirm: false,
                name: datas[toEdit].name,
                error: { msg:''},
                validate(e) {
                    {{-- this.name = e.target.value.replace(/\s+/g, ' ').trim().toLowerCase() --}}
                    this.name = e.target.value


                    if(this.name.length < 4) {
                        this.error.msg = 'Text must be longer than 4 characters'
                        return
                    }

                    if(this.name.length > 20) {
                        this.error.msg = 'Text must not be longer than 20 characters'

                        return
                    }
                    this.error.msg = ''

                    return
                },

                async sendData(form) {
                    if( !this.name ) {
                        this.error.msg = 'Department Name is required'
                        return
                    }

                    if(this.error.msg) {
                        return
                    }

                    this.showForm = false;

                    const inputForm = new FormData(form)
                    const input = new URLSearchParams(inputForm)


                    const res = await fetch(url + '/' + datas[toEdit].id, {
                        method: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content,
                            'Accept': 'application/json'
                        },
                        body: input
                    })

                    if (res.status == 200) {
                        this.confirm = true

                        const result = await res.json()
                        datas = result.data
                        sort()
                        return
                    }

                    if (res.status == 422) {
                        this.showForm = true
                        const result = await res.json()

                        this.error.msg = result.errors.name[0]

                        return
                    }

                },

                again() {
                    this.showForm = true
                    this.error.msg = ''
                    this.confirm = false
                },
            }"
            x-cloak x-show="openEdit"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div
                class="bg-gray-100/75 flex justify-center items-start min-h-screen px-4 text-center sm:p-0"
                x-init="$watch('openEdit', (value) => {
                    if (value == true) {
                        showForm = true
                        error.msg = ''
                        confirm = false
                    }
                })"
            >

                <div
                    x-cloak x-show="openEdit" @click.outside="openEdit = false"
                    x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="inline-block w-full max-w-xl p-6 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl"
                >
                    <template x-cloak x-if="showForm">
                        <div>
                            <div class="flex items-center justify-between space-x-4">
                                <h3 class="text-xl font-medium text-gray-800 ">Update Department</h3>

                                <button @click="openEdit = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
                            </div>

                            <p class="mt-2 text-sm text-gray-500 ">
                                Update a department of the school.
                            </p>

                            <form class="mt-5" id="updateData" @submit.prevent="await sendData($el)">
                                <div>
                                    <label for="name" class="block text-sm text-gray-700 capitalize">Department Name</label>

                                    <input id="name" name="name" placeholder="Enter Depatment Name . . . " type="text" :value="datas[toEdit].name" class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md capitalize"
                                        @keyup="validate" :class="error.msg && 'border-red-800 ring-1 ring-red-800 focus:ring-red-800 focus:border-red-800'"
                                    >

                                    <input id="id" name="id" type="hidden" :value="datas[toEdit].id" >

                                    <div x-show="error.msg" x-text="error.msg" class="text-red-800 text-sm font-semibold my-2">
                                    </div>

                                </div>

                                <div class="flex justify-end mt-6">
                                    <button type="submit" class="bg-green-500 focus:ring-green-700 inline-flex items-center px-4 py-2 border-transparent rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Update Department
                                    </button>
                                </div>
                            </form>
                        </div>
                    </template>

                    <template x-cloak x-if="!showForm&&!confirm">
                        <div role="status" class="flex justify-center m-2">
                            <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin  fill-red-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                    </template>

                    <template x-cloak x-if="confirm">
                        <div role="confirm" class="flex flex-col justify-center items-center gap-2 m-2">
                            <svg class="w-8 h-8 mr-2 text-gray-200 fill-green-600 animate-pulse" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" />
                            </svg>
                            <p class="text-xl font-medium text-green-800">Successfully created</p>
                            <div class="flex justify-between gap-2">
                                <button @click="again()" class="flex-1 bg-green-500 focus:ring-green-700 inline-flex items-center px-4 py-2 border-transparent rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">Add</button>
                                <button @click="openEdit = false" class="flex-1 bg-red-500 focus:ring-red-700 inline-flex items-center px-4 py-2 border-transparent rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">Close</button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
