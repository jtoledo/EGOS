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
$comprueba=get_paquete_exist();

if($comprueba==1)
include("paquete_m.php"); 
else
include("paquete_new.php"); 



?>
</div> 

<?php
include (FOOTER);  
?>