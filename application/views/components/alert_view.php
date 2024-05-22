<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script>
$(document).ready(function() {
    // Verifica se existe uma mensagem flash na sessão
    <?php if ($this->session->flashdata('message')) : ?>
    // Obtém a mensagem e o nível da sessão flash
    <?php $flashMessage = $this->session->flashdata('message'); ?>
    <?php $message = $flashMessage['message']; ?>
    <?php $level = $flashMessage['level']; ?>

    // Exibe o alerta do SweetAlert com base no nível
    <?php if ($level == 'success') : ?>
    swal({
        title: "Success",
        text: "<?php echo $message; ?>",
        icon: "success",
    });
    <?php elseif ($level == 'error') : ?>
    swal({
        title: "Error",
        text: "<?php echo $message; ?>",
        icon: "error",
    });
    <?php elseif ($level == 'warning') : ?>
    swal({
        title: "Warning",
        text: "<?php echo $message; ?>",
        icon: "warning",
    });
    <?php else : ?>
    swal({
        title: "Info",
        text: "<?php echo $message; ?>",
        icon: "info",
    });
    <?php endif; ?>

    <?php endif; ?>
});
</script>