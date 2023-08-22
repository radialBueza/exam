@props(['open', 'maxWidth' => 'default'])


@php
    switch ($maxWidth) {
        case 'default':
            $maxWidth = 'max-w-xl';
            break;

        case '2xl':
            $maxWidth = 'max-w-2xl';
            break;

        case '2xl':
            $maxWidth = 'max-w-3xl';
            break;

        case '4xl':
            $maxWidth = 'max-w-3xl';
            break;
    }
@endphp
<div
    x-cloak x-show="{{$open}}"
    x-transition:enter="transition ease-out duration-300 transform"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200 transform"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-40 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="bg-gray-100/75 flex justify-center items-start min-h-screen px-4 text-center sm:p-0">
            <div
                x-cloak x-show="{{$open}}" @click.outside="{{$open}} = false"
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block w-full {{$maxWidth}} p-6 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl"
            >
                {{$slot}}

            </div>
        </div>
    </div>
