<div class="container">
    <h2>Adicionar Campo</h2>
    <form action="<?php echo site_url('forms/save_field'); ?>" method="post">
        <input type="hidden" name="form_id" value="<?php echo $form_id; ?>">
        <div class="form-group">
            <label for="name">Nome do Campo</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="display">Label do Campo</label>
            <input type="text" class="form-control" id="display" name="display" required>
        </div>
        <div class="form-group">
            <label for="type">Tipo do Campo</label>
            <select class="form-control" id="type" name="type" required>
                <option value="text">Texto</option>
                <option value="textarea">Textarea</option>
                <option value="select">Select</option>
                <option value="radio">Radio</option>
                <option value="checkbox">Checkbox</option>
                <option value="file">File</option>
            </select>
        </div>
        <div class="form-group">
            <label for="options">Opções (separadas por vírgula)</label>
            <input type="text" class="form-control" id="options" name="options">
        </div>
        <div class="form-group">
            <label for="required">Obrigatório</label>
            <input type="checkbox" id="required" name="required" value="1">
        </div>
        <div class="form-group">
            <label for="validations">Validações</label>
            <input type="text" class="form-control" id="validations" name="validations">
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
