<div x-data="{
    open: false
}"
class="relative"
>
{{-- <button @click="open = !open" class="block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
    Structure
</button> --}}
    {{$button}}
<div
    x-show="open"
    @click.outside = "open = false"
    class="block bg-slate-50"
>
    {{$slot}}
</div>
</div>
