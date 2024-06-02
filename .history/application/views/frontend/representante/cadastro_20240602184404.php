<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Representante</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #495057;
        }

        .container {
            margin-top: 50px;
        }

        h1 {
            color: #4b4f56;
            font-weight: 600;
            margin-bottom: 30px;
        }

        .form-control {
            border-radius: 0.25rem;
            background: #ffffff;
            border: 1px solid #ced4da;
            padding: 0.75rem 1rem;
            color: #495057;
            font-size: 1rem;
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
            color: #4b4f56;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .success-msg .alert {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }

        .contact-form {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        .logo {
            max-height: 100px;
            margin-bottom: 20px;
        }

        @media (max-width: 576px) {
            .bt-cadastro-x {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center">SEJA UM REPRESENTANTE</h1>
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
                <div class="col-md-12 text-center">
                    <button type="button" id="submitBtn" class="btn btn-primary bt-cadastro-x">Cadastrar</button>
                </div>
            </div>
        </form>

        <div class="contact-form text-center">
            <img src="path_to_logo.png" alt="Logo" class="logo">
            <h4 class="mb-4">Formulário de Contato</h4>
            <form id="contactForm" action="<?php echo site_url('contact/submit'); ?>" method="post">
                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="message">Mensagem:</label>
                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary bt-cadastro-x">Enviar</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imask/6.2.2/imask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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
                            Swal.fire({
                                icon: 'success',
                                title: 'Sucesso!',
                                text: 'Cadastro realizado com sucesso! Você será redirecionado para mais detalhes.',
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                window.open(`<?= base_url('poscadastro');?>/${data.representante}`, '_blank');
                            });
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
