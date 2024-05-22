<h1>Respostas dos Formulários</h1>
<ul class="list-group mt-3">
    <?php foreach ($responses as $response): ?>
        <li class="list-group-item">
            Resposta ID: <?php echo $response->id; ?>
            <a href="<?php echo site_url('responses/view/' . $response->id); ?>" class="btn btn-sm btn-info float-right">Visualizar</a>
        </li>
    <?php endforeach; ?>
</ul>
