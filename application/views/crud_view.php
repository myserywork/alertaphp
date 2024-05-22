<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciador CRUD com Campos Customizados</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .truncate {
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .loader {
            display: none;
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
            position: absolute;
            left: 50%;
            top: 50%;
            margin-left: -60px;
            margin-top: -60px;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .dataTables_wrapper .dataTables_filter {
            float: right;
            text-align: right;
        }
        .dataTables_wrapper .dataTables_paginate {
            float: right;
            text-align: right;
        }
        .dataTables_wrapper .dataTables_info {
            float: left;
        }
        .dataTables_wrapper .dataTables_length {
            float: left;
        }
        .header-stats {
            display: flex;
            justify-content: flex-end;
            gap: 2rem;
            font-size: 0.875rem;
        }
        .stat-item {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .stat-item span {
            font-size: 1.25rem;
            font-weight: 600;
        }
        .modal-body .row > .col-md-6 {
            margin-bottom: 15px;
        }
    </style>
</head>
<body class="bg-light text-dark">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><i class="fas fa-database"></i> Gerenciador CRUD</a>
        <div class="header-stats ms-auto">
            <div class="stat-item">
                <span id="diskUsage">0 MB</span>
                <p class="text-light">Uso de Disco</p>
            </div>
            <div class="stat-item">
                <span id="memoryUsage">0 MB</span>
                <p class="text-light">Uso de Memória</p>
            </div>
        </div>
        <div class="d-flex">
            <button class="btn btn-primary me-2" id="createDatabaseBtn">Criar Banco de Dados</button>
            <button class="btn btn-success" id="aiSearchBtn">Busca com IA</button>
        </div>
    </div>
</nav>

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Bancos de Dados</h5>
                    <ul id="databaseList" class="list-group"></ul>
                </div>
            </div>
        </div>
        <div class="col-md-2" id="tableContainer" style="display:none;">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tabelas</h5>
                    <ul id="tableList" class="list-group"></ul>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Dados</h5>
                    <div class="d-flex mb-4">
                        <button class="btn btn-primary me-2" id="createRecordBtn">Criar Registro</button>
                        <button class="btn btn-danger me-2" id="deleteSelectedBtn">Excluir Selecionados</button>
                        <button class="btn btn-success me-2" id="exportJsonBtn">Exportar JSON</button>
                        <input type="file" class="form-control-file me-2" id="importJsonInput">
                    </div>
                    <table id="dataTable" class="table table-striped display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="selectAllRowsCheckbox"></th>
                                <th>ID</th>
                                <!-- Adicione outros cabeçalhos de coluna dinamicamente -->
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody id="dataRows">
                            <!-- Linhas de dados serão adicionadas dinamicamente aqui -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Database Modal -->
<div id="createDatabaseModal" class="modal fade" tabindex="-1" aria-labelledby="createDatabaseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDatabaseModalLabel">Criar Novo Banco de Dados</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createDatabaseForm">
                    <div class="mb-3">
                        <label for="newDatabaseName" class="form-label">Nome do Banco de Dados</label>
                        <input type="text" class="form-control" id="newDatabaseName">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Criar Banco de Dados</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Create Record Modal -->
<div id="createRecordModal" class="modal fade" tabindex="-1" aria-labelledby="createRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createRecordModalLabel">Criar Novo Registro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createRecordForm" class="row">
                    <!-- Campos de entrada serão adicionados dinamicamente aqui -->
                    <div class="modal-footer col-12">
                        <button type="submit" class="btn btn-primary">Criar Registro</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Record Modal -->
<div id="editRecordModal" class="modal fade" tabindex="-1" aria-labelledby="editRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRecordModalLabel">Editar Registro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editRecordForm" class="row">
                    <!-- Campos de entrada serão adicionados dinamicamente aqui -->
                    <div class="modal-footer col-12">
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- AI Search Modal -->
<div id="aiSearchModal" class="modal fade" tabindex="-1" aria-labelledby="aiSearchModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="aiSearchModalLabel">Busca com IA</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="aiSearchForm">
                    <div class="mb-3">
                        <label for="aiSearchQuery" class="form-label">Consulta de Busca</label>
                        <textarea class="form-control" id="aiSearchQuery" rows="5"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Gerar Relatório</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        let activeTable = null;

        function loadDatabases() {
            $.ajax({
                url: '<?php echo base_url('crud/handle_request?action=list_databases'); ?>',
                method: 'GET',
                success: function(data) {
                    var databases = JSON.parse(data);
                    $('#databaseList').empty();
                    $.each(databases, function(index, database) {
                        $('#databaseList').append('<li class="list-group-item list-group-item-action" data-db="' + database.Database + '">' + database.Database + '</li>');
                    });
                }
            });
        }

        function loadTables(database) {
            $.ajax({
                url: '<?php echo base_url('crud/handle_request?action=list_tables&database='); ?>' + database,
                method: 'GET',
                success: function(data) {
                    var tables = JSON.parse(data);
                    $('#tableList').empty();
                    $.each(tables, function(index, table) {
                        $('#tableList').append('<li class="list-group-item list-group-item-action" data-table="' + table + '">' + table + '</li>');
                    });
                    $('#tableContainer').show();
                }
            });
        }

        function sanitizeHTML(str) {
            var temp = document.createElement('div');
            temp.textContent = str;
            return temp.innerHTML;
        }

        function loadData(table) {
            activeTable = table;
            $.ajax({
                url: '<?php echo base_url('crud/handle_request?action=get_all&table='); ?>' + table,
                method: 'POST',
                success: function(data) {
                    data = JSON.parse(data);
                    if (data.status === 'error') {
                        alert(data.message);
                    } else {
                        var columns = Object.keys(data[0] || {});
                        var rows = data;
                        var tableHeader = '<tr>';
                        tableHeader += '<th><input type="checkbox" id="selectAllRowsCheckbox"></th>';
                        tableHeader += '<th>ID</th>';
                        $.each(columns, function(index, column) {
                            tableHeader += '<th>' + sanitizeHTML(column) + '</th>';
                        });
                        tableHeader += '<th>Ações</th>';
                        tableHeader += '</tr>';
                        $('#dataTable thead').html(tableHeader);
                        var tableRows = '';
                        $.each(rows, function(index, row) {
                            tableRows += '<tr>';
                            tableRows += '<td><input type="checkbox" class="row-checkbox" value="' + row.id + '"></td>';
                            tableRows += '<td>' + sanitizeHTML(row.id) + '</td>';
                            $.each(columns, function(index, column) {
                                tableRows += '<td class="truncate" title="' + sanitizeHTML(row[column]) + '">' + sanitizeHTML(row[column]) + '</td>';
                            });
                            tableRows += '<td>';
                            tableRows += '<button class="btn btn-sm btn-primary me-2 edit-btn" data-row=\'' + JSON.stringify(row) + '\'><i class="fas fa-edit"></i></button>';
                            tableRows += '<button class="btn btn-sm btn-danger delete-btn" data-id="' + row.id + '"><i class="fas fa-trash"></i></button>';
                            tableRows += '</td></tr>';
                        });
                        $('#dataTable tbody').html(tableRows);
                        initializeDataTable();
                    }
                }
            });
        }

        function initializeDataTable() {
            $('#dataTable').DataTable({
                responsive: true,
                scrollX: true,
                destroy: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        }

        function updateUsageStats() {
            $.ajax({
                url: '<?php echo base_url('crud/handle_request?action=get_usage_stats'); ?>',
                method: 'GET',
                success: function(data) {
                    var stats = JSON.parse(data);
                    $('#diskUsage').text(stats.diskUsage + ' MB');
                    $('#memoryUsage').text(stats.memoryUsage + ' MB');
                }
            });
        }

        $('#databaseList').on('click', 'li', function() {
            var database = $(this).data('db');
            $('#tableContainer').hide();
            loadTables(database);
        });

        $('#tableList').on('click', 'li', function() {
            var table = $(this).data('table');
            $('#dataTable').DataTable().clear().destroy();  // Destruir a tabela antes de carregar os novos dados
            loadData(table);
        });

        $('#createDatabaseBtn').click(function() {
            $('#createDatabaseModal').modal('show');
        });

        $('#createDatabaseForm').submit(function(e) {
            e.preventDefault();
            var databaseName = $('#newDatabaseName').val();
            $.ajax({
                url: '<?php echo base_url('crud/handle_request?action=create_database'); ?>',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({ database: databaseName }),
                success: function(data) {
                    alert(data.message);
                    $('#createDatabaseModal').modal('hide');
                    loadDatabases();
                }
            });
        });

        $('#createRecordBtn').click(function() {
            $.ajax({
                url: '<?php echo base_url('crud/handle_request?action=list_columns&table='); ?>' + activeTable,
                method: 'GET',
                success: function(data) {
                    var columns = JSON.parse(data);
                    $('#createRecordForm').empty();
                    $.each(columns, function(index, column) {
                        $('#createRecordForm').append('<div class="col-md-6"><label class="form-label">' + column + '</label><input type="text" class="form-control" id="' + column + '"></div>');
                    });
                    $('#createRecordForm').append('<div class="modal-footer col-12"><button type="submit" class="btn btn-primary">Criar Registro</button><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button></div>');
                    $('#createRecordModal').modal('show');
                }
            });
        });

        $('#createRecordForm').submit(function(e) {
            e.preventDefault();
            var newRow = {};
            $('#createRecordForm').find('input').each(function() {
                var column = $(this).attr('id');
                var value = $(this).val();
                newRow[column] = value;
            });
            $.ajax({
                url: '<?php echo base_url('crud/handle_request?action=create'); ?>',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({ table: activeTable, data: newRow }),
                success: function(data) {
                    alert(data.message);
                    $('#createRecordModal').modal('hide');
                    loadData(activeTable);
                }
            });
        });

        $('#dataRows').on('click', '.edit-btn', function() {
            var row = $(this).data('row');
            $('#editRecordForm').empty();
            $.each(row, function(column, value) {
                $('#editRecordForm').append('<div class="col-md-6"><label class="form-label">' + column + '</label><input type="text" class="form-control" id="' + column + '" value="' + sanitizeHTML(value) + '"></div>');
            });
            $('#editRecordForm').append('<div class="modal-footer col-12"><button type="submit" class="btn btn-primary">Salvar Alterações</button><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button></div>');
            $('#editRecordModal').modal('show');
        });

        $('#editRecordForm').submit(function(e) {
            e.preventDefault();
            var editedRow = {};
            $('#editRecordForm').find('input').each(function() {
                var column = $(this).attr('id');
                var value = $(this).val();
                editedRow[column] = sanitizeHTML(value);
            });
            $.ajax({
                url: '<?php echo base_url('crud/handle_request?action=update'); ?>',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({ table: activeTable, id: editedRow.id, data: editedRow }),
                success: function(data) {
                    alert(data.message);
                    $('#editRecordModal').modal('hide');
                    loadData(activeTable);
                }
            });
        });

        $('#dataRows').on('click', '.delete-btn', function() {
            var id = $(this).data('id');
            if (confirm('Tem certeza de que deseja excluir este registro?')) {
                $.ajax({
                    url: '<?php echo base_url('crud/handle_request?action=delete'); ?>',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({ table: activeTable, id: id }),
                    success: function(data) {
                        alert(data.message);
                        loadData(activeTable);
                    }
                });
            }
        });

        $('#selectAllRowsCheckbox').change(function() {
            var isChecked = $(this).is(':checked');
            $('.row-checkbox').prop('checked', isChecked);
        });

        $('#deleteSelectedBtn').click(function() {
            var ids = [];
            $('.row-checkbox:checked').each(function() {
                ids.push($(this).val());
            });
            if (ids.length > 0 && confirm('Tem certeza de que deseja excluir os registros selecionados?')) {
                $.ajax({
                    url: '<?php echo base_url('crud/handle_request?action=multi_delete'); ?>',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({ table: activeTable, ids: ids }),
                    success: function(data) {
                        alert(data.message);
                        loadData(activeTable);
                    }
                });
            }
        });

        $('#exportJsonBtn').click(function() {
            $.ajax({
                url: '<?php echo base_url('crud/handle_request?action=export_json&table='); ?>' + activeTable,
                method: 'GET',
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(data) {
                    var url = window.URL.createObjectURL(data);
                    var a = document.createElement('a');
                    a.style.display = 'none';
                    a.href = url;
                    a.download = activeTable + '.json';
                    document.body.appendChild(a);
                    a.click();
                    window.URL.revokeObjectURL(url);
                }
            });
        });

        $('#importJsonInput').change(function() {
            var file = this.files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                var jsonData = e.target.result;
                $.ajax({
                    url: '<?php echo base_url('crud/handle_request?action=import_json&table='); ?>' + activeTable,
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({ data: jsonData }),
                    success: function(data) {
                        alert(data.message);
                        loadData(activeTable);
                    }
                });
            };
            reader.readAsText(file);
        });

        $('#aiSearchBtn').click(function() {
            $('#aiSearchModal').modal('show');
        });

        $('#aiSearchForm').submit(function(e) {
            e.preventDefault();
            var query = $('#aiSearchQuery').val();
            $.ajax({
                url: '<?php echo base_url('crud/handle_request?action=generate_report'); ?>',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({ query: query, table: activeTable }),
                success: function(data) {
                    alert(data.message);
                    if (data.data) {
                        $('#data').html('<pre>' + data.data + '</pre>');
                    }
                    $('#aiSearchModal').modal('hide');
                }
            });
        });

        // Inicializar carregando bancos de dados
        loadDatabases();

        // Atualizar estatísticas de uso
        updateUsageStats();
        setInterval(updateUsageStats, 60000); // Atualizar a cada minuto
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
