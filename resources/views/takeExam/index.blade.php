<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title class="capitalize">{{$info->name}}</title>

        <link rel="icon" type="image/x-icon" href="{{Vite::asset('resources/images/logo.png')}}">
        <!-- Fonts -->
        {{-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased" x-data="{
        entered: {{Js::from($entered)}},
        init() {
            if(this.entered) {
                sessionStorage.removeItem('_x_expiry')
                sessionStorage.removeItem('_x_attempt')
            }
        }
    }">
        <main class="bg-gray-100 py-6 sm:py-12 min-h-screen flex justify-center" x-data="{
            currPage: 0,
            pages: [],
            hasAnswer: [],
            attempt: $persist(null).using(sessionStorage),
            expiry: $persist(null).using(sessionStorage),
            remaining:null,
            init() {

                for(let i = 0; i < {{count($questions)}}; i++) {
                    if(i == 0) {
                        this.pages[i] = true
                    }else {
                        this.pages[i] = false
                    }
                    this.hasAnswer[i] = false
                }

                @isset($attempt)
                this.attempt = {{$attempt}}
                @endisset
                if(!this.expiry) {
                    this.expiry = new Date().setSeconds(new Date().getSeconds() + {{($info->time_limit * 60)}})
                }
                this.setRemaining()
                const interval = setInterval(() => {
                    this.setRemaining()
                    if(this.remaining <= 0) {
                        clearInterval(interval)
                        $refs.form.submit()
                    }
                }, 1000)
            },
            next() {
                if(this.currPage < this.pages.length-1) {
                    this.pages[this.currPage] = false
                    this.currPage++
                    this.pages[this.currPage] = true
                }
            },
            prev() {
                if(this.currPage > 0) {
                    this.pages[this.currPage] = false
                    this.currPage--
                    this.pages[this.currPage] = true
                }
            },
            answer() {
                if(this.hasAnswer[this.currPage] == false) {
                    this.hasAnswer[this.currPage] = true
                }
            },
            jump(index) {
                this.pages[this.currPage] = false
                this.currPage = index
                this.pages[this.currPage] = true
            },
            setRemaining() {
                const diff = this.expiry - new Date().getTime()
                this.remaining =  parseInt(diff / 1000)
            },
            days() {
                return {
                    value:this.remaining / 86400,
                    remaining:this.remaining % 86400
                }
            },
            hours() {
                return {
                    value:this.days().remaining / 3600,
                    remaining:this.days().remaining % 3600
                }
            },
            minutes() {
                return {
                    value:this.hours().remaining / 60,
                    remaining:this.hours().remaining % 60
                }
            },
            seconds() {
                return {
                    value:this.minutes().remaining,
                }
            },
            format(value) {
                return ('0' + parseInt(value)).slice(-2)
            },
            time(){
                return {
                    days:this.format(this.days().value),
                    hours:this.format(this.hours().value),
                    minutes:this.format(this.minutes().value),
                    seconds:this.format(this.seconds().value),
                }
            },
            clearSession() {
                sessionStorage.removeItem('_x_expiry')
                sessionStorage.removeItem('_x_attempt')
            },
            submit() {
                $refs.form.submit()
            }
        }">
            <div class="sm:px-6 lg:px-8 max-w-7xl w-full flex flex-col gap-3 justify-center lg:flex-row lg:items-center">
                <template x-cloak x-if="expiry">
                    <div class="absolute top-0 right-0 flex justify-center w-1/5 p-1">
                        <p x-text="time().hours" ></p>
                        <p x-text="time().minutes" class="before:content-[':']"></p>
                        <p x-text="time().seconds" class="before:content-[':']"></p>
                    </div>
                </template>
                <x-mine.card-container class="p-8 sm:p-14 w-full lg:w-3/4">
                    <form :action="`{{route('exam', ['exam' => $info->id])}}/${attempt}`" method="POST" x-ref="form" @submit="clearSession">
                        @csrf
                        @method('PUT')
                        @foreach ($questions as $question)
                            <div x-cloak x-show="pages[{{$loop->index}}]">
                                <div class="pb-2">
                                    <p class="text-lg inline-block">{{"{$loop->iteration}.)"}} {{Str::ucfirst($question->question)}}</p>
                                    @isset($question->question_file)
                                        <img src="{{asset("storage/{$question->question_file}")}}" alt="question" class="inline-block">
                                    @endisset
                                </div>
                                <div class="grid grid-cols-2 w-full mx-auto">
                                    <div class="px-4">
                                        <input type="radio" name="{{$question->id}}" id="{{$question->id}}_option_a" value="a" @click="answer()">
                                        <label for="{{$question->id}}_option_a">a. {{Str::ucfirst($question->a)}}</label>
                                        @isset($question->a_file)
                                            <img src="{{asset("storage/{$question->a_file}")}}" alt="option a" class="inline-block">
                                        @endisset
                                    </div>
                                    <div class="px-4">
                                        <input type="radio" name="{{$question->id}}" id="{{$question->id}}}_option_c" value="c" @click="answer()">
                                        <label for="{{$question->id}}_option_c">c. {{Str::ucfirst($question->c)}}</label>
                                        @isset($question->c_file)
                                            <img src="{{asset("storage/{$question->c_file}")}}" alt="option c" class="inline-block">
                                        @endisset
                                    </div>
                                    <div class="px-4">
                                        <input type="radio" name="{{$question->id}}" id="{{$question->id}}_option_b" value="b" @click="answer()">
                                        <label for="{{$question->id}}_option_b">b. {{Str::ucfirst($question->b)}}</label>
                                        @isset($question->b_file)
                                            <img src="{{asset("storage/{$question->b_file}")}}" alt="option b" class="inline-block">
                                        @endisset
                                    </div>
                                    <div class="px-4">
                                        <input type="radio" name="{{$question->id}}" id="{{$question->id}}_option_d" value="d" @click="answer()">
                                        <label for="{{$question->id}}_option_d">d. {{Str::ucfirst($question->d)}}</label>
                                        @isset($question->d_file)
                                            <img src="{{asset("storage/{$question->d_file}")}}" alt="option d" class="inline-block">
                                        @endisset
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="flex justify-between mt-1">
                            <x-mine.button do="prev()" class="text-slate-500 border border-transparent focus:ring-transparent">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path fill-rule="evenodd" d="M7.28 7.72a.75.75 0 010 1.06l-2.47 2.47H21a.75.75 0 010 1.5H4.81l2.47 2.47a.75.75 0 11-1.06 1.06l-3.75-3.75a.75.75 0 010-1.06l3.75-3.75a.75.75 0 011.06 0z" clip-rule="evenodd" />
                                </svg>
                                Previous
                            </x-mine.button>
                            <template x-cloak x-if="currPage < pages.length-1">
                                <x-mine.button do="next()" class="text-green-400 border border-transparent focus:ring-transparent">
                                    next
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path fill-rule="evenodd" d="M16.72 7.72a.75.75 0 011.06 0l3.75 3.75a.75.75 0 010 1.06l-3.75 3.75a.75.75 0 11-1.06-1.06l2.47-2.47H3a.75.75 0 010-1.5h16.19l-2.47-2.47a.75.75 0 010-1.06z" clip-rule="evenodd" />
                                    </svg>
                                </x-mine.button>
                            </template>
                            <template x-cloak x-if="currPage == pages.length-1">
                                <x-mine.button type="submit" class="text-green-400 border border-transparent focus:ring-transparent">
                                    Submit Exam
                                </x-mine.button>
                            </template>
                        </div>
                    </form>
                </x-mine.card-container>
                <x-mine.card-container class="flex flex-col w-full min-h-min max-h-96 p-4 sm:p-7 lg:w-1/4 lg:max-h-[34rem]">
                    <div class="grid grid-cols-10 lg:grid-cols-5 h-3/4 gap-2 overflow-y-auto">
                        @foreach ($questions as $question)
                            <button type="button" class="flex flex-col items-center border-2 rounded-md p-2" @click="jump({{$loop->index}})">
                                <p class="text-sm font-semibold">{{$loop->iteration}}</p>
                                <div class="border rounded w-4 h-4" :class="{
                                    'bg-white': (currPage == {{$loop->index}} && hasAnswer[{{$loop->index}}] == false),
                                    'bg-slate-300': (currPage != {{$loop->index}} && hasAnswer[{{$loop->index}}] == false),
                                    'bg-green-400': hasAnswer[{{$loop->index}}]
                                }">
                                </div>
                            </button>
                        @endforeach
                    </div>
                    <div class="self-end pt-2">
                        <x-mine.button do="submit()" class="text-red-400 border border-transparent focus:ring-transparent">
                            End Exam
                        </x-mine.button>
                    </div>
                </x-mine.card-container>
            </div>
        </main>
    </body>
</html>
