@props(['name' => 'birthday', 'edit' => false])

<div>
    <label for="birthday" class="block text-sm text-gray-700 capitalize">{{ucwords($name)}}</label>

    <input id="birthday" name="birthday" type="date"  @if($edit) :value="toEdit && toEdit.birthday" @endif
        {{ $attributes->merge(['class' => 'block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md']) }}
        :class="error.birthday?.msg && 'border-red-800 ring-1 ring-red-800 focus:ring-red-800 focus:border-red-800'"
    >
    <div x-show="error.birthday?.msg" x-text="error.birthday?.msg" class="text-red-800 text-sm font-semibold my-2">
    </div>
</div>
