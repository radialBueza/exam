@props(['datas', 'pdf'=> false])
@foreach ($datas as $key => $value)
    <div x-show="spread[{{$loop->index}}]"class="w-full h-full" x-data="corrChart($refs.corr{{$loop->index}}, { key: '{{$key}}', value: '{{$value}}'}, all)">
        @if($pdf)<h1 class="w-full mx-auto font-bold my-4 text-center">{{$value}}</h1>@endif
        <div class="w-full mx-auto overflow-auto">
            <canvas x-ref="corr{{$loop->index}}" class="w-full h-full"></canvas>
        </div>
        <table class="w-full mt-2">
            <thead>
                <tr class="border-b">
                    <td></td>
                    <td class="text-center px-6 py-3">Pearson Product-Moment Correlation</td>
                    <td class="text-center px-6 py-3">Spearman's Rank-Order Correlation</td>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b">
                    <td class="text-center px-6 py-3">Correlation</td>
                    <td class="text-center px-6 py-3" x-text="result.pCorr"></td>
                    <td class="text-center px-6 py-3" x-text="result.sCorr"></td>
                </tr>
                <tr class="border-b">
                    <td class="text-center px-6 py-3">Significance</td>
                    <td class="text-center capitalize px-6 py-3" x-text="result.pRej"></td>
                    <td class="text-center capitalize px-6 py-3" x-text="result.sRej"></td>
                </tr>
            </tbody>
        </table>
        <div class="flex flex-col space-y-2 pt-2.5 font-light">
            <div>
                <h3 class="capitalize font-semibold">interpretation</h3>
                <p class="indent-4" x-html="result.inter"></p>
            </div>
            <div>
                <h3 class="capitalize font-semibold">Recommended Action</h3>
                <p class="indent-4" x-text="result.recom"></p>
            </div>
            <p class="text-stone-900 border-t-2 text-sm pt-2"><strong>Warning:</strong> The displayed correlations (Pearson’s r and Spearman’s ρ) show links between gaming time and abstract reasoning scores, but they don’t mean that one causes the other. Patterns like bell-shaped trends or outside influences might not be captured. Please interpret the results carefully.</p>
        </div>
    </div>
    @if ($pdf)
        <div style="page-break-after: always;"></div>
    @endif
@endforeach
