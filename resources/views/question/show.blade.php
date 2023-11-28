<x-app-layout title="Question">
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
            {{$parent->name}}
        </h1>
    </x-slot>
        <x-mine.datas :$datas index="{{route('users.all')}}">
            <x-mine.bg-container>
                <x-mine.card-container class="p-5 sm:p-9">
                    <div class="space-y-2">
                        {{-- Question --}}
                        <div class="pb-2 border-b-2">
                            <div class="font-semibold">Question:</div>
                            <p x-text="datas.question" class="text-sm"></p>
                            <template x-if="datas.question_file">
                                <img :src="`{{asset('storage/')}}/${datas.question_file}`" alt="Question Image" class="object-contain h-20 max-w-full">
                            </template>
                        </div>
                        {{-- A --}}
                        <div>
                            <div class="font-semibold">Option A:</div>
                            <p x-text="datas.a" class="text-sm"></p>
                            <template x-if="datas.a_file">
                                <img :src="`{{asset('storage/')}}/${datas.a_file}`" alt="optionA" class="object-contain h-20 max-w-full">
                            </template>
                        </div>

                        {{-- B --}}
                        <div>
                            <div class="font-semibold">Option B:</div>
                            <p x-text="datas.b" class="text-sm"></p>
                            <template x-if="datas.question_file">
                                <img :src="`{{asset('storage/')}}/${datas.b_file}`" alt="optionB" class="object-contain h-20 max-w-full">
                            </template>
                        </div>

                        {{-- C --}}
                        <div>
                            <div class="font-semibold">Option C:</div>
                            <p x-text="datas.c" class="text-sm"></p>
                            <template x-if="datas.question_file">
                                <img :src="`{{asset('storage/')}}/${datas.c_file}`" alt="optionC" class="object-contain h-20 max-w-full">
                            </template>
                        </div>

                        {{-- D --}}
                        <div >
                            <div class="font-semibold">Option D:</div>
                            <p x-text="datas.d" class="text-sm"></p>
                            <template x-if="datas.question_file">
                                <img :src="`{{asset('storage/')}}/${datas.d_file}`" alt="optionD" class="object-contain h-20 max-w-full">
                            </template>
                        </div>

                        <div class="pt-2 border-t-2">
                            <div class="font-semibold inline-block">Correct Answer:</div>
                            <p x-text="datas.correct_answer" class="text-sm capitalize inline-block"></p>
                            <div x-data="{
                                correctFile: `${datas.correct_answer}_file`,
                                {{-- init() {
                                    console.log(this.correctFile)
                                } --}}
                            }">
                                <template x-if="datas[correctFile]">
                                    <img :src="`{{asset('storage/')}}/${datas[correctFile]}`" alt="optionD" class="object-contain h-20 max-w-full">
                                </template>
                            </div>
                        </div>
                    </div>
                </x-mine.card-container>
            </x-mine.bg-container>
        </x-mine.datas>
</x-app-layout>
