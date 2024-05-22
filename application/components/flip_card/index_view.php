
<?php foreach($itens as $item) : ?>
<div class="card-container">
      <a href='<?= $item['url']; ?>'>
          <img class="card-image" src="<?= $item['image_url']; ?>" alt="<?= $item['title']; ?>">
          <div class="card-overlay">
            <div class="card-icon">
              <ion-icon name="person-add-outline"></ion-icon>
            </div>
            <div class="card-text"><?= $item['title']; ?></div>
          </div>
      </a>
</div>
<?php endforeach; ?>
