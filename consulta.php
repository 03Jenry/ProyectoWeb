<link rel="stylesheet" href="tabla.css">

<?php 
session_start();
include('conexion.php');
include('principal.html');
$sql = "select * from delegacion";
$cmarcas = mysqli_query($mysqli,$sql) ; 
$marca =array() ;
$mov =array() ; 
//$movloc =array();
 
if (empty($_POST['nomdel'])){ 
	$tip=-1; 
}
else
{
	$tip = $_POST['nomdel'];
	$_SESSION["nomdel"]=$tip;
}
if(empty($_POST['nommun'])){ 
$tip2=-1;  
}else {
	$tip2 =$_POST['nommun'];
	$_SESSION["nommun"]=$tip2;
}
if(empty($_POST['nomloc'])){ 
$tip3=-1;  
}else {
	$tip3 =$_POST['nomloc'];
	$_SESSION["nomloc"]=$tip3;
}
?> 
	<div id="cajafondo">
	<table class="flat-table"> 
		<tbody>
		<tr> 
			<th>  
				<?php 
				echo "<form name='form1' action='".$_SERVER['PHP_SELF']."' method='POST'>"; 
				echo " <select name='nomdel' size='1' onChange='submit()'>"; 
				echo " <option value='nada' selected>Delegacion</option>";  
				while($marca=mysqli_fetch_array($cmarcas))  
				{ 
					if($marca[0]==$_SESSION["nomdel"])
					{ 
					echo "<option value='".$marca[0]."' selected>".$marca[1]."</option>"; 
					} 
					else 
					{ 
					echo "<option value='".$marca[0]."'>".$marca[1]."</option>"; 
					} 
				} 
				mysql_free_result($cmarcas) ; 
				?> 
				</select> 
				</form> 
			</th>
			<th>
				<?php
				echo "<form name='select2' action='".$_SERVER['PHP_SELF']."' method='POST'>"; 
				echo " <select name='nommun' size='1'onChange='submit()'>"; 
				echo " <option value='nada' selected>Municipio</option>";  
				$sqli = "select * from municipio where numdel=".$_SESSION['nomdel']."";
				$cmov = mysqli_query($mysqli,$sqli);
				while($mov=mysqli_fetch_array($cmov))  
				{ 
					if($mov[0]==$_SESSION["nommun"])
					{ 
						echo "<option value='".$mov[0]."' selected>".$mov[1]."</option>"; 
						} 
						else 
						{ 
						echo "<option value='".$mov[0]."'>".$mov[1]."</option>"; 
					} 
				} 
				mysql_free_result($cmov) ; 
				?> 
				</select>
				</form> 
			</th>
			<th>
				<?php
				echo "<form name='menu' action='".$_SERVER['PHP_SELF']."' method='POST'>"; 
				echo " <select name='nomloc' size='1'onChange='submit()'>"; 
				echo " <option value='nada' selected>Localidad</option>";  
				$sqloc1 = "select * from locselect where cvemun=".$_SESSION['nommun']."";
				$cmoloc = mysqli_query($mysqli,$sqloc1);
				//$sqloc= "select nomloc from localidad inner join locselect on locselect.cveloc=localidad.cveloc and locselect.cvemun=localidad.cvemun and locselect.cvemun=".$_SESSION['nommun']."";
				//$cmoloc = mysqli_query($mysqli,$sqloc);
				while($movloc=mysqli_fetch_array($cmoloc))  
				{
					if($movloc[0]==$_SESSION["nomloc"])
					{ 
						echo "<option value='".$movloc[0]."' selected>".$movloc[2]."</option>"; 
					} 
					else 
					{ 
						echo "<option value='".$movloc[0]."'>".$movloc[2]."</option>"; 
					} 
				} 
				mysql_free_result($cmoloc) ; 
				?> 
				</select>
				</th>
				<th><p><a href="http://localhost:8080/proyectoweb/agregar.php?"><input class="btn" type="button" name="menu" value="Agregar Beneficiario" /></a></p></th>
				<th><p><a href="http://localhost:8080/proyectoweb/beneficiarios.php?"><input class="btn"type="button" name="menu" value="Consultar Beneficiario" /></a></p></th>
				</form>		
		</tr>
	</table> 

</body> 
</html>