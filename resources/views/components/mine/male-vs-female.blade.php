<div x-data="maleVsfemale($refs.gamer, $refs.nonGamer, gamer, nonGamer)">
    <div class="flex w-full mx-auto overflow-auto justify-around">
        <div class="w-2/3 h-auto aspect-square">
            <canvas x-ref="gamer" class="w-full h-full"></canvas>
        </div>
        <div class="w-2/3 h-auto aspect-square">
            <canvas x-ref="nonGamer" class="w-full h-full"></canvas>
        </div>
    </div>

    <table class="w-full mt-2">
        <thead>
            <tr class="border-b">
                <td></td>
                <td class="text-center px-6 py-3">Male</td>
                <td class="text-center px-6 py-3">Female</td>
            </tr>
        </thead>
        <tbody>
            <tr class="border-b">
                <td class="text-center px-6 py-3">Gamer</td>
                <td class="text-center px-6 py-3" x-text="gamer.male"></td>
                <td class="text-center px-6 py-3" x-text="gamer.female"></td>
            </tr>
            <tr class="border-b">
                <td class="text-center px-6 py-3">Non-Gamer</td>
                <td class="text-center px-6 py-3" x-text="nonGamer.male"></td>
                <td class="text-center px-6 py-3" x-text="nonGamer.female"></td>
            </tr>
        </tbody>
    </table>
</div>
