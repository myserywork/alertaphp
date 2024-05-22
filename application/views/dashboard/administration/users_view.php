<h6 class="mb-0 text-uppercase">Gerenciar Usuários</h6>
<hr />
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Sobrenome</th>
                        <th>CPF</th>
                        <th>E-mail</th>
                        <th>Ativo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr data-id="<?= $user->id; ?>">
                        <td>
                            <?= $user->id; ?>
                        </td>
                        <td>
                            <span class="editable">
                                <?= $user->first_name; ?>
                            </span>
                        </td>
                        <td>
                            <span class="editable">
                                <?= $user->last_name; ?>
                            </span>
                        </td>
                        <td>
                            <span class="editable">
                                <?= $user->cpf; ?>
                            </span>
                        </td>
                        <td>
                            <span class="editable">
                                <?= $user->email; ?>
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-primary btn-edit"
                                onClick="openEditModal(<?= $user->id; ?>)">Editar</button>
                            <button class="btn btn-success btn-update hidden"
                                onClick="updateUser(<?= $user->id; ?>)">Atualizar</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Sobrenome</th>
                        <th>CPF</th>
                        <th>E-mail</th>
                        <th>Ativo</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- Modal de Edição -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar" onClick="closeModal();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="editName">Nome</label>
                    <input type="text" class="form-control" id="editName">
                </div>
                <div class="form-group">
                    <label for="editLastName">Sobrenome</label>
                    <input type="text" class="form-control" id="editLastName">
                </div>
                <div class="form-group">
                    <label for="editCPF">CPF</label>
                    <input type="text" class="form-control" id="editCPF">
                </div>
                <div class="form-group">
                    <label for="editEmail">E-mail</label>
                    <input type="email" class="form-control" id="editEmail">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    onClick="closeModal();">Fechar</button>
                <button type="button" class="btn btn-primary" onClick="updateUser()">Atualizar</button>
            </div>
        </div>
    </div>
</div>

<script>
var selectedUserId; // Variável para armazenar o ID do usuário selecionado

function closeModal() {
    $('#editModal').modal('hide');
}

function openEditModal(userId) {
    selectedUserId = userId;
    var name = $('tr[data-id="' + userId + '"]').find('.editable:eq(0)').text().trim();
    var lastName = $('tr[data-id="' + userId + '"]').find('.editable:eq(1)').text().trim();
    var cpf = $('tr[data-id="' + userId + '"]').find('.editable:eq(2)').text().trim();
    var email = $('tr[data-id="' + userId + '"]').find('.editable:eq(3)').text().trim();

    $('#editName').val(name);
    $('#editLastName').val(lastName);
    $('#editCPF').val(cpf);
    $('#editEmail').val(email);

    $('#editModal').modal('show');
}

function updateUser() {
    var name = $('#editName').val();
    var lastName = $('#editLastName').val();
    var cpf = $('#editCPF').val();
    var email = $('#editEmail').val();

    // Envie os dados atualizados para o servidor via Ajax
    $.ajax({
        url: '<?= base_url("users/update_user"); ?>', // Substitua pelo URL do seu método de atualização no controlador
        method: 'POST',
        data: {
            id: selectedUserId,
            name: name,
            lastName: lastName,
            cpf: cpf,
            email: email
        },
        success: function(response) {
            // Atualizar os valores na tabela
            var row = $('tr[data-id="' + selectedUserId + '"]');
            row.find('.editable:eq(0)').text(name);
            row.find('.editable:eq(1)').text(lastName);
            row.find('.editable:eq(2)').text(cpf);
            row.find('.editable:eq(3)').text(email);

            $('#editModal').modal('hide');
            swal("Sucesso!", "Usuário atualizado com sucesso!", "success");
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}

$(document).ready(function() {
    $('#example').DataTable({
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json"
        }
    });
});
</script>