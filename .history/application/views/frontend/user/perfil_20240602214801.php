<!-- frontend/user/perfil.php -->
<div class="container">
    <h1>Perfil do Paciente</h1>
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
