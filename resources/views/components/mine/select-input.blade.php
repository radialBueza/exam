@props(['name', 'title', 'options', 'selected'=> false])


<div>
    <label for="{{$name}}" class="block text-sm text-gray-700 capitalize">{{ucwords($title)}}</label>
    <select name="{{$name}}" id="{{$name}}"
        {{$attributes->merge(['class' => 'block w-full px-3 py-2 mt-2 text-gray-600 bg-white border border-gray-200 rounded-md capitalize'])}}
        @change="validate" :class="error.{{$name}}?.msg && 'border-red-800 ring-1 ring-red-800 focus:ring-red-800 focus:border-red-800'"
        >
        @foreach ($options as $option)
            <option value="{{$option->id}}" @if ($selected)
                :selected="{{$option->id}} == toEdit.department_id"
            @endif>{{$option->name}}</option>
        @endforeach
    </select>
    <div x-show="error.{{$name}}?.msg" x-text="error.{{$name}}?.msg" class="text-red-800 text-sm font-semibold my-2">
    </div>
</div>

