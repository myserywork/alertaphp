<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Paciente</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f7fa;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background: white;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            margin-top: 20px;
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
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 25px;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
            font-size: 1em;
        }
        .tabs {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }
        .tabs button {
            flex: 1;
            padding: 10px;
            background: #e9ecef;
            border: none;
            cursor: pointer;
            text-align: center;
            font-size: 1em;
            color: #007bff;
            border-radius: 25px;
            margin: 0 5px;
            transition: background 0.3s, color 0.3s;
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
        .profile-details th {
            text-align: left;
            background-color: #f1f1f1;
        }
        .medication-form {
            margin-top: 20px;
        }
        .medication-form input, .medication-form button, .medication-form select {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .medication-form button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        .medications-list ul {
            list-style-type: none;
            padding: 0;
        }
        .medications-list li {
            padding: 10px;
            margin: 5px 0;
            background: #e9ecef;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .medications-list li .details {
            flex: 1;
        }
        .medications-list li .actions {
            display: flex;
            gap: 10px;
        }
        .medications-list li .actions button {
            background: transparent;
            border: none;
            cursor: pointer;
            color: #007bff;
            font-size: 1em;
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
            <button onclick="showTab('medicacoes')">Medicações</button>
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
        <div id="medicacoes" class="tab-content">
            <h2>Medicações</h2>
            <form class="medication-form" action="<?= base_url('paciente/add_medicacao') ?>" method="POST">
                <input type="hidden" name="paciente_id" value="<?= $paciente->id ?>">
                <input type="text" name="medicacao" placeholder="Nome da Medicação" required>
                <input type="text" name="quantidade" placeholder="Quantidade (mg, ml, etc)" required>
                <input type="time" name="horario" placeholder="Horário" required>
                <select name="dias_semana[]" multiple required>
                    <option value="Domingo">Domingo</option>
                    <option value="Segunda-feira">Segunda-feira</option>
                    <option value="Terça-feira">Terça-feira</option>
                    <option value="Quarta-feira">Quarta-feira</option>
                    <option value="Quinta-feira">Quinta-feira</option>
                    <option value="Sexta-feira">Sexta-feira</option>
                    <option value="Sábado">Sábado</option>
                </select>
                <input type="text" name="duracao" placeholder="Duração (dias, semanas, meses)" required>
                <button type="submit">Adicionar Medicação</button>
            </form>
            <div class="medications-list">
                <h3>Medicações Cadastradas</h3>
                <ul>
                    <?php foreach ($medicacoes as $medicacao): ?>
                        <li>
                            <div class="details">
                                <strong><?= $medicacao->nome ?></strong> - <?= $medicacao->quantidade ?><br>
                                <?= $medicacao->dias_semana ?> às <?= $medicacao->horario ?> por <?= $medicacao->duracao ?>
                            </div>
                            <div class="actions">
                                <button onclick="editMedication(<?= $medicacao->id ?>)">Editar</button>
                                <button onclick="deleteMedication(<?= $medicacao->id ?>)">Excluir</button>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
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

        function editMedication(id) {
            // Implementar função para editar medicação
        }

        function deleteMedication(id) {
            // Implementar função para excluir medicação
        }
    </script>
</body>
</html>
