<div class="container">
    <h2>Editar Formulário: <?php echo $form->name; ?></h2>
    <form action="<?php echo site_url('forms/save'); ?>" method="post">
        <div class="form-group">
            <label for="name">Nome do Formulário</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $form->name; ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Descrição</label>
            <textarea class="form-control" id="description" name="description"><?php echo $form->description; ?></textarea>
        </div>
        <div class="form-group">
            <label for="category_id">Categoria</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category->id; ?>" <?php echo $category->id == $form->category_id ? 'selected' : ''; ?>><?php echo $category->title; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
    <h3>Campos</h3>
    <a href="<?php echo site_url('forms/add_field/'.$form->id); ?>" class="btn btn-primary mb-3">Adicionar Campo</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Label</th>
                <th>Tipo</th>
                <th>Opções</th>
                <th>Validações</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fields as $field): ?>
            <tr>
                <td><?php echo $field->name; ?></td>
                <td><?php echo $field->display; ?></td>
                <td><?php echo $field->type; ?></td>
                <td><?php echo $field->options; ?></td>
                <td><?php echo $field->validations; ?></td>
                <td>
                    <a href="<?php echo site_url('forms/edit_field/'.$field->id); ?>" class="btn btn-warning">Editar</a>
                    <a href="<?php echo site_url('forms/delete_field/'.$field->id); ?>" class="btn btn-danger">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
