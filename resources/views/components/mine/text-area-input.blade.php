@props(['name' => 'name', 'title', 'value'])

<div>
    <label for="{{$name}}" class="block text-sm text-gray-700 capitalize">{{ucwords($title)}}</label>

    <textarea id="{{$name}}" rows="4" name="{{$name}}" placeholder="Enter {{ucwords($title)}}. . . " @isset($value) x-text="{{$value}}"@endisset
        class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md"
        :class="error.{{$name}}?.msg && 'border-red-800 ring-1 ring-red-800 focus:ring-red-800 focus:border-red-800'"
    ></textarea>
    <div x-show="error.{{$name}}?.msg" x-text="error.{{$name}}?.msg" class="text-red-800 text-sm font-semibold my-2">
    </div>
</div>
