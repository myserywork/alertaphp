<!-- Inclua o arquivo CSS do inputmask -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.css">

<style>
    .form-item {
        margin-bottom: 15px;
    }

    .form-label {
        font-weight: bold;
    }

    .form-control {
        border-radius: 5px;
    }

    .submit-btn {
        margin-top: 20px;
        border-radius: 5px;
        padding: 10px 20px;
        font-weight: bold;
    }
</style>

<h6 class="mb-3 text-uppercase">Plano de Saúde</h6>
<?php echo validation_errors(); ?>
<?php echo form_open(); ?>
<div class="form-item">
    <label class="form-label">Nome</label>
    <input value="<?= set_value('name') ? set_value('name') : ''; ?>" type="text" class="form-control" name="name">
</div>
<input value="<?= $pacient->id; ?>" name="pacient_id" type="hidden" class="form-control" name="pacient_id">
<div class="form-item">
    <label class="form-label">Cobertura</label>
    <select class="form-control" name="coverage">
        <option value="one" <?php echo set_select('myselect', 'one', TRUE); ?>>One</option>
        <option value="two" <?php echo set_select('myselect', 'two'); ?>>Two</option>
        <option value="three" <?php echo set_select('myselect', 'three'); ?>>Three</option>
    </select>
</div>
<div class="form-item">
    <label class="form-label">Telefone</label>
    <input type="text" value="<?= set_value('phone') ? set_value('phone') : ''; ?>" class="form-control phone-input"
        name="phone" data-inputmask="'mask': ['(99) 9999-9999', '(99) 9 9999-9999']">
</div>
<div class="form-item">
    <label class="form-label">Identificação</label>
    <input type="text" value="<?= set_value('identification') ? set_value('identification') : ''; ?>"
        class="form-control" name="identification">
</div>


<div class="text-end">
    <button type="submit" class="btn btn-primary submit-btn">Salvar</button>
</div>
<?php echo form_close(); ?>
<!-- Inclua o arquivo JavaScript do inputmask -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
<script>
    // Aplica a máscara no campo de telefone
    $('.phone-input').inputmask();

// Para usar o inputmask com o jQuery é necessário incluir o jQuery antes do inputmask
</script>