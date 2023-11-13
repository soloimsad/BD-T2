<?php
    include("connection.php");
    include "basic.html";
    
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0"> 
    <title>Iniciar Sesi&oacute;n</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            text-align: center;
            margin-top: 100px;
        }
        .form-container {
            width: 300px;
            margin: 0 auto;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }
        input[type="submit"] {
            background-color: #e69f06;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #e69f06;
        }
        a {
            text-decoration: none;
            color: #e69f06;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sabor USM</h1>
        <div class="form-container">
            <h2>Iniciar Sesi&oacute;n</h2>
            
            <form name= "form" action="procesar_login" method="POST">
                <input type="text" id= "correo" name="correo" placeholder="Correo electr&oacute;nico" required><br>
                <input type="password" id= "password" name="password" placeholder="Contrase&#241;a" required><br>
                <input type="submit" value="Iniciar Sesi&oacute;n">
            </form>
            <p>&iquest;No tienes una cuenta? <a href="register">Reg&iacute;strate</a></p>
        </div>
    </div>
</body>
</html>