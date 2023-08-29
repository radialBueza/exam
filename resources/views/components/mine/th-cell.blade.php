@props(['col', 'sort' => true])

<th scope="col" class="px-6 py-3 hover:ring-1 hover:ring-gray-300 hover:bg-gray-300"
    @isset ($col)
    @click="sort('{{$col}}')"
    @endisset
    {{-- @click="sort('{{$col}}')" --}}
    >
    {{$slot}}
    @isset ($col)
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
    @endisset
    {{-- <template x-if="sortAsc">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-block w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75L12 3m0 0l3.75 3.75M12 3v18" />
        </svg>
    </template>
    <template x-if="!sortAsc">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-block w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25L12 21m0 0l-3.75-3.75M12 21V3" />
        </svg>
    </template> --}}
</th>
