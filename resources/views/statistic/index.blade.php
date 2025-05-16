<x-app-layout title="Statistical Results">
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
            Statistical Results
        </h1>
    </x-slot>
    <x-mine.bg-container>
        <div x-data="{
            gamer: {{$gamer}},
            nonGamer: {{$nonGamer}},
            all: {{$all}},
            pages: [
                [true, 'Correlation'],
                [false, 'Gamer vs. Non-Gamer'],
                [false, 'Male vs. Female'],
                [false, 'Frequency and Percentage of Answers'],
            ],
            currPage: 0,
            next() {
                if(this.currPage < this.pages.length-1) {
                    this.pages[this.currPage][0] = false
                    this.currPage++
                    this.pages[this.currPage][0] = true
                }else {
                    this.pages[this.currPage][0] = false
                    this.currPage = 0
                    this.pages[this.currPage][0] = true

                }
            },
            prev() {
                if(this.currPage > 0) {
                    this.pages[this.currPage][0] = false
                    this.currPage--
                    this.pages[this.currPage][0] = true
                }else {
                    this.pages[this.currPage][0] = false
                    this.currPage = this.pages.length-1
                    this.pages[this.currPage][0] = true

                }
            },
        }">
            <x-mine.card-container class="p-5 sm:p-9">
                <div class="flex justify-between items-center pb-5 border-b border-slate-300">
                    <x-mine.button do="prev" class="text-black border-2 border-transparent focus:ring-transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M7.72 12.53a.75.75 0 010-1.06l7.5-7.5a.75.75 0 111.06 1.06L9.31 12l6.97 6.97a.75.75 0 11-1.06 1.06l-7.5-7.5z" clip-rule="evenodd" />
                        </svg>
                    </x-mine.button>

                    <h2 class="font-semibold text-xl" x-text="pages[currPage][1]">

                    </h2>
                    <x-mine.button do="next" class="text-black border-2 border-transparent focus:ring-transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M16.28 11.47a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 011.06-1.06l7.5 7.5z" clip-rule="evenodd" />
                        </svg>

                    </x-mine.button>

                </div>
                {{-- correlation--}}
                <div x-cloak x-show="pages[0][0]" x-data="{
                        spread: [
                            true,
                            false,
                            false,
                            false,
                            false,
                            false,
                            false,
                            false,
                            false,
                            false,
                            false,
                            false,
                            false,
                            false,
                            false,
                        ],
                        updateChart(e) {
                            this.spread = this.spread.map((_, i) => i === Number(e.value))
                        },
                    }">
                    <div class="flex justify-center px-3 py-2 mb-2 text-gray-600 capitalize">
                        <form method="GET">
                            <label for="var" class="sr-only">Pick Variable</label>
                            <select name="varA" id="varA" @change="updateChart($el)" class="rounded-md">
                                @foreach ($datas as $key => $value)
                                    <option value="{{$loop->index}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                    <div class="w-full flex flex-row justify-end my-2.5">
                        <x-mine.link-button href="{{route('correlationPdf')}}" class="whitespace-nowrap border-transparent bg-blue-600 focus:ring-blue-600 hover:bg-blue-500 focus:bg-blue-500 active:bg-blue-700">
                            Create PDF
                        </x-mine.link-button>
                    </div>
                    <x-mine.correlation :$datas />
                </div>

                {{-- gamer-vs-non--}}
                <div x-cloak x-show="pages[1][0]">
                    <div class="w-full flex flex-row justify-end my-2.5">
                        <x-mine.link-button href="{{route('gamersVsPdf')}}" class="whitespace-nowrap border-transparent bg-blue-600 focus:ring-blue-600 hover:bg-blue-500 focus:bg-blue-500 active:bg-blue-700">
                            Create PDF
                        </x-mine.link-button>
                    </div>
                    <x-mine.gamer-vs-non :$datas />
                </div>
                {{-- Male vs. Female --}}
                <div x-cloak x-show="pages[2][0]">
                    <div class="w-full flex flex-row justify-end my-2.5">
                        <x-mine.link-button href="{{route('maleVsPdf')}}" class="whitespace-nowrap border-transparent bg-blue-600 focus:ring-blue-600 hover:bg-blue-500 focus:bg-blue-500 active:bg-blue-700">
                            Create PDF
                        </x-mine.link-button>
                    </div>
                    <x-mine.male-vs-female />
                </div>
                {{-- Frequency freqChart()--}}
                <div x-cloak x-show="pages[3][0]" x-data="{
                    spread: [
                            true,
                            false,
                            false,
                            false,
                            false,
                            false,
                            false,
                            false,
                            false,
                            false,
                            false,
                            false,
                            false,
                            false,
                            false,
                        ],
                        updateChartFrq(e) {
                            this.spread = this.spread.map((_, i) => i === Number(e.value))
                        },
                }">
                    <div class="flex justify-center px-3 py-2 mb-2 text-gray-600 capitalize">
                        <form method="GET">
                            {{-- x-model="type" --}}
                            <label for="var" class="sr-only">Pick Variable</label>
                            <select name="varB" id="varB" @change="updateChartFrq($el)" class="rounded-md">
                                @foreach ($datas as $key => $value)
                                    <option value="{{$loop->index}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                    <div class="w-full flex flex-row justify-end my-2.5">
                        <x-mine.link-button href="{{route('freqPdf')}}" class="whitespace-nowrap border-transparent bg-blue-600 focus:ring-blue-600 hover:bg-blue-500 focus:bg-blue-500 active:bg-blue-700">
                            Create PDF
                        </x-mine.link-button>
                    </div>
                    <x-mine.frequency :$datas />
                </div>
            </x-mine.card-container>
        </div>
    </x-mine.bg-container>
</x-app-layout>
