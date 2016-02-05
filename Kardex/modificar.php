<!DOCTYPE html>
<html>
	<head>


		<style>

		.right 
		{
    		position: absolute;
    		right: 0px;
		}

		.center 
		{
    		position: absolute;
    		font-size: 18px;
    		left: 0%;
    		top: 50%;
    		width: 100%;
		}
		table {text-align: center;    border-collapse: collapse; }
		td {padding: 8px;      border-bottom: 1px ;     border-top: 1px; }
		th {font-weight: normal;     padding: 8px;  border-top: 4px ;    border-bottom: 1px ; }

		</style>

	</head>
	
	<body>

		<?php

			$casilla_a_modificar= 	intval($_GET["casilla_a_modificar"]);
			$se_esta_editanto_casilla = intval($_GET["se_esta_editanto_casilla"]);
			$auxiliar_casilla_a_editar = intval($_GET["auxiliar_casilla_a_editar"]);

			if ($casilla_a_modificar == 0)
			{
				 	$q = 				intval($_GET['q']);
					$Costo = 			($_GET["Costo"]);
					$Proveedor = 		($_GET["Proveedor"]);
					$Cambio = 			($_GET["Cambio"]);
					$Cantidad = 		($_GET["Cantidad"]);
					$Peso = 			($_GET["Peso"]);
					$Fecha 	= 			($_GET["Fecha"]);

				$con = mysqli_connect('localhost','kadashy','123456789','shop');

				if (!$con) 
				{die('Could not connect: ' . mysqli_error($con));}

				echo "<table>
				<tr>
 				<td><strong> ID </strong> </td>
  				<td><strong>Precio de costo</strong></td>
  				<td><strong>Proveedor</strong></td>
  				<td><strong>Tasa de cambio</strong></td>
  				<td><strong>Cantidad adquirida</strong></td>
  				<td><strong>Peso (g)</strong></td>
  				<td><strong>Fecha (AAAA-MM-DD) </strong></td>
				</tr>
				<tr>";

  				echo "
  				<tr>
  				<td>&nbsp;&nbsp;  </td>	
  				<td><input type='text' id='ID' name='webcampics' value='' /> &nbsp;</td>
  				<td><input type='text' id='Precio de costo' name='webcampics' value='' />&nbsp;</td>
  				<td><input type='text' id='Proveedor' name='webcampics' value='' />&nbsp;</td>
  				<td><input type='text' id='Tasa de cambio' name='webcampics' value='' />&nbsp;</td>
  				<td><input type='text' id='Peso' name='webcampics' value='' />&nbsp;</td>
  				<td><input type='text' name='webcampics' class='datepicker' value='' style='text-align: center' id='webcampics' />&nbsp;</td>
				</tr>
				</TABLE>";

				if (($Costo ==  0 ) && ($Proveedor ==  "undefined"))
				{

				}
				elseif ($Costo ==  0 )
				{
    				echo "No pueden quedar campos vacios";
				} 
				elseif ($casilla_a_modificar == 0 )
				{

					if($se_esta_editanto_casilla == 1)
					{
						$q = intval($_GET['q']);

						$con = mysqli_connect('localhost','kadashy','123456789','shop');
						if (!$con) {
    					die('Could not connect: ' . mysqli_error($con));
						}


						mysqli_select_db($con,"ajax_demo");
						$sql="SELECT id_ingreso FROM kardex  ";

						$result = mysqli_query($con,$sql);
						$numero_de_filas = $result->num_rows;


       					if ($numero_de_filas > 0)
        				{
            
                			while($row = mysqli_fetch_array($result)) 
							{
    							$id_ingreso[] = 	$row['id_ingreso'] ;
    						}    
    						
							$id_ingreso_modificar=$id_ingreso[$auxiliar_casilla_a_editar-1];

						}
						$sql = "UPDATE  `shop`.`kardex` SET  `Cantidad` = '$Cantidad',`Costo` =  '$Costo',`Proveedor` = '$Proveedor',`Cambio` = '$Cambio',`Peso` ='$Peso' WHERE  `kardex`.`id_ingreso` ='".$id_ingreso_modificar."'";

						if ($con->query($sql) === TRUE) 
						{echo "Nuevo valor almacenado con exito";}
						else {echo "Error: " . $sql . "<br>" . $con->error;}
					}
					else 
					{
						$sql = "INSERT INTO kardex (id_producto_kard,	Costo,	Proveedor,	Cambio,	Cantidad,	Peso,	Fecha)
						VALUES ('$q', '$Costo', '$Proveedor', '$Cambio', '$Cantidad', '$Peso', '$Fecha')";

						if ($con->query($sql) === TRUE) 
						{echo "Nuevo valor almacenado con exito";}
						else {echo "Error: " . $sql . "<br>" . $con->error;}
					}

					mysqli_select_db($con,"ajax_demo");
					$sql="SELECT id_ingreso FROM kardex  WHERE id_producto_kard = '".$q."'";

					$result = mysqli_query($con,$sql);
					$numero_de_filas = ($result->num_rows+1);

					echo "<table>
					<tr>
    				<tr>
    				<td><strong>ID </strong> &nbsp;&nbsp;</td>
        			<td><strong>Precio de costo</strong></td>
       				<td><strong>Proveedor</strong></td>
        			<td><strong>Tasa de cambio</strong></td>
        			<td><strong>Cantidad adquirida</strong></td>
        			<td><strong>Peso (g)</strong></td>
        			<td><strong>Fecha(AAAA-MM-DD)</strong></td>
    				</tr>
					</tr>";

    				echo "<tr>";

    				echo "<td>" . $numero_de_filas . "</td>";
   					echo "<td>" . $Costo . "</td>";
    				echo "<td>" . $Proveedor . "</td>";
    				echo "<td>" . $Cambio . "</td>";
    				echo "<td>" . $Cantidad . "</td>";
    				echo "<td>" . $Peso . "</td>";
    				echo "<td>" . $Fecha . "</td>";
    				echo "</tr>";

					echo "</table>";
					echo "El nuevo ingreso se ha almacenado con exito!";

				}

			mysqli_close($con);

			}
			else
			{
				$q = intval($_GET['q']);

				$con = mysqli_connect('localhost','kadashy','123456789','shop');
				if (!$con) {
    			die('Could not connect: ' . mysqli_error($con));
				}


				mysqli_select_db($con,"ajax_demo");
				$sql="SELECT id_ingreso, Costo, Proveedor, Cambio, Cantidad, Peso, Fecha FROM kardex  WHERE id_producto_kard = '".$q."'";

				$result = mysqli_query($con,$sql);

				$numero_de_filas = $result->num_rows;


       			if ($numero_de_filas > 0)
        		{
            
                	while($row = mysqli_fetch_array($result)) 
					{
    					$id_ingreso[] = 	$row['id_ingreso'] ;
    					$Costo[] 		= 	$row['Costo'] ;
    					$Proveedor[] 	= 	$row['Proveedor'];
    	 				$Cambio[] 		= 	$row['Cambio'];
    					$Cantidad[] 	= 	$row['Cantidad'] ;
    					$Peso[] 		= 	$row['Peso'] ;
    					$Fecha[] 		= 	$row['Fecha'] ;
    				}         		
            		
            		echo "<table>
					<tr>
 					<td><strong> ID </strong> </td>
  					<td><strong>Precio de costo</strong></td>
  					<td><strong>Proveedor</strong></td>
  					<td><strong>Tasa de cambio</strong></td>
  					<td><strong>Cantidad adquirida</strong></td>
  					<td><strong>Peso (g)</strong></td>
  					<td><strong>Fecha (AAAA-MM-DD) </strong></td>
					</tr>
					<tr>";

					$id_ingreso_modificar=$casilla_a_modificar-1;
					echo "<tr>";
					echo "<td>" . $id_ingreso[$casilla_a_modificar-1] . "</td>";
					echo "<td><input type='text' id='Precio de costo' name='webcampics' value='" . $Costo[$id_ingreso_modificar] . "' /></td>";
					echo "<td><input type='text' id='Proveedor' name='webcampics' value='" . $Proveedor[$id_ingreso_modificar] . "' /></td>";
					echo "<td><input type='text' id='Tasa de cambio' name='webcampics' value='" . $Cambio[$id_ingreso_modificar] . "' /></td>";
					echo "<td><input type='text' id='Cantidad adquirida' name='webcampics' value='" . $Cantidad[$id_ingreso_modificar]. "' /></td>";
					echo "<td><input type='text' id='Peso' name='webcampics' value='" . $Peso[$id_ingreso_modificar] . "' /></td>";
					echo "<td><input type='text' class='datepicker'  style='text-align: center' id='sp_to' name='webcampics' value='" . $Fecha[$id_ingreso_modificar] . "' /></td>";
        		}
				mysqli_close($con);
			}
		?>
	</body>
</html>