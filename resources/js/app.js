import './bootstrap';

import pcorrtest from '@stdlib/stats-pcorrtest';
import ranks from '@stdlib/stats-ranks';
import Alpine from 'alpinejs';
import persist from '@alpinejs/persist';

Alpine.plugin(persist);
window.Alpine = Alpine;

Alpine.data('stats', (x,y) => ({
    x: x,
    y: y,
    // pcorrtest: pcorrtest,
    pearsonResult: null,
    spearmanResult: null,
    init() {
        // const corr = pcorrtest(this.x, this.y);
        // this.pearsonResult = corr.print();
        // console.log(this.result);
        const rankX = ranks(this.x);
        const rankY = ranks(this.y);
        const col = pcorrtest(rankX, rankY);
        console.log(col);
    }
}));



Alpine.start();

import.meta.glob(['../images/**', '../fonts/**']);
