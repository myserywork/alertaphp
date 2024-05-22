<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Database Error</title>
<style type="text/css">
body {
    background-color: #f8f8f8;
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}

.container {
    max-width: 500px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #d0d0d0;
    border-radius: 5px;
    box-shadow: 0 0 8px #d0d0d0;
}

h1 {
    color: #333;
    font-size: 24px;
    margin: 0 0 14px;
    padding: 14px 15px 10px;
    border-bottom: 1px solid #d0d0d0;
}

p {
    margin: 12px 15px;
    font-size: 13px;
    line-height: 20px;
    color: #4f5155;
}

a {
    color: #003399;
    font-weight: normal;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

code {
    font-family: Consolas, Monaco, Courier New, Courier, monospace;
    font-size: 12px;
    background-color: #f9f9f9;
    border: 1px solid #d0d0d0;
    color: #002166;
    display: block;
    margin: 14px 0;
    padding: 12px 10px;
}
</style>
</head>
<body>
    <div class="container">
        <h1><?php echo $heading; ?></h1>
        <?php echo $message; ?>
    </div>
</body>
</html>
