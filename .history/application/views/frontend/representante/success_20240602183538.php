<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensagem de Sucesso</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        .success-msg {
            margin-top: 50px;
            text-align: center;
        }

        .success-msg .alert {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }

        .contact-form {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .contact-form .form-control {
            border-radius: 0.25rem;
            background: #ffffff;
            border: 1px solid #ced4da;
            padding: 0.75rem 1rem;
            color: #495057;
            font-size: 1rem;
        }

        .contact-form .btn {
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

        .contact-form .btn:hover {
            background-color: #00a653;
        }

        .logo {
            max-height: 100px;
            margin-right: 20px;
        }

        @media (max-width: 576px) {
            .contact-form .form-group {
                margin-bottom: 1rem;
            }

            .contact-form .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="success-msg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Cadastro realizado com sucesso!</h4>
                        <p>Seu cadastro foi realizado com sucesso. Em breve entraremos em contato.</p>
                        <hr>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="contact-form">
                        <div class="row">
                            <div class="col-md-2 text-center">
                                <img src="path_to_logo.png" alt="Logo" class="logo">
                            </div>
                            <div class="col-md-10">
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
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>
