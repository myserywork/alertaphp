<div class="container">
    <h2>Visualizar Resposta</h2>
    <ul class="list-group mt-3">
        <?php if (isset($response->values) && !empty($response->values)): ?>
            <?php foreach ($response->values as $value): ?>
                <li class="list-group-item">
                    Campo: <?php echo $value->field_name; ?> - Valor: <?php echo $value->value; ?>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li class="list-group-item">Nenhum valor encontrado para esta resposta.</li>
        <?php endif; ?>
    </ul>
</div>
