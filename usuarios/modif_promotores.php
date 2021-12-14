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

$filtro=get_promotor_bd();
if($filtro==1)
include("f_m_promotor.php"); 
else
include("f_new_promotor.php"); 

?>
</div> 
   
<?php
include (FOOTER);  
?>