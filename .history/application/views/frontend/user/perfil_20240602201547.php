
<?php 

$this->load->view('frontend/layout/header.php');?>
   
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
        }
        .profile-header {
            display: flex;
            align-items: center;
        }
        .profile-header img {
            border-radius: 50%;
            margin-right: 20px;
        }
        .profile-header div {
            font-size: 1.2em;
        }
        .profile-details {
            margin-top: 20px;
        }
        .profile-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .profile-details table, .profile-details th, .profile-details td {
            border: 1px solid #ddd;
        }
        .profile-details th, .profile-details td {
            padding: 8px;
            text-align: left;
        }
        .tabs {
            margin-top: 20px;
        }
        .tab {
            display: none;
        }
        .tab.active {
            display: block;
        }
        .tab-buttons {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }
        .tab-buttons button {
            padding: 10px 20px;
            border: none;
            background-color: #ddd;
            cursor: pointer;
        }
        .tab-buttons button.active {
            background-color: #aaa;
        }
        .btn-schedule {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>

    <div class="container">
        <h1>Perfil do Paciente</h1>
        <div class="profile-header">
            <img src="<?= $paciente->foto ?: base_url('assets/images/default.png') ?>" alt="Foto do Paciente" width="100" height="100">
            <div>
                <strong><?= $paciente->nome ?></strong><br>
                <?= $paciente->email ?><br>
                <?= $paciente->telefone ?>
            </div>
        </div>
        <button class="btn-schedule">Agendar Avaliação</button>
        <div class="tabs">
            <div class="tab-buttons">
                <button onclick="showTab('meus-dados')" class="active">Meus Dados</button>
                <button onclick="showTab('avaliacoes')">Avaliações</button>
                <button onclick="showTab('graficos')">Gráficos</button>
            </div>
            <div id="meus-dados" class="tab active">
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
            <div id="avaliacoes" class="tab">
                <p>Aqui estarão as avaliações do paciente.</p>
                <!-- Conteúdo das avaliações -->
            </div>
            <div id="graficos" class="tab">
                <p>Aqui estarão os gráficos do paciente.</p>
                <!-- Conteúdo dos gráficos -->
            </div>
        </div>
    </div>

    <script>
        function showTab(tabId) {
            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(tab => tab.classList.remove('active'));

            const buttons = document.querySelectorAll('.tab-buttons button');
            buttons.forEach(button => button.classList.remove('active'));

            document.getElementById(tabId).classList.add('active');
            document.querySelector(`button[onclick="showTab('${tabId}')"]`).classList.add('active');
        }
    </script>
</body>
</html>
