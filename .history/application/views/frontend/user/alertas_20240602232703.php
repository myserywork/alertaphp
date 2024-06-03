<div>
    <h2>Alertas</h2>
    <div class="list-container">
        <h3>Alertas Ativos</h3>
        <ul id="alerts-list">
            <?php foreach ($alertas as $alerta): ?>
                <li data-id="<?= $alerta->id ?>">
                    <div class="details">
                        <strong><?= $alerta->riisco ?></strong><br>
                     
                    </div>
                    <div class="actions">
                        <a href="<?= base_url('user/delete_alerta/'.$alerta->id) ?>"><i class="material-icons">delete</i></a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<style>
    .list-container h3 {
        margin-top: 20px;
    }
</style>
