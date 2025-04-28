<x-app-layout title="Accounts">
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
            Accounts
        </h1>
    </x-slot>

        <x-mine.datas :$datas index="{{route('users.all')}}">
            <x-mine.crud>
                <x-mine.bg-container >
                    <x-mine.card-container class="p-5 sm:p-9">
                        <x-mine.cdp/>
                        <x-mine.search url="{{route('users.index')}}"/>
                        <x-mine.table>
                            {{-- <x-mine.table-multi-del-sel url="{{route('users.index')}}"> --}}
                                <x-mine.clean-table>
                                    <x-slot name="thead">
                                        <th scope="col" class="px-6 py-3"><input type="checkbox" :checked="toDelete.items.length == datas?.length  && datas.length != 0" @click="selectAll()"></th>
                                        <x-mine.th-cell col="name">
                                            name
                                        </x-mine.th-cell>
                                        <x-mine.th-cell col="account_type">
                                            Account Type
                                        </x-mine.th-cell>
                                        <x-mine.th-cell col="created_at">
                                            Registered On
                                        </x-mine.th-cell>
                                        <th scope="col" class="px-6 py-3"></th>
                                    </x-slot>
                                    <td class="px-6 py-3"><input type="checkbox" :checked="toDelete.items.includes(data.id)" @click="addDelete(data.id)"></td>
                                    <x-mine.td-cell-primary>
                                        <a :href="`${index}/${data.id}`" x-text="data.name" ></a>
                                    </x-mine.td-cell-primary>
                                    <x-mine.td-cell txt="data.account_type"/>
                                    <x-mine.td-cell txt="data.created_at"/>
                                    <x-slot name="action">
                                        <x-mine.td-action/>
                                    </x-slot>
                                </x-mine.clean-table>
                            {{-- </x-mine.table-multi-del-sel> --}}
                        </x-mine.table>
                        <div x-data="{
                            async retake() {
                                const res = await fetch('{{route('retake')}}', {
                                    method: 'PUT',
                                    headers: {
                                        'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content,
                                        'Accept': 'application/json'
                                    }
                                })

                                {{-- if (res.status == 200 ) {
                                    const result = await res.json()
                                    datas = result.data
                                    sort()
                                    return
                                } --}}
                            }
                        }">
                            <x-mine.button do="retake()" class="text-slate-600 border border-transparent focus:ring-transparent">
                                Re-Take Survey
                            </x-mine.button>
                        </div>

                    </x-mine.card-container>
                    @php
                        $title = "Register Account";
                        $subtitle = "Create an account for a student, teacher, or admin.";
                        $form = "addUser";
                        $inputs = ['name', 'email', 'gender','birthday', 'account_type', 'department_id', 'section_id'];
                        // $accountType = ['admin', 'advisor', 'teacher',  'student']
                    @endphp
                    <x-mine.modal open="openAdd">
                        <x-mine.form-modal :title="$title" :subtitle="$subtitle" :form="$form"
                        :inputs="$inputs" url="{{route('users.store')}}">
                            <x-mine.input title="Name"/>
                            <x-mine.input name="{{$inputs[1]}}" title="email"/>
                            <x-mine.select-input name="{{$inputs[2]}}" title="Gender" :options="$gender"/>
                            <x-mine.date-input />
                            <div x-data="{
                                accountType: '',
                            }" class="space-y-4">
                                <x-mine.select-input name="{{$inputs[4]}}" title="account type" :options="$accountType" :nullable="true" do="accountType"/>

                                <template x-if="accountType == 'admin'">
                                    <x-mine.select-input name="{{$inputs[5]}}" title="Department" :$options/>
                                </template>
                                <template x-if="accountType == 'admin' || accountType == 'advisor' || accountType == 'student'">
                                    <x-mine.select-input name="{{$inputs[6]}}" title="Section" :options="$sections"/>
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
                        <x-mine.form-modal :title="$title" :subtitle="$subtitle" :form="$form" :inputs="$inputs" url="{{route('users.index')}}/${toEdit.id}">
                            <x-mine.input title="Name" class="capitalize" value="toEdit.name"/>
                            <x-mine.input name="{{$inputs[1]}}" title="email" value="toEdit.email"/>
                            <x-mine.select-input name="{{$inputs[2]}}" title="Gender" :options="$gender" selected="toEdit.gender"/>
                            <x-mine.date-input :edit="true"/>
                            <div x-data="{
                                accountType: '',
                            }" class="space-y-4" x-init="$watch('openEdit', (value) => {
                                if (value == true) {
                                    accountType = toEdit.account_type
                                }
                            })">
                                <x-mine.select-input name="{{$inputs[4]}}" title="account type" :options="$accountType" :nullable="true" do="accountType" selected="toEdit.account_type"/>
                                <template x-if="accountType == 'admin'">
                                    <x-mine.select-input name="{{$inputs[5]}}" title="Department" :$options selected="toEdit.department_id"/>
                                </template>
                                <template x-if="accountType == 'admin' || accountType == 'advisor' || accountType == 'student'">
                                    <x-mine.select-input name="{{$inputs[6]}}" title="Section" :options="$sections" selected="toEdit.section_id"/>
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
                </x-mine.bg-container>
            </x-mine.crud>
        </x-mine.datas>
</x-app-layout>
