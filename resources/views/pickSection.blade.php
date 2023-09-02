<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title class="capitalize">Pick Section</title>

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
        <main class="min-h-screen bg-gray-100 flex items-center justify-center" x-data="{
            departments: {{$departments}},
            gradeLevels: {{$gradeLevels}},
            sections: {{$sections}},
            pages: [true, false, false],
            currPage: 0,
            dept: '',
            glvl: '',
            sect: '',
            get deptsLevels() {
                return this.gradeLevels.filter((item) => {
                    if(item.department_id == parseInt(this.dept)) {
                        return true
                    }
                })
            },
            get gradeSection() {
                return this.sections.filter((item) => {
                    if(item.grade_level_id == parseInt(this.glvl)) {
                        return true
                    }
                })
            },
            next() {
                let param = null
                switch(this.currPage) {
                    case 0:
                        param = this.dept
                        break;
                    case 1:
                        param = this.glvl
                        break;
                }
                console.log(param)
                console.log(param.length)

                if(this.currPage < this.pages.length-1 && param.length != 0) {
                    this.pages[this.currPage] = false
                    this.currPage++
                    this.pages[this.currPage] = true
                }

            },
            back() {
                console.log(this.currPage > 0)
                if(this.currPage > 0) {
                    this.pages[this.currPage] = false
                    this.currPage--
                    this.pages[this.currPage] = true
                }
            },
            open: false
        }">
            <div x-cloak x-show="open" x-transition.scale.origin.top class="text-lg font-medium text-red-600 absolute top-0 px-1 py-2 flex justify-center bg-white border w-1/2 rounded-b-lg">
                Please pick a section.
            </div>
            <div class="py-6 sm:py-12">
                <x-mine.bg-container maxWidth="4xl">
                    <x-mine.card-container>
                        <form action="{{route('setSection', auth()->user()->id)}}" method="POST" class="flex flex-col justify-between gap-4"
                            @submit="(e) => {
                                if(sect.length != 0) {
                                    return true
                                    console.log('hello')
                                }else{
                                    open = true
                                    setTimeout(() => open = false, 3000)
                                    e.preventDefault()
                                    console.log('hi')
                                }
                                {{-- return false
                                console.log('hi') --}}
                            }"
                            >
                            @csrf
                            @method('PUT')
                            <template x-cloak x-if="pages[0]">
                                <div class=" flex flex-col items-center justify-center gap-6">
                                    <p class="text-2xl">What <span class="font-bold  ">department</span> do you belong to?</p>
                                    <div class="flex flex-row gap-2">
                                        <template x-cloak x-for="department in departments">
                                            <div>
                                                <input type="radio" name="department_id" :id="department.name" :value="department.id" :checked="department.id == dept" x-model="dept">
                                                <label for="department.name" class="capitalize" x-text="department.name"></label>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </template>
                            <template x-cloak x-if="pages[1]">
                                <div class=" flex flex-col items-center justify-center gap-6">
                                    <p class="text-2xl">What <span class="font-bold">grade level</span> do you belong to?</p>
                                    <div class="flex flex-row gap-2">
                                        <template x-cloak x-for="gradeLevel in deptsLevels">
                                            <div>
                                                <input type="radio" name="grade_level_id" :id="gradeLevel.name" :value="gradeLevel.id" :checked="gradeLevel.id == glvl" x-model="glvl">
                                                <label for="gradeLevel.name" class="capitalize" x-text="gradeLevel.name"></label>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </template>
                            <template x-cloak x-if="pages[2]">
                                <div class=" flex flex-col items-center justify-center gap-6">
                                    <p class="text-2xl">What <span class="font-bold">section</span> do you belong to?</p>
                                    <div class="flex flex-row gap-2">
                                        <template x-cloak x-for="section in gradeSection">
                                            <div>
                                                <input type="radio" name="section_id" :id="section.name" :value="section.id" :checked="section.id == sect" x-model="sect">
                                                <label for="section.name" class="capitalize" x-text="section.name"></label>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </template>
                            <div class="flex justify-between">
                                <x-mine.button do="back()" class="text-slate-500 border border-transparent focus:ring-transparent">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path fill-rule="evenodd" d="M7.28 7.72a.75.75 0 010 1.06l-2.47 2.47H21a.75.75 0 010 1.5H4.81l2.47 2.47a.75.75 0 11-1.06 1.06l-3.75-3.75a.75.75 0 010-1.06l3.75-3.75a.75.75 0 011.06 0z" clip-rule="evenodd" />
                                    </svg>
                                    Back
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
                                        Submit
                                    </x-mine.button>
                                </template>
                            </div>
                        </form>
                    </x-mine.card-container>
                </x-mine.bg-container>
            </div>
        </main>
    </body>
</html>
