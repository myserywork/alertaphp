<div>
    <div>
        <strong>Atenção!</strong><br>
        <p>Este paciente está com um humor abaixo do normal. Considere entrar em contato com ele.</p>
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
