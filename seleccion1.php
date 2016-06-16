<html> 
<head> 
 <link rel="stylesheet" href="tabla.css">
 <link rel="stylesheet" href="estilo2.css">

<?php 
	session_start();
	include('conexion.php');
	include('principal.html');
	$sql = "select * from delegacion";
	$cmarcas = mysqli_query($mysqli,$sql) ; 
	$marca =array() ;
	$mov =array() ;  
	if (empty($_POST['nomdel'])){ 
		$tip=-1; 
	}
	else
	{
		$tip = $_POST['nomdel'];
		$_SESSION["nomdel"]=$tip;
	}
	if (empty($_POST['nommun'])){ 
	$tip2=-1;  /*Necesitamos guardar el primer tip para que vuelva aponer la delegacion*/
	}
	else {
		$tip2 =$_POST["nommun"];
		$_SESSION["nommun"]=$tip2;
	}
	$loqui= -1;
?> 
<div id="cajafondo">
	<table class="flat-table"> 
		<tbody>
		<tr> 
			<th> 
				<!--buscador por categorias--> 
				<?php 
				echo "<form name='form1' action='".$_SERVER['PHP_SELF']."' method='POST'>"; //le indico que me envie el formulario a esta página web 
				echo " <select name='nomdel' size='1' onChange='submit()'>"; // Creamos el select en HTML como cualquier otro y le indicamos que envie el formulario al cambiar el valor por defecto 
				echo " <option value='nada' selected>Delegacion</option>"; // Dato por defecto al cargar 
				while($marca=mysqli_fetch_array($cmarcas)) //cargamos los datos con mysql_fetch 
				{ 
					if($marca[0]==$_SESSION["nomdel"])//este if es para cuando carguemos de nuevo el formulario que ponga por defecto la marca seleccionada (para que no ponga "seleccione una marca" al al seleccionarlo, que si hemos elegido, Audi, que ponga Audi, al cmabiarse 
					{ 
					echo "<option value='".$marca[0]."' selected>".$marca[1]."</option>"; 
					} 
					else 
					{ 
					echo "<option value='".$marca[0]."'>".$marca[1]."</option>"; 
					} 
				} 
				mysql_free_result($cmarcas) ; // Liberar memoria usada por consulta. 
				?> 
				</select> 
				</form> 
			</th>

			<th>
				<?php
				echo "<form name='select2' action='".$_SERVER['PHP_SELF']."' method='POST'>"; //le indico que me envie el formulario a esta página web 
				echo " <select name='nommun' size='1'onChange='submit()'>"; // Creamos el select en HTML como cualquier otro y le indicamos que envie el formulario al cambiar el valor por defecto 
				echo " <option value='nada' selected>Municipio</option>"; // Dato por defecto al cargar 
				$sqli = "select * from municipio where numdel=".$_SESSION['nomdel']."";
				$cmov = mysqli_query($mysqli,$sqli);
				while($mov=mysqli_fetch_array($cmov)) //cargamos los datos con mysql_fetch 
				{ 
					if($mov[0]==$_SESSION["nommun"])//este if es para cuando carguemos de nuevo el formulario que ponga por defecto la marca seleccionada (para que no ponga "seleccione una marca" al al seleccionarlo, que si hemos elegido, Audi, que ponga Audi, al cmabiarse 
					{ 
						echo "<option value='".$mov[0]."' selected>".$mov[1]."</option>"; 
						} 
						else 
						{ 
						echo "<option value='".$mov[0]."'>".$mov[1]."</option>"; 
					} 
				} 
				mysql_free_result($cmov) ; // Liberar memoria usada por consulta. 
				?> 
				</select>
				</form> 
			</th>
			<th>
				<form method="POST" action="#">
				<input class="btn" type="submit" name="escuchar" value="Consultar">
				</form>
			</th>
		</tr>
		</tbody>
		</table>
		<table border="1" align="center" class="flat-table">
		<?php 
		if(isset($_POST['escuchar']))
		{
				echo "<form name='benef' action='' method='GET'>"; //le indico que me envie el formulario a esta página web 
				$sqlo = "select * from localidad where cvemun=".$_SESSION['nommun']."";
				$cmox = mysqli_query($mysqli,$sqlo); //Con esta consulta le indico que me cargue de todos los modelos, que hay de productos, me cargue los correspondientes a la marca (si os fijaies, carga la variable tip que es la que se envia en el formulario anterior  
				$j=0;
				$i=1;
				$numcolumnas = 6;
				
				while($loc=mysqli_fetch_assoc($cmox) )// muestra de los dartos 
				{ 	
					$item[$j]=$loc["nomloc"];
					$coditem[$j]=$loc["cveloc"];
					$resto = ($i % $numcolumnas); 
					$marcado="select cveloc from locselect where cveloc=".$coditem[$j]." and cvemun=".$_SESSION['nommun']."";
					$marc = mysqli_query($mysqli,$marcado);
					while ($loc1=mysqli_fetch_assoc($marc) ){
						$loqui=$loc1["cveloc"];
						}
						if($resto == 1){ /*si es el primer elemento creamos una nueva fila*/ 
        				 echo "<tr>";
					     }
					     if($coditem[$j]==$loqui){
							echo "<td><input type='checkbox' checked disabled='TRUE'>".$item[$j]." , ".$coditem[$j]." </td> ";
						}
						else {
							echo "<td><input name='ID[]' type='checkbox' value= '".$coditem[$j]."'>".$item[$j]." , ".$coditem[$j]." </td> "; 			
						}
					   if($resto == 0){
					      echo "</tr>";
					    }
					   $i++; 
					$j++;				
				}
				 echo "<input class='btn' type='submit' name='benef' value='Guardar'>";
				 echo "<form>";
		} ?>
		</form>
		</table>
		</div>

		<?php
		if ( !empty($_GET["ID"]) && is_array($_GET["ID"]) ) {
    		
    		foreach ( $_GET["ID"] as $ID ) {
    			$nomlc = "select nomloc from localidad where cveloc='".$ID."' and cvemun='".$_SESSION["nommun"]."'";
    			$nomlc1= mysqli_query($mysqli,$nomlc);
    			while ($nomlc2=mysqli_fetch_assoc($nomlc1) ){
						$nomlca=$nomlc2["nomloc"];
						}
    			$insert= "insert into locselect (cveloc,cvemun,nomloc) VALUES ('".$ID."','".$_SESSION["nommun"]."','".$nomlca."')";
				mysqli_query($mysqli,$insert);
			}
		}

		?>		

</body> 
</html>