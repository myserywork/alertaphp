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

    .card {
        border-radius: 10px;
    }

    .card .card-body {
        padding: 20px;
    }

    .test-class {
        color: white;
    }

    .card-header {
        background-image: linear-gradient(to top, rgb(0, 198, 251) 0%, rgb(0, 91, 234) 100%) !important;
        color: white;
        padding: 10px 20px;
        border-radius: 10px 10px 0 0;
    }

    .form-check-label {
        margin-left: 10px;
    }

    .phone-input {
        width: 100%;
    }


    .form-switch .form-check-input {
        width: 2.5rem;
        height: 1.2rem;
        margin-top: -1px;
    }
</style>

<h6 class="mb-3 text-uppercase">Configurações Dispositivo</h6>


<div class="row">
    <div class="col-12 col-md-6 col-lg-4">
        <form id="deviceForm">
            <div class="card radius-10">
                <div class="card-header">
                    Configurações do Dispositivo
                </div>
                <div class="card-body">
                    <div class="form-item">
                        <label class="form-label">Modelo</label>
                        <select class="form-control" name="model">
                            <option value="GSM">GSM</option>
                            <option value="MOBILE">MOBILE</option>
                        </select>
                    </div>
                    <div class="form-item">
                        <label class="form-label">Telefone</label>
                        <input type="text" class="form-control phone-input" name="phone"
                            data-inputmask="'mask': ['(99) 9999-9999', '(99) 9 9999-9999']">
                    </div>
                    <div class="form-item">
                        <label class="form-label">IMEI Dispositivo</label>
                        <input type="text" class="form-control" name="imei">
                    </div>
                    <div class="form-item">
                        <label class="form-label">Número de Série</label>
                        <input type="text" class="form-control" name="sn">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary submit-btn save">Salvar</button>
            </div>
        </form>
    </div>

    <?php $this->load->view('dashboard/device/falldown_view'); ?>
    <?php $this->load->view('dashboard/device/sedentary_view'); ?>

</div>

<script>
    // Aplica a máscara no campo de telefone
    $('.phone-input').inputmask({
        mask: ['(99) 9999-9999', '(99) 9 9999-9999']
    });

    // Envia o formulário de configurações do dispositivo para a API
    $('#deviceForm').on('submit', function (e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: 'api-url',
            method: 'POST',
            data: formData,
            success: function (response) {
                swal({
                    icon: 'success',
                    title: 'Sucesso',
                    text: 'Dados das configurações do dispositivo salvos com sucesso!'
                });
            },
            error: function (xhr, status, error) {
                swal({
                    icon: 'error',
                    title: 'Erro',
                    text: 'Ocorreu um erro ao salvar os dados das configurações do dispositivo.'
                });
            }
        });

    });
</script>