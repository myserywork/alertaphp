<!-- Inclua o arquivo CSS do TinyMCE -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tinymce@5.9.2/skins/ui/oxide/skin.min.css">
<style>
    .tox-tinymce {
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .bg-hot-actions {
        background-color: #717171;
        padding: 10px;
        border-radius: 5px;
    }

</style>

<div class="d-flex align-items-center justify-content-between">
    <h2 class="me-3">Formulário de Atendimentos</h2>
    
    <div class="d-flex bg-hot-actions">


        <button type="button" class="btn btn-danger ms-3" onclick="chamarAmbulancia()">
            <ion-icon name="alert-circle-outline"></ion-icon> Chamar Ambulância
        </button>
    </div>
</div>

<form id="atendimentoForm">
     <?php  $this->load->view('dashboard/pacients/body_data_view'); ?>

     <div class="form-item">
    <h3 class="form-label">Status </h3>
        <select id="status" class="form-control" name="status">
            <option value="1">Em andamento</option>
            <option value="2">Finalizado</option>
        </select>
    </div>
    
    
    <div class="form-item">
    <h3 class="form-label">Status </h3>
        <select id="alert_reference" class="form-control" name="alert_reference">
            <option value="1">1</option>
            <option value="2">2</option>
        </select>
    </div>
    

    <div class="form-item">
    <h3 class="form-label">Descrição do Atendimento </h3>
        <textarea id="description" name="description">
            Paciente : <?= $pacient->name ?> <br>
            Data : <?= date('d/m/Y H:i:s') ?> <br>
            Atendente : <?= loggedInUser()->first_name . ' ' . loggedInUser()->last_name; ?> <br>

        </textarea>
    </div>
    <br>
    <input type="hidden" name="pacient_id" value="<?= $pacient->id ?>">
    <button type="submit" class="btn btn-primary submit-btn save">Salvar</button>
</form>

<!-- Inclua o arquivo JavaScript do TinyMCE -->
<script src="https://cdn.jsdelivr.net/npm/tinymce@5.9.2/tinymce.min.js"></script>
<script>
    // Inicialize o TinyMCE
    tinymce.init({
        selector: '#description',
        height: 300,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help',
        skin: 'oxide',
        skin_url: 'https://cdn.jsdelivr.net/npm/tinymce@5.9.2/skins/ui/oxide',
    });

    // Envia o formulário de atendimento para a API
    $('#atendimentoForm').on('submit', function(e) {
    e.preventDefault();

    var formData = $(this).serialize();

    $.ajax({
        url: '<?= base_url('attendances/save/' . $pacient->id);?>',
        method: 'POST',
        data: formData,
        success: function(response) {
            swal({
                icon: 'success',
                title: 'Sucesso',
                text: 'Atendimento salvo com sucesso!'
            }).then(function() {
                parent.location.reload();
            });
        },
        error: function(xhr, status, error) {
            swal({
                icon: 'error',
                title: 'Erro',
                text: 'Ocorreu um erro ao salvar o atendimento.'
            });
        }
    });
});
</script>

<?php $this->load->view('dashboard/attendances/call_widget_view'); ?>

<script>
    function chamarAmbulancia() {
        // Lógica para chamar a ambulância
        swal({
            icon: 'info',
            title: 'Ambulância',
            text: 'A ambulância foi chamada com sucesso!'
        });
    }
</script>
