// resources/js/admin/dashboard-charts.js

export function initializeDashboardCharts() {
    // Gráfico de Ventas Mensuales
    const salesChartElement = document.getElementById('salesChart');
    
    if (salesChartElement) {
        const salesChartData = JSON.parse(salesChartElement.dataset.chartData || '[]');
        
        new Chart(salesChartElement.getContext('2d'), {
            type: 'line',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                datasets: [{
                    label: 'Ventas',
                    data: salesChartData,
                    backgroundColor: 'rgba(40, 167, 69, 0.1)',
                    borderColor: 'rgba(40, 167, 69, 1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
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
                            callback: function(value) {
                                return '$' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    }
}

// Inicialización cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    initializeDashboardCharts();
});