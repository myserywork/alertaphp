<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Componente de Humor</title>
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
        .humor-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background: white;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            text-align: center;
        }
        .mensagem {
            margin-bottom: 20px;
            font-size: 1em;
            color: #555;
        }
        .humor-medidor {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
        }
        .humor-medidor i {
            font-size: 3em;
            cursor: pointer;
            transition: transform 0.3s, color 0.3s;
        }
        .humor-medidor i:hover {
            transform: scale(1.2);
        }
        .humor-medidor i.selecionado {
            transform: scale(1.4);
            color: #27ae60;
        }
        .grafico-container {
            margin-top: 40px;
        }
        .grafico {
            width: 100%;
            height: 300px;
        }
        .valor-humor-selecionado {
            margin-top: 20px;
            font-size: 1.2em;
            color: #27ae60;
        }
        .aviso {
            display: none;
            color: red;
            font-size: 1.2em;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="humor-container">
        <h1>Selecione Seu Humor</h1>
        <p class="mensagem">Registrar seu humor diariamente pode ajudar a acompanhar seu bem-estar emocional ao longo do tempo. Selecione o emoji que melhor representa como você se sente hoje:</p>
        <div class="humor-medidor">
            <i class="fas fa-grin-beam" data-humor="Feliz" data-valor-humor="5" style="color: #FFD700;"></i>
            <i class="fas fa-frown" data-humor="Triste" data-valor-humor="1" style="color: #1E90FF;"></i>
            <i class="fas fa-meh" data-humor="Neutro" data-valor-humor="3" style="color: #808080;"></i>
            <i class="fas fa-angry" data-humor="Irritado" data-valor-humor="2" style="color: #FF4500;"></i>
            <i class="fas fa-tired" data-humor="Cansado" data-valor-humor="1" style="color: #8B4513;"></i>
        </div>
        <div class="valor-humor-selecionado" id="valorHumorSelecionado">Nenhum humor selecionado</div>
        <div class="aviso" id="avisoHumorJaRegistrado">Você já registrou seu humor hoje. Por favor, volte amanhã.</div>
        <div class="grafico-container">
            <h2>Gráfico de Humor</h2>
            <canvas id="graficoHumor" class="grafico"></canvas>
        </div>
    </div>

    <script>
        let humorSelecionado = '';
        let valorHumorSelecionado = 0;
        let jaRegistrouHoje = false;

        document.addEventListener('DOMContentLoaded', function() {
            verificarRegistroHoje();

            document.querySelectorAll('.humor-medidor i').forEach(icone => {
                icone.addEventListener('click', function() {
                    if (jaRegistrouHoje) {
                        document.getElementById('avisoHumorJaRegistrado').style.display = 'block';
                        document.querySelector('.humor-medidor').style.display = 'none';
                        return;
                    }

                    const humor = icone.getAttribute('data-humor');
                    const valor = icone.getAttribute('data-valor-humor');
                    if (humor && valor) {
                        selecionarHumor(humor, valor, icone);
                        salvarHumor(humor, valor);
                    }
                });
            });

            carregarGraficoHumor();
        });

        function verificarRegistroHoje() {
            $.get('<?= base_url('user/get_moods') ?>', { paciente_id: <?= $paciente->id ?> }, function(data) {
                const hoje = new Date().toISOString().split('T')[0];
                data.forEach(humor => {
                    if (humor.data === hoje) {
                        jaRegistrouHoje = true;
                        document.getElementById('avisoHumorJaRegistrado').style.display = 'block';
                        document.querySelector('.humor-medidor').style.display = 'none';
                    }
                });
            }, 'json');
        }

        function selecionarHumor(humor, valor, elemento) {
            const icones = document.querySelectorAll('.humor-medidor i');
            icones.forEach(icone => icone.classList.remove('selecionado'));
            elemento.classList.add('selecionado');
            humorSelecionado = humor;
            valorHumorSelecionado = valor;
            document.getElementById('valorHumorSelecionado').innerText = `Humor selecionado: ${humor} (Valor: ${valor})`;
        }

        function salvarHumor(humor, valor) {
            $.post('<?= base_url('user/save_mood') ?>', {
                paciente_id: <?= $paciente->id ?>,
                humor: humor,
                valor_humor: valor,
                data: new Date().toISOString().split('T')[0]
            }, function(response) {
                if (response.success) {
                    document.getElementById('avisoHumorJaRegistrado').style.display = 'block';
                    document.querySelector('.humor-medidor').style.display = 'none';
                    carregarGraficoHumor();
                    jaRegistrouHoje = true;
                } else {
                    alert('Erro ao salvar humor.');
                }
            }, 'json');
        }

        function carregarGraficoHumor() {
            $.get('<?= base_url('user/get_moods') ?>', { paciente_id: <?= $paciente->id ?> }, function(data) {
                const ctx = document.getElementById('graficoHumor').getContext('2d');
                const dadosHumor = {
                    labels: data.map(humor => humor.data),
                    datasets: [{
                        label: 'Humor',
                        data: data.map(humor => humor.valor_humor),
                        backgroundColor: 'rgba(39, 174, 96, 0.2)',
                        borderColor: 'rgba(39, 174, 96, 1)',
                        borderWidth: 1
                    }]
                };

                new Chart(ctx, {
                    type: 'line',
                    data: dadosHumor,
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
