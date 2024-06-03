<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mood Component</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f7fa;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .mood-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background: white;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            margin-top: 20px;
            margin-bottom: 60px;
            text-align: center;
        }
        .mood-meter {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
        }
        .mood-meter i {
            font-size: 2em;
            cursor: pointer;
            transition: transform 0.3s, color 0.3s;
        }
        .mood-meter i:hover {
            transform: scale(1.2);
        }
        .mood-meter i.selected {
            color: #27ae60;
        }
        .chart-container {
            margin-top: 40px;
        }
        .chart {
            width: 100%;
            height: 300px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="mood-container">
        <h1>Selecione Seu Humor</h1>
        <div class="mood-meter">
            <i class="material-icons" data-mood="Feliz" onclick="selectMood(this)">sentiment_very_satisfied</i>
            <i class="material-icons" data-mood="Triste" onclick="selectMood(this)">sentiment_dissatisfied</i>
            <i class="material-icons" data-mood="Neutro" onclick="selectMood(this)">sentiment_neutral</i>
            <i class="material-icons" data-mood="Irritado" onclick="selectMood(this)">sentiment_very_dissatisfied</i>
            <i class="material-icons" data-mood="Cansado" onclick="selectMood(this)">sentiment_very_tired</i>
        </div>
        <button onclick="saveMood()">Salvar Humor</button>
        <div class="chart-container">
            <h2>Gráfico de Humor</h2>
            <canvas id="moodChart" class="chart"></canvas>
        </div>
    </div>

    <script>
        let selectedMood = '';

        function selectMood(element) {
            document.querySelectorAll('.mood-meter i').forEach(icon => icon.classList.remove('selected'));
            element.classList.add('selected');
            selectedMood = element.getAttribute('data-mood');
        }

        function saveMood() {
            if (selectedMood === '') {
                alert('Por favor, selecione um humor.');
                return;
            }

            fetch('<?= base_url('user/save_mood') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    paciente_id: <?= $paciente->id ?>,
                    mood: selectedMood,
                    data: new Date().toISOString().split('T')[0]
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Humor salvo com sucesso!');
                    loadMoodChart();
                } else {
                    alert('Erro ao salvar humor.');
                }
            })
            .catch(error => console.error('Erro:', error));
        }

        function loadMoodChart() {
            fetch('<?= base_url('user/get_moods') ?>?paciente_id=<?= $paciente->id ?>')
            .then(response => response.json())
            .then(data => {
                const ctx = document.getElementById('moodChart').getContext('2d');
                const moodData = {
                    labels: data.map(mood => mood.data),
                    datasets: [{
                        label: 'Humor',
                        data: data.map(mood => {
                            switch (mood.mood) {
                                case 'Feliz': return 5;
                                case 'Triste': return 1;
                                case 'Neutro': return 3;
                                case 'Irritado': return 2;
                                case 'Cansado': return 1;
                                default: return 0;
                            }
                        }),
                        backgroundColor: 'rgba(39, 174, 96, 0.2)',
                        borderColor: 'rgba(39, 174, 96, 1)',
                        borderWidth: 1
                    }]
                };

                new Chart(ctx, {
                    type: 'line',
                    data: moodData,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 5
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Erro:', error));
        }

        document.addEventListener('DOMContentLoaded', () => {
            loadMoodChart();
        });
    </script>
</body>
</html>
