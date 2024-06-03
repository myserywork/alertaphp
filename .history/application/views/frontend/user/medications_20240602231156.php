<div>
    <h2>Medicações</h2>
    <div class="form-container">
        <form action="<?= base_url('user/add_medicacao') ?>" method="post">
            <input type="hidden" name="paciente_id" value="<?= $paciente->id ?>">
            <input type="text" name="nome" placeholder="Nome da Medicação" required>
            <input type="text" name="quantidade" placeholder="Quantidade (mg, ml, etc)" required>
            <input type="time" name="horario" required>
            <select name="tipo" required>
                <option value="" disabled selected>Tipo de Medicamento</option>
                <option value="Comprimido">Comprimido</option>
                <option value="Líquido">Líquido</option>
                <option value="Injeção">Injeção</option>
                <option value="Pomada">Pomada</option>
                <option value="Outro">Outro</option>
            </select>
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
                        <?= $medicacao->tipo ?><br>
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

<style>
    .form-container {
        margin-top: 20px;
    }
    .form-container input, .form-container select, .form-container button {
        width: 100%;
        padding: 10px;
        margin: 5px 0;
        border-radius: 5px;
        border: 1px solid #ccc;
        transition: border-color 0.3s, box-shadow 0.3s;
    }
    .form-container input:focus, .form-container select:focus {
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
    .list-container li .actions a {
        background: transparent;
        border: none;
        cursor: pointer;
        color: #27ae60;
        font-size: 1.5em;
        transition: color 0.3s, transform 0.3s;
    }
    .list-container li .actions a:hover {
        color: #219150;
        transform: scale(1.1);
    }
    .list-container h3 {
        margin-top: 20px;
    }
</style>
