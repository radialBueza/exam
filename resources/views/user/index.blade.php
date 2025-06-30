<x-app-layout title="Accounts">
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
            Accounts
        </h1>
    </x-slot>
        <x-mine.datas :$datas index="{{route('users.all')}}">
            <x-mine.crud
                :search="route('users.index')"
                :addTitle="'Register Account'"
                :addSub="'Create an account for a student, teacher, or admin.'"
                :addForm="'addUser'"
                :inputs="['name', 'gender', 'birthday', 'account_type', 'department_id', 'section_id']"
                :addRoute="route('users.store')"
                :dellAllRoute="route('users.destroyAll')"
                :dellOneRoute="route('users.index')"
                :updateTitle="'Update Account'"
                :updateSub="'Update an Account for a student, teacher, or admin.'"
                :updateForm="'updateUser'"
                :updateRoute="route('users.index')"
            >
                <x-slot name="thead">
                    <x-mine.th-cell col="name">
                        name
                    </x-mine.th-cell>
                    <x-mine.th-cell col="username">
                        Username
                    </x-mine.th-cell>
                    <x-mine.th-cell col="account_type">
                        Account Type
                    </x-mine.th-cell>
                    <x-mine.th-cell col="created_at">
                        Registered On
                    </x-mine.th-cell>
                </x-slot>
                <x-slot name="table">
                    <x-mine.td-cell-primary>
                        <a :href="`${index}/${data.id}`" x-text="data.name" ></a>
                    </x-mine.td-cell-primary>
                    <x-mine.td-cell :cap="false" txt="data.username"/>
                    <x-mine.td-cell txt="data.account_type"/>
                    <x-mine.td-cell txt="data.created_at"/>
                </x-slot>
                <x-slot name="extra">
                    <div x-data="{
                        openRetake: false,
                        showForm: true,
                        success: false,
                        async retake() {
                            const res = await fetch('{{route('retake')}}', {
                                method: 'PUT',
                                headers: {
                                    'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content,
                                    'Accept': 'application/json'
                                },
                                credentials: 'include'
                            })
                            this.showForm = false
                            if(res.status == 200) {
                                this.success = true
                            }
                        }
                    }">
                        <x-mine.button do="openRetake = true" class="text-slate-600 border border-transparent focus:ring-transparent">
                            Re-Take Survey
                        </x-mine.button>
                        <x-mine.modal open="openRetake">
                            <div x-init="$watch('openRetake', (value) => {
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
                                            <p class="text-xl font-medium text-red-500 text-center">Are you sure you want to make students retake survey?</p>
                                            <div class="flex items-center justify-between gap-2">
                                                <x-mine.button do="retake()" class="text-white border border-transparent bg-green-600 focus:ring-green-600 hover:bg-green-500 focus:bg-green-500 active:bg-green-700">Confirm</x-mine.button>
                                                <x-mine.button do="openRetake = false" class="text-white border border-transparent bg-red-600 focus:ring-red-600 hover:bg-red-500 focus:bg-red-500 active:bg-red-700">Cancel</x-mine.button>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                                <x-mine.loading condition="!showForm&&!success"/>

                                <x-mine.success txt="edited">
                                    <x-mine.button do="openRetake = false" class="text-white border border-transparent bg-red-600 focus:ring-red-600 hover:bg-red-500 focus:bg-red-500 active:bg-red-700">Close</x-mine.button>
                                </x-mine.success>
                            </div>
                        </x-mine.modal>
                    </div>
                </x-slot>
                <x-slot name="addModal">
                    <x-mine.input title="Name"/>
                    {{-- <x-mine.input name="email" title="email"/> --}}
                    <x-mine.select-input name="gender" title="Gender" :options="$gender"/>
                    <x-mine.date-input />
                    <div x-data="{
                        accountType: '',
                    }" class="space-y-4">
                        <x-mine.select-input name="account_type" title="account type" :options="$accountType" :nullable="true" do="accountType"/>

                        <template x-if="accountType == 'admin'">
                            <x-mine.select-input name="department_id" title="Department" :$options/>
                        </template>
                        <template x-if="accountType == 'admin' || accountType == 'advisor' || accountType == 'student'">
                            <x-mine.select-input name="section_id" title="Section" :options="$sections"/>
                        </template>

                        {{-- <div> --}}
                        <p class="text-xs text-slate-500"><strong class="font-medium">Note:</strong> generated password will be of the format: <em>name_nameYYYY/MM/DD</em> </p>
                        {{-- </div> --}}
                    </div>
                </x-slot>
                <x-slot name="upModal">
                    <x-mine.input title="Name" class="capitalize" value="toEdit.name"/>
                    {{-- <x-mine.input name="email" title="email" value="toEdit.email"/> --}}
                    <x-mine.select-input name="gender" title="Gender" :options="$gender" selected="toEdit.gender"/>
                    <x-mine.date-input :edit="true"/>
                    <div x-data="{
                        accountType: '',
                    }" class="space-y-4" x-init="$watch('openEdit', (value) => {
                        if (value == true) {
                            accountType = toEdit.account_type
                        }
                    })">
                        <x-mine.select-input name="account_type" title="account type" :options="$accountType" :nullable="true" do="accountType" selected="toEdit.account_type"/>
                        <template x-if="accountType == 'admin'">
                            <x-mine.select-input name="department_id" title="Department" :$options selected="toEdit.department_id"/>
                        </template>
                        <template x-if="accountType == 'admin' || accountType == 'advisor' || accountType == 'student'">
                            <x-mine.select-input name="section_id" title="Section" :options="$sections" selected="toEdit.section_id"/>
                        </template>
                    </div>
                </x-slot>
            </x-mine.crud>
        </x-mine.datas>
</x-app-layout>
