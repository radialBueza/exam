<div x-data="{
    open: false
}"
class="relative"
>

    {{$button}}
<div
    x-show="open"
    @click.outside = "open = false"
    class="block bg-slate-50"
>
    {{$slot}}
</div>
</div>
