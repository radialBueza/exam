@aware(['condition' => 'success'])

<template x-cloak x-if="{{$condition}}">
    <div role="success" class="flex flex-col justify-center items-center gap-2 m-2">
        <svg class="w-8 h-8 text-gray-200 fill-green-600 animate-pulse" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" />
        </svg>
        <p class="text-xl font-medium text-green-800">Successfully created</p>
        <div class="flex justify-between gap-2">
            {{$slot}}
        </div>
    </div>
</template>
