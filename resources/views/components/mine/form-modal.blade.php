{{-- @aware([
    'title',
    'subtitle',
    'form',
    'inputs' => ['name'],
    'open',
    'url',
]) --}}
@aware(['open'])
@props([
    'title',
    'subtitle',
    'form',
    'inputs',
    'open',
    'url',
])
<div x-data="{
    showLoad: false,
    success: false,
    error: {},
    init() {
        @foreach($inputs as $input)
            this.error.{{$input}} = { msg: ''}
        @endforeach
    },
    async sendData(form) {
        @if($open == "openEdit")
            const url = '{{$url}}/' + toEdit.id
        @else
            const url = '{{$url}}'
        @endif
        this.showLoad = true
        const inputForm = new FormData(form)
        const res = await fetch(url, {
            method: 'POST',
            headers: {
                'Accept': 'application/json'
            },
            body: inputForm
        })
        if(res.status == 201 || res.status == 200) {
            const result = await res.json()
            this.success = result.success
            this.showLoad = false
            datas = result.data
            sort()
            @if($open == "openEdit")
            const getIndex = (el) => el.id == toEdit.id
            let index = datas.findIndex(getIndex)
            toEdit = datas[index]
            @endif

            return
        }
        if (res.status == 422) {
            const result = await res.json()

            for(let error in result.errors) {
                this.error[error].msg = result.errors[error][0]
            }
            this.showLoad = false
            return
        }
    },
    again() {
        this.showLoad = false
        @foreach($inputs as $input)
            this.error.{{$input}} = { msg: ''}
        @endforeach

        this.success = false
    },

}"x-init="$watch('{{$open}}', (value) => {
    if (value == true) {
        showLoad = false
        success = false
        @foreach($inputs as $input)
            error.{{$input}} = { msg: ''}
        @endforeach

        @if($open == "openAdd")
        if ($refs.{{$form}}) {
            $refs.{{$form}}.reset()
        }
        @endif
    }else {

    @if($open == "openEdit")

        toEdit = {}
    @endif
    }

})">
    <template x-cloak x-if="!success">
        <div>
            <div class="flex items-center justify-between space-x-4">
                <h3 class="text-xl font-medium text-gray-800 ">{{ucwords($title)}}</h3>
                <button @click="{{$open}} = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </button>
            </div>
            <p class="mt-2 text-sm text-gray-500 ">
                {{ucfirst($subtitle)}}
            </p>
            <form class="mt-5" x-ref="{{$form}}" @submit.prevent="await sendData($el)"
            >
                @csrf
                @if ($open == "openEdit")
                    @method('PUT')
                @endif
                <div class="space-y-4">
                    {{$slot}}
                </div>
                {{$buttons}}
            </form>
        </div>
    </template>
    <x-mine.loading condition="showLoad" :isModal="true"/>

    <x-mine.success>
        @if ($open == "openAdd")
            <x-mine.button do="again()" class="text-white border border-transparent bg-green-600 focus:ring-green-600 hover:bg-green-500 focus:bg-green-500 active:bg-green-700">Add</x-mine.button>
            <x-mine.button do="{{$open}} = false" class="text-white border border-transparent bg-red-600 focus:ring-red-600 hover:bg-red-500 focus:bg-red-500 active:bg-red-700">Close</x-mine.button>
        @else
            <x-mine.button do="again()" class="text-white border border-transparent bg-green-600 focus:ring-green-600 hover:bg-green-500 focus:bg-green-500 active:bg-green-700">Edit</x-mine.button>
            <x-mine.button do="{{$open}} = false" class="text-white border border-transparent bg-red-600 focus:ring-red-600 hover:bg-red-500 focus:bg-red-500 active:bg-red-700">Close</x-mine.button>
        @endif
    </x-mine.success>
</div>
