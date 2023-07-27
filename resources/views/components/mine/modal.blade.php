@props(['open'])

<div
    x-cloak x-show="{{$open}}"
    x-transition:enter="transition ease-out duration-300 transform"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200 transform"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="bg-gray-100/75 flex justify-center items-start min-h-screen px-4 text-center sm:p-0">
            <div
                x-cloak x-show="{{$open}}" @click.outside="{{$open}} = false"
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block w-full max-w-xl p-6 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl"
            >
                {{$slot}}
                {{-- <template x-cloak x-if="showForm"> --}}

                    {{-- <div>
                        <div class="flex items-center justify-between space-x-4">
                            <h3 class="text-xl font-medium text-gray-800 ">Add Department</h3>
                            <button @click="{{$open}} = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                        </div>
                        <p class="mt-2 text-sm text-gray-500 ">
                            Add a department for the school.
                        </p>
                        <form class="mt-5" id="addData" @submit.prevent="await sendData($el)">
                            <div>
                                <label for="name" class="block text-sm text-gray-700 capitalize">Department name</label>
                                <input id="name" name="name" placeholder="Enter Depatment Name . . . " type="text" class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md"
                                    @keyup="validate" :class="error.msg && 'border-red-800 ring-1 ring-red-800 focus:ring-red-800 focus:border-red-800'"
                                >
                                <div x-show="error.msg" x-text="error.msg" class="text-red-800 text-sm font-semibold my-2">
                                </div>
                            </div>
                            <div class="flex justify-end mt-6">
                                <button type="submit" class="bg-green-500 focus:ring-green-700 inline-flex items-center px-4 py-2 border-transparent rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Add Department
                                </button>
                            </div>
                        </form>
                    </div> --}}
                {{-- </template> --}}
                {{-- <template x-cloak x-if="!showForm&&!confirm">
                    <div role="status" class="flex justify-center m-2">
                        <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin  fill-red-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </template>
                <template x-cloak x-if="confirm">
                    <div role="confirm" class="flex flex-col justify-center items-center gap-2 m-2">
                        <svg class="w-8 h-8 mr-2 text-gray-200 fill-green-600 animate-pulse" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" />
                        </svg>
                        <p class="text-xl font-medium text-green-800">Successfully created</p>
                        <div class="flex justify-between gap-2">
                            <button @click="again()" class="flex-1 bg-green-500 focus:ring-green-700 inline-flex items-center px-4 py-2 border-transparent rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">Add</button>
                            <button @click="{{$open}} = false" class="flex-1 bg-red-500 focus:ring-red-700 inline-flex items-center px-4 py-2 border-transparent rounded-md font-semibold text-xs text-white tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">Close</button>
                        </div>
                    </div>
                </template> --}}
            </div>
        </div>
    </div>
