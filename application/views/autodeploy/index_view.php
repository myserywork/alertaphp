<!DOCTYPE html>
<html>

<head>
    <title>Auto Deploy</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Auto Deploy</h2>

        <form action="<?php echo site_url('autodeploy/deploy'); ?>" method="post" class="mt-4">
            <div class="form-group">
                <label for="message">Mensagem do Commit:</label>
                <input type="text" name="message" id="message" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Deploy</button>
        </form>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>