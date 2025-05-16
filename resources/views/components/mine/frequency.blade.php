@props(['datas', 'pdf'=> false])
@foreach ($datas as $key => $value)
    <div @if(!$pdf)x-show="spread[{{$loop->index}}]"@endif class="w-full h-full" x-data="frequency($refs.freqDough{{$loop->index}}, { key:'{{$key}}'}, all)">
        @if($pdf)<h1 class="w-full mx-auto font-bold my-4 text-center">{{$value}}</h1>@endif
        <div class="w-full mx-auto @if(!$pdf) overflow-auto @endif">
            <canvas x-ref="freqDough{{$loop->index}}" class="w-9/12 h-9/12"></canvas>
        </div>
        <table class="w-full mt-2">
            <thead>
                <tr class="border-b">
                    <td></td>
                    <td class="text-center px-6 py-3">Frequency</td>
                    <td class="text-center px-6 py-3">Percentage</td>
                </tr>
            </thead>
            <tbody>
                <template x-cloak x-for="(data,index) in header">
                    <tr class="border-b">
                        <td class="text-center px-6 py-3" x-text="data.name"></td>
                        <td class="text-center px-6 py-3" x-text="data.f"></td>
                        <td class="text-center px-6 py-3" x-text="data.fp"></td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
    @if ($pdf)
        <div style="page-break-after: always;"></div>
    @endif
@endforeach
