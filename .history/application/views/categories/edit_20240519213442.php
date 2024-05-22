<div class="container">
    <h2>Editar Categoria</h2>
    <form action="<?php echo site_url('categories/update/'.$category->id); ?>" method="post">
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo $category->title; ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Descrição</label>
            <textarea class="form-control" id="description" name="description"><?php echo $category->description; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
