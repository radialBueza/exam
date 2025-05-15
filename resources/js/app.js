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

Alpine.data('corrChart', (canva, data, all)=> ({
    chart: null,
    result: {},
    init() {
        let xy = this.createData(all[data.key], all.absScore);
        let xAxis = data.value;
        this.result = this.getStat(all[data.key], all.absScore, xy[0].length);
        this.renderChart({xy, xAxis});
    },
    renderChart(data){
        this.chart = new Chart(canva, {
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
        if(length >= 4) {
            let pResult = pcorrtest(games, abs)
            let sResult = spearman(games, abs)
            let pCorr = isNaN(pResult.pcorr)  ? 'Too little variation' : (pResult.pcorr).toFixed(2)
            let sCorr = isNaN(pResult.pcorr)  ? 'Too little variation' : (sResult.pcorr).toFixed(2)
            let interAndAction =  this.interpretCorrelation(pCorr,sCorr,pResult.rejected,sResult.rejected)
            return {
                pCorr: pCorr,
                sCorr: sCorr,
                pRej: pResult.rejected,
                sRej: sResult.rejected,
                inter: interAndAction.interpretation,
                recom: interAndAction.action
            };
        }else {
            return {
                pCorr: 'Not Enough Data',
                sCorr: 'Not Enough Data',
                pRej: 'Not Enough Data',
                sRej: 'Not Enough Data',
                inter: 'Not Enough Data',
                recom: 'Not Enough Data',
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
    interpretCorrelation(pearsonR, spearmanR, pearsonSignificant, spearmanSignificant) {
        const pearsonStrength = this.getStrength(pearsonR);
        const spearmanStrength = this.getStrength(spearmanR);
        let interpretation = "";
        let action = "";
        if (isNaN(pearsonR) || isNaN(spearmanR)) {
            return {
                interpretation: 'There is too little or no variation in data. We can\'t give an interpretion of the data.',
                action: 'There are no recommended action.'
            }
        }
            // Case 1: Both correlations are strong and significant in the same direction
            if (pearsonR >= 0.6 && spearmanR >= 0.6 && pearsonSignificant && spearmanSignificant) {
                interpretation = "There is a strong and reliable positive relationship: <strong class='font-medium'>more gaming is linked to higher abstract reasoning scores</strong>.";
                action = "It is okay for students to play video games, as it may enhance abstract reasoning skills. However, gaming should not take away from their main responsibilities like school, chores, and personal well-being.";
            }else if (pearsonR <= -0.5 && spearmanR <= -0.5 && pearsonSignificant && spearmanSignificant) {
                interpretation = "<strong class='font-medium'>Higher gaming hours seem to be associated with lower abstract reasoning scores</strong>. This trend is statistically meaningful.";
                action = "Excessive gaming may negatively impact abstract reasoning ability. Students should moderate their gaming time and prioritize academic and cognitive development.";
            }

            // Case 2: Moderate correlation from Spearman only
            else if (pearsonR >= 0.6 && !pearsonSignificant && spearmanR >= 0.4 && spearmanSignificant) {
                interpretation = "There may be a trend between gaming and abstract reasoning, but it’s unclear. <strong class='font-medium'>Rankings suggest a moderate connection, but exact values fluctuate too much to confirm a strong pattern</strong>.";
                action = "While gaming may have some cognitive benefits, its effects are not fully certain. Students should balance gaming with their studies and other responsibilities to ensure a well-rounded approach to learning.";
            }

            // Case 3: Mixed or weak signals
            else if (
                (pearsonStrength === "moderate" || pearsonStrength === "strong") && pearsonSignificant &&
                (spearmanStrength === "weak" || !spearmanSignificant)
            ) {
                interpretation = "Pearson correlation shows a significant relationship, but rank-based data does not support it. <strong class='font-medium'>This may indicate the presence of outliers or a non-monotonic trend</strong>.";
                action = "Students may experience benefits, but more data is needed to trust the pattern. They should continue to prioritize balance and core responsibilities.";
            } else if (
                (spearmanStrength === "moderate" || spearmanStrength === "strong") && spearmanSignificant &&
                (!pearsonSignificant || pearsonStrength === "weak")
            ) {
                interpretation = "Spearman correlation shows a consistent trend, though the exact values vary. <strong class='font-medium'>There may be a general pattern between gaming and reasoning ability</strong>.";
                action = "Gaming could have an influence, but it's best treated with caution. Students should play in moderation while maintaining academic effort.";
            }

            // Case 4: No meaningful or significant relationship
            else {
                interpretation = "No meaningful correlation between gaming and abstract reasoning. <strong class='font-medium'>The relationship is weak and/or unreliable</strong>.";
                action = "There is no clear connection between gaming and abstract reasoning scores. Students can enjoy gaming, but they should ensure it does not interfere with their essential daily tasks and learning opportunities.";
            }
            return { interpretation, action };
    },
    getStrength(r) {
        const absR = Math.abs(r);
        if (absR >= 0.7) return "strong";
        if (absR >= 0.4) return "moderate";
        if (absR >= 0.2) return "weak";
        return "negligible";
    }
}))

Alpine.data('gamerVsNon', (canva, gamer, nonGamer, labels) => ({
    labels: labels,
    arrayAvgGamer: [],
    arrayAvgNonGamer: [],
    arrayStdevGamer: [],
    arrayStdevNonGamer: [],
    gamerLength: gamer.numGames.length,
    nonGamerLength: nonGamer.numGames.length,
    init() {
        for (const name in gamer) {
            if(name == 'male' || name == 'female') {
                continue
            }
            if(this.gamerLength <= 1) {
                this.arrayAvgGamer.push(0)
                this.arrayStdevGamer.push(0)
            }else {
                this.arrayAvgGamer.push(mean(this.gamerLength,gamer[name],1))
                this.arrayStdevGamer.push(stdev(this.gamerLength,1,gamer[name],1))
            }
        }

        for (const name in this.nonGamer) {
            if(name == 'male' || name == 'female') {
                continue
            }
            if(this.nonGamerLength <= 1) {
                this.arrayAvgNonGamer.push(0)
                this.arrayStdevNonGamer.push(0)
            }else {
                this.arrayAvgNonGamer.push(mean(this.nonGamerLength,nonGamer[name],1))
                this.arrayStdevNonGamer.push(stdev(this.nonGamerLength,1,nonGamer[name],1))
            }

        }
        new Chart(canva, {
            type: 'bar',
            data: {
                labels: this.labels,
                datasets: [{
                    label: 'Gamer\'s Avg.',
                    data: this.arrayAvgGamer,
                    borderColor: '#ef4444',
                    backgroundColor: '#f87171',
                    // stack: 'Stack 0',
                }, {
                    label: 'Gamer\'s Standard Deviation',
                    data: this.arrayStdevGamer,
                    borderColor: '#d97706',
                    backgroundColor: '#f59e0b',
                    // stack: 'Stack 0',
                },
                {
                    label: 'Non-Gamer\'s Avg.',
                    data: this.arrayAvgNonGamer,
                    borderColor: '#0891b2',
                    backgroundColor: '#06b6d4',
                    // stack: 'Stack 1',
                },
                {
                    label: 'Non-Gamer\'s Standard Deviation',
                    data: this.arrayStdevNonGamer,
                    borderColor: '#7c3aed',
                    backgroundColor: '#8b5cf6',
                    // stack: 'Stack 1',
                }
            ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display:true
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        // stacked: true,
                    },
                    x: {
                        // stacked: true,
                    }
                }
            }
        })
    }
}))

Alpine.data('maleVsfemale', (aCanva, bCanva, gamer, nonGamer) => ({
     init() {
        new Chart(aCanva, {
            type: 'doughnut',
            data: {
                labels: ['Male', 'Female'],
                datasets: [{
                    lable: 'Gamer',
                    data: [gamer.male, gamer.female],
                    backgroundColor: [
                        '#2563eb',
                        '#f43f5e',
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Gamer'
                    }
                }
            }
        })

        new Chart(bCanva, {
            type: 'doughnut',
            data: {
                labels: ['Male', 'Female'],
                datasets: [{
                    lable: 'Non-Gamer',
                    data: [nonGamer.male, nonGamer.female],
                    backgroundColor: [
                        '#2563eb',
                        '#f43f5e',
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Non-Gamer'
                    }
                }
            }
        })
    }
}))

Alpine.data('frequency', (canva, data, all) => ({
    chart: null,
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
        this.result = tabulate(all[data.key]);
        let info = this.createData(this.result, this.type);
        this.renderChart(info);
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
        this.chart = new Chart(canva, {
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
                responsive: true,
                maintainAspectRatio: false,
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
}))

Alpine.start();

import.meta.glob(['../images/**', '../fonts/**']);
