<?php
session_start();
include 'connection.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['id_usuario'])) {
    $idUsuario = $_SESSION['id_usuario'];
    $idReceta = $_POST['id_receta'];

    // Verificar si la receta ya está en favoritos
    $consultaExistencia = $conn->query("SELECT * FROM favoritos WHERE id_usuario = $idUsuario AND id_receta = $idReceta");

    if ($consultaExistencia->num_rows == 0) {
        // Agregar la receta a la lista de favoritos del usuario
        $conn->query("INSERT INTO favoritos (id_usuario, id_receta) VALUES ($idUsuario, $idReceta)");
        
        echo "<script>
            alert('Receta Agregada Correctamente');
            window.history.back();
            </script>";
    } else {
        echo "La receta ya está en favoritos.";
    }
} else {
    echo "Error al agregar la receta a favoritos.";
}

$conn->close();
?>
