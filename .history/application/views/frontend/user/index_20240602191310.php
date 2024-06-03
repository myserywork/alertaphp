<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alerta Saúde</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imask/6.2.2/imask.min.js"></script>

    <style>
        .navbar-brand img {
            max-height: 50px;
        }

        .navbar-nav .nav-link {
            color: #6d7982;
            font-weight: 500;
            text-transform: uppercase;
            margin: 0 0.5rem;
        }

        .navbar-nav .nav-link:hover {
            color: #00bc62;
        }

        .btn-urgent {
            background-color: #00bc62;
            color: white;
            font-weight: 700;
            text-transform: uppercase;
            border-radius: 2rem;
            padding: 0.5rem 1.5rem;
        }

        .btn-urgent:hover {
            background-color: #00a653;
        }

        .navbar-collapse {
            justify-content: flex-end;
        }

        .modal-header {
            border-bottom: none;
        }

        .modal-title {
            font-weight: 600;
        }

        .modal-body {
            text-align: center;
        }

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

        .bt-login {
            background-color: #00bc62;
            border: 0;
            border-radius: 2rem;
            padding: 0.75rem 1.5rem;
            color: white;
            font-size: 1rem;
            font-weight: 700;
            text-transform: uppercase;
            transition: background-color 0.3s;
            width: 100%;
        }

        .bt-login:hover {
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

        .form-group {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .forgot-password {
            text-align: center;
            margin-top: 1rem;
            font-weight: 600;
            color: #00bc62;
        }

        .forgot-password a {
            color: #00bc62;
            text-decoration: none;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="path/to/logo.png" alt="Alerta Saúde">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Sobre</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Objetivos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Como Funciona</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Doenças Crônicas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Seja um Parceiro</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contato</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Quero Associar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Teleconsultas</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-urgent" href="#">Chamada Urgente</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Avaliação urgente</h5>
                        <form id="formLogin" action="seu_script_de_login.php" method="post">
                            <fieldset>
                                <legend class="text-center" style="color:#6d7982;font-weight: 600;">Login de acesso</legend>
                                <div class="form-group">
                                    <label for="cpf">CPF:</label>
                                    <input type="text" class="form-control" id="cpf" name="cpf" placeholder="000.000.000-00" required>
                                    <div class="error" id="cpfError"></div>
                                </div>
                                <div class="form-group">
                                    <label for="pin">PIN:</label>
                                    <input type="password" class="form-control" id="pin" name="pin" placeholder="••••" required>
                                    <span class="toggle-password" id="togglePin">👁️</span>
                                    <div class="error" id="pinError"></div>
                                </div>
                            </fieldset>

                            <div class="row mt-3 mb-3">
                                <div class="col-md-12 text-center">
                                    <button type="button" id="submitBtn" class="btn bt-login">Entrar</button>
                                </div>
                            </div>
                            <div class="forgot-password">
                                <a href="#">Esqueci a senha</a>
                            </div>
                        </form>
                    </div>
                </div>
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
                    Login realizado com sucesso!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Inicializar máscara de CPF
            IMask(document.getElementById('cpf'), { mask: '000.000.000-00' });

            // Alternar visibilidade do PIN
            $('#togglePin').click(function () {
                const pinInput = $('#pin');
                const type = pinInput.attr('type') === 'password' ? 'text' : 'password';
                pinInput.attr('type', type);
                $(this).text($(this).text() === '👁️' ? '🙈' : '👁️');
            });

            $('#submitBtn').click(function () {
                var valid = true;
                $('.error').text(''); // Limpar mensagens de erro

                if (!$('#cpf').val()) {
                    $('#cpfError').text('O campo CPF é obrigatório.');
                    valid = false;
                }
                if (!$('#pin').val()) {
                    $('#pinError').text('O campo PIN é obrigatório.');
                    valid = false;
                }

                if (valid) {
                    $('#formLogin').submit();
                }
            });

            $("#formLogin").submit(function (e) {
                e.preventDefault();
                var actionurl = e.currentTarget.action;

                $.ajax({
                    url: actionurl,
                    type: 'post',
                    dataType: 'json',
                    data: $("#formLogin").serialize(),
                    success: function (data) {
                        if (data.success) {
                            $('#successModal').modal('show');
                        } else {
                            alert(data.message);
                        }
                    },
                    error: function () {
                        alert('Erro ao realizar o login');
                    }
                });
            });
        });
    </script>
</body>

</html>
