<div class="container">
    <h2>Formulários</h2>
    <a href="<?php echo site_url('forms/create'); ?>" class="btn btn-primary mb-3">Criar Formulário</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Categoria</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($forms as $form): ?>
            <tr>
                <td><?php echo $form->name; ?></td>
                <td><?php echo $form->description; ?></td>
                <td><?php echo $form->category_title; ?></td>
                <td>
                    <a href="<?php echo site_url('forms/edit/'.$form->id); ?>" class="btn btn-warning">Editar</a>
                    <a href="<?php echo site_url('forms/delete/'.$form->id); ?>" class="btn btn-danger">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
