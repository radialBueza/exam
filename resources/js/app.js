import './bootstrap';

import pcorrtest from '@stdlib/stats-pcorrtest';
import ranks from '@stdlib/stats-ranks';
import Alpine from 'alpinejs';
import persist from '@alpinejs/persist';
import mean from '@stdlib/stats-base-mean';
import stdev from '@stdlib/stats-base-stdev';
import tabulate from '@stdlib/utils-tabulate';
import regression from 'regression';
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

// Alpine.data('stats', () => ({
    // Chart: Chart,
    // pearson: pcorrtest,
    // spearman(a,b) {
    //     const x = ranks(a);
    //     const y = ranks(b);
    //     return pcorrtest(x,y);
    // },
    // mean: mean,
    // stdev: stdev,
    // tabulate: tabulate,
// }));

function spearman(a,b) {
    const x = ranks(a);
    const y = ranks(b);
    return pcorrtest(x,y);
}

function corrChart() {
    let chart;

    const clearChartData = () => {
        chart.options.scales.x.title.text = ''
        chart.data.datasets.forEach(dataset => {
            dataset.data.length = 0;
        });
    }

    const setChartData = (data) => {
        chart.options.scales.x.title.text = data.xAxis;
        chart.data.datasets.forEach((dataset, i) => {
            dataset.data = data.xy[i];
        });
    };

    return {
        result: {},
        init() {
            let xy = this.createData(this.all.numGames, this.all.absScore);
            let xAxis = 'Number of Games Played';
            this.result = this.getStat(this.all.numGames, this.all.absScore, xy[0].length);
            this.renderChart({xy, xAxis});
        },
        updateChart(data) {
            clearChartData();
            let xy = this.createData(this.all[data.value], this.all.absScore);
            let xAxis = data.options[data.selectedIndex].text;
            this.result = {};
            this.result = this.getStat(this.all[data.value], this.all.absScore, xy[0].length);
            setChartData({xy, xAxis});
            chart.update();
        },
        renderChart(data){
            chart = new Chart(this.$refs.corr, {
                data: {
                    datasets: [{
                        type: 'scatter',
                        data: data.xy[0],
                        backgroundColor: 'rgb(255, 99, 132)'
                    }, {
                        type: 'line',
                        data: data.xy[1],
                        backgroundColor: 'rgb(99, 255, 222)',
                        borderColor: 'rgb(99, 255, 222)',
                        pointRadius: 0
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
                            beginAtZero: false,
                            type: 'linear',
                            position: 'bottom',
                            title: {
                                display: true,
                                text: data.xAxis
                            }
                        },
                        y: {
                            beginAtZero: false,
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
                pResult = pcorrtest(games, abs)
                sResult = spearman(games, abs)
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
            let xy = [];
            let data = [];
            let reg;
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
            data = xy.map(({x,y}) => {
                return [x,y];
            });
            reg = regression.linear(data).points
            return [xy, reg];
        },
    }
}

function freqChart() {
    let chart;

    const clearChartData = () => {
        chart.data.labels = ''
        chart.data.datasets.forEach(dataset => {
            dataset.data.length = 0;
        });
    }

    const setChartData = (data) => {
        chart.data.labels = data.label;
        chart.data.datasets.forEach((dataset) => {
            dataset.data = data.freq;
        });
    };

    return {
        result: [],
        type: 'numGames',
        options: {
            numGames: [
                'Zero(0) Games',
                'One (1) Game',
                'Two (2) Games',
                'Three (3) Games',
                'Four (4) Games',
                'Five (5) Games',
                'Six (6) Games',
            ],
            all: [
                '0 minutes',
                '≤ 1 hour',
                '≤ 2 hours',
                '≤ 3 hours',
                '≤ 4 hours',
                '≤ 5 hours',
                '≤ 5 hours'
            ]
        },
        init() {
            this.result = tabulate(this.all.numGames)
            let info = this.createData(this.result, this.type)
            this.renderChart(info);
        },
        updateChartFrq(data) {
            clearChartData();
            this.result = tabulate(this.all[data.value]);
            let info = this.createData(this.result, this.type);
            setChartData(info);
            chart.update();
        },
        createData(data, type) {
            let freq = [];
            let label = [];
            data.sort((a,b) => {
                return a[0] - b[0]
            });
            let option = (type == 'numGames') ? 'numGames' : 'all';
            data.forEach((el) => {
                freq.push(el[1]);
                label.push(this.options[option][el[0]]);
            });

            return {
                freq: freq,
                label: label
            }
        },
        renderChart(data){
            chart = new Chart(this.$refs.freqDough, {
                type: 'doughnut',
                data: {
                    labels: data.label,
                    datasets: [{
                        data: data.freq,
                        backgroundColor: [
                            '#ea580c',
                            '#65a30d',
                            '#0d9488',
                            '#2563eb',
                            '#7c3aed',
                            '#db2777',
                            '#4b5563',
                        ],
                        hoverOffset: 4
                    }]
                },
                options: {
                    plugins: {
                        title: {
                            display: true
                        },
                    }
                }
            });
        },
        get header() {
            const data = []
            if(this.type === 'numGames') {
                this.options.numGames.forEach((element, index) => {
                    let f = 0
                    let fp = '0%'
                    this.result.forEach((el, i)=> {
                        if(el[0] == index) {
                            f = el[1]
                            fp = `${el[2] * 100}%`
                        }
                    })
                    data.push({
                        name: element,
                        f: f,
                        fp: fp
                    })

                })
                return data
            }else {
                this.options.all.forEach((element, index) => {
                    let f = 0
                    let fp = '0%'
                    this.result.forEach((el)=> {
                        if(el[0] == index) {
                            f = el[1]
                            fp = `${el[2] * 100}%`
                        }
                    })
                    data.push({
                        name: element,
                        f: f,
                        fp: fp
                    })

                })
                return data
            }
        },
    };
}

window.mean = mean;
window.stdev = stdev;
window.Chart = Chart;
window.corrChart = corrChart;
window.freqChart = freqChart;
Alpine.start();

import.meta.glob(['../images/**', '../fonts/**']);
