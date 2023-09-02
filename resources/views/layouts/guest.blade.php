<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

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
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
