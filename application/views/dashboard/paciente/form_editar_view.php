
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <form class="row g-3" id="formPaciente" action="url_para_processamento_dos_dados" method="post">
        <div class="col-md-6">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="col-md-6">
            <label for="genero" class="form-label">Gênero</label>
            <select id="genero" class="form-select" name="genero" required>
                <option selected disabled value="">Escolha...</option>
                <option value="Masculino">Masculino</option>
                <option value="Feminino">Feminino</option>
                <option value="Outro">Outro</option>
            </select>
        </div>
    
        <div class="col-md-6">
            <label for="dataNascimento" class="form-label">Data de Nascimento</label>
            <input type="date" class="form-control" id="dataNascimento" name="dataNascimento" required>
        </div>
        <div class="col-md-6">
            <label for="cpf" class="form-label">CPF</label>
            <input type="text" class="form-control" id="cpf" name="cpf" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" placeholder="000.000.000-00" required>
        </div>
        <div class="col-md-6">
            <label for="rg" class="form-label">RG</label>
            <input type="text" class="form-control" id="rg" name="rg">
        </div>
        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="col-md-6">
            <label for="cep" class="form-label">CEP</label>
            <input type="text" class="form-control" id="cep" name="cep" pattern="\d{5}-\d{3}" placeholder="00000-000" onblur="buscarCEP()" required>
        </div>
        <div class="col-md-6">
            <label for="estadoCivil" class="form-label">Estado Civil</label>
            <select id="estadoCivil" class="form-select" name="estadoCivil">
                <option selected disabled value="">Escolha...</option>
                <option value="Solteiro">Solteiro(a)</option>
                <option value="Casado">Casado(a)</option>
                <option value="Divorciado">Divorciado(a)</option>
                <option value="Viúvo">Viúvo(a)</option>
            </select>
        </div>
        <div class="col-12">
            <label for="endereco" class="form-label">Endereço</label>
            <input type="text" class="form-control" id="endereco" name="endereco" required>
        </div>
        <div class="col-md-6">
            <label for="cidade" class="form-label">Cidade</label>
            <input type="text" class="form-control" id="cidade" name="cidade" required>
        </div>
        <div class="col-md-6">
            <label for="estado" class="form-label">Estado</label>
            <input type="text" class="form-control" id="estado" name="estado" required>
        </div>
        <div class="col-md-6">
            <label for="profissaoAtual" class="form-label">Profissão Atual</label>
            <input type="text" class="form-control" id="profissaoAtual" name="profissaoAtual">
        </div>
        <div class="col-md-6">
            <label for="profissaoAnterior" class="form-label">Profissão Anterior</label>
            <input type="text" class="form-control" id="profissaoAnterior" name="profissaoAnterior">
        </div>
        <div class="col-12">
            <label for="observacoes" class="form-label">Observações</label>
            <textarea class="form-control" id="observacoes" name="observacoes" rows="4"></textarea>
        </div>
        <div class="col-12">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Salvar Informações</button>
            </div>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    function buscarCEP() {
        var cep = document.getElementById('cep').value.replace(/\D/g, '');
        if (cep !== "") {
            var url = "https://viacep.com.br/ws/" + cep + "/json/";

            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    if (!("erro" in response)) {
                        document.getElementById('endereco').value = response.logradouro;
                        document.getElementById('cidade').value = response.localidade;
                        document.getElementById('estado').value = response.uf;
                    } else {
                        alert("CEP não encontrado.");
                    }
                },
                error: function() {
                    alert("Erro ao buscar o CEP.");
                }
            });
        }
    }

    document.getElementById('formPaciente').onsubmit = function() {
        return validarFormulario();
    };

    function validarFormulario() {
        var cpf = document.getElementById('cpf').value.replace(/\D/g, '');
        if (cpf.length !== 11) {
            alert('CPF inválido. Deve conter 11 dígitos.');
            return false;
        }
        return true;
    }
    </script>

