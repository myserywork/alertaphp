<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mood Component</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f7fa;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .mood-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background: white;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            text-align: center;
        }
        .message {
            margin-bottom: 20px;
            font-size: 1em;
            color: #555;
        }
        .mood-meter {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
        }
        .mood-meter i {
            font-size: 4em;
            cursor: pointer;
            transition: transform 0.3s, color 0.3s;
        }
        .mood-meter i:hover {
            transform: scale(1.2);
        }
        .mood-meter i.selected {
            color: #27ae60;
        }
        .save-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #27ae60;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 1em;
            transition: background 0.3s, transform 0.3s;
        }
        .save-button:hover {
            background-color: #219150;
            transform: scale(1.05);
        }
        .chart-container {
            margin-top: 40px;
        }
        .chart {
            width: 100%;
            height: 300px;
        }
    </style>
</head>
<body>
    <div class="mood-container">
        <h1>Selecione Seu Humor</h1>
        <p class="message">Registrar seu humor diariamente pode ajudar a acompanhar seu bem-estar emocional ao longo do tempo. Selecione o emoji que melhor representa como você se sente hoje.</p>
        <div class="mood-meter">
            <i class="material-icons" data-mood="Feliz" style="color: #FFD700;" onclick="selectMood(this)">sentiment_very_satisfied</i>
            <i class="material-icons" data-mood="Triste" style="color: #1E90FF;" onclick="selectMood(this)">sentiment_dissatisfied</i>
            <i class="material-icons" data-mood="Neutro" style="color: #808080;" onclick="selectMood(this)">sentiment_neutral</i>
            <i class="material-icons" data-mood="Irritado" style="color: #FF4500;" onclick="selectMood(this)">sentiment_very_dissatisfied</i>
            <i class="material-icons" data-mood="Cansado" style="color: #8B4513;" onclick="selectMood(this)">sentiment_very_tired</i>
        </div>
        <button class="save-button" onclick="saveMood()">Salvar Humor</button>
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

            $.post('<?= base_url('user/save_mood') ?>', {
                paciente_id: <?= $paciente->id ?>,
                mood: selectedMood,
                data: new Date().toISOString().split('T')[0]
            }, function(response) {
                if (response.success) {
                    alert('Humor salvo com sucesso!');
                    loadMoodChart();
                } else {
                    alert('Erro ao salvar humor.');
                }
            }, 'json');
        }

        function loadMoodChart() {
            $.get('<?= base_url('user/get_moods') ?>', { paciente_id: <?= $paciente->id ?> }, function(data) {
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
            }, 'json');
        }

        $(document).ready(function() {
            loadMoodChart();
        });
    </script>
</body>
</html>
