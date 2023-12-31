<?php
    session_start();
    include 'basic.html'; 
    include 'connection.php';
    //include 'index.php';
   
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="hero">
        <nav>
            <img src="img/favicon.ico" class="logo">
       
            <ul>
                <li><a href="#">Minuta</a></li>
                <li><a href="#">Top</a></li>
                <li><a href="welcome?favoritos">Favoritos</a></li>
                
                
                <li><form action="welcome" method="get">
                    <input type="text" name="barra" >
                    <input type="submit" name="enviar" value="Buscar">
                   
                </form></li>
               
            
            </ul>

            
            <img src="img/llama2.gif" class="user-pic" onclick="toggleMenu()">
            

            <div class="sub-menu-wrap" id="subMenu">
                <div class="sub-menu">
                    <div class="uer-info">

                        <img src="img/llama2.gif" width="50" height="50">
                        <h2><strong><?php echo $_SESSION['nombre']; ?></h3>
                    </div>
                    <hr>
                    <a href="#" class="sub-menu-link">
                        <img src="img/profile.png"  >
                        <p>Ver Perfil</p>
                        <span>></span>
                    
                    </a>
                    <a href="#" class="sub-menu-link">
                        <img src="img/pngwing.com.png">
                        <p>Mis Favoritos</p>
                        <span>></span>
                    
                    </a>

                    <a href="logout" class="sub-menu-link">
                        <img src="img/logout.png">
                        <p>Cerrar Sesi&oacute;n</p>
                        <span>></span>

                    </a>

                </div>    
            </div>
        </nav>


    <br>
    
    <?php
                    
        if(isset($_GET['enviar'])){
            $barra= $_GET['barra'];
            $consulta =$conn->query("SELECT * FROM recetas WHERE nombre LIKE '%$barra%'");
            while($row = $consulta->fetch_array()){
                echo '<div class="receta">';
                echo '<h3>' . $row['nombre'] . '</h3>';
                
                echo '<img src="' . $row['url_foto'] . '" alt="' . $row['nombre'] . '" style="width: 200px; height: 150px;">';

                echo '<form action="welcome" method="get">';
                echo '<input type="hidden" name="ver_receta" value="' . $row['id_receta'] . '">';
                echo '<input type="submit" value="Ver receta">';
                echo '</form>';

                
                echo '</div>';
                        
            }
        }

        if (isset($_GET['favoritos'])) {
            // Verificar si la variable de sesión está definida
            if (isset($_SESSION['id_usuario'])) {
                $idUsuario = $_SESSION['id_usuario'];
                $consultaFavoritos = $conn->query("SELECT r.*, f.id_usuario, ROUND(AVG(c.calificacion), 2) AS calificacion_promedio
                                                    FROM recetas r
                                                    LEFT JOIN favoritos f ON r.id_receta = f.id_receta
                                                    LEFT JOIN calificaciones c ON r.id_receta = c.id_receta
                                                    WHERE f.id_usuario = $idUsuario
                                                    GROUP BY r.id_receta;");

                while ($favorito = $consultaFavoritos->fetch_array()) {
                    echo '<div class="receta">';
                    echo '<h3>' . $favorito['nombre'] . '</h3>';
                    
                    // Mostrar la imagen de la receta
             
                    echo '<img src="' . $favorito['url_foto'] . '" alt="' . $favorito['nombre'] . '" style="width: 200px; height: 150px;">';

                    echo '<form action="welcome" method="get">';
                    echo '<input type="hidden" name="ver_receta" value="' . $favorito['id_receta'] . '">';
                    echo '<input type="submit" value="Ver receta">';
                    echo '</form>';

                    if ($favorito['calificacion_promedio'] !== null) {
                        echo '<p>Calificación Promedio: ' . $favorito['calificacion_promedio'] . '</p>';
                    } else {
                        echo '<p>Aún no hay calificación para esta receta.</p>';
                    }
                   
                    echo '</div>';
                }
            } else {
                echo "No se ha iniciado sesión correctamente.";
            }
        }
        if(isset($_GET['ver_receta'])){
            $idReceta = $_GET['ver_receta'];
            $idUsuario = $_SESSION['id_usuario'];
    
            // Obtener la información de la receta y la calificación del usuario logueado
            $consultaReceta = $conn->query("SELECT r.*, c.calificacion
                                            FROM recetas r
                                            LEFT JOIN calificaciones c ON r.id_receta = c.id_receta AND c.id_usuario = $idUsuario
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

            if ($receta['calificacion'] !== null) {
                echo '<p>Tu Calificación: ' . $receta['calificacion'] . '</p>';
            } else {
                echo '<p>Aún no hay calificación para esta receta.</p>';
            }

            echo '<form action="calificar" method="post">';
            echo '<input type="hidden" name="id_receta" value="' . $receta['id_receta'] . '">';
            echo '<label for="calificacion">Calificación (1-5):</label>';
            echo '<input type="number" name="calificacion" min="1" max="5" required>';
            echo '<input type="submit" value="Calificar">';
            echo '</form>';

            echo '<form action="calificar" method="GET">';
            echo '<input type="hidden" name="delete" value="'.$receta['id_receta'].'">';
            echo '<button type="submit">Eliminar Calificación</button>';
            echo '</form>';

            echo '</div>';
        }
    

        

    ?>
    
    <script>
        let subMenu =document.getElementById("subMenu");
        function toggleMenu(){
            subMenu.classList.toggle("open-menu");   
        }
    </script>
    
</div>
</body>
</html>