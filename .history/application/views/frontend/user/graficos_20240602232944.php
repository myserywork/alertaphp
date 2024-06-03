<div>
    <h2>Gráficos de Alertas</h2>
    <canvas id="alertasChart" width="400" height="200"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const alertasData = {
            labels: ['Baixo', 'Médio', 'Alto', 'Urgente'],
            datasets: [{
                label: 'Quantidade de Alertas',
                data: [<?= $alertasCount['baixo'] ?? 0; ?>, <?= $alertasCount['medio'] ?? 0; ?>, <?= $alertasCount['alto'] ?? 0; ?>, <?= $alertasCount['urgente'] ?? 0; ?>],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 0, 0, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 0, 0, 1)'
                ],
                borderWidth: 1
            }]
        };

        const ctx = document.getElementById('alertasChart').getContext('2d');
        const alertasChart = new Chart(ctx, {
            type: 'bar',
            data: alertasData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
