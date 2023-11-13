<?php

    include('connection.php');
    session_start();
    $id_usuario=$_SESSION['id_usuario'];
    $result= $conn->query("SELECT actualizar_lastseen($id_usuario) as resultado");
    session_destroy();
    header("Location: home.html");

?>