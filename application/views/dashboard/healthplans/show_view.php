<?php if ($pacient->healthplans == NULL): ?>
    <div class="card radius-10">
        <div class="card-body">
            <h5 class="mb-3">Nenhum plano de saúde encontrado!</h5>
            <p class="mb-0">
                <a href="<?= base_url('healthplans/create/' . $pacient->id) ?>" class="btn btn-primary"
                    style="margin-top: 5px;">
                    <ion-icon name="add-sharp"></ion-icon>Adicionar um novo!
                </a>
            </p>
        </div>
    <?php endif; ?>
    <?php if ($pacient->healthplans != NULL): ?>
        <div class="card radius-10">
            <div class="card-body">
                <h5 class="mb-3">Plano de Saúde</h5>
                <p class="mb-0">
                <h5 class="mb-3">
                    <?= $pacient->healthplans->name; ?>
                </h5>
                <p class="mb-0">
                    <ion-icon name="call-outline" class="me-2"></ion-icon>
                    <?= $pacient->healthplans->phone; ?>
                    <br>
                    <ion-icon name="megaphone-outline"></ion-icon>
                    <?= $pacient->healthplans->coverage; ?>
                    <br>
                    <ion-icon name="id-card-outline" class="me-2"></ion-icon>
                    <?= $pacient->healthplans->identification; ?>

                <div class="">
                    <a <?= showModal(base_url('healthplans/show/' . $pacient->id), 80, 80); ?> class="btn btn-primary"
                        style="margin-top: 5px;">
                        <ion-icon name="create-outline"></ion-icon>EDITAR
                    </a>
                    <a href="<?= base_url('healthplans/delete/' . $pacient->healthplans->id); ?>" class="btn btn-danger"
                        style="margin-top: 5px;">
                        <ion-icon name="trash-outline"></ion-icon>DELETAR
                    </a>
                </div>
                </p>
            </div>
        </div>
    <?php endif; ?>