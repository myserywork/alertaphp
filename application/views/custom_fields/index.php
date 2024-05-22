<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Custom Fields</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Categorias</h1>
        <a href="<?php echo site_url('customfields/create_category'); ?>" class="btn btn-primary">Criar Nova Categoria</a>
        <ul class="list-group mt-3">
            <?php foreach ($categories as $category): ?>
                <li class="list-group-item">
                    <?php echo $category->name; ?>
                    <a href="<?php echo site_url('customfields/create_field/' . $category->id); ?>" class="btn btn-sm btn-success float-right">Adicionar Campo</a>
                    <a href="<?php echo site_url('customfields/create/' . $category->id); ?>" class="btn btn-sm btn-info float-right mr-2">Criar Formulário</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
