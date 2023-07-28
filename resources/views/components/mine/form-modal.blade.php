@aware(['title', 'subtitle', 'form', 'inputs', 'open'])

@php
    $keys = array_keys($inputs)
@endphp
<div x-data="{

    showForm: true,
    confirm: false,
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
    length(value, input) {
        if(value.length < 4) {
            this.error[input].msg = 'Text must be longer than 4 characters'

            return
        }
        if(value.length > 20) {
            this.error[input].msg = 'Text must not be longer than 20 characters'

            return
        }
        this.error[input].msg = ''

        return
    },
    validate(e) {
        let input = e.target.getAttribute('name')

        if(this.inputs[input].length == true) {
            this.length(e.target.value, input)
        }
    },



    async sendData(form) {
        const inputs = $refs.{{$form}}.getElementsByTagName('input')

        for(let input of inputs) {
            let name = input.getAttribute('name')
            if(this.inputs[name].required && input.value < 1) {
                this.error[name].msg = `${name.charAt(0).toUpperCase() + name.slice(1)} is required`
            }

        }

        {{-- @foreach($inputs as $keys => $values)

        if(this.error.{{$keys}}.msg) {
            return
        }

        @endforeach --}}
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
            this.confirm = true
            const result = await res.json()
            this.datas = result.data
            sort()
            return
        }
        if (res.status == 422) {
            this.showForm = true
            this.error.hasError = true
            const result = await res.json()

            for(let error in result.errors) {
                this.error[error].msg = result.errors[error][0]
            }
            return
        }
    },
    again() {
        this.showForm = true
        {{-- @foreach($inputs as $keys => $values)
        this.error.{{$keys}}.msg = ''
        @endforeach --}}
        @foreach($keys as $value)
        this.error.{{$value}}.msg = ''
        @endforeach
        console.log(this.error)
        this.confirm = false
    },

}"x-init="$watch('{{$open}}', (value) => {
    if (value == true) {
        showForm = true
        {{-- @foreach($inputs as $keys => $values)
        error.{{$keys}}.msg = ''
        @endforeach --}}
        @foreach($keys as $value)
        error.{{$value}}.msg = ''
        @endforeach
        $refs.{{$form}}.reset()
        confirm = false
    }
})">
    <template x-cloak x-if="showForm">
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
            <form class="mt-5" x-ref="{{$form}}" @submit.prevent="await sendData($el)">
                <div class="space-y-4">
                    {{$slot}}
                </div>
                <div class="flex justify-end mt-6">
                    {{$button}}
                </div>
            </form>
        </div>
    </template>
    <x-mine.loading condition="!showForm&&!confirm"/>

    <template x-cloak x-if="confirm">
        <div role="confirm" class="flex flex-col justify-center items-center gap-2 m-2">
            <svg class="w-8 h-8 mr-2 text-gray-200 fill-green-600 animate-pulse" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" />
            </svg>
            <p class="text-xl font-medium text-green-800">Successfully created</p>
            <div class="flex justify-between gap-2">
                <button @click="again()" class="flex-1 bg-green-500 focus:ring-green-700 inline-flex items-center px-4 py-2 border-transparent rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">Add</button>
                <button @click="{{$open}} = false" class="flex-1 bg-red-500 focus:ring-red-700 inline-flex items-center px-4 py-2 border-transparent rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">Close</button>
            </div>
        </div>
    </template>
</div>
