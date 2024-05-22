<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Criar Campo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Criar Campo</h1>
        <form action="<?php echo site_url('customfields/save_field'); ?>" method="post">
            <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
            <div class="form-group">
                <label for="name">Nome do Campo</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="display">Display do Campo</label>
                <input type="text" class="form-control" id="display" name="display" required>
            </div>
            <div class="form-group">
                <label for="type">Tipo do Campo</label>
                <select class="form-control" id="type" name="type" required>
                    <option value="text">Text</option>
                    <option value="textarea">Textarea</option>
                    <option value="select">Select</option>
                    <option value="radio">Radio</option>
                    <option value="checkbox">Checkbox</option>
                    <option value="date">Date</option>
                    <option value="datetime">Datetime</option>
                    <option value="file">File</option>
                    <option value="multiselect">Multiselect</option>
                </select>
            </div>
            <div class="form-group">
                <label for="options">Opções (separadas por vírgula para select, radio, checkbox, multiselect)</label>
                <input type="text" class="form-control" id="options" name="options">
            </div>
            <div class="form-group">
                <label for="required">Obrigatório</label>
                <input type="checkbox" id="required" name="required">
            </div>
            <div class="form-group">
                <label for="validations">Validações (CI rules format)</label>
                <input type="text" class="form-control" id="validations" name="validations">
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</body>
</html>
