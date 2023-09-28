<x-app-layout title="Result of {{$info->name}}">
    {{-- <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">
            {{$info->name}} Result
        </h1>
    </x-slot> --}}
    <x-mine.bg-container maxWidth="3xl">
        <x-mine.card-container class="p-5 sm:p-9 flex flex-col justify-center gap-2">
            {{-- <div class="flex flex-col "> --}}
                <div class="flex flex-col justify-center items-center gap-1.5 pb-2">
                    <h1 class="font-semibold text-2xl text-gray-800 leading-tight capitalize">{{$info->name}}</h1>
                    <p class="p-1 text-xs font-extralight capitalize text-white rounded-lg bg-gray-400">{{$info->subject->name}}</p>
                </div>
                <table>
                    <tr class="border-b-2">
                        <td class="text-sm p-1.5 font-medium">Score:</td>
                        <td class="text-right text-sm p-1.5">{{$attempt->score}}</td>
                    </tr>
                    <tr class="border-b-2">
                        <td class="text-sm p-1.5 font-medium">Percent:</td>
                        <td class="text-right text-sm p-1.5">{{$attempt->percent}}</td>
                    </tr>
                    <tr>
                        <td class="text-sm p-1.5 font-medium">Grade:</td>
                        <td class="text-right text-sm p-1.5">{{$attempt->grade}}</td>
                    </tr>
                </table>
                <img src="{{ Vite::asset('resources/images/giphy (1).gif')}}" alt="snoop dog congratulation" class="w-1/4 self-center">
                @if ($type == 'notSubmit')
                    <a href="{{url()->previous()}}" class="self-end inline-flex items-center px-4 py-2 border rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150 whitespace-nowrap border-transparent bg-green-600 focus:ring-green-600 hover:bg-green-500 focus:bg-green-500 active:bg-green-700">
                        Okay
                    </a>
                @else
                    <a href="{{route('dashboard')}}" class="self-end inline-flex items-center px-4 py-2 border rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150 whitespace-nowrap border-transparent bg-green-600 focus:ring-green-600 hover:bg-green-500 focus:bg-green-500 active:bg-green-700">
                        Okay
                    </a>
                @endif


                {{-- <x-mine.link-button href="{{url()->previous()}}" class="whitespace-nowrap border-transparent bg-sky-600 focus:ring-sky-600 hover:bg-sky-500 focus:bg-sky-500 active:bg-sky-700">
                    Go to Exam
                </x-mine.link-button> --}}
            {{-- </div> --}}

        </x-mine.card-container>
    </x-mine.bg-container>
</x-app-layout>
