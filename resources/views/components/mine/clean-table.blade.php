<div>
    <template x-cloack x-if="datas">
        <div class="inline-block text-xs font-light text-slate-400 ml-6"> <span x-text="entryStart"></span> - <span x-text="entryEnd"></span> of <span x-text="datas.length"></span></div>
    </template>
    <div class="overflow-x-auto pb-2">
        <table class="w-full table-auto text-sm text-left text-gray-500 mb-4">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 whitespace-nowrap">
                <tr class="border-b bg-gray-100">
                    {{$thead}}
                </tr>
            <thead>
            <tbody>
                <template x-cloak x-for="data in pagedDatas" :key="data.id" >
                    <tr class="bg-white border-b ">
                        {{$slot}}
                        <td scope="col" x-text="data.created_at" class="px-6 py-4"></td>
                        @isset($action)
                            {{$action}}
                        @endisset
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

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
