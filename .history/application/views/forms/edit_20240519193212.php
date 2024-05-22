<h1>Editar Formulário</h1>
<h2><?php echo $form->name; ?></h2>
<p><?php echo $form->description; ?></p>
<a href="<?php echo site_url('forms/add_field/' . $form->id); ?>" class="btn btn-primary">Adicionar Campo</a>
<ul class="list-group mt-3">
    <?php foreach ($fields as $field): ?>
        <li class="list-group-item">
            <?php echo $field->display; ?> (<?php echo $field->type; ?>)
        </li>
    <?php endforeach; ?>
</ul>
