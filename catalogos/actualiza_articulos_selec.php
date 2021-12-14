<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 


$idarticulos = $_POST["idarticulos"];


		if(isset($idarticulos)) {
			if($idarticulos!='') {	
		 		$con=conectarse();
		 		$sql="select * from al_cat_articulos al where al.id_catalogo=$idarticulos";
				$id_query = pg_query($con,$sql);
         
				echo "<table border=0> ";
    			echo "		<th>Producto</th><th>Precio</th> ";         
         	while( $fila= pg_fetch_array($id_query) )
         	{  			
					echo "		<tr> ";
					echo "			<td>".$fila["descripcion"]."</td><td><input type='text' onkeypress='return acceptNum(event)' value='".$fila["precio1"]."' name='precio' size=5><input type='hidden' value='".$fila["precio1"]."' name='precio_ant'><input type='hidden' onkeypress='return acceptNum(event)' value='".$fila["id_catalogo"]."' name='clv_precio'></td>";    				
    				echo "		</tr>";
					echo "<tr><td></td><td><B>MIN</B></td><td><B>MAX</B></td></tr>";    				
    				echo "<tr><td>Rendimiento</td><td><input type=text onkeypress='return acceptNum(event)' size=5 value='".$fila["ren_min_permitido"]."' name='ren_min'>%</td><td><input type=text size=5 onkeypress='return acceptNum(event)' value='".$fila["ren_max_permitido"]."' name='ren_max'>%</td></tr>";
    				echo "<tr><td>Mancha</td><td><input type=text size=5 onkeypress='return acceptNum(event)' value='".$fila["man_min_permitido"]."' name='man_min'>%</td><td><input type=text size=5 onkeypress='return acceptNum(event)' value='".$fila["man_max_permitido"]."' name='man_max'>%</td></tr>";
    				echo "<tr><td>Humedad</td><td><input type=text size=5 onkeypress='return acceptNum(event)' value='".$fila["hum_min_permitido"]."' name='hum_min'>%</td><td><input type=text size=5 onkeypress='return acceptNum(event)' value='".$fila["hum_max_permitido"]."' name='hum_max'>%</td></tr>";
    				echo "<tr><td>Mancha Secado</td><td></td><td><input type=text size=5 onkeypress='return acceptNum(event)' value='".$fila["man_secado"]."' name='man_sec'>%</td></tr>";
    				echo "<tr><td>Flete x Bulto</td><td><input type=text size=5  onkeypress='return acceptNum(event)' value='".$fila["fletex_bulto"]."' name='fle_bul'>%</td><td></td></tr>";
    				echo "<tr><td>Maniobra x Bulto</td><td><input type=text size=5 onkeypress='return acceptNum(event)' value='".$fila["maniobrax_bulto"]."' name='mani_bul'>%</td><td></td></tr>";
    				echo "<tr><td>Secado x Caja</td><td><input type=text size=5 onkeypress='return acceptNum(event)' value='".$fila["secadox_caja"]."' name='sec_caj'>%</td><td></td></tr>";
    			}
    			echo "<tr><td colspan=2 align='right'><input type='submit' value='Guardar'></td></tr></table>";
			}
    	}	




?>