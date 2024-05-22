<div class="container">
    <h2>Respostas da Categoria</h2>
    <ul class="list-group mt-3">
        <?php foreach ($responses as $response): ?>
            <li class="list-group-item">
                Formulário: <?php echo $response->form_name; ?> - Usuário: <?php echo $response->user_id; ?>
                <a href="<?php echo site_url('responses/view/'.$response->id); ?>" class="btn btn-sm btn-info float-right">Ver Resposta</a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
