/**
 * Inicializa el gráfico de ventas con datos desde PHP
 * Combina las mejores características de ambas implementaciones
 */
document.addEventListener('DOMContentLoaded', function() {
    // Obtener elemento con datos
    const dataElement = document.getElementById('chart-data');
    if (!dataElement) return;
    
    // Parsear datos
    const meses = JSON.parse(dataElement.dataset.meses);
    const ventas = JSON.parse(dataElement.dataset.ventas);
    
    // Configuración del gráfico
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar', // Tipo principal (de la primera implementación)
        data: {
            labels: meses,
            datasets: [{
                label: 'Ventas Totales',
                data: ventas,
                backgroundColor: 'rgba(75, 192, 192, 0.6)', // Color original
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                // Opciones adicionales de la segunda implementación
                tension: 0.4,
                fill: false
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
                            return 'Ventas: $' + context.raw.toLocaleString(); // Formato bonito
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '$' + value.toLocaleString(); // Formato monetario
                        }
                    }
                }
            }
        }
    });
});