// public/js/admin-chart.js
function initVentasChart(ventasData) {
    const ctx = document.getElementById('ventasChart').getContext('2d');
    const labels = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'];

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Ventas del Mes',
                data: ventasData,
                borderColor: '#28a745',
                backgroundColor: 'rgba(40, 167, 69, 0.1)',
                fill: true,
                tension: 0.4,
                pointRadius: 0
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: value => '$' + value.toLocaleString()
                    }
                }
            }
        }
    });
}