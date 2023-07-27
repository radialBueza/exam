@props(['title', 'subtitle', 'id'])
<div x-data="{
    showForm: true,
    confirm: false,
    {{-- name: null, --}}
    {{-- validate(e) {
            this.name = e.target.value

            if(this.name.length < 4) {
                this.error.msg = 'Text must be longer than 4 characters'
                return
            }

            if(this.name.length > 20) {
                this.error.msg = 'Text must not be longer than 20 characters'

                return
            }
            this.error = {}

            return
        }, --}}

        {{-- async sendData(form) {
            if( !this.name ) {
                this.error.msg = 'Department Name is required'
                return
            }

            if(Object.keys(this.error).length) {
                return
            }


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
                const result = await res.json()
                this.error.msg = result.errors.name[0]
                return
            }
        }, --}}

        again() {
            this.showForm = true
            this.error = {}
            console.log(this.error)
            this.confirm = false
        },

}"x-init="$watch('openAdd', (value) => {
    if (value == true) {
        showForm = true
        error = {}
        $refs
        confirm = false
    }
})">
<div>
    <div class="flex items-center justify-between space-x-4">
        <h3 class="text-xl font-medium text-gray-800 ">{{ucwords($title)}}</h3>
        <button @click="openAdd = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </button>
    </div>
    <p class="mt-2 text-sm text-gray-500 ">
        {{ucfirst($subtitle)}}
    </p>
    <form class="mt-5" id="{{$id}}" @submit.prevent="await sendData($el)">
        <div>
            {{$slot}}
        </div>
        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-green-500 focus:ring-green-700 inline-flex items-center px-4 py-2 border-transparent rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">
                Add Department
            </button>
        </div>
    </form>
</div>

</div>
