@props(['datas'])
<div x-data="gamerVsNon($refs.avgStdev, gamer, nonGamer, {{json_encode(array_values($datas))}})">
    <div class="w-full mx-auto overflow-auto">
        <canvas x-ref="avgStdev" class="w-full h-full"></canvas>
    </div>
    <table class="w-full mt-2">
        <thead>
            <tr class="border-b">
                <td></td>
                <td class="text-center px-6 py-3">Gamers' Avg. Score</td>
                <td class="text-center px-6 py-3">Gamers' Standard Deviation</td>
                <td class="text-center px-6 py-3">Non-Gamers' Avg. Score</td>
                <td class="text-center px-6 py-3">Non-Gamers' Standard Deviation</td>
            </tr>
        </thead>
        <tbody>
            <template x-cloak x-for="(label, index) in labels">
                <tr class="border-b">
                    <td class="text-center px-6 py-3" x-text="label"></td>
                    <td class="text-center px-6 py-3" x-text="Math.round((arrayAvgGamer[index] + Number.EPSILON) * 100) / 100"></td>
                    <td class="text-center px-6 py-3" x-text="Math.round((arrayStdevGamer[index] + Number.EPSILON) * 100) / 100"></td>
                    <td class="text-center px-6 py-3" x-text="Math.round((arrayAvgNonGamer[index] + Number.EPSILON) * 100) / 100"></td>
                    <td class="text-center px-6 py-3" x-text="Math.round((arrayStdevNonGamer[index] + Number.EPSILON) * 100) / 100"></td>
                </tr>
            </template>
        </tbody>
    </table>
</div>
