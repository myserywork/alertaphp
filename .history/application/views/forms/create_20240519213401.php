<div class="container">
    <h2>Criar Formulário</h2>
    <form action="<?php echo site_url('forms/save'); ?>" method="post">
        <div class="form-group">
            <label for="name">Nome do Formulário</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="description">Descrição</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="form-group">
            <label for="category_id">Categoria</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category->id; ?>"><?php echo $category->title; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
