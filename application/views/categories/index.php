<div class="container">
    <h2>Categorias</h2>
    <a href="<?php echo site_url('categories/create'); ?>" class="btn btn-primary mb-3">Criar Categoria</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Título</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
            <tr>
                <td><?php echo $category->title; ?></td>
                <td><?php echo $category->description; ?></td>
                <td>
                    <a href="<?php echo site_url('categories/edit/'.$category->id); ?>" class="btn btn-warning">Editar</a>
                    <a href="<?php echo site_url('categories/delete/'.$category->id); ?>" class="btn btn-danger">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
