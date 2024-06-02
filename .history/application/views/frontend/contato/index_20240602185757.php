<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <style>
        .form-control {
            border-radius: 0.25rem;
            background: #f5f5f5;
            border: 1px solid #e6e6e6;
            padding: 0.75rem 1rem;
            width: 100%;
            height: auto;
            color: #495057;
            font-weight: 500;
            font-size: 1rem;
        }

        .bt-enviar {
            background-color: #00bc62;
            border: 0;
            border-radius: 0.25rem;
            padding: 0.75rem 1.5rem;
            color: white;
            font-size: 1rem;
            font-weight: 700;
            text-transform: uppercase;
            transition: background-color 0.3s;
        }

        .bt-enviar:hover {
            background-color: #00a653;
        }

        label {
            color: #9ba2a7;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }

        .error {
            color: red;
            font-size: 0.875rem;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="text-center" style="color:#6d7982;font-weight: 500;margin-bottom:2em;">Contato</h1>
                <p class="text-center">Entre em contato conosco preenchendo o formulário abaixo.</p>
                <form id="formContato" action="seu_script_de_envio.php" method="post">
                    <fieldset>
                        <legend style="color:#6d7982;font-weight: 600;">Dados de Contato</legend>
                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Ex: João da Silva" required>
                            <div class="error" id="nomeError"></div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="exemplo@dominio.com" required>
                            <div class="error" id="emailError"></div>
                        </div>
                        <div class="form-group">
                            <label for="telefone">Telefone:</label>
                            <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(00) 00000-0000" required>
                            <div class="error" id="telefoneError"></div>
                        </div>
                        <div class="form-group">
                            <label for="mensagem">Mensagem:</label>
                            <textarea class="form-control" id="mensagem" name="mensagem" rows="5" placeholder="Digite sua mensagem aqui..." required></textarea>
                            <div class="error" id="mensagemError"></div>
                        </div>
                    </fieldset>

                    <div class="row mt-3 mb-3">
                        <div class="col-md-12 text-right">
                            <button type="button" id="submitBtn" class="btn btn-primary bt-cadastro-x">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Sucesso!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Sua mensagem foi enviada com sucesso! Entraremos em contato em breve.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bt-cadastro-x" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <style>
           .bt-cadastro {
            background-color: #00bc62;
            border: 0;
            border-radius: 0.25rem;
            padding: 0.75rem 1.5rem;
            color: white;
            font-size: 1rem;
            font-weight: 700;
            text-transform: uppercase;
            transition: background-color 0.3s;
        }

        .bt-cadastro:hover {
            background-color: #00a653;
        }

        .bt-cadastro-x {
            background-color: rgb(0, 188, 98) !important;
            border: 0px;
            border-radius: 64px;
            height: 2.5vw;
            min-height: 38px;
            padding: 0px 16px;
            color: rgb(255, 255, 255);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            width: 100%;
        }

        </style>

    <script>
        $(document).ready(function () {
            // Máscara de telefone
            IMask(document.getElementById('telefone'), { mask: '(00) 00000-0000' });

            $('#submitBtn').click(function () {
                var valid = true;
                $('.error').text(''); // Limpar mensagens de erro

                if (!$('#nome').val()) {
                    $('#nomeError').text('O campo Nome é obrigatório.');
                    valid = false;
                }
                if (!$('#email').val()) {
                    $('#emailError').text('O campo Email é obrigatório.');
                    valid = false;
                }
                if (!$('#telefone').val()) {
                    $('#telefoneError').text('O campo Telefone é obrigatório.');
                    valid = false;
                }
                if (!$('#mensagem').val()) {
                    $('#mensagemError').text('O campo Mensagem é obrigatório.');
                    valid = false;
                }

                if (valid) {
                    $('#formContato').submit();
                }
            });

            $("#formContato").submit(function (e) {
                e.preventDefault();
                var actionurl = e.currentTarget.action;

                $.ajax({
                    url: actionurl,
                    type: 'post',
                    dataType: 'json',
                    data: $("#formContato").serialize(),
                    success: function (data) {
                        if (data.success) {
                            $('#successModal').modal('show');
                        } else {
                            alert(data.message);
                        }
                    },
                    error: function () {
                        alert('Erro ao enviar sua mensagem');
                    }
                });
            });
        });
    </script>
</body>

</html>
