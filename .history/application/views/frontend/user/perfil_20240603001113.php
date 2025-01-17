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
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
            color: #4c5258;
            padding: 20px;
            border-radius: 15px;
            text-align: center;
        }
        .profile-header img {
            border-radius: 50%;
            margin-bottom: 10px;
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
            margin: 10px 0;
            padding: 8px 16px;
            background-color: #27ae60;
            color: white;
            border: none;
            border-radius: 25px;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
            font-size: 0.9em;
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
            flex: 1 0 48%;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px;
            background: #e9ecef;
            border: none;
            cursor: pointer;
            text-align: center;
            font-size: 0.9em;
            color: #27ae60;
            border-radius: 15px;
            margin: 5px 1%;
            transition: background 0.3s, color 0.3s, transform 0.3s;
        }
        .tabs button i {
            font-size: 1.5em;
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
            max-height: 300px; /* Set your desired max height */
            overflow-y: auto;
            padding: 10px;
        }
        .tab-content.active {
            display: block;
        }
        .tab-content::-webkit-scrollbar {
            width: 8px;
        }
        .tab-content::-webkit-scrollbar-thumb {
            background-color: #27ae60;
            border-radius: 10px;
        }
        .tab-content::-webkit-scrollbar-track {
            background: #f5f7fa;
        }
        .contact-buttons {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .contact-buttons .btn-schedule {
            flex: 1 0 48%;
        }
        @media (max-width: 600px) {
            .tabs button {
                flex: 1 0 48%;
                margin: 5px 1%;
            }
        }
        @media (max-width: 375px) {
            .tabs button {
                flex: 1 0 48%;
                margin: 5px 1%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-header">
            <img src="<?= $paciente->foto ?: base_url('/assets/images/logo-iso.png') ?>" alt="Foto do Paciente">
            <div>
                <strong><?= $paciente->nome ?></strong><br>
                <?= $paciente->email ?><br>
                <?= $paciente->telefone ?>
            </div>
        </div>
        <a href="<?= base_url("robo/" . $paciente->id); ?>" class="btn-schedule">Avaliação urgente</a>
        <div class="tabs">
            <button onclick="showTab('overview')" class="active"><i class="material-icons">info</i> Overview</button>
            <button onclick="showTab('meus-dados')"><i class="material-icons">person</i> Meus Dados</button>
            <button onclick="showTab('avaliacoes')"><i class="material-icons">list_alt</i> Avaliações</button>
            <button onclick="showTab('graficos')"><i class="material-icons">bar_chart</i> Gráficos</button>
            <button onclick="showTab('medicacoes')"><i class="material-icons">medical_services</i> Medicações</button>
            <button onclick="showTab('prontuarios')"><i class="material-icons">description</i> Prontuários</button>
            <button onclick="showTab('alertas')"><i class="material-icons">notifications</i> Alertas</button>
            <button onclick="showTab('teste-dengue')"><i class="material-icons">bug_report</i> Teste Dengue</button>
            <button onclick="showTab('contato-rapido')"><i class="material-icons">phone</i> Contato Rápido</button>
        </div>
        <div id="overview" class="tab-content active">
            <?php $this->load->view('frontend/user/mood', array('paciente' => $paciente)); ?>
        </div>
        <div id="meus-dados" class="tab-content">
            <?php $this->load->view('frontend/user/perfil_details', array('paciente' => $paciente)); ?>
        </div>
        <div id="avaliacoes" class="tab-content">
            <h2>Avaliações</h2>
            <!-- Conteúdo das avaliações aqui -->
        </div>
        <div id="graficos" class="tab-content">
            <?php $this->load->view('frontend/user/graficos'); ?>
        </div>
        <div id="medicacoes" class="tab-content">
            <?php $this->load->view('frontend/user/medications', array('medicacoes' => $paciente->medicacoes, 'paciente' => $paciente)); ?>
        </div>
        <div id="prontuarios" class="tab-content">
            <?php $this->load->view('frontend/user/prontuarios', array('prontuarios' => $paciente->prontuarios, 'paciente' => $paciente)); ?>
        </div>
        <div id="alertas" class="tab-content">
            <?php $this->load->view('frontend/user/alertas', array('alertas' => $paciente->alertas, 'paciente' => $paciente)); ?>
        </div>
        <div id="teste-dengue" class="tab-content">
            <h2>Teste Dengue</h2>
            <!-- Conteúdo do teste de dengue aqui -->
        </div>
        <div id="contato-rapido" class="tab-content">
            <h2>Contato Rápido</h2>
            <div class="contact-buttons">
                <a href="https://wa.me/55<?= $paciente->telefone ?>" class="btn-schedule">WhatsApp Paciente</a>
                <a href="tel:<?= $paciente->telefone ?>" class="btn-schedule">Ligar para Paciente</a>
                <a href="https://wa.me/55<?= $paciente->celular_cuidador ?>" class="btn-schedule">WhatsApp Cuidador</a>
                <a href="tel:<?= $paciente->telefone_fixo_cuidador ?>" class="btn-schedule">Ligar para Cuidador</a>
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
    </script>
</body>
</html>
