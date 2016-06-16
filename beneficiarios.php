<link rel="stylesheet" href="tabla.css">
<?php 
session_start();
include('conexion.php');	
include('principal.html');	
echo "<div class='contenido'>";
echo "<table class='flat-table2'><tbody><tr><th>Nombre</th><th>CURP</th><th>Localidad</th></tr>";	
$sqlo = "select nombre,curp,nomloc from beneficiarios B1 inner join localidad B2 on B1.cveloc=B2.cveloc and B1.cveloc=".$_SESSION["nomloc"]." and B2.cvemun=".$_SESSION['nommun']."";
				$cmox = mysqli_query($mysqli,$sqlo); 
				while($benef=mysqli_fetch_array($cmox))
				{ 	    
					    echo "<tr> <td> ".$benef[0]." </td>";
					    echo "<td> ".$benef[1]." </td> ";
					    echo "<td> ".$benef[2]." </td></tr>";		
				}
		echo "</tbody></table> </div>";
?> 