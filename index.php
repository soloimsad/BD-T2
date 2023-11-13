<?php


	if ((!isset($_SESSION['id_usuario']) || $_SESSION['id_usuario']=="") ||(!isset($_SESSION['nombre']) || $_SESSION['nombre'])==""){
		session_destroy();
		if (headers_sent()){
			echo "<script> window.location.href= 'home';<script>";
			
		}

		else{
			header("Location:home");
		}
	}
	exit;
?>

