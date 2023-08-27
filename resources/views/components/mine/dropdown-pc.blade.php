<div
    x-data="{
        open: false
    }"
    class="relative",
>
    {{$button}}
    <div
        x-cloak x-show="open" @click.outside="open = !open"
        class="absolute bg-white border px-2 pt-1 flex flex-col rounded-b shadow capitalize"
        @mouseenter="open = true" @mouseleave="open = false"

    >
        {{$slot}}
    </div>
</div>
