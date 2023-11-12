<?php
    
    include "basic.html";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
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
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div>
        <?php
        if(isset($_POST['create'])){
            echo "Ingreso exitoso";
        }
        ?>

    </div>
    <div class="container">
        <h1>Sabor USM</h1>
        <div class="form-container">
            <h2>Registro</h2>
            <form action="procesar_registro" method="POST">
                <input type="text" name="nombre" placeholder="Nombre completo" required><br>
                <input type="email" name="correo" placeholder="Correo electr&oacute;nico" required><br>
                <input type="password" name="contrasena" placeholder="Contrase&#241;a" required><br>
                <input type="submit" name = "create" value="Registrarse">
            </form>
        </div>
    </div>
</body>
</html>
