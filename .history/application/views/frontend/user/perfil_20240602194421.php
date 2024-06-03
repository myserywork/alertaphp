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
    </style>
</head>
<body>
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
</body>
</html>
