<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include 'connection.php';
    include "basic.html";
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $sql = "SELECT id, correo, password, nombre FROM usuario WHERE correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];
        if (password_verify($password, $hashedPassword)) {
            
            session_start();
            $_SESSION['correo'] = $correo;
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['id_usuario'] = $row['id'];
            header("Location: welcome"); 
           
        } 
        
        else {
            echo "<script>
            window.location.href = 'login';
            alert('Contraseña incorrecta, intentar nuevamente.');
            </script>";
        }
    } 
    
    else {
        echo "<script>
        window.location.href = 'login';
        alert('Correo incorrecto, intentar nuevamente.');
        </script>";
    }
  
    $stmt->close();
    $conn->close();
} else {
    
    header("Location: login");
}
?>
