<?php
    session_start();
    include 'basic.html'; 
    include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minuta USM</title>
</head>
<body>
    
    <br><br>
    <?php 
    if(isset($_GET['enviar'])){
        $busqueda=$_GET['busqueda'];
        $consulta=$conn->query("SELECT * FROM recetas WHERE nombre LIKE '%$busqueda%'");
        while ($row = $consulta->fetch_array()) {
            echo $row['nombre'].'<br>';
        }
    }
    ?>


</body>
</html>