<h1>Preencher Formulário</h1>
<h2><?php echo $form->name; ?></h2>
<p><?php echo $form->description; ?></p>
<form action="<?php echo site_url('forms/save_response'); ?>" method="post" enctype="multipart/form-data">
    <?php echo $form_html; ?>
    <input type="hidden" name="form_id" value="<?php echo $form->id; ?>">
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>
