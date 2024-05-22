<div class="container">
    <h2>Visualizar Resposta</h2>
    <ul class="list-group mt-3">
        <?php foreach ($response->values as $value): ?>
            <li class="list-group-item">
                Campo: <?php echo $value->field_id; ?> - Valor: <?php echo $value->value; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
