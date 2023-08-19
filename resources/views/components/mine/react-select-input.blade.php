@props(['name', 'title', 'options', 'selected', 'nullable' => false, 'do'])


<div>
    <label for="{{$name}}" class="block text-sm text-gray-700 capitalize">{{ucwords($title)}}</label>
    <select name="{{$name}}" id="{{$name}}"
        {{$attributes->merge(['class' => 'block w-full px-3 py-2 mt-2 text-gray-600 bg-white border border-gray-200 rounded-md capitalize'])}}
        :class="error.{{$name}}?.msg && 'border-red-800 ring-1 ring-red-800 focus:ring-red-800 focus:border-red-800'"
        x-model="{{$do}}">
        @if ($nullable)
            <option value="" class="text-gray-500">-- Pick {{$title}} --</option>
        @endif
        @foreach ($options as $option)
            <option value="{{$option}}" @isset($selected)
                :selected="'{{$option}}' == {{$selected}}"
            @endisset>{{$option}}</option>
        @endforeach
    </select>
    <div x-show="error.{{$name}}?.msg" x-text="error.{{$name}}?.msg" class="text-red-800 text-sm font-semibold my-2">
    </div>
</div>
