<div x-data="{
    searchTxt: '',
    async search() {
        datas = null
        url.searchParams.set('search', this.searchTxt)

        const res = await fetch(this.url)

        console.log(res)

        const result = await res.json()

        console.log(result)

        return this.datas = result
    },
}">
    <form action="" class="flex justify-center my-6" @submit.prevent="search">
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
