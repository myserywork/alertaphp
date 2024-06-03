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
        .input-container {
            margin-top: 20px;
        }
        .input-container input {
            width: 80%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
        }
    </style>
</head>
<body>
    <div class="mood-container">
        <h1>Selecione Seu Humor</h1>
        <p class="message">Registrar seu humor diariamente pode ajudar a acompanhar seu bem-estar emocional ao longo do tempo. Selecione o emoji que melhor representa como você se sente hoje ou digite abaixo:</p>
        <div class="mood-meter">
            <i class="fas fa-grin-beam" data-mood="Feliz" data-mood-value="5" style="color: #FFD700;" onclick="selectMood(this)"></i>
            <i class="fas fa-frown" data-mood="Triste" data-mood-value="1" style="color: #1E90FF;" onclick="selectMood(this)"></i>
            <i class="fas fa-meh" data-mood="Neutro" data-mood-value="3" style="color: #808080;" onclick="selectMood(this)"></i>
            <i class="fas fa-angry" data-mood="Irritado" data-mood-value="2" style="color: #FF4500;" onclick="selectMood(this)"></i>
            <i class="fas fa-tired" data-mood="Cansado" data-mood-value="1" style="color: #8B4513;" onclick="selectMood(this)"></i>
        </div>
        <div class="input-container">
            <input type="text" id="textMood" placeholder="Digite seu humor...">
            <input type="text" id="selectedMoodValue" placeholder="Valor do Humor" readonly>
        </div>
        <button class="save-button" onclick="saveMood()">Salvar Humor</button>
        <div class="chart-container">
            <h2>Gráfico de Humor</h2>
            <canvas id="moodChart" class="chart"></canvas>
        </div>
    </div>

    <script>
        let selectedMood = '';
        let selectedMoodValue = 0;

        function selectMood(element) {
            $('.mood-meter i').removeClass('selected');
            $(element).addClass('selected');
            selectedMood = $(element).data('mood');
            selectedMoodValue = $(element).data('mood-value');
            $('#selectedMoodValue').val(selectedMoodValue);
        }

        function saveMood() {
            const textMood = $('#textMood').val().trim();
            if (textMood === '' && selectedMoodValue === 0) {
                alert('Por favor, selecione um humor ou digite seu humor.');
                return;
            }

            let mood = '';
            if (selectedMoodValue !== 0) {
                mood = selectedMood;
            } else {
                mood = textMood;
            }

            $.post('<?= base_url('user/save_mood') ?>', {
                paciente_id: <?= $paciente->id ?>,
                mood: mood,
                mood_value: selectedMoodValue,
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

        $(document).ready(function() {
            loadMoodChart();
        });
    </script>
</body>
</html>
