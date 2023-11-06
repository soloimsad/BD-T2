<?php

    $servername= "localhost";
    $usuario= "root";
    $password= "MAINTEEMO1";
    $db_name = "sabor_usm";
    $conn = new mysqli($servername,$usuario,$password,$db_name);
    if($conn->connect_error){
        die("Conexión fallida".$conn->connect_error);
    }
    echo "";

?>