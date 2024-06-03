<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Paciente</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f7fa;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .profile-header img {
            border-radius: 50%;
            margin-right: 20px;
            width: 80px;
            height: 80px;
            object-fit: cover;
        }
        .profile-header div {
            font-size: 1.2em;
        }
        .btn-schedule {
            display: block;
            margin: 20px 0;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
        }
        .tabs {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .tabs button {
            flex: 1;
            padding: 10px 0;
            background: #e9ecef;
            border: none;
            cursor: pointer;
            text-align: center;
            font-size: 1em;
            color: #007bff;
        }
        .tabs button.active {
            background: #007bff;
            color: white;
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }
        .profile-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .profile-details th, .profile-details td {
            padding: 10px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Perfil do Paciente</h1>
        <div class="profile-header">
            <img src="<?= $paciente->foto ?: base_url('assets/images/default.png') ?>" alt="Foto do Paciente">
            <div>
                <strong><?= $paciente->nome ?></strong><br>
                <?= $paciente->email ?><br>
                <?= $paciente->telefone ?>
            </div>
        </div>
        <a href="#" class="btn-schedule">Agendar Avaliação</a>
        <div class="tabs">
            <button onclick="showTab('meus-dados')" class="active">Meus Dados</button>
            <button onclick="showTab('avaliacoes')">Avaliações</button>
            <button onclick="showTab('graficos')">Gráficos</button>
        </div>
        <div id="meus-dados" class="tab-content active">
            <div class="profile-details">
                <table>
                    <tr>
                        <th>CPF</th>
                        <td><?= $paciente->cpf ?></td>
                    </tr>
                    <tr>
                        <th>Data de Nascimento</th>
                        <td><?= $paciente->data_nascimento ?></td>
                    </tr>
                    <tr>
                        <th>Gênero</th>
                        <td><?= $paciente->genero == 'M' ? 'Masculino' : 'Feminino' ?></td>
                    </tr>
                    <tr>
                        <th>Naturalidade</th>
                        <td><?= $paciente->naturalidade ?></td>
                    </tr>
                    <tr>
                        <th>Peso</th>
                        <td><?= $paciente->peso ?> kg</td>
                    </tr>
                    <tr>
                        <th>Altura</th>
                        <td><?= $paciente->altura ?> m</td>
                    </tr>
                    <tr>
                        <th>Plano de Saúde</th>
                        <td><?= $paciente->plano_saude ?></td>
                    </tr>
                    <tr>
                        <th>CEP</th>
                        <td><?= $paciente->cep ?></td>
                    </tr>
                    <tr>
                        <th>Endereço</th>
                        <td><?= $paciente->endereco ?>, <?= $paciente->numero ?>, <?= $paciente->cidade ?> - <?= $paciente->estado ?></td>
                    </tr>
                    <tr>
                        <th>Observações</th>
                        <td><?= $paciente->observacoes ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div id="avaliacoes" class="tab-content">
            <p>Aqui estarão as avaliações do paciente.</p>
        </div>
        <div id="graficos" class="tab-content">
            <p>Aqui estarão os gráficos do paciente.</p>
        </div>
    </div>

    <script>
        function showTab(tabId) {
            const contents = document.querySelectorAll('.tab-content');
            contents.forEach(content => content.classList.remove('active'));

            const buttons = document.querySelectorAll('.tabs button');
            buttons.forEach(button => button.classList.remove('active'));

            document.getElementById(tabId).classList.add('active');
            document.querySelector(`.tabs button[onclick="showTab('${tabId}')"]`).classList.add('active');
        }
    </script>
</body>
</html>
