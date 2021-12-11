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
?>


<div id="contenido" align="center">

<?php 


$stock=get_requerimiento();
if($stock==0)
{
$proceso=get_proceso();
$idproceso=$proceso["idproceso"];
include("requerimiento_new.php"); 
}
else
{
include("requerimiento_m.php"); 
}




?>
</div> 

<?php
include (FOOTER);  
?>