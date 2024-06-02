<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Representante</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imask/6.2.2/imask.min.js"></script>

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
            <div class="col-md-12">
                <h1 class="text-center" style="color:#6d7982;font-weight: 500;margin-bottom:2em;">SEJA UM REPRESENTANTE</h1>
                <p class="text-center">Seja um Representante Alerta Saúde em sua cidade. Preencha o formulário e envie.</p>
                <form id="formCadastro" action="<?php echo site_url('representante/create'); ?>" method="post">
                    <fieldset>
                        <legend style="color:#6d7982;font-weight: 600;">Dados Pessoais</legend>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nome">Nome:</label>
                                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Ex: João da Silva" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cpf">CPF:</label>
                                    <input type="text" class="form-control" id="cpf" name="cpf" placeholder="000.000.000-00" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="profissao">Profissão:</label>
                                    <input type="text" class="form-control" id="profissao" name="profissao" placeholder="Ex: Vendas" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sexo">Sexo:</label>
                                    <select class="form-control" id="sexo" name="sexo" required>
                                        <option value="M">Masculino</option>
                                        <option value="F">Feminino</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="data_nascimento">Data de Nascimento:</label>
                                    <input type="text" class="form-control" id="data_nascimento" name="data_nascimento" placeholder="DD/MM/AAAA" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="estado">Estado:</label>
                                    <input type="text" class="form-control" id="estado" name="estado" placeholder="Select..." required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cidade">Cidade de Residência:</label>
                                    <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Ex: São Paulo" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="telefone">Telefone com DDD:</label>
                                    <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(00) 00000-0000" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="whatsapp">Número do WhatsApp:</label>
                                    <input type="text" class="form-control" id="whatsapp" name="whatsapp" placeholder="(00) 00000-0000" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cep">CEP:</label>
                                    <input type="text" class="form-control" id="cep" name="cep" placeholder="00000-000" required>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <div class="row mt-3 mb-3">
                        <div class="col-md-12 text-right">
                            <button type="button" id="submitBtn" class="btn btn-primary bt-cadastro-x">Cadastrar</button>
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
                    Cadastro realizado com sucesso! Em breve você receberá uma mensagem com mais detalhes.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Inicializar máscaras de entrada
            IMask(document.getElementById('cpf'), { mask: '000.000.000-00' });
            IMask(document.getElementById('telefone'), { mask: '(00) 00000-0000' });
            IMask(document.getElementById('whatsapp'), { mask: '(00) 00000-0000' });
            IMask(document.getElementById('cep'), { mask: '00000-000' });
            IMask(document.getElementById('data_nascimento'), { mask: '00/00/0000' });

            $('#submitBtn').click(function () {
                $('#formCadastro').submit();
            });

            $("#formCadastro").submit(function (e) {
                e.preventDefault();
                var actionurl = e.currentTarget.action;

                $.ajax({
                    url: actionurl,
                    type: 'post',
                    dataType: 'json',
                    data: $("#formCadastro").serialize(),
                    success: function (data) {
                        if (data.success) {
                            $('#successModal').modal('show');
                        } else {
                            alert(data.message);
                        }
                    },
                    error: function () {
                        alert('Erro ao realizar seu cadastro');
                    }
                });
            });
        });
    </script>
</body>

</html>
