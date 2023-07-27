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
    {{$slot}}
</div>
