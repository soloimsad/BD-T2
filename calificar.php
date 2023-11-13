<?php
session_start();
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si el usuario está autenticado
    if (isset($_SESSION['id_usuario'])) {
        $idUsuario = $_SESSION['id_usuario'];
        $idReceta = $_POST['id_receta'];
        $calificacion = $_POST['calificacion'];

        // Verificar si ya existe una calificación del usuario para esta receta
        $verificarCalificacion = $conn->prepare("SELECT id_calificacion FROM calificaciones WHERE id_usuario = ? AND id_receta = ?");
        $verificarCalificacion->bind_param("ii", $idUsuario, $idReceta);
        $verificarCalificacion->execute();
        $verificarCalificacion->store_result();

        if ($verificarCalificacion->num_rows > 0) {
            // La calificación ya existe, actualizarla
            $actualizarCalificacion = $conn->prepare("UPDATE calificaciones SET calificacion = ? WHERE id_usuario = ? AND id_receta = ?");
            $actualizarCalificacion->bind_param("iii", $calificacion, $idUsuario, $idReceta);
            
            if ($actualizarCalificacion->execute()) {
                echo "<script>
                    window.history.back();
                    alert('Calificación actualizada correctamente.');
                </script>";
            } else {
                echo "<script>
                    window.history.back();
                    alert('Error al actualizar la calificación.');
                </script>";
            }

            $actualizarCalificacion->close();
        } else {
            // La calificación no existe, insertarla
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
        }

        $verificarCalificacion->close();
    } else {
        echo "<script>
            window.history.back();
            alert('Debe iniciar sesión para calificar la receta.');
        </script>";
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['delete'])) {
    // Verificar si el usuario está autenticado
    if (isset($_SESSION['id_usuario'])) {
        $idUsuario = $_SESSION['id_usuario'];
        $idReceta = $_GET['delete'];

        // Eliminar la calificación del usuario para esta receta
        $eliminarCalificacion = $conn->prepare("DELETE FROM calificaciones WHERE id_usuario = ? AND id_receta = ?");
        $eliminarCalificacion->bind_param("ii", $idUsuario, $idReceta);
        
        if ($eliminarCalificacion->execute()) {
            echo "<script>
                window.history.back();
                alert('Calificación eliminada correctamente.');
            </script>";
        } else {
            echo "<script>
                window.history.back();
                alert('Error al eliminar la calificación.');
            </script>";
        }

        $eliminarCalificacion->close();
    } else {
        echo "<script>
            window.history.back();
            alert('Debe iniciar sesión para eliminar la calificación.');
        </script>";
    }
} else {
    echo "<script>
        window.history.back();
    </script>";
}
?>
