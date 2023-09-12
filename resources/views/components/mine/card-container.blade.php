{{-- <section {{$attributes->merge(['class'=> 'p-5 sm:p-9 overflow-hidden bg-white shadow-md sm:rounded-lg'])}}> --}}
<section {{$attributes->merge(['class'=> 'overflow-hidden bg-white shadow-md sm:rounded-lg'])}}>

    {{-- <div class="max-w-xl"> --}}
        {{$slot}}
    {{-- </div> --}}
</section>
