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

<style>
    .form-container textarea {
        display: block;
        width: 100%;
        padding: 10px;
        margin: 5px 0;
        border-radius: 5px;
        border: 1px solid #ccc;
        transition: border-color 0.3s, box-shadow 0.3s;
    }
    .form-container textarea:focus {
        border-color: #27ae60;
        box-shadow: 0 0 8px rgba(39, 174, 96, 0.2);
    }
    .list-container h3 {
        margin-top: 20px;
    }
</style>
