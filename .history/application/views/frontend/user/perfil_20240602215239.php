<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Paciente</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f7fa;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background: white;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            margin-top: 20px;
            margin-bottom: 60px;
        }
        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
       
            color:  #4c5258;;
            padding: 20px;
            border-radius: 15px;
        }
        .profile-header img {
            border-radius: 50%;
            margin-right: 20px;
            width: 80px;
            height: 80px;
            object-fit: cover;
            border: 3px solid #fff;
        }
        .profile-header div {
            font-size: 1.5em;
        }
        .btn-schedule {
            display: block;
            margin: 20px 0;
            padding: 10px 20px;
            background-color: #27ae60;
            color: white;
            border: none;
            border-radius: 25px;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
            font-size: 1em;
            transition: background 0.3s, transform 0.3s;
        }
        .btn-schedule:hover {
            background-color: #219150;
            transform: scale(1.05);
        }
        .tabs {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .tabs button {
            flex: 1 0 30%;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 15px;
            background: #e9ecef;
            border: none;
            cursor: pointer;
            text-align: center;
            font-size: 1em;
            color: #27ae60;
            border-radius: 15px;
            margin: 5px;
            transition: background 0.3s, color 0.3s, transform 0.3s;
        }
        .tabs button i {
            font-size: 2em;
            margin-bottom: 5px;
        }
        .tabs button:hover {
            background: #d4dfe2;
            transform: scale(1.05);
        }
        .tabs button.active {
            background: #27ae60;
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
        .form-container {
            margin-top: 20px;
        }
        .form-container input, .form-container button, .form-container select, 
        .form-container textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        .form-container input:focus, .form-container select:focus, 
        .form-container textarea:focus {
            border-color: #27ae60;
            box-shadow: 0 0 8px rgba(39, 174, 96, 0.2);
        }
        .form-container button {
            background-color: #27ae60;
            color: white;
            border: none;
            cursor: pointer;
            transition: background 0.3s, transform 0.3s;
        }
        .form-container button:hover {
            background-color: #219150;
            transform: scale(1.05);
        }
        .list-container ul {
            list-style-type: none;
            padding: 0;
        }
        .list-container li {
            padding: 10px;
            margin: 5px 0;
            background: #e9ecef;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .list-container li .details {
            flex: 1;
        }
        .list-container li .actions {
            display: flex;
            gap: 10px;
        }
        .list-container li .actions button {
            background: transparent;
            border: none;
            cursor: pointer;
            color: #27ae60;
            font-size: 1em;
            transition: color 0.3s, transform 0.3s;
        }
        .list-container li .actions button:hover {
            color: #219150;
            transform: scale(1.1);
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
    </style>
</head>
<body><!-- frontend/user/perfil.php -->
<div class="container">
    <!-- Adicione o seguinte dentro da aba Overview -->
<div id="overview" class="tab-content active">
    <h2>Overview da Vida do Paciente</h2>
    <?php $this->load->view('mood_component', array('paciente' => $paciente)); ?>
</div>

    <div class="profile-header">
        <img src="<?= $paciente->foto ?: base_url('/assets/images/logo.png') ?>" alt="Foto do Paciente">
        <div>
            <strong><?= $paciente->nome ?></strong><br>
            <?= $paciente->email ?><br>
            <?= $paciente->telefone ?>
        </div>
    </div>
    <a href="#" class="btn-schedule">Agendar Avaliação</a>
    <div class="tabs">
        <button onclick="showTab('overview')" class="active"><i class="material-icons">info</i> Overview</button>
        <button onclick="showTab('meus-dados')"><i class="material-icons">person</i> Meus Dados</button>
        <button onclick="showTab('avaliacoes')"><i class="material-icons">list_alt</i> Avaliações</button>
        <button onclick="showTab('graficos')"><i class="material-icons">bar_chart</i> Gráficos</button>
        <button onclick="showTab('medicacoes')"><i class="material-icons">medical_services</i> Medicações</button>
        <button onclick="showTab('prontuarios')"><i class="material-icons">description</i> Prontuários</button>
    </div>
    <div id="overview" class="tab-content active">
        <h2>Overview da Vida do Paciente</h2>
        <!-- Conteúdo da aba Overview -->
    </div>
    <div id="meus-dados" class="tab-content">
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
        <h2>Avaliações</h2>
        <!-- Conteúdo das avaliações aqui -->
    </div>
    <div id="graficos" class="tab-content">
        <h2>Gráficos</h2>
        <!-- Conteúdo dos gráficos aqui -->
    </div>
    <div id="medicacoes" class="tab-content">
        <h2>Medicações</h2>
        <div class="form-container">
            <form action="<?= base_url('user/add_medicacao') ?>" method="post">
                <input type="hidden" name="paciente_id" value="<?= $paciente->id ?>">
                <input type="text" name="nome" placeholder="Nome da Medicação" required>
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
        </div>
        <div class="list-container">
            <h3>Medicações Cadastradas</h3>
            <ul id="medications-list">
                <?php foreach ($medicacoes as $medicacao): ?>
                    <li data-id="<?= $medicacao->id ?>">
                        <div class="details">
                            <strong><?= $medicacao->nome ?></strong> - <?= $medicacao->quantidade ?><br>
                            <?= $medicacao->dias_semana ?> às <?= $medicacao->horario ?> por <?= $medicacao->duracao ?>
                        </div>
                        <div class="actions">
                            <a href="<?= base_url('user/delete_medicacao/'.$medicacao->id) ?>"><i class="material-icons">delete</i></a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div id="prontuarios" class="tab-content">
        <h2>Prontuários</h2>
        <div class="form-container">
            <form action="<?= base_url('user/add_prontuario') ?>" method="post">
                <input type="hidden" name="paciente_id" value="<?= $paciente->id ?>">
                <textarea name="descricao" placeholder="Descrição do Prontuário" required></textarea>
                <button type="submit">Adicionar Prontuário</button>
            </form>
        </div>
        <div class="list-container">
            <h3>Prontuários Cadastrados</h3>
            <ul id="records-list">
                <?php foreach ($prontuarios as $prontuario): ?>
                    <li data-id="<?= $prontuario->id ?>">
                        <div class="details">
                            <strong><?= $prontuario->data ?></strong><br>
                            <?= $prontuario->descricao ?>
                        </div>
                        <div class="actions">
                            <a href="<?= base_url('user/delete_prontuario/'.$prontuario->id) ?>"><i class="material-icons">delete</i></a>
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

    function selectMood(element, mood) {
        document.querySelectorAll('.mood-meter i').forEach(icon => icon.classList.remove('selected'));
        element.classList.add('selected');
        document.getElementById('mood-input').value = mood;
    }
</script>


</html>
