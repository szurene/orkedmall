const monthlyChartEl = document.getElementById("monthlyChart");
const typeChartEl = document.getElementById("typeChart");
const ageChartEl = document.getElementById("ageChart");

// Keep references to Chart.js instances to destroy them before redrawing
let monthlyChartInstance = null;
let typeChartInstance = null;
let ageChartInstance = null;

/* ==============================
   AJAX FUNCTION TO FETCH DASHBOARD DATA
   This is the AJAX part: it calls getChartData.php
   and updates the summary cards and charts dynamically
============================== */
function loadDashboardData() {
    fetch("getChartData.php")          // <-- AJAX request starts here
        .then(res => res.json())       // <-- Convert PHP JSON response to JS object
        .then(data => {

            /* ------------------------------
               SUMMARY CARDS UPDATE
               (total members, active members, pending payments)
            ------------------------------- */
            document.getElementById("totalMembers").textContent = data.totalMembers;
            document.getElementById("activeMembers").textContent = data.activeMembers;
            document.getElementById("pendingPayments").textContent = data.pendingPayments;

            /* ------------------------------
               DESTROY OLD CHARTS BEFORE REDRAWING
            ------------------------------- */
            if(monthlyChartInstance) monthlyChartInstance.destroy();
            if(typeChartInstance) typeChartInstance.destroy();
            if(ageChartInstance) ageChartInstance.destroy();

            /* ------------------------------
               MONTHLY BAR CHART
            ------------------------------- */
            monthlyChartInstance = new Chart(monthlyChartEl, {
    type: 'bar',
    data: {
        labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
        datasets: [{
            data: data.monthly,
            backgroundColor: '#e19bb1'
        }]
    },
    options: {
        plugins: {
            legend: { display: false },
            title: {
                display: true,
                text: 'Year ' + new Date().getFullYear(),
                font: {
                    family: 'Poppins, sans-serif',
                    size: 16,    // smaller but readable
                    weight: '600'
                },
                color: '#e91e63',
                padding: { bottom: 10 }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    font: {
                        family: 'Poppins, sans-serif',
                        size: 12,   // smaller tick font
                        weight: '500'
                    },
                    color: '#333'
                }
            },
            x: {
                ticks: {
                    font: {
                        family: 'Poppins, sans-serif',
                        size: 12,   // smaller tick font
                        weight: '500'
                    },
                    color: '#333'
                }
            }
        }
    }
});

            /* ------------------------------
               MEMBERSHIP TYPE PIE CHART
            ------------------------------- */
            typeChartInstance = new Chart(typeChartEl, {
                type: 'pie',
                data: {
                    labels: data.type.labels,
                    datasets: [{
                        data: data.type.values,
                        backgroundColor: ['#e0ca1f','#666163','#f1c4d6']
                    }]
                }
            });

            /* ------------------------------
               AGE BAR CHART
            ------------------------------- */
            ageChartInstance = new Chart(ageChartEl, {
                type: 'bar',
                data: {
                    labels: data.age.labels,
                    datasets: [{
                        data: data.age.values,
                        backgroundColor: '#f1c4d6'
                    }]
                },
                options: {
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true } }
                }
            });

        })
        .catch(err => console.error("Dashboard error:", err));
}

/* ------------------------------
   INITIAL LOAD OF DASHBOARD
   Calls the AJAX function when page loads
------------------------------- */
loadDashboardData();
