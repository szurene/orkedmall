const monthLabels = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

// Map the PHP data (monthlyData) to the chart labels
const monthValues = monthLabels.map((_, i) => monthlyData[i+1] || 0);

/* Bar Chart (Monthly Registered Members) */
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
        plugins: { legend: { display: false } },
        scales: {
            y: {
                beginAtZero: true,
                ticks: { stepSize: 1 }
            }
        }
    }
});

/* Pie Chart (Membership Type Distribution) */
const typeLabels = Object.keys(typeData);
const typeValues = Object.values(typeData);

new Chart(document.getElementById('typeChart'), {
    type: 'pie',
    data: {
        labels: typeLabels,
        datasets: [{
            data: typeValues,
            backgroundColor: ['#e19bb1', '#333']
        }]
    },
    options: {
        plugins: {
            tooltip: {
                callbacks: {
                    label: ctx => {
                        let total = ctx.dataset.data.reduce((a,b)=>a+b, 0);
                        let percent = ((ctx.raw / total) * 100).toFixed(1);
                        return `${ctx.label}: ${percent}% (${ctx.raw})`;
                    }
                }
            }
        }
    }
});

/* --- Updated Logic for the Yellow Highlight Area --- */
const totalsContainer = document.getElementById('typeChartTotals');
if (totalsContainer) {
    let grandTotal = typeValues.reduce((a, b) => a + b, 0);
    
    // Create strings for each type (e.g., "Gold: 5")
    let segments = typeLabels.map((label, index) => {
        return `<strong>${label}:</strong> ${typeValues[index]}`;
    });

    // Combine them with the grand total
    totalsContainer.innerHTML = segments.join(' &nbsp;|&nbsp; ') + ` &nbsp;&nbsp; (<strong>Total: ${grandTotal}</strong>)`;
}