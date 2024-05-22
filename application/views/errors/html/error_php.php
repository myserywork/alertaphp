<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Error</title>
<style type="text/css">
body {
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}

.container {
    max-width: 500px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #990000;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

h4 {
    color: #990000;
    font-size: 24px;
    margin: 0 0 20px;
    padding: 0;
}

p {
    margin: 0 0 10px;
    color: #555;
    font-size: 16px;
}

.backtrace {
    margin-left: 10px;
}
</style>
</head>
<body>
    <div class="container">
        <h4>A PHP Error was encountered</h4>

        <p>Severity: <?php echo $severity; ?></p>
        <p>Message:  <?php echo $message; ?></p>
        <p>Filename: <?php echo $filepath; ?></p>
        <p>Line Number: <?php echo $line; ?></p>

        <?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>
            <p>Backtrace:</p>
            <?php foreach (debug_backtrace() as $error): ?>
                <?php if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0): ?>
                    <div class="backtrace">
                        <p>File: <?php echo $error['file'] ?></p>
                        <p>Line: <?php echo $error['line'] ?></p>
                        <p>Function: <?php echo $error['function'] ?></p>
                    </div>
                <?php endif ?>
            <?php endforeach ?>
        <?php endif ?>
    </div>
</body>
</html>
