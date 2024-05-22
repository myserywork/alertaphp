<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Paciente</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 2em;
        }

        .profile-header img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #007bff;
            transition: transform 0.3s ease-in-out;
        }

        .profile-header img:hover {
            transform: scale(1.1);
        }

        .tab-content {
            margin-top: 20px;
        }

        .nav-tabs .nav-link {
            color: #495057;
            border-radius: 0;
        }

        .nav-tabs .nav-link.active {
            background-color: #007bff;
            color: white;
            border: 1px solid #007bff;
        }

        .tab-pane {
            padding: 20px;
            border: 1px solid #dee2e6;
            border-top: 0;
            background-color: #ffffff;
            border-radius: 0.25rem;
        }

        .list-group-item {
            border: 0;
            padding: 0.75rem 1.25rem;
            background-color: #f8f9fa;
        }

        .list-group-item span {
            font-weight: 600;
            color: #6c757d;
        }

        .profile-section {
            margin-bottom: 20px;
        }

        .doenca-item {
            display: flex;
            align-items: center;
            margin-bottom: 1em;
        }

        .doenca-item img {
            width: 50px;
            height: 50px;
            margin-right: 15px;
            border-radius: 5px;
            object-fit: cover;
        }

        .btn-edit {
            display: inline-block;
            margin-top: 20px;
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 0.25rem;
            transition: background-color 0.3s ease-in-out;
        }

        .btn-edit:hover {
            background-color: #218838;
        }

        @media (max-width: 768px) {
            .profile-header img {
                width: 100px;
                height: 100px;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="profile-header">
            <img src="<?= base_url('assets/uploads/files/'); ?><?= $paciente->foto ?>" alt="Foto do Paciente">
            <h1 style="color:#6d7982;font-weight: 500;margin-top:10px;"><?= $paciente->nome ?></h1>
            <a href="<?= site_url('paciente/crud/'.$paciente->id . '/edit' . '/' . $paciente->id  )  ?>" class="btn-edit">Editar Perfil</a>
        </div>
        <ul class="nav nav-tabs" id="perfilTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="dados-tab" data-toggle="tab" href="#dados" role="tab" aria-controls="dados" aria-selected="true">Dados Pessoais</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="doencas-tab" data-toggle="tab" href="#doencas" role="tab" aria-controls="doencas" aria-selected="false">Doenças Crônicas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="dias-tab" data-toggle="tab" href="#dias" role="tab" aria-controls="dias" aria-selected="false">Dias da Semana</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="relatorios-tab" data-toggle="tab" href="#relatorios" role="tab" aria-controls="relatorios" aria-selected="false">Relatórios</a>
            </li>
        </ul>
        <div class="tab-content" id="perfilTabsContent">
            <div class="tab-pane fade show active" id="dados" role="tabpanel" aria-labelledby="dados-tab">
                <div class="profile-section">
                    <h3>Dados Pessoais</h3>
                    <div class="card">
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item"><span>Nome:</span> <?= $paciente->nome ?></li>
                                <li class="list-group-item"><span>Data de Nascimento:</span> <?= $paciente->data_nascimento ?></li>
                                <li class="list-group-item"><span>Gênero:</span> <?= $paciente->genero ?></li>
                                <li class="list-group-item"><span>CPF:</span> <?= $paciente->cpf ?></li>
                                <li class="list-group-item"><span>RG:</span> <?= $paciente->rg ?></li>
                                <li class="list-group-item"><span>Email:</span> <?= $paciente->email ?></li>
                                <li class="list-group-item"><span>Telefone:</span> <?= $paciente->telefone ?></li>
                                <li class="list-group-item"><span>Telefone Fixo:</span> <?= $paciente->telefone_fixo ?></li>
                                <li class="list-group-item"><span>Naturalidade:</span> <?= $paciente->naturalidade ?></li>
                                <li class="list-group-item"><span>Peso:</span> <?= $paciente->peso ?> kg</li>
                                <li class="list-group-item"><span>Altura:</span> <?= $paciente->altura ?> m</li>
                                <li class="list-group-item"><span>Bebe Alcool?</span> <?= $paciente->bebida ?></li>
                                <li class="list-group-item"><span>Fumante?</span> <?= $paciente->fumante ?></li>
                                <li class="list-group-item"><span>Alergia a Remédios?</span> <?= $paciente->alergia ?></li>
                                <li class="list-group-item"><span>Problema de Mobilidade?</span> <?= $paciente->mobilidade ?></li>
                                <li class="list-group-item"><span>Faz Terapia de Reabilitação?</span> <?= $paciente->terapia ?></li>
                                <li class="list-group-item"><span>Possui Plano de Saúde?</span> <?= $paciente->plano ?></li>
                                <li class="list-group-item"><span>Plano de Saúde:</span> <?= $paciente->plano_saude ?></li>
                                <li class="list-group-item"><span>Possui Cuidador?</span> <?= $paciente->cuidador ?></li>
                                <li class="list-group-item"><span>Nome do Cuidador:</span> <?= $paciente->nome_cuidador ?></li>
                                <li class="list-group-item"><span>Celular do Cuidador:</span> <?= $paciente->celular_cuidador ?></li>
                                <li class="list-group-item"><span>Telefone Fixo do Cuidador:</span> <?= $paciente->telefone_fixo_cuidador ?></li>
                                <li class="list-group-item"><span>CEP:</span> <?= $paciente->cep ?></li>
                                <li class="list-group-item"><span>Endereço:</span> <?= $paciente->endereco ?>, Nº <?= $paciente->numero ?></li>
                                <li class="list-group-item"><span>Complemento:</span> <?= $paciente->complemento ?></li>
                                <li class="list-group-item"><span>Estado:</span> <?= $paciente->estado ?></li>
                                <li class="list-group-item"><span>Cidade:</span> <?= $paciente->cidade ?></li>
                                <li class="list-group-item"><span>Estado Civil:</span> <?= $paciente->estadoCivil ?></li>
                                <li class="list-group-item"><span>Profissão Atual:</span> <?= $paciente->profissaoAtual ?></li>
                                <li class="list-group-item"><span>Profissão Anterior:</span> <?= $paciente->profissaoAnterior ?></li>
                                <li class="list-group-item"><span>Observações:</span> <?= $paciente->observacoes ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="doencas" role="tabpanel" aria-labelledby="doencas-tab">
                <div class="profile-section">
                    <h3>Doenças Crônicas</h3>
                    <div class="card">
                        <div class="card-body">
                            <ul class="list-group">
                                <?php foreach ($paciente->doencas as $doenca): ?>
                                    <li class="list-group-item doenca-item">
                                        <img src="<?= base_url('assets/uploads/files/'); ?><?= $doenca->foto ?>" alt="Foto da Doença">
                                        <span><?= $doenca->nome ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="dias" role="tabpanel" aria-labelledby="dias-tab">
                <div class="profile-section">
                    <h3>Dias da Semana</h3>
                    <div class="card">
                        <div class="card-body">
                            <ul class="list-group">
                                <?php foreach ($paciente->diasSemana as $dia): ?>
                                    <li class="list-group-item"><?= $dia->dia ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="relatorios" role="tabpanel" aria-labelledby="relatorios-tab">
                <div class="profile-section">
                    <h3>Relatórios de Análises</h3>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Risco</th>
                                        <th>Análise IA</th>
                                        <th>Análise</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($relatorios as $relatorio): ?>
                                        <tr>
                                            <td><?php echo $relatorio->id; ?></td>
                                            <td><?php echo $relatorio->risco; ?></td>
                                            <td><?php echo $relatorio->analiseIA; ?></td>
                                            <td><?php echo base64_decode($relatorio->analise); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
