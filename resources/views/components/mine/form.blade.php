@props(['title', 'subtitle', 'id'])

<div>
    <div class="flex items-center justify-between space-x-4">
        <h3 class="text-xl font-medium text-gray-800 ">{{ucwords($title)}}</h3>
        <button @click="openAdd = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </button>
    </div>
    <p class="mt-2 text-sm text-gray-500 ">
        {{ucfirst($subtitle)}}
    </p>
    <form class="mt-5" id="{{$id}}" @submit.prevent="await sendData($el)">
        <div>
            {{$slot}}
        </div>
        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-green-500 focus:ring-green-700 inline-flex items-center px-4 py-2 border-transparent rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">
                Add Department
            </button>
        </div>
    </form>
</div>
