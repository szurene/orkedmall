const monthLabels = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

const monthValues = monthLabels.map((_, i) => monthlyData[i+1] || 0);

/* Bar Chart */
new Chart(document.getElementById('monthlyChart'), {
    type: 'bar',
    data: {
        labels: monthLabels,
        datasets: [{
            data: monthValues,
            backgroundColor: '#e19bb1'
        }]
    },
    options: {
        plugins: { legend: { display: false } }
    }
});

/* Pie Chart */
new Chart(document.getElementById('typeChart'), {
    type: 'pie',
    data: {
        labels: Object.keys(typeData),
        datasets: [{
            data: Object.values(typeData),
            backgroundColor: ['#e19bb1', '#333']
        }]
    },
    options: {
        plugins: {
            tooltip: {
                callbacks: {
                    label: ctx => {
                        let total = ctx.dataset.data.reduce((a,b)=>a+b);
                        let percent = ((ctx.raw / total) * 100).toFixed(1);
                        return `${ctx.label}: ${percent}%`;
                    }
                }
            }
        }
    }
});
