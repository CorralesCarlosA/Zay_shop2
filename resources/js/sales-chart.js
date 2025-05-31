document.addEventListener('DOMContentLoaded', function() {
    if (typeof window.ChartConfig !== 'undefined' && window.ChartConfig.sales) {
        const ctx = document.getElementById('salesChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: window.ChartConfig.sales.labels,
                    datasets: [{
                        label: 'Ventas Mensuales',
                        data: window.ChartConfig.sales.data,
                        backgroundColor: window.ChartConfig.sales.colors[0],
                        borderColor: window.ChartConfig.sales.colors[1],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    }
});