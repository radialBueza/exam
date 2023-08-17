<x-app-layout title="Account">
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
            Account
        </h1>
    </x-slot>
    <x-mine.bg-container>
        <x-mine.crud-table-container :$datas url="{{route('users.index')}}" index="{{route('users.all')}}">
            <x-mine.card-container>
                <x-mine.cdp pdfUrl=" "/>
                <x-mine.search/>
                <x-mine.table>
                    <x-slot name="thead">
                        <x-mine.th-cell col="name">
                            name
                        </x-mine.th-cell>
                        <x-mine.th-cell col="account_type">
                            Account Type
                        </x-mine.th-cell>
                        <x-mine.th-cell col="created_at">
                            Registered On
                        </x-mine.th-cell>
                    </x-slot>
                    <x-mine.td-cell-primary>
                        <a :href="`${index}/${data.id}`" x-text="data.name" ></a>
                    </x-mine.td-cell-primary>
                    <x-mine.td-cell txt="data.account_type"/>
                </x-mine.table>
                <x-mine.loading condition="!datas"/>
            </x-mine.card-container>
            @php
                $title = "Register Account";
                $subtitle = "Create an account for a student, teacher, or admin.";
                $form = "addUser";
                $inputs = ['name', 'email', 'birthday', 'account_type', 'department_id', 'section_id'];
                $accountType = ['admin', 'advisor', 'teacher',  'student']
            @endphp
            <x-mine.modal open="openAdd">
                <x-mine.form-modal :title="$title" :subtitle="$subtitle" :form="$form"
                :inputs="$inputs">
                    <x-mine.text-input title="Name"/>
                    <x-mine.text-input name="{{$inputs[1]}}" title="email"/>
                    <x-mine.date-input />
                    <div x-data="{
                        isAdmin: false,
                        isTeacher: false,
                        isAdvisor: false,
                        isStudent: false,
                        accountType(el) {
                            this.isAdmin = (el.value == 'admin') ? true : false
                            this.isAdvisor = (el.value == 'advisor') ? true : false
                            this.isTeacher = (el.value == 'teacher') ? true : false
                            this.isStudent = (el.value == 'student') ? true : false
                        }
                    }" class="space-y-4">
                        <x-mine.react-select-input name="{{$inputs[3]}}" title="account type" :options="$accountType" :nullable="true" do="accountType($el)"/>
                        <template x-if="isAdmin">
                            <x-mine.select-input name="{{$inputs[4]}}" title="Department" :$options/>
                        </template>
                        <template x-if="isAdmin || isAdvisor">
                            <x-mine.select-input name="{{$inputs[5]}}" title="Section" :options="$sections"/>
                        </template>
                    </div>
                    <x-slot name="buttons">
                        <x-mine.submit-button class="justify-end">
                            <x-mine.button type="submit" class="border-transparent border text-white bg-green-600 focus:ring-green-600 hover:bg-green-500 focus:bg-green-500 active:bg-green-700">
                                {{$title}}
                            </x-mine.button>
                        </x-mine.submit-button>
                    </x-slot>
                </x-mine.form-modal>
            </x-mine.modal>
            <x-mine.modal open="openDel">
                <x-mine.delete-modal delUrl="{{route('users.destroyAll')}}"/>
            </x-mine.modal>
            @php
                $title = "Update Account";
                $subtitle = "Update an account for a student, teacher, or admin.";
                $form = "updateUser";
            @endphp
            <x-mine.modal open="openEdit">
                <x-mine.form-modal :title="$title" :subtitle="$subtitle" :form="$form" :inputs="$inputs" method="PUT" url="{{route('users.index')}}/${toEdit.id}">
                    <x-mine.text-input title="Name" class="capitalize" value="toEdit.name"/>
                    <x-mine.text-input name="{{$inputs[1]}}" title="email" value="toEdit.email"/>
                    <x-mine.date-input :edit="true"/>
                    <div x-data="{
                        isAdmin: false,
                        isTeacher: false,
                        isAdvisor: false,
                        isStudent: false,
                        accountType(el) {
                            this.isAdmin = (el.value == 'admin') ? true : false
                            this.isAdvisor = (el.value == 'advisor') ? true : false
                            this.isTeacher = (el.value == 'teacher') ? true : false
                            this.isStudent = (el.value == 'student') ? true : false
                        }
                    }" class="space-y-4">
                        <x-mine.react-select-input name="{{$inputs[3]}}" title="account type" :options="$accountType" :nullable="true" do="accountType($el)" selected="toEdit.account_type"/>
                        <template x-if="isAdmin">
                            <x-mine.select-input name="{{$inputs[4]}}" title="Department" :$options selected="toDate.department_id"/>
                        </template>
                        <template x-if="isAdmin || isAdvisor">
                            <x-mine.select-input name="{{$inputs[5]}}" title="Section" :options="$sections" selected="toDate.section_id"/>
                        </template>
                    </div>
                    <x-slot name="buttons">
                        <x-mine.submit-button class="justify-end">
                            <x-mine.button type="submit" class="border-transparent border text-white bg-green-600 focus:ring-green-600 hover:bg-green-500 focus:bg-green-500 active:bg-green-700">
                                {{$title}}
                            </x-mine.button>
                        </x-mine.submit-button>
                    </x-slot>
                </x-mine.form-modal>
            </x-mine.modal>
        </x-mine.crud-table-container>
    </x-mine.bg-container>
</x-app-layout>
