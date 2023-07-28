@aware(['title', 'subtitle', 'form', 'inputs', 'open'])

@php
    $keys = array_keys($inputs)
@endphp
<div x-data="{
    showForm: true,
    success: false,
    inputs: {{Js::from($inputs)}},
    error: {},
    init() {
        {{-- @foreach($inputs as $keys => $values)
        this.error.{{$keys}} = { msg: ''}

        @endforeach --}}
        @foreach($keys as $value)
            this.error.{{$value}} = { msg: ''}
        @endforeach

    },
    length(value, name) {
        if(value.length < 4) {
            this.error[name].msg = `The ${name} field must be longer than 4 characters`

            return
        }
        if(value.length > 20) {
            this.error[name].msg = `The ${name} field must not be longer than 20 characters`

            return
        }
        this.error[name].msg = ''

        return
    },
    validate(e) {
        let name = e.target.getAttribute('name')

        if(this.inputs[name].includes('length')) {
            this.length(e.target.value, name)
        }

    },



    async sendData(form) {
        const inputs = $refs.{{$form}}.getElementsByTagName('input')

        for(let input of inputs) {
            let name = input.getAttribute('name')

            if(this.inputs[name].includes('required') && input.value < 1) {
                this.error[name].msg = `The ${name} field is required`
            }
        }


        @foreach($keys as $value)
            if(this.error.{{$value}}.msg) {
                return
            }
        @endforeach

        this.showForm = false;
        const inputForm = new FormData(form)
        const input = new URLSearchParams(inputForm)
        const res = await fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content,
                'Accept': 'application/json'
            },
            body: input
        })
        if (res.status == 201) {
            this.success = true
            const result = await res.json()
            datas = result.data
            sort()
            return
        }
        if (res.status == 422) {
            this.showForm = true
            const result = await res.json()

            for(let error in result.errors) {
                this.error[error].msg = result.errors[error][0]
            }
            return
        }
    },
    again() {
        this.showForm = true
        @foreach($keys as $value)
        this.error.{{$value}}.msg = ''
        @endforeach
        this.success = false
    },

}"x-init="$watch('{{$open}}', (value) => {
    if (value == true) {
        showForm = true
        success = false
        @foreach($keys as $value)
        error.{{$value}}.msg = ''
        @endforeach
    }
})">
    <template x-cloak x-if="showForm">
        <div x-init="$watch('showForm', (value) => {
            if (value == true) {
                $refs.{{$form}}.reset()
            }
        })">
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
            <form class="mt-5" x-ref="{{$form}}" id="{{$form}}" @submit.prevent="await sendData($el)"
            >
                <div class="space-y-4">
                    {{$slot}}
                </div>
                <div class="flex justify-end mt-6">
                    <x-mine.button type="submit" class="border-transparent border text-white bg-green-600 focus:ring-green-600 hover:bg-green-500 focus:bg-green-500 active:bg-green-700">
                        {{$title}}
                    </x-mine.button>
                </div>
            </form>
        </div>
    </template>
    <x-mine.loading condition="!showForm&&!success"/>

    <x-mine.success>
        <x-mine.button do="again()" class="text-white border border-transparent bg-green-600 focus:ring-green-600 hover:bg-green-500 focus:bg-green-500 active:bg-green-700">Add</x-mine.button>
        <x-mine.button do="{{$open}} = false" class="text-white border border-transparent bg-red-600 focus:ring-red-600 hover:bg-red-500 focus:bg-red-500 active:bg-red-700">Close</x-mine.button>
    </x-mine.success>
</div>
