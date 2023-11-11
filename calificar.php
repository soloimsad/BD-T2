<?php
session_start();
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si el usuario está autenticado
    if (isset($_SESSION['id_usuario'])) {
        $idUsuario = $_SESSION['id_usuario'];
        $idReceta = $_POST['id_receta'];
        $calificacion = $_POST['calificacion'];

        // Insertar la calificación en la base de datos
        $insertarCalificacion = $conn->prepare("INSERT INTO calificaciones (id_usuario, id_receta, calificacion) VALUES (?, ?, ?)");
        $insertarCalificacion->bind_param("iii", $idUsuario, $idReceta, $calificacion);
        
        if ($insertarCalificacion->execute()) {
            echo "<script>
                window.history.back();
                alert('Receta calificada correctamente.');
            </script>";
        } else {
            echo "<script>
                window.history.back();
                alert('Error al calificar la receta.');
            </script>";
        }

        $insertarCalificacion->close();
    } else {
        echo "<script>
            window.history.back();
            alert('Debe iniciar sesión para calificar la receta.');
        </script>";
    }
} else {
    echo "<script>
        window.history.back();
    </script>";
}
?>
