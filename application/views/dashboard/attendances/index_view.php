<style>
    /* Estilo para o iframe */
    #my-iframe {
        width: 100%;
        border: none;

        height: 80vh; 
    }
</style>

<!-- Código do iframe -->
<?php if(isset($create)) : ?>
    <iframe id="my-iframe" src="<?= base_url('attendances/crud/add'); ?>" frameborder="0" ></iframe>
<?php else : ?>
    <iframe id="my-iframe" src="<?= base_url('attendances/crud'); ?>" frameborder="0" ></iframe>
<?php endif; ?>

<!-- Script para ajustar a altura do iframe -->
