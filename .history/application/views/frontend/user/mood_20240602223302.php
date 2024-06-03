<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mood Component</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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
            font-size: 3em;
            cursor: pointer;
            transition: transform 0.3s, color 0.3s;
        }
        .mood-meter i:hover {
            transform: scale(1.2);
        }
        .mood-meter i.selected {
            transform: scale(1.4);
            color: #27ae60;
        }
        .chart-container {
            margin-top: 40px;
        }
        .chart {
            width: 100%;
            height: 300px;
        }
        .selected-mood-value {
            margin-top: 20px;
            font-size: 1.2em;
            color: #27ae60;
        }
    </style>
</head>
<body>
    <div class="mood-container">
        <h1>Selecione Seu Humor</h1>
        <p class="message">Registrar seu humor diariamente pode ajudar a acompanhar seu bem-estar emocional ao longo do tempo. Selecione o emoji que melhor representa como você se sente hoje:</p>
        <div class="mood-meter">
            <i class="fas fa-grin-beam" data-mood="Feliz" data-mood-value="5" style="color: #FFD700;"></i>
            <i class="fas fa-frown" data-mood="Triste" data-mood-value="1" style="color: #1E90FF;"></i>
            <i class="fas fa-meh" data-mood="Neutro" data-mood-value="3" style="color: #808080;"></i>
            <i class="fas fa-angry" data-mood="Irritado" data-mood-value="2" style="color: #FF4500;"></i>
            <i class="fas fa-tired" data-mood="Cansado" data-mood-value="1" style="color: #8B4513;"></i>
        </div>
        <div class="selected-mood-value" id="selectedMoodValue">Nenhum humor selecionado</div>
        <div class="chart-container">
            <h2>Gráfico de Humor</h2>
            <canvas id="moodChart" class="chart"></canvas>
        </div>
    </div>

    <script>
        let selectedMood = '';
        let selectedMoodValue = 0;

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.mood-meter i').forEach(icon => {
                icon.addEventListener('click', function() {
                    const mood = icon.getAttribute('data-mood');
                    const value = icon.getAttribute('data-mood-value');
                    if (mood && value) {
                        selectMood(mood, value, icon);
                        saveMood(mood, value);
                    }
                });
            });

            loadMoodChart();
        });

        function selectMood(mood, value, element) {
            const icons = document.querySelectorAll('.mood-meter i');
            icons.forEach(icon => icon.classList.remove('selected'));
            element.classList.add('selected');
            selectedMood = mood;
            selectedMoodValue = value;
            document.getElementById('selectedMoodValue').innerText = `Humor selecionado: ${mood} (Valor: ${value})`;
        }

        function saveMood(mood, value) {
            $.post('<?= base_url('user/save_mood') ?>', {
                paciente_id: <?= $paciente->id ?>,
                mood: mood,
                mood_value: value,
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
                        data: data.map(mood => mood.mood_value),
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
    </script>
</body>
</html>
