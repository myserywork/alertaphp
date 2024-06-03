
<?php 

$this->load->view('frontend/layout/header.php');?>
   
   
   <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="">
                    <div class="card-body">
                 
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

    <style>
        .btn-urgent  {
            color: #fff !important;
        }
    </style>

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
                    url: '<?php echo base_url('user/verifyLogin') ?>',
                    type: 'post',
                    dataType: 'json',
                    data: $("#formLogin").serialize(),
                    success: function (data) {
                        if (data.success) {
                            $('#successModal').modal('show');
                            setTimeout(function () {
                                window.location.href = '<?php echo base_url('user/perfil') ?>';
                            }, 2000);
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
