<div class="notifications-page">
  <h1>Notificações</h1>

  <?php if (!empty($notifications)) : ?>
    <?php foreach ($notifications as $notification) : ?>
      <div class="notification-block">
        <div class="notification-header">
          <h3><?= $notification->title; ?></h3>
          <span class="notification-time"><?= date('d/m/Y H:i:s', strtotime($notification->created_at)); ?></span>
          <button class="toggle-button btn btn-link">Mostrar/Ocultar</button>
          <a href="<?= base_url("notifications/{$notification->id}/markAsRead"); ?>" class="btn btn-primary">Marcar como lido</a>
        </div>
        <div class="notification-body hidden">
          <div class="row">
            <div class="col-lg-2 col-md-12">
              <p class="notification-description"><strong>Descrição:</strong></p>
            </div>
            <div class="col-lg-10 col-md-12">
              <p class="notification-description-content"><?= $notification->description; ?></p>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-2 col-md-12">
              <p class="notification-message"><strong>Mensagem:</strong></p>
            </div>
            <div class="col-lg-10 col-md-12">
              <p class="notification-message-content"><?= $notification->message; ?></p>
            </div>
          </div>
          <p><strong>Tipo:</strong> <?= $notification->type; ?></p>
          <p><strong>Ícone:</strong> <?= $notification->icon; ?></p>
          <p><strong>Origem:</strong> <?= $notification->origin; ?></p>
          <p><strong>Status:</strong> <?= $notification->status; ?></p>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else : ?>
    <p>Não há notificações disponíveis.</p>
  <?php endif; ?>

  <style>
    .notifications-page {
      padding: 20px;
    }

    .notification-block {
      border: 1px solid #e6e6e6;
      border-radius: 4px;
      margin-bottom: 20px;
      padding: 10px;
      background-color: #f9f9f9;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .notification-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 10px;
    }

    .notification-header h3 {
      font-size: 18px;
      margin-bottom: 0;
    }

    .notification-time {
      font-size: 12px;
      color: #777;
    }

    .notification-body {
      padding: 10px;
    }

    .notification-description,
    .notification-message {
      font-weight: bold;
    }

    .notification-description-content,
    .notification-message-content {
      margin-top: 5px;
    }

    .btn-primary {
      margin-left: 10px;
    }
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const toggleButtons = document.querySelectorAll('.toggle-button');

      toggleButtons.forEach(function(button) {
        button.addEventListener('click', function() {
          const notificationBody = this.parentNode.parentNode.querySelector('.notification-body');
          notificationBody.classList.toggle('hidden');
        });
      });
    });
  </script>
</div>
