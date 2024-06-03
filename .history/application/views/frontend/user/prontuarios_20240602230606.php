<div>
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
