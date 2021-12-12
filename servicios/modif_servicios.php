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
if(isset($_GET['modif']))
{
	$modificar=$_GET['modif'];

}else{ $modificar=1;}
?>

<div id="contenido" align="center">
<?php 

//$comprueba=get_exits_servicios();
if($modificar==1)
{
	$comprueba=get_exits_servicios($_SESSION['mov_sucursal'],$_SESSION['cosecha_sel']);
	include("servicio_m.php"); 
}
else
{
	
	include("servicio_new.php"); 
}

?>
</div> 



<?php
include (FOOTER);  
?>