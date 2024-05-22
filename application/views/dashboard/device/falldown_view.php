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


<div class="col-12 col-md-6 col-lg-4">
        <form id="alarmForm">
            <div class="card radius-10">
                <div class="card-header">
                    Alarme de Queda
                </div>
                <div class="card-body">
                    <div class="form-item">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="alarmSwitch" checked="">
                            <label class="form-check-label" for="alarmSwitch">Habilitado</label>
                        </div>
                    </div>
                    <div class="form-item">
                        <label class="form-label">Level</label>
                        <select class="form-control" name="fall_level">
                            <option value="Nível 1">Nível 1</option>
                            <option value="Nível 2">Nível 2</option>
                            <option value="Nível 3">Nível 3</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary submit-btn save">Salvar</button>
            </div>
        </form>
 </div>


    <script>
            // Envia o formulário de alarme de queda para a API
    $('#alarmForm').on('submit', function(e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: 'api-url',
            method: 'POST',
            data: formData,
            success: function(response) {
                swal({
                    icon: 'success',
                    title: 'Sucesso',
                    text: 'Dados do alarme de queda salvos com sucesso!'
                });
            },
            error: function(xhr, status, error) {
                swal({
                    icon:

            'error',
                    title: 'Erro',
                    text: 'Ocorreu um erro ao salvar os dados do alarme de queda.'
                });
            }
        });
    });
    </script>