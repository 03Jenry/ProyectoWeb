<?php
	$mysqli = mysqli_connect("localhost","root","","gobierno");
	mysql_query("SET NAMES 'utf8'");
	if($mysqli -> connect_errno)
	{
		echo "fallo la conexion a Mysql :(".$mysqli->connect_errno.")".$mysqli->connect_errno;
	}
?>