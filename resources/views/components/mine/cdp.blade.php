@props(['pdfUrl'])

<div class="flex justify-between pb-6 border-b">
    <div class="inline-flex justify-start items-center gap-2">
        <x-mine.button do="openAdd =! openAdd" class="text-white border border-transparent bg-green-600 focus:ring-green-600 hover:bg-green-500 focus:bg-green-500 active:bg-green-700">Add</x-mine.button>
        <x-mine.button do="openDel =! openDel" class="text-white border border-transparent bg-red-600 focus:ring-red-600 hover:bg-red-500 focus:bg-red-500 active:bg-red-700">Delete</x-mine.button>
    </div>
    <div class="inline-flex justify-start items-center gap-2">
        <x-mine.link-button href="{{$pdfUrl}}" class="border-transparent bg-sky-600 focus:ring-sky-600 hover:bg-sky-500 focus:bg-sky-500 active:bg-sky-700">
            Print/PDF
        </x-mine.link-button>
    </div>
</div>
