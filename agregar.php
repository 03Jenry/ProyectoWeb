<?php
session_start();
include('principal.html');
?>
<html>
    <link rel="stylesheet" href="estilo.css">
	<body>
<div class="container">
      <div id="login">
        <h2><span class="fontawesome-lock"></span>Registrar Beneficiario </h2>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <fieldset>
            <p><label for="Beneficiario">Beneficiario</label></p>
            <p><input type="text" name="nombres" placeholder="Nombre" required></p>
            <p><label for="curp">Curp</label></p>
            <p><input type="text" name="Curp" placeholder="Curp" required></p>
            <p><input type="submit" name="agregar"value="Agregar"></p>
          </fieldset>
        </form>
      </div> 
    </div>
	</body>
</html>
<?php
	include('conexion.php');
	if (isset($_POST['agregar'])) 
	{
		$nombre = $_POST['nombres'];
		$curp = $_POST['Curp'];
		$sql = "insert into beneficiarios (nombre, curp, cveloc,cvemun) VALUES ('".$nombre."','".$curp."','".$_SESSION['nomloc']."','".$_SESSION["nommun"]."')";
		$result = mysqli_query($mysqli,$sql);
		echo "¡Gracias! Hemos recibido sus datos";
	}
?>