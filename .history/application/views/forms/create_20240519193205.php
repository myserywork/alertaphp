<h1>Criar Formulário</h1>
<form action="<?php echo site_url('forms/save'); ?>" method="post">
    <div class="form-group">
        <label for="name">Nome do Formulário</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="description">Descrição</label>
        <textarea class="form-control" id="description" name="description"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>
