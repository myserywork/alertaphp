<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Paciente</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/5.5.2/collection/components/icon/icon.min.css">
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
            background-color: #2ecc71;
            color: white;
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
        }
        .tabs {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }
        .tabs button {
            flex: 1;
            padding: 15px;
            background: #e9ecef;
            border: none;
            cursor: pointer;
            text-align: center;
            font-size: 1em;
            color: #27ae60;
            border-radius: 15px;
            margin: 0 5px;
            transition: background 0.3s, color 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .tabs button i {
            margin-right: 8px;
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
        }
        .form-container button {
            background-color: #27ae60;
            color: white;
            border: none;
            cursor: pointer;
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
        }
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #27ae60;
            display: flex;
            justify-content: space-around;
            padding: 10px 0;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        }
        .bottom-nav a {
            color: white;
            text-align: center;
            font-size: 1.2em;
        }
        .bottom-nav a.active {
            color: #2ecc71;
        }
        .mood-meter {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
        }
        .mood-meter i {
            font-size: 2em;
            cursor: pointer;
            transition: transform 0.3s;
        }
        .mood-meter i:hover {
            transform: scale(1.2);
        }
        .mood-meter i.selected {
            color: #27ae60;
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
            <button onclick="showTab('overview')" class="active"><i class="ion-ios-information-circle"></i> Overview</button>
            <button onclick="showTab('meus-dados')"><i class="ion-ios-person"></i> Meus Dados</button>
            <button onclick="showTab('avaliacoes')"><i class="ion-ios-list-box"></i> Avaliações</button>
            <button onclick="showTab('graficos')"><i class="ion-ios-stats"></i> Gráficos</button>
            <button onclick="showTab('medicacoes')"><i class="ion-ios-medkit"></i> Medicações</button>
            <button onclick="showTab('prontuarios')"><i class="ion-ios-paper"></i> Prontuários</button>
        </div>
        <div id="overview" class="tab-content active">
            <h2>Overview da Vida do Paciente</h2>
            <div class="mood-meter">
                <i class="ion-ios-happy-outline" onclick="selectMood(this, 'Feliz')"></i>
                <i class="ion-ios-sad-outline" onclick="selectMood(this, 'Triste')"></i>
                <i class="ion-ios-meh-outline" onclick="selectMood(this, 'Neutro')"></i>
                <i class="ion-ios-angry-outline" onclick="selectMood(this, 'Irritado')"></i>
                <i class="ion-ios-tired-outline" onclick="selectMood(this, 'Cansado')"></i>
            </div>
            <input type="hidden" id="mood-input" name="mood">
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
                <form id="medication-form">
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
                                <button onclick="editMedication(<?= $medicacao->id ?>)"><i class="fas fa-edit"></i></button>
                                <button onclick="deleteMedication(<?= $medicacao->id ?>)"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div id="prontuarios" class="tab-content">
            <h2>Prontuários</h2>
            <div class="form-container">
                <form id="record-form">
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
                                <button onclick="editRecord(<?= $prontuario->id ?>)"><i class="fas fa-edit"></i></button>
                                <button onclick="deleteRecord(<?= $prontuario->id ?>)"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="bottom-nav">
        <a href="#overview" onclick="showTab('overview')" class="active"><i class="ion-ios-information-circle"></i><br>Overview</a>
        <a href="#meus-dados" onclick="showTab('meus-dados')"><i class="ion-ios-person"></i><br>Meus Dados</a>
        <a href="#avaliacoes" onclick="showTab('avaliacoes')"><i class="ion-ios-list-box"></i><br>Avaliações</a>
        <a href="#graficos" onclick="showTab('graficos')"><i class="ion-ios-stats"></i><br>Gráficos</a>
        <a href="#medicacoes" onclick="showTab('medicacoes')"><i class="ion-ios-medkit"></i><br>Medicações</a>
        <a href="#prontuarios" onclick="showTab('prontuarios')"><i class="ion-ios-paper"></i><br>Prontuários</a>
    </div>

    <script>
        function showTab(tabId) {
            const contents = document.querySelectorAll('.tab-content');
            contents.forEach(content => content.classList.remove('active'));

            const buttons = document.querySelectorAll('.bottom-nav a');
            buttons.forEach(button => button.classList.remove('active'));

            document.getElementById(tabId).classList.add('active');
            document.querySelector(`.bottom-nav a[href="#${tabId}"]`).classList.add('active');
        }

        document.getElementById('medication-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            const id = Date.now();
            const li = document.createElement('li');
            li.setAttribute('data-id', id);

            const details = document.createElement('div');
            details.classList.add('details');
            details.innerHTML = `
                <strong>${formData.get('medicacao')}</strong> - ${formData.get('quantidade')}<br>
                ${Array.from(formData.getAll('dias_semana')).join(', ')} às ${formData.get('horario')} por ${formData.get('duracao')}
            `;

            const actions = document.createElement('div');
            actions.classList.add('actions');
            actions.innerHTML = `
                <button onclick="editMedication(${id})"><i class="fas fa-edit"></i></button>
                <button onclick="deleteMedication(${id})"><i class="fas fa-trash-alt"></i></button>
            `;

            li.appendChild(details);
            li.appendChild(actions);

            document.getElementById('medications-list').appendChild(li);
            e.target.reset();
        });

        function editMedication(id) {
            // Implementar função para editar medicação
        }

        function deleteMedication(id) {
            document.querySelector(`li[data-id="${id}"]`).remove();
        }

        document.getElementById('record-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            const id = Date.now();
            const li = document.createElement('li');
            li.setAttribute('data-id', id);

            const details = document.createElement('div');
            details.classList.add('details');
            details.innerHTML = `
                <strong>${new Date().toLocaleDateString()}</strong><br>
                ${formData.get('descricao')}
            `;

            const actions = document.createElement('div');
            actions.classList.add('actions');
            actions.innerHTML = `
                <button onclick="editRecord(${id})"><i class="fas fa-edit"></i></button>
                <button onclick="deleteRecord(${id})"><i class="fas fa-trash-alt"></i></button>
            `;

            li.appendChild(details);
            li.appendChild(actions);

            document.getElementById('records-list').appendChild(li);
            e.target.reset();
        });

        function editRecord(id) {
            // Implementar função para editar prontuário
        }

        function deleteRecord(id) {
            document.querySelector(`li[data-id="${id}"]`).remove();
        }

        function selectMood(element, mood) {
            document.querySelectorAll('.mood-meter i').forEach(icon => icon.classList.remove('selected'));
            element.classList.add('selected');
            document.getElementById('mood-input').value = mood;
        }
    </script>
</body>
</html>
