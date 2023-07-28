@aware(['delUrl', 'open'])

<div x-data="{
    showForm: true,
    success: false,
    url: '{{$delUrl}}',
    async destroyAll() {
        const res = await fetch(this.url, {
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
            this.success = true
        }
    },
}" x-init="$watch('{{$open}}', (value) => {
    if (value == true) {
        showForm = true
        success = false
    }
})">
    <template x-cloak x-if="showForm">
        <div>
            <div class="flex flex-col items-center justify-center space-y-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 stroke-red-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>
                <p class="text-xl font-medium text-red-500">Delete Items?</p>
                <div class="flex items-center justify-between gap-2">
                    <x-mine.button do="destroyAll" class="text-white border border-transparent bg-green-600 focus:ring-green-600 hover:bg-green-500 focus:bg-green-500 active:bg-green-700">Confirm</x-mine.button>
                    <x-mine.button do="openDel = false" class="text-white border border-transparent bg-red-600 focus:ring-red-600 hover:bg-red-500 focus:bg-red-500 active:bg-red-700">Cancel</x-mine.button>
                </div>
            </div>
        </div>
    </template>
    <x-mine.loading condition="!showForm&&!success"/>

    <x-mine.success>
        <x-mine.button do="{{$open}} = false" class="text-white border border-transparent bg-red-600 focus:ring-red-600 hover:bg-red-500 focus:bg-red-500 active:bg-red-700">Close</x-mine.button>
    </x-mine.success>
</div>
