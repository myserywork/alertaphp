<div class="container">
    <h2>Formulários</h2>
    <a href="<?php echo site_url('forms/create'); ?>" class="btn btn-primary">Criar Novo Formulário</a>
    <ul class="list-group mt-3">
        <?php foreach ($forms as $form): ?>
            <li class="list-group-item">
                <?php echo $form->name; ?>
                <a href="<?php echo site_url('forms/edit/'.$form->id); ?>" class="btn btn-sm btn-info float-right">Editar</a>
                <a href="<?php echo site_url('forms/load_form_by_category/'.$form->category_id); ?>" class="btn btn-sm btn-info float-right mr-2">Preencher</a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
