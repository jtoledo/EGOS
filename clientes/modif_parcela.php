<?php require("../includes/session.php");?>
<?php verificar_sesion(); ?>
<?php
$orden=1; //ESPECIFICAR CUANDO ESTA DENTRO DE UNA CARPETA
$d="../"; //ESPECIFICAR PARA EL RECORRIDO DE MENU
$titulo="SISTEMA INTEGRAL DE INFORMACION";
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php");

require(CABECERA);
/*$c_sucursal="SELECT * FROM cc_sucursales WHERE id='$sucursal_id'";
$query_c=pg_query($con,$c_sucursal);
while($row_sucursal=pg_fetch_array($query_c))
{
$sucursal=$row_sucursal["sucursal"];
$direccion=$row_sucursal["direccion"];
$telefono=$row_sucursal["telefono"];
$cp=$row_sucursal["cp"];
$idsede=$row_sucursal["idsede"];
$idencargado=$row_sucursal["idencargado"];

}
*/?>


<div id="contenido" align="center">

<?php include("f_m_s.php"); ?>
</div> 



<div id="consul_sucursal">
  </div>




   
<?php
include (FOOTER);  
?>