<li class="nav-item dropdown dropdown-large">
    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown">
        <div class="position-relative">
            <span class="notify-badge">
                <?= count($notifications); ?>
            </span>
            <ion-icon name="notifications-sharp"></ion-icon>
        </div>
    </a>
    <div class="dropdown-menu dropdown-menu-end">
        <a href="javascript:;">
            <div class="msg-header">
                <p class="msg-header-title">Notificações</p>
                <p class="msg-header-clear ms-auto"><a href="<?= base_url("notifications/markAllAsRead"); ?>">Marcar
                        todas como lidas<a></p>
            </div>
        </a>
        <div class="header-notifications-list">

            <?php



            foreach ($notifications as $notification) {
                $timeAgo = time_ago(strtotime($notification->created_at)); // Calcula o tempo decorrido usando a função `time_ago()`
                ?>

                <a class="dropdown-item" href="javascript:;">
                    <div class="d-flex align-items-center">
                        <div class="notify bg-light-primary text-primary">
                            <ion-icon name="cart-outline"></ion-icon>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="msg-name">
                                <?= $notification->title; ?><span class="msg-time float-end time-ago"
                                    data-time="<?= strtotime($notification->created_at); ?>"><?= $timeAgo; ?></span>
                            </h6>
                            <p class="msg-info">
                                <?= $notification->description; ?>
                            </p>
                        </div>
                    </div>
                </a>

            <?php } ?>

        </div>
        <a href="<?= base_url("notifications"); ?>">
            <div class="text-center msg-footer">Ver todas as notificações</div>
        </a>
    </div>
</li>

<!-- Inclua o arquivo JavaScript do timeago.js -->
<script src="https://cdn.jsdelivr.net/npm/timeago.js"></script>

<script>
    // Configuração do timeago.js para o idioma Português
    timeago.register('pt_BR', {
        prefixAgo: 'há',
        prefixFromNow: 'em',
        suffixAgo: null,
        suffixFromNow: null,
        seconds: 'menos de um minuto',
        minute: 'cerca de um minuto',
        minutes: '%d minutos',
        hour: 'cerca de uma hora',
        hours: 'cerca de %d horas',
        day: 'um dia',
        days: '%d dias',
        month: 'cerca de um mês',
        months: '%d meses',
        year: 'cerca de um ano',
        years: '%d anos'
    });

    // Aplica o timeago.js para todos os elementos com a classe 'time-ago'
    timeago.render(document.querySelectorAll('.time-ago'), 'pt_BR');
</script>