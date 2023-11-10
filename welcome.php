<?php
    session_start();
    include 'basic.html'; 
    include 'connection.php';
 
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
                <li><a href="home">Minuta</a></li>
                <li><a href="home">Favoritos</a></li>
                
                <li><form action="welcome" method="get">
                    <input type="text" name="barra" >
                    <input type="submit" name="enviar" value="Buscar">


                </form></li>
               
            </li>
            </ul>
       
            <img src="img/llama.jpeg" class="user-pic" onclick="toggleMenu()">
        
            <div class="sub-menu-wrap" id="subMenu">
                <div class="sub-menu">
                    <div class="uer-info">

                        <img src="img/user.png" width="50" height="50">
                        <h2></h2>

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
                    echo $row['nombre'].'<br>';
                        
            }
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