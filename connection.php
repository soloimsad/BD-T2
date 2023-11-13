<?php

    $servername= "localhost";
    $usuario= "root";
    $password= "1234";
    $db_name = "sabor_usm";
    $conn = new mysqli($servername,$usuario,$password,$db_name);
    if($conn->connect_error){
        die("Conexión fallida".$conn->connect_error);
    }
   

?>
