session_start();
include 'basic.html'; 
include 'connection.php';

if (isset($_GET['ver_receta'])) {
    $idReceta = $_GET['ver_receta'];
    
    // Obtener la información de la receta
    $consultaReceta = $conn->query("SELECT r.*, c.calificacion
                                    FROM recetas r
                                    LEFT JOIN calificaciones c ON r.id_receta = c.id_receta
                                    WHERE r.id_receta = $idReceta");
    $receta = $consultaReceta->fetch_assoc();

    // Mostrar la receta
    echo '<div class="receta">';
    echo '<h3>' . $receta['nombre'] . '</h3>';
    echo '<img src="' . $receta['url_foto'] . '" alt="' . $receta['nombre'] . '" style="width: 200px; height: 150px;">';
    echo '<p>Tipo de Platillo: ' . $receta['tipo_platillo'] . '</p>';
    echo '<p>Tiempo de Preparación: ' . $receta['tiempo_preparacion'] . '</p>';
    echo '<p>Instrucciones: ' . $receta['instrucciones'] . '</p>';

    echo '<form action="favoritos" method="post" style="display: flex; justify-content: flex-start;">';
    echo '<input type="hidden" name="id_receta" value="' . $receta['id_receta'] . '">';
    echo '<input type="submit" value="Agregar a Favoritos">';
    echo '</form>';

    // Mostrar la calificación del usuario logueado si está disponible, de lo contrario, mostrar un mensaje alternativo
    if ($receta['calificacion'] !== null) {
        echo '<p>Su Calificación: ' . $receta['calificacion'] . '</p>';
    } else {
        echo '<p>Aún no ha calificado esta receta.</p>';
    }

    echo '<form action="calificar" method="post">';
    echo '<input type="hidden" name="id_receta" value="' . $receta['id_receta'] . '">';
    echo '<label for="calificacion">Calificación (1-5):</label>';
    echo '<input type="number" name="calificacion" min="1" max="5" required>';
    echo '<input type="submit" value="Calificar">';
    echo '</form>';

    echo '</div>';
}
