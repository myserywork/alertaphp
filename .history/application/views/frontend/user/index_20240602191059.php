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
</body>

</html>
