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
                [false, 'Gamer vs Non-Gamer'],
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
                <div class="flex justify-between pb-5">
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
                {{-- correlation --}}
                <div x-cloak x-show="pages[0][0]" x-data="corrChart()">
                    <div class="flex justify-center px-3 py-2 mb-2 text-gray-600 capitalize">
                        <form method="GET">
                            <label for="var" class="sr-only">Pick Variable</label>
                            <select name="varA" id="varA" @change="updateChart($el)" class="rounded-md">
                                <option value="numGames">Number of Games Played</option>
                                <option value="mobile">Daily Mobile Playtime</option>
                                <option value="console">Daily Console Playtime</option>
                                <option value="pc">Daily Computer Playtime</option>
                                <option value="shooter">Daily Shooter Game Playtime</option>
                                <option value="actAdv">Daily Action and Adventure Game Playtime</option>
                                <option value="sims">Daily Simulation Game Playtime</option>
                                <option value="moba">Daily MOBA Game Playtime</option>
                                <option value="sports">Daily Sports Game Playtime</option>
                                <option value="race">Daily Racing Game Playtime</option>
                                <option value="strat">Daily Strategy Game Playtime</option>
                                <option value="batRoy">Daily Battle Royal Game Playtime</option>
                                <option value="puzzPlat">Daily Puzzle Platform Game Playtime</option>
                                <option value="fight">Daily Fighting Game Playtime</option>
                                <option value="board">Daily Online Board Game Playtime</option>
                            </select>
                        </form>
                    </div>
                    <div class="w-4/5 mx-auto overflow-auto">
                        <canvas x-ref="corr"></canvas>
                    </div>
                    <table class="w-full mt-2">
                        <thead>
                            <tr class="border-b">
                                <td></td>
                                <td class="text-center px-6 py-3">Pearson Product-Moment Correlation</td>
                                <td class="text-center px-6 py-3">Spearman's Rank-Order Correlation</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td class="text-center px-6 py-3">Correlation</td>
                                <td class="text-center px-6 py-3" x-text="result.pCorr"></td>
                                <td class="text-center px-6 py-3" x-text="result.sCorr"></td>
                            </tr>
                            <tr class="border-b">
                                <td class="text-center px-6 py-3">Significance</td>
                                <td class="text-center capitalize px-6 py-3" x-text="result.pRej"></td>
                                <td class="text-center capitalize px-6 py-3" x-text="result.sRej"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Play Time --}}
                <div x-cloak x-show="pages[1][0]"x-data="{
                    {{-- avg: mean, --}}
                    {{-- std: stdev, --}}
                    labels: [
                        'Number of Games Played',
                        'Mobile Playtime',
                        'Console Playtime',
                        'Computer Playtime',
                        'Shooter Game Playtime',
                        'Action and Adventure Game Playtime',
                        'Simulation Game Playtime',
                        'MOBA Game Playtime',
                        'Sports Game Playtime',
                        'Racing Game Playtime',
                        'Strategy Game Playtime',
                        'Battle Royal Game Playtime',
                        'Puzzle Platform Game Playtime',
                        'Fighting Game Playtime',
                        'Online Board Game Playtime',
                        'Abstract Reasoning Exam Grade'
                    ],
                    arrayAvgGamer: [],
                    arrayAvgNonGamer: [],
                    arrayStdevGamer: [],
                    arrayStdevNonGamer: [],
                    gamerLength: gamer.numGames.length,
                    nonGamerLength: nonGamer.numGames.length,
                    init() {
                        for (const name in gamer) {
                            if(name == 'male' || name == 'female') {
                                continue
                            }
                            if(this.gamerLength <= 1) {
                                this.arrayAvgGamer.push(0)
                                this.arrayStdevGamer.push(0)
                            }else {
                                this.arrayAvgGamer.push(mean(this.gamerLength,gamer[name],1))
                                this.arrayStdevGamer.push(stdev(this.gamerLength,1,gamer[name],1))
                            }
                        }

                        for (const name in nonGamer) {
                            if(name == 'male' || name == 'female') {
                                continue
                            }
                            if(this.nonGamerLength <= 1) {
                                this.arrayAvgNonGamer.push(0)
                                this.arrayStdevNonGamer.push(0)
                            }else {
                                this.arrayAvgNonGamer.push(mean(this.nonGamerLength,nonGamer[name],1))
                                this.arrayStdevNonGamer.push(stdev(this.nonGamerLength,1,nonGamer[name],1))
                            }

                        }


                        new Chart($refs.avgStdev, {
                            type: 'bar',
                            data: {
                                labels: this.labels,
                                datasets: [{
                                    label: 'Gamer\'s Avg.',
                                    data: this.arrayAvgGamer,
                                    borderColor: '#ef4444',
                                    backgroundColor: '#f87171',
                                    {{-- stack: 'Stack 0', --}}
                                }, {
                                    label: 'Gamer\'s Standard Deviation',
                                    data: this.arrayStdevGamer,
                                    borderColor: '#d97706',
                                    backgroundColor: '#f59e0b',
                                    {{-- stack: 'Stack 0', --}}
                                },
                                {
                                    label: 'Non-Gamer\'s Avg.',
                                    data: this.arrayAvgNonGamer,
                                    borderColor: '#0891b2',
                                    backgroundColor: '#06b6d4',
                                    {{-- stack: 'Stack 1', --}}
                                },
                                {
                                    label: 'Non-Gamer\'s Standard Deviation',
                                    data: this.arrayStdevNonGamer,
                                    borderColor: '#7c3aed',
                                    backgroundColor: '#8b5cf6',
                                    {{-- stack: 'Stack 1', --}}
                                }
                            ]
                            },
                            options: {
                                plugins: {
                                    legend: {
                                        display:true
                                    },
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        {{-- stacked: true, --}}
                                    },
                                    x: {
                                        {{-- stacked: true, --}}
                                    }
                                }
                            }
                        })
                    }
                }">
                    <div>
                        <canvas x-ref="avgStdev"></canvas>
                    </div>
                    <table class="w-full mt-2">
                        <thead>
                            <tr class="border-b">
                                <td></td>
                                <td class="text-center px-6 py-3">Gamers' Avg. Score</td>
                                <td class="text-center px-6 py-3">Gamers' Standard Deviation</td>
                                <td class="text-center px-6 py-3">Non-Gamers' Avg. Score</td>
                                <td class="text-center px-6 py-3">Non-Gamers' Standard Deviation</td>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-cloak x-for="(label, index) in labels">
                                <tr class="border-b">
                                    <td class="text-center px-6 py-3" x-text="label"></td>
                                    <td class="text-center px-6 py-3" x-text="Math.round((arrayAvgGamer[index] + Number.EPSILON) * 100) / 100"></td>
                                    <td class="text-center px-6 py-3" x-text="Math.round((arrayStdevGamer[index] + Number.EPSILON) * 100) / 100"></td>
                                    <td class="text-center px-6 py-3" x-text="Math.round((arrayAvgNonGamer[index] + Number.EPSILON) * 100) / 100"></td>
                                    <td class="text-center px-6 py-3" x-text="Math.round((arrayStdevNonGamer[index] + Number.EPSILON) * 100) / 100"></td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
                {{-- Male vs. Female --}}
                <div x-cloak x-show="pages[2][0]" x-data="{
                    init() {
                        new Chart($refs.gamer, {
                            type: 'doughnut',
                            data: {
                                labels: ['Male', 'Female'],
                                datasets: [{
                                    lable: 'Gamer',
                                    data: [gamer.male, gamer.female],
                                    backgroundColor: [
                                        '#2563eb',
                                        '#f43f5e',
                                    ],
                                    hoverOffset: 4
                                }]
                            },
                            options: {
                                plugins: {
                                    title: {
                                        display: true,
                                        text: 'Gamer'
                                    }
                                }
                            }
                        })

                        new Chart($refs.nonGamer, {
                            type: 'doughnut',
                            data: {
                                labels: ['Male', 'Female'],
                                datasets: [{
                                    lable: 'Non-Gamer',
                                    data: [nonGamer.male, nonGamer.female],
                                    backgroundColor: [
                                        '#2563eb',
                                        '#f43f5e',
                                    ],
                                    hoverOffset: 4
                                }]
                            },
                            options: {
                                plugins: {
                                    title: {
                                        display: true,
                                        text: 'Non-Gamer'
                                    }
                                }
                            }
                        })
                    }
                }">
                    <div class="flex">
                        <div class="w-1/2">
                            <canvas x-ref="gamer"></canvas>
                        </div>
                        <div class="w-1/2">
                            <canvas x-ref="nonGamer"></canvas>
                        </div>
                    </div>

                    <table class="w-full mt-2">
                        <thead>
                            <tr class="border-b">
                                <td></td>
                                <td class="text-center px-6 py-3">Male</td>
                                <td class="text-center px-6 py-3">Female</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td class="text-center px-6 py-3">Gamer</td>
                                <td class="text-center px-6 py-3" x-text="nonGamer.male"></td>
                                <td class="text-center px-6 py-3" x-text="nonGamer.female"></td>
                            </tr>
                            <tr class="border-b">
                                <td class="text-center px-6 py-3">Non-Gamer</td>
                                <td class="text-center px-6 py-3" x-text="nonGamer.male"></td>
                                <td class="text-center px-6 py-3" x-text="nonGamer.female"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                {{-- Frequency --}}
                <div x-cloak x-show="pages[3][0]" x-data="freqChart()">
                    <div class="flex justify-center px-3 py-2 mb-2 text-gray-600 capitalize">
                        <form method="GET">
                            <label for="var" class="sr-only">Pick Variable</label>
                            <select name="varB" id="varB" @change="updateChartFrq($el)" class="rounded-md" x-model="type">
                                <option value="numGames">Number of Games Played</option>
                                <option value="mobile">Daily Mobile Playtime</option>
                                <option value="console">Daily Console Playtime</option>
                                <option value="pc">Daily Computer Playtime</option>
                                <option value="shooter">Daily Shooter Game Playtime</option>
                                <option value="actAdv">Daily Action and Adventure Game Playtime</option>
                                <option value="sims">Daily Simulation Game Playtime</option>
                                <option value="moba">Daily MOBA Game Playtime</option>
                                <option value="sports">Daily Sports Game Playtime</option>
                                <option value="race">Daily Racing Game Playtime</option>
                                <option value="strat">Daily Strategy Game Playtime</option>
                                <option value="batRoy">Daily Battle Royal Game Playtime</option>
                                <option value="puzzPlat">Daily Puzzle Platform Game Playtime</option>
                                <option value="fight">Daily Fighting Game Playtime</option>
                                <option value="board">Daily Online Board Game Playtime</option>
                            </select>
                        </form>
                    </div>
                    <div class="w-1/2 mx-auto">
                        <canvas x-ref="freqDough"></canvas>
                    </div>
                    <table class="w-full mt-2">
                        <thead>
                            <tr class="border-b">
                                <td></td>
                                <td class="text-center px-6 py-3">Frequency</td>
                                <td class="text-center px-6 py-3">Percentage</td>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-cloak x-for="(data,index) in header">
                                <tr class="border-b">
                                    <td class="text-center px-6 py-3" x-text="data.name"></td>
                                    <td class="text-center px-6 py-3" x-text="data.f"></td>
                                    <td class="text-center px-6 py-3" x-text="data.fp"></td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </x-mine.card-container>
        </div>
    </x-mine.bg-container>
</x-app-layout>
