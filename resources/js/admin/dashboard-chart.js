// Función para inicializar el gráfico de ventas
function initSalesChart() {
    // Obtener datos pasados desde PHP
    const chartData = window.dashboardData?.ventasChartData || [0, 0, 0, 0, 0, 0];
    const labels = window.dashboardData?.mesesLabels || ['Mes 1', 'Mes 2', 'Mes 3', 'Mes 4', 'Mes 5', 'Mes 6'];
    
    // Configuración del gráfico
    const ctx = document.getElementById('salesChart');
    if (!ctx) return;
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Ventas Mensuales',
                data: chartData,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2,
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Ventas: $' + context.raw.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '$' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });
}

// Inicializar gráfico cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    initSalesChart();
});
