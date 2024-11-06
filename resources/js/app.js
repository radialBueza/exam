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
    LineController,
    LineElement,
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
    LineController,
    LineElement,
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

function corrChart() {
    let chart;

    const clearChartData = () => {
        chart.options.scales.x.title.text = ''
        chart.data.datasets.forEach(dataset => {
            dataset.data.length = 0;
        });
    }

    const setChartData = (data) => {
        chart.options.scales.x.title.text = data.name;
        chart.data.datasets[0].data = data.xy;
    };

    return {
        result: {},
        init() {
            let xy = this.createData(this.all.numGames, this.all.absScore);
            let xAxis = 'Number of Games Played';
            this.result = this.getStat(this.all.numGames, this.all.absScore, xy.length);
            this.renderChart({xy, xAxis});
        },
        updateChart(data) {
            clearChartData();
            let xy = this.createData(this.all[data.value], this.all.absScore);
            let xAxis = data.options[data.selectedIndex].text;
            this.result = {};
            this.result = this.getStat(this.all[data.value], this.all.absScore, xy.length);
            setChartData({xy, xAxis});
            chart.update();
        },
        renderChart(data){
            chart = new Chart(this.$refs.corr, {
                type: 'scatter',
                data: {
                    datasets: [{
                        data: data.xy,
                        backgroundColor: 'rgb(255, 99, 132)'
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display:false
                        },
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            type: 'linear',
                            position: 'bottom',
                            title: {
                                display: true,
                                text: data.name
                            }
                        },
                        y: {
                            beginAtZero: true,
                            type: 'linear',
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Abstract Reasoning Exam Grade'
                            }
                        }
                    }
                }
            });
        },
        // game = game data, abs = abstract test data, length = min length
        getStat(games, abs, length) {
            let pResult = null;
            let sResult = null;
            let pCorr = null;
            let sCorr = null;
            let pRej = null;
            let sRej = null;
            if(length >= 4) {
                pResult = this.pearson(games, abs)
                sResult = this.spearman(games, abs)
                pCorr = isNaN(pResult.pcorr)  ? 'Too little variation' : (pResult.pcorr).toFixed(2)
                sCorr = isNaN(pResult.pcorr)  ? 'Too little variation' : (sResult.pcorr).toFixed(2)
                pRej = pResult.rejected
                sRej = sResult.rejected
                return {
                    pCorr: pCorr,
                    sCorr: sCorr,
                    pRej: pRej,
                    sRej: sRej
                };
            }else {
                return {
                    pCorr: 'Not Enough Data',
                    sCorr: 'Not Enough Data',
                    pRej: 'Not Enough Data',
                    sRej: 'Not Enough Data'
                }
            }
        },
        createData(x, y) {
            let xy = []
            x.forEach((el, i)=> {
                xy.push(
                    {
                        x: x[i],
                        y: y[i],
                    }
                )
            });
            xy.sort((a,b) => {
                return a.x - b.x
            });

            return xy;
        },
    }
}

window.corrChart = corrChart;
Alpine.start();

import.meta.glob(['../images/**', '../fonts/**']);
