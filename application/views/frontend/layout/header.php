
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
            <img src="<?=base_url("/assets/images/logo.png");?>" alt="Alerta Saúde">
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