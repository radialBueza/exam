<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Fonts -->
        {{-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen" x-data="{
            gamer: {{$gamer}},
            nonGamer: {{$nonGamer}},
        }">
            <h1 class="w-full font-bold my-4 text-left text-lg">Gamer vs. Non-Gamer</h1>

            <x-mine.gamer-vs-non :$datas :pdf="true"/>
        </div>
    </body>
</html>
