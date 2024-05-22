<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php foreach ($css_files as $file) : ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
    <?php endforeach; ?>
    <style>
        .btn-secondary {
            color: #fff !important;
            background-color: #005bea !important;
            border-color: #005bea !important;
        }

        .cancel-button {
            background-color: red !important;
        }

        #gcrud-search-form > div.header-tools > div.floatL.t5 > a {
            background-color: #1be123 !important;
            color: #fff !important;
            border-color: #1be123 !important;
        }

        #gcrud-search-form > div.scroll-if-required > table > tbody > tr > td:nth-child(1) > input {
            width: 20px;
            height: 20px;
            background: #ffffff;
            border-radius: 5px;
            border: 1px solid #cccccc;
            cursor: pointer;
            display: inline-block;
            margin: 0 0 10px 0;
            position: relative;
            top: 8px;
            left: 5px;
        }

        .table>thead {
            border-bottom: 0px !important;
            background-color: #fff !important;
            color: black !important;
        }

        .mini-sidebar-wrapper {
            background-image: linear-gradient(to top, rgb(0, 198, 251) 0%, rgb(0, 91, 234) 100%) !important;
        }

        .btn-primary {
            color: #fff !important;
            background-color: #005bea !important;
            border-color: #005bea !important;
        }

        .btn-primary:hover {
            color: #fff !important;
            background-color: #2658a6 !important;
            border-color: #2658a6 !important;
        }

        .btn-check:focus+.btn-primary,
        .btn-primary:focus {
            color: #fff !important;
            background-color: #2658a6 !important;
            border-color: #2658a6 !important;
            box-shadow: 0 0 0 .25rem rgba(0, 91, 234, 0.5) !important;
        }

        .btn-check:active+.btn-primary,
        .btn-check:checked+.btn-primary,
        .btn-primary.active,
        .btn-primary:active,
        .show>.btn-primary.dropdown-toggle {
            color: #fff !important;
            background-color: #2658a6 !important;
            border-color: #2658a6 !important;
        }

        .btn-check:active+.btn-primary:focus,
        .btn-check:checked+.btn-primary:focus,
        .btn-primary.active:focus,
        .btn-primary:active:focus,
        .show>.btn-primary.dropdown-toggle:focus {
            box-shadow: 0 0 0 .25rem rgba(0, 91, 234, 0.5) !important;
        }

        .btn-primary.disabled,
        .btn-primary:disabled {
            color: #fff !important;
            background-color: #005bea !important;
            border-color: #005bea !important;
        }

        .btn-outline-primary {
            color: #2658a6 !important;
            border-color: #2658a6 !important;
        }

        .btn-outline-primary:hover {
            color: #fff;
            background-color: #2658a6 !important;
            border-color: #2658a6 !important;
        }

        .btn-check:focus+.btn-outline-primary,
        .btn-outline-primary:focus {
            box-shadow: 0 0 0 .25rem rgb(84, 55, 145, 0.5)
        }

        .btn-check:active+.btn-outline-primary,
        .btn-check:checked+.btn-outline-primary,
        .btn-outline-primary.active,
        .btn-outline-primary.dropdown-toggle.show,
        .btn-outline-primary:active {
            color: #fff;
            background-color: #2658a6 !important;
            border-color: #2658a6 !important;
        }

        .btn-check:active+.btn-outline-primary:focus,
        .btn-check:checked+.btn-outline-primary:focus,
        .btn-outline-primary.active:focus,
        .btn-outline-primary.dropdown-toggle.show:focus,
        .btn-outline-primary:active:focus {
            box-shadow: 0 0 0 .25rem rgba(84, 55, 145, 0.5)
        }

        .btn-outline-primary.disabled,
        .btn-outline-primary:disabled {
            color: #2658a6 !important;
            background-color: transparent;
        }

        .btn-link {
            font-weight: 400;
            color: #2658a6 !important;
            text-decoration: underline
        }

        .text-primary {
            color: #2658a6 !important;
        }

        :root {
            --bs-blue: #2658a6 !important;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7f7ff;
        }

        .table-container {
            background-color: #fff !important;
            font-family: 'Roboto', sans-serif;
        }

        .table-label {
            background-color: #fff !important;
            color: #000;
            font-weight: bold;
        }

        .breadcrumb {
            background-color: transparent !important;
        }

        .table>tbody {
            border-style: none !important;
            border-color: transparent !important;
        }

        .table>thead {
            background-color: #5F6368;
            color: #fff;
        }

        .table-active {
            color: black !important;
            --bs-table-accent-bg: rgba(95, 99, 104, .9) !important;
            text-decoration: none;
        }

        .table-active>a {
            text-decoration: none;
            color: black !important;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #fff !important;
        }

        #report-success>p>a {
            color: #fff !important;
        }

        .form-horizontal {
            justify-content: center;
            align-items: center;
        }

        .crud-container {
            padding: 150px;
        }

        #gcrud-search-form > div.scroll-if-required > table > tbody > tr:nth-child(1) > td:nth-child(2) > div.only-desktops > div > button {
            background-color: #005bea !important;
            color: #fff !important;
            border-color: #005bea !important;
        }
    </style>
