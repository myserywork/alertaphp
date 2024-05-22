<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imask/6.2.2/imask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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

        label {
            color: #9ba2a7;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }

        .custom-control {
            padding-left: 0 !important;
        }

        .form-check {
            padding-left: 1.5rem !important;
        }

        .weekDays {
            background-color: #e6f4ec;
            padding: 1.5rem;
            border-radius: 0.5rem;
            font-family: "Montserrat";
        }

        .days {
            margin-right: 0.5rem;
        }

        .modal {
            height: 30% !important;
            overflow: visible !important;
        }

        @media (max-width: 576px) {
            .form-group {
                margin-bottom: 1rem;
            }

            .bt-cadastro {
                width: 100%;
            }
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
                <h1 class="text-center" style="color:#6d7982;font-weight: 500;margin-bottom:2em;">CADASTRE-SE</h1>
                <form id="formCadastro" action="<?php echo site_url('cadastro/create'); ?>" method="post">
                    <fieldset>
                        <legend style="color:#6d7982;font-weight: 600;">Pessoal</legend>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nome">Nome:</label>
                                    <input type="text" class="form-control" id="nome" name="nome" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="data_nascimento">Data de Nascimento:</label>
                                    <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="doencas_cronicas">Doenças Crônicas:</label>
                                    <select class="form-control selectpicker" id="doencas_cronicas" name="doencas_cronicas[]" title="Selecione até 3 doenças..." multiple required data-max-options="3" data-live-search="true" data-style="btn-default">
                                        <?php foreach ($doencas as $doenca) : ?>
                                            <option value="<?= $doenca->id ?>"><?= $doenca->nome ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="naturalidade">Naturalidade:</label>
                                    <input type="text" class="form-control" id="naturalidade" name="naturalidade" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="genero">Gênero:</label>
                                    <select class="form-control" id="genero" name="genero" required>
                                        <option value="M">Masculino</option>
                                        <option value="F">Feminino</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cpf">CPF:</label>
                                    <input type="text" class="form-control" id="cpf" name="cpf" placeholder="___.___.___-__" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pin">PIN:</label>
                                    <input type="text" class="form-control" id="pin" name="pin" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="passwordConfirm">Confirmação do PIN:</label>
                                    <input type="text" class="form-control" id="passwordConfirm" name="passwordConfirm" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="observacao">Observação:</label>
                                    <textarea class="form-control" id="observacao" name="observacao" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend style="color:#6d7982;font-weight: 600;">Contato</legend>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">E-mail:</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="telefone">Celular com DDD:</label>
                                    <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(00) 0 0000-0000" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="telefoneConfirm">Telefone Fixo com DDD:</label>
                                    <input type="text" class="form-control" id="telefoneConfirm" name="telefoneConfirm" placeholder="(00) 0000-0000" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cep">CEP:</label>
                                    <input type="text" class="form-control" id="cep" name="cep" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="endereco">Endereço:</label>
                                    <input type="text" class="form-control" id="endereco" name="endereco" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="numero">Número:</label>
                                    <input type="number" class="form-control" id="numero" name="numero" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="complemento">Complemento:</label>
                                    <input type="text" class="form-control" id="complemento" name="complemento">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cidade">Cidade:</label>
                                    <input type="text" class="form-control" id="cidade" name="cidade" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="estado">Estado:</label>
                                    <input type="text" class="form-control" id="estado" name="estado" required>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend style="color:#6d7982;font-weight: 600;">Complementares</legend>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="altura">Altura [M]:</label>
                                    <input type="text" class="form-control" id="altura" name="altura" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="peso">Peso [KG]:</label>
                                    <input type="number" class="form-control" id="peso" name="peso" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group custom-control custom-radio">
                                    <label>Ingere Bebida Alcoólica?</label>
                                    <div class="form-check">
                                        <input class="custom-control-input" type="radio" name="bebida" id="bebida_sim" value="sim" required>
                                        <label class="custom-control-label" for="bebida_sim">Sim</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="custom-control-input" type="radio" name="bebida" id="bebida_nao" value="nao" required>
                                        <label class="custom-control-label" for="bebida_nao">Não</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group custom-control custom-radio">
                                    <label>Fumante?</label>
                                    <div class="form-check">
                                        <input class="custom-control-input" type="radio" name="fumante" id="fumante_sim" value="sim" required>
                                        <label class="custom-control-label" for="fumante_sim">Sim</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="custom-control-input" type="radio" name="fumante" id="fumante_nao" value="nao" required>
                                        <label class="custom-control-label" for="fumante_nao">Não</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group custom-control custom-radio">
                                    <label>Possui Alergia a Remédios?</label>
                                    <div class="form-check">
                                        <input class="custom-control-input" type="radio" name="alergia" id="alergia_sim" value="sim" required>
                                        <label class="custom-control-label" for="alergia_sim">Sim</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="custom-control-input" type="radio" name="alergia" id="alergia_nao" value="nao" required>
                                        <label class="custom-control-label" for="alergia_nao">Não</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group custom-control custom-radio">
                                    <label>Possui Problema de Mobilidade?</label>
                                    <div class="form-check">
                                        <input class="custom-control-input" type="radio" name="mobilidade" id="mobilidade_sim" value="sim" required>
                                        <label class="custom-control-label" for="mobilidade_sim">Sim</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="custom-control-input" type="radio" name="mobilidade" id="mobilidade_nao" value="nao" required>
                                        <label class="custom-control-label" for="mobilidade_nao">Não</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group custom-control custom-radio">
                                    <label>Faz Terapia de Reabilitação?</label>
                                    <div class="form-check">
                                        <input class="custom-control-input" type="radio" name="terapia" id="terapia_sim" value="sim" required>
                                        <label class="custom-control-label" for="terapia_sim">Sim</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="custom-control-input" type="radio" name="terapia" id="terapia_nao" value="nao" required>
                                        <label class="custom-control-label" for="terapia_nao">Não</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group custom-control custom-radio">
                                    <label>Possui Plano de Saúde?</label>
                                    <div class="form-check">
                                        <input class="custom-control-input" type="radio" name="plano" id="plano_sim" value="sim" required>
                                        <label class="custom-control-label" for="plano_sim">Sim</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="custom-control-input" type="radio" name="plano" id="plano_nao" value="nao" required>
                                        <label class="custom-control-label" for="plano_nao">Não</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" id="plano_saude_detalhes">
                                    <label for="plano_saude">Qual Plano de Saúde?</label>
                                    <input type="text" class="form-control" id="plano_saude" name="plano_saude">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="profissao_atual">Profissão Atual:</label>
                                    <input type="text" class="form-control" id="profissao_atual" name="profissao_atual">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="profissao_anterior">Profissão Anterior:</label>
                                    <input type="text" class="form-control" id="profissao_anterior" name="profissao_anterior">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group custom-control custom-radio">
                                    <label>Possui Cuidador?</label>
                                    <div class="form-check">
                                        <input class="custom-control-input" type="radio" name="cuidador" id="cuidador_sim" value="sim" required>
                                        <label class="custom-control-label" for="cuidador_sim">Sim</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="custom-control-input" type="radio" name="cuidador" id="cuidador_nao" value="nao" required>
                                        <label class="custom-control-label" for="cuidador_nao">Não</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="dadosCuidador" style="display:none;">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group" id="fg_nome_cuidador">
                                        <label for="nome_cuidador">Nome do Cuidador:</label>
                                        <input type="text" class="form-control" id="nome_cuidador" name="nome_cuidador">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" id="fg_celular_cuidador">
                                        <label for="celular_cuidador">Celular do Cuidador:</label>
                                        <input type="text" class="form-control" id="celular_cuidador" name="celular_cuidador" placeholder="(00) 0 0000-0000">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" id="fg_telefone_fixo_cuidador">
                                        <label for="telefone_fixo_cuidador">Telefone Fixo do Cuidador:</label>
                                        <input type="text" class="form-control" id="telefone_fixo_cuidador" name="telefone_fixo_cuidador" placeholder="(00) 0000-0000">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="flex-box weekDays">
                            <div style="color: #9ba2a7;text-transform: uppercase;margin-bottom: 12px;">
                                <label for="days">Quais os dias da semana que deseja receber a avaliação?</label>
                            </div>
                            <div class="input-content">
                                <div class="sc-iCKXBC daYHuF">
                                    <div class="list-radios">
                                        <label for="days0">
                                            <input id="days0" name="days[]" class="days" type="checkbox" value="segunda-feira">Segunda-feira
                                        </label>
                                        <label for="days1">
                                            <input id="days1" name="days[]" class="days" type="checkbox" value="terca-feira">Terça-feira
                                        </label>
                                        <label for="days2">
                                            <input id="days2" name="days[]" class="days" type="checkbox" value="quarta-feira">Quarta-feira
                                        </label>
                                        <label for="days3">
                                            <input id="days3" name="days[]" class="days" type="checkbox" value="quinta-feira">Quinta-feira
                                        </label>
                                        <label for="days4">
                                            <input id="days4" name="days[]" class="days" type="checkbox" value="sexta-feira">Sexta-feira
                                        </label>
                                        <label for="days5">
                                            <input id="days5" name="days[]" class="days" type="checkbox" value="sabado">Sábado
                                        </label>
                                        <label for="days6">
                                            <input id="days6" name="days[]" class="days" type="checkbox" value="domingo">Domingo
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="row mt-3 mb-3">
                        <div class="col-md-12 text-right">
                            <button type="button" id="submitBtn" class="btn btn-primary bt-cadastro">Cadastrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Inicializar máscaras de entrada
            IMask(document.getElementById('cpf'), { mask: '000.000.000-00' });
            IMask(document.getElementById('telefone'), { mask: '(00) 0 0000-0000' });
            IMask(document.getElementById('telefoneConfirm'), { mask: '(00) 0000-0000' });
            IMask(document.getElementById('cep'), { mask: '00000-000' });
            IMask(document.getElementById('altura'), { mask: '0.00' });
            IMask(document.getElementById('celular_cuidador'), { mask: '(00) 0 0000-0000' });
            IMask(document.getElementById('telefone_fixo_cuidador'), { mask: '(00) 0000-0000' });

            // Buscar endereço pelo CEP
            $('#cep').on('blur', function () {
                const cep = $(this).val().replace(/\D/g, '');
                if (cep !== '') {
                    const validacep = /^[0-9]{8}$/;
                    if (validacep.test(cep)) {
                        $.getJSON(`https://viacep.com.br/ws/${cep}/json/?callback=?`, function (dados) {
                            if (!('erro' in dados)) {
                                $('#endereco').val(dados.logradouro);
                                $('#cidade').val(dados.localidade);
                                $('#estado').val(dados.uf);
                            } else {
                                alert('CEP não encontrado.');
                            }
                        });
                    } else {
                        alert('Formato de CEP inválido.');
                    }
                }
            });

            $('input[type=radio][name=cuidador]').change(function () {
                if (this.value == 'sim') {
                    $('#dadosCuidador').slideDown();
                } else {
                    $('#dadosCuidador').slideUp();
                    $('#nome_cuidador').val('');
                    $('#celular_cuidador').val('');
                    $('#telefone_fixo_cuidador').val('');
                }
            });

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
                                window.open(`<?= base_url('poscadastro');?>/${data.pacient}`, '_blank');
                            });
                        } else {
                            const errorMessage = data.message.replace(/<\/?p>/g, '\n'); // Remove as tags <p> e </p> e adiciona uma quebra de linha
                            Swal.fire({
                                icon: 'error',
                                title: 'Erro!',
                                text: 'Erro ao realizar o cadastro:\n' + errorMessage,
                                customClass: {
                                    popup: 'swal2-error-popup',
                                    title: 'swal2-error-title',
                                    content: 'swal2-error-content'
                                }
                            });
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erro!',
                            text: 'Erro ao realizar o cadastro! Tente novamente.',
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>
