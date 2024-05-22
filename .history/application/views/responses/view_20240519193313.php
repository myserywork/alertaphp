<h1>Visualizar Resposta</h1>
<p>ID da Resposta: <?php echo $response->id; ?></p>
<p>ID do Formulário: <?php echo $response->form_id; ?></p>
<p>ID do Usuário: <?php echo $response->user_id; ?></p>
<p>Data de Criação: <?php echo $response->created_at; ?></p>

<!-- Mostrar campos e valores da resposta -->
<?php foreach ($response->fields as $field): ?>
    <div class="form-group">
        <label><?php echo $field->display; ?>:</label>
        <p><?php echo $field->value; ?></p>
    </div>
<?php endforeach; ?>