</head>

<body>
    <div class="container-full crud-container">
        <div class="table-container" style="padding: 10px">
            <?php echo $output; ?>
        </div>
    </div>
    <?php foreach ($js_files as $file) : ?>
    <script src="<?php echo $file; ?>"></script>
    <?php endforeach; ?>

    <script>
        function aumentarForm() {
            var resizeSmallElement = document.querySelector('.fa.el.fa-expand.fa-compress.el-resize-small');

            if (resizeSmallElement) {
                // Se o elemento de redimensionamento pequeno existir, está tudo certo
                return;
            } else {
                var resizeFullElement = document.querySelector('.fa.el.el-resize-full');

                if (resizeFullElement) {
                    // Se o elemento de redimensionamento completo existir, clique nele
                    resizeFullElement.click();
                }
            }
        }

        // Função para ser executada após 2 segundos
        function executarAposDoisSegundos() {
            setTimeout(aumentarForm, 1000);
        }

        // Executar a função após 2 segundos do carregamento da página
        window.addEventListener('load', executarAposDoisSegundos);
    </script>

    <!-- Script para buscar o endereço com base no CEP -->
    <script>
        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            document.getElementById('endereco').value = ("");
            document.getElementById('bairro').value = ("");
            document.getElementById('cidade').value = ("");
            document.getElementById('estado').value = ("");
        }

        function meu_callback(conteudo) {
            if (!("erro" in conteudo)) {
                // Atualiza os campos com os valores.
                document.getElementById('endereco').value = (conteudo.logradouro);
                document.getElementById('bairro').value = (conteudo.bairro);
                document.getElementById('cidade').value = (conteudo.localidade);
                document.getElementById('estado').value = (conteudo.uf);
            } else {
                // CEP não Encontrado.
                limpa_formulário_cep();
                alert("CEP não encontrado.");
            }
        }

        function pesquisacep(valor) {
            // Nova variável "cep" somente com dígitos.
            var cep = valor.replace(/\D/g, '');

            // Verifica se campo cep possui valor informado.
            if (cep != "") {

                // Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                // Valida o formato do CEP.
                if (validacep.test(cep)) {

                    // Preenche os campos com "..." enquanto consulta webservice.
                    document.getElementById('endereco').value = "...";
                    document.getElementById('bairro').value = "...";
                    document.getElementById('cidade').value = "...";
                    document.getElementById('estado').value = "...";

                    // Cria um elemento javascript.
                    var script = document.createElement('script');

                    // Sincroniza com o callback.
                    script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

                    // Insere script no documento e carrega o conteúdo.
                    document.body.appendChild(script);

                } else {
                    // cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } else {
                // cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        }
    </script>
</body>

</html>
