<!DOCTYPE html>
<html>

<head>
    <title>Lista de Backups</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Lista de Backups</h2>

        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Arquivo</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($files as $backup): ?>
                    <tr>
                        <td>
                            <?php echo $backup['file']; ?>
                        </td>
                        <td>
                            <?php echo $backup['date']; ?>
                        </td>
                        <td>
                            <a href="<?php echo site_url('databasebackup/import_backup/' . $backup['file']); ?>"
                                class="btn btn-primary">Importar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2 class="mt-5">Importar Backup</h2>

        <form action="<?php echo site_url('databasebackup/import_backup'); ?>" method="post"
            enctype="multipart/form-data" class="mt-4">
            <div class="form-group">
                <label for="backupFile">Selecione o backup:</label>
                <input type="file" name="backupFile" id="backupFile" class="form-control-file">
            </div>
            <button type="submit" class="btn btn-primary">Importar</button>
        </form>

        <h2 class="mt-5">Realizar Backup</h2>

        <form action="<?php echo site_url('databasebackup/do_backup'); ?>" method="post" class="mt-4">
            <button type="submit" class="btn btn-primary">Realizar Backup</button>
        </form>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>