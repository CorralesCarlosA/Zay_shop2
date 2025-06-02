// resources/js/admin/dashboard-charts.js
export function initializeDashboardCharts() {
    // Gráfico de Ventas Mensuales
    const salesCtx = document.getElementById('salesChart');
    if (salesCtx) {
        const salesChartData = JSON.parse(salesCtx.dataset.chartData || '[]');
        
        new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                datasets: [{
                    label: 'Ventas',
                    data: salesChartData,
                    backgroundColor: 'rgba(61, 122, 82, 0.1)',
                    borderColor: 'rgba(61, 122, 82, 1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#d4af37',
                    pointBorderColor: '#fff',
                    pointHoverRadius: 6,
                    pointHoverBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(26, 71, 42, 0.9)',
                        titleFont: { size: 14, weight: 'bold' },
                        bodyFont: { size: 12 },
                        callbacks: {
                            label: function(context) {
                                return '$ ' + context.parsed.y.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            callback: function(value) {
                                return '$' + value.toLocaleString();
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
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
    
    // Efecto hover para las tarjetas
    const cards = document.querySelectorAll('.admin-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-5px)';
            card.style.boxShadow = '0 10px 25px rgba(0,0,0,0.1)';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = '';
            card.style.boxShadow = '';
        });
    });
});