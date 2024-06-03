<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Paciente</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f7fa;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background: white;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            margin-top: 20px;
            margin-bottom: 60px;
        }
        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            color:  #4c5258;;
            padding: 20px;
            border-radius: 15px;
        }
        .profile-header img {
            border-radius: 50%;
            margin-right: 20px;
            width: 80px;
            height: 80px;
            object-fit: cover;
            border: 3px solid #fff;
        }
        .profile-header div {
            font-size: 1.5em;
        }
        .btn-schedule {
            display: block;
            margin: 20px 0;
            padding: 10px 20px;
            background-color: #27ae60;
            color: white;
            border: none;
            border-radius: 25px;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
            font-size: 1em;
            transition: background 0.3s, transform 0.3s;
        }
        .btn-schedule:hover {
            background-color: #219150;
            transform: scale(1.05);
        }
        .tabs {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .tabs button {
            flex: 1 0 30%;
            display: flex;
            flex
