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
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="validationRequired" name="validations[required]" value="1">
                <label class="form-check-label" for="validationRequired">Obrigatório</label>
            </div>
            <div class="form-group">
                <label for="validationMinLength">Comprimento Mínimo</label>
                <input type="number" class="form-control" id="validationMinLength" name="validations[min_length]">
            </div>
            <div class="form-group">
                <label for="validationMaxLength">Comprimento Máximo</label>
                <input type="number" class="form-control" id="validationMaxLength" name="validations[max_length]">
            </div>
            <div class="form-group">
                <label for="validationPattern">Padrão</label>
                <input type="text" class="form-control" id="validationPattern" name="validations[pattern]">
            </div>
            <div class="form-group" id="fileValidations" style="display:none;">
                <label for="allowedTypes">Tipos Permitidos</label>
                <input type="text" class="form-control" id="allowedTypes" name="validations[allowed_types]" placeholder="ex: jpg,png,pdf">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>

<script>
document.getElementById('type').addEventListener('change', function() {
    if (this.value === 'file') {
        document.getElementById('fileValidations').style.display = 'block';
    } else {
        document.getElementById('fileValidations').style.display = 'none';
    }
});
</script>
