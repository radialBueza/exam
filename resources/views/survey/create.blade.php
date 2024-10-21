<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title class="capitalize">Survey</title>

        <style>
        @font-face {
          font-family: 'Figtree';
          font-style: normal;
          font-weight: 300;
          font-stretch: 100%;
          font-display: swap;
          src: url({{ Vite::asset('resources/fonts/figtree/fonts/webfonts/Figtree-Light.woff2') }}) format('woff2');
        }

        @font-face {
          font-family: 'Figtree';
          font-style: normal;
          font-weight: 400;
          font-stretch: 100%;
          font-display: swap;
          src: url({{ Vite::asset('resources/fonts/figtree/fonts/webfonts/Figtree-Regular.woff2') }}) format('woff2');
        }

        @font-face {
          font-family: 'Figtree';
          font-style: normal;
          font-weight: 500;
          font-stretch: 100%;
          font-display: swap;
          src: url({{ Vite::asset('resources/fonts/figtree/fonts/webfonts/Figtree-Medium.woff2') }}) format('woff2');
        }

        @font-face {
          font-family: 'Figtree';
          font-style: normal;
          font-weight: 600;
          font-stretch: 100%;
          font-display: swap;
          src: url({{ Vite::asset('resources/fonts/figtree/fonts/webfonts/Figtree-SemiBold.woff2') }}) format('woff2');
        }

        @font-face {
          font-family: 'Figtree';
          font-style: normal;
          font-weight: 700;
          font-stretch: 100%;
          font-display: swap;
          src: url({{ Vite::asset('resources/fonts/figtree/fonts/webfonts/Figtree-Bold.woff2') }}) format('woff2');
        }

        @font-face {
          font-family: 'Figtree';
          font-style: normal;
          font-weight: 800;
          font-stretch: 100%;
          font-display: swap;
          src: url({{ Vite::asset('resources/fonts/figtree/fonts/webfonts/Figtree-ExtraBold.woff2') }}) format('woff2');
        }

        @font-face {
          font-family: 'Figtree';
          font-style: normal;
          font-weight: 800;
          font-stretch: 100%;
          font-display: swap;
          src: url({{ Vite::asset('resources/fonts/figtree/fonts/webfonts/Figtree-Black.woff2') }}) format('woff2');
        }
        </style>
        <link rel="icon" type="image/x-icon" href="{{Vite::asset('resources/images/logo.png')}}">
        <!-- Fonts -->
        {{-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <main class="bg-gray-100 py-6 sm:py-12 min-h-screen flex justify-center" x-data="{
            currPage: 0,
            pages: [],
            open: false,
            init() {
                for(let i = 0; i < 16; i++) {
                    if(i == 0) {
                        this.pages[i] = true
                    }else {
                        this.pages[i] = false
                    }
                }
                {{-- console.log(this.pages.length) --}}
                @if($errors->any())
                    this.open = true
                    setTimeout(() => this.open = false, 5000)
                @endif
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
        }">
            <div x-cloak x-show="open" x-transition.scale.origin.top class="self-center text-sm font-medium text-red-600 absolute top-0 px-1 py-2 flex justify-center bg-white border w-1/2 rounded-b-lg">
                @if($errors->any())
                <ul class="list-none space-y-2">
                    @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                        @if ($loop->index == 3)
                            <li>More...</li>
                            @break
                        @endif
                    @endforeach
                </ul>

                @endif
            </div>
            <div class="sm:px-6 lg:px-8 max-w-7xl w-full flex flex-col gap-3 justify-center lg:flex-row lg:items-center">
                <x-mine.card-container class="p-8 sm:p-14 w-full">
                    <form action="{{route('recordSurvey', Auth::id())}}" method="POST" x-ref="form">
                        @csrf
                        @foreach ($surveys as $survey)
                            <div x-cloak x-show="pages[{{$loop->index}}]">
                                <div class="pb-2">
                                    <p class="text-lg inline-block">{{"{$loop->iteration}.)"}} {{Str::ucfirst($survey['question'])}}</p>
                                </div>
                                <div class="flex  justify-center px-1 gap-2" :class="({{$loop->index}} == 15) ? 'flex-col-reverse':'flex-col'" >
                                    @foreach ($survey['answers'] as $answer)
                                        <div class="text-sm">
                                            <input type="radio" name="{{$survey['name']}}" id="{{$survey['name'] . '_' . $loop->index}}" value="{{$loop->index}}">
                                            <label for="{{$survey['name'] . '_' . $loop->index}}" class="whitespace-nowrap">{{Str::ucfirst($answer)}}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                        <div class="flex justify-between mt-1">
                            <x-mine.button do="prev()" class="text-slate-500 border-0 border-transparent focus:ring-transparent">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path fill-rule="evenodd" d="M7.28 7.72a.75.75 0 010 1.06l-2.47 2.47H21a.75.75 0 010 1.5H4.81l2.47 2.47a.75.75 0 11-1.06 1.06l-3.75-3.75a.75.75 0 010-1.06l3.75-3.75a.75.75 0 011.06 0z" clip-rule="evenodd" />
                                </svg>
                                Previous
                            </x-mine.button>
                            <template x-cloak x-if="currPage < pages.length-1">
                                <x-mine.button do="next()" class="text-green-400 border-0 border-transparent focus:ring-transparent">
                                    next
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path fill-rule="evenodd" d="M16.72 7.72a.75.75 0 011.06 0l3.75 3.75a.75.75 0 010 1.06l-3.75 3.75a.75.75 0 11-1.06-1.06l2.47-2.47H3a.75.75 0 010-1.5h16.19l-2.47-2.47a.75.75 0 010-1.06z" clip-rule="evenodd" />
                                    </svg>
                                </x-mine.button>
                            </template>
                            <template x-cloak x-if="currPage == pages.length-1">
                                <x-mine.button type="submit" class="text-green-400 border border-transparent focus:ring-transparent">
                                    Submit Survey
                                </x-mine.button>
                            </template>
                        </div>
                    </form>
                </x-mine.card-container>
            </div>
        </main>
    </body>
</html>
