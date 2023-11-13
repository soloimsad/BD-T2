<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    include 'connection.php';
    include "basic.html";
    date_default_timezone_set('America/Santiago');  
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $almuerzos_d = 0;
    $lastseen = date('Y-m-d H:i:s');
    $sql = "SELECT correo FROM usuario WHERE correo = ?";   
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      
        echo "<script>
        window.location.href = 'register';
        alert('El correo ya existe. Por favor, elige otro correo.');
        </script>";
    } 

    else {
      
        $hashedPassword = password_hash($contrasena, PASSWORD_BCRYPT);
        $sql = "INSERT INTO usuario (nombre, correo, password, almuerzos_d, lastseen) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $nombre, $correo, $hashedPassword, $almuerzos_d, $lastseen);
        if ($stmt->execute()) {
            header("Location: welcome");
        } 
        
        else {    
            header("Location: registro.php?error=2");
        }
    }
    $stmt->close();
    $conn->close();
} 

else {
    
    header("Location: registro");
}
?>
