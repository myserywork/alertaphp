<div class="container">
    <h2>Editar Formulário</h2>
    <form action="<?php echo site_url('forms/save'); ?>" method="post">
        <input type="hidden" name="form_id" value="<?php echo $form->id; ?>">
        <div class="form-group">
            <label for="name">Nome do Formulário</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $form->name; ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Descrição</label>
            <textarea class="form-control" id="description" name="description"><?php echo $form->description; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
    <h3 class="mt-5">Campos do Formulário</h3>
    <a href="<?php echo site_url('forms/add_field/'.$form->id); ?>" class="btn btn-primary">Adicionar Campo</a>
    <ul class="list-group mt-3">
        <?php foreach ($fields as $field): ?>
            <li class="list-group-item"><?php echo $field->display; ?></li>
        <?php endforeach; ?>
    </ul>
</div>
