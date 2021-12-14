<?php
include("../../includes/constantes.php");
include("../../includes/funciones.php");
include("../../bd/conexion.php");
$con=conectarse();
$idcuenta=$_POST["idcuenta"];

if($idcuenta=="" or empty($idcuenta))
{
echo 0;
}
else
{
	
	?>
     <select name="id_cuenta" id="id_cuenta" class="iselect">
        <option value="">Seleccione Cuenta</option>
        <?php
                    
					 
                     $consulta="SELECT * FROM cuentas WHERE idpadre=4448 ORDER BY clave_gral";
                     $id_query = pg_query($con,$consulta);
                     while( $fila= pg_fetch_array($id_query) )
                        {  
						$b=$fila["idcuenta"];
						$clave_gral=$fila["clave_gral"];
						$descripcion=$fila["descripcion"];
						$tipo=$fila["tipo"];
						
						
						$resp="$clave_gral $descripcion $tipo";
						if($idcuenta==$b)
						print("<option value=\"$b\" selected=\"selected\">".$resp."</option>");
						else
						print("<option value=\"$b\" >".$resp."</option>");
						                                 
                        }
						?>
      </select>
    <?php
	
}





?>