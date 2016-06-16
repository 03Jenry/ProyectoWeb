<?php
session_start();
session_destroy();
include('conexion.php');
	$usuario = $_POST["usuario"];
	$password = $_POST["pass"];
	$sql = "select idusuarios,nombre,contrasenia from usuarios where nombre ='".$usuario."'and contrasenia='".$password."'";
	$consulta = mysqli_query($mysqli,$sql);
	
	if($row = mysqli_fetch_array($consulta))
	{
		include('principal.html');
		//echo " Sesion iniciada";
		//echo "<br/>";
		//echo $usuario;
		setcookie($usuario,"Hola!");
		
	}
	else
	{
		//echo "Usuario o contraseña incorrectos";
		include('login.html');

	}

?>