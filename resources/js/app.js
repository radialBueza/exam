import './bootstrap';

import pcorrtest from '@stdlib/stats-pcorrtest';
import ranks from '@stdlib/stats-ranks';
import Alpine from 'alpinejs';
import persist from '@alpinejs/persist';
import mean from '@stdlib/stats-base-mean';
import stdev from '@stdlib/stats-base-stdev';
import tabulate from '@stdlib/utils-tabulate';
import {
    Chart,
    ScatterController,
    PointElement,
    LinearScale,
    Tooltip,
    Legend,
    BarController,
    BarElement,
    CategoryScale,
    DoughnutController,
    ArcElement,
    Title,
 } from "chart.js";

Chart.register(
    ScatterController,
    PointElement,
    LinearScale,
    Tooltip,
    Legend,
    BarController,
    BarElement,
    CategoryScale,
    DoughnutController,
    ArcElement,
    Title,
);
Alpine.plugin(persist);
window.Alpine = Alpine;

Alpine.data('stats', () => ({
    Chart: Chart,
    pearson: pcorrtest,
    spearman(a,b) {
        const x = ranks(a);
        const y = ranks(b);
        return pcorrtest(x,y);
    },
    mean: mean,
    stdev: stdev,
    tabulate: tabulate,
}));


Alpine.start();

import.meta.glob(['../images/**', '../fonts/**']);
