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

$comprueba=get_exits_sol_grupo();
if($comprueba==1)
{
include("grupo_sol_m.php"); 
}
else
{
$fila_g=get_grupo();
$idgrupo=$fila_g["idgrupo"];
$fila=get_grupo_m($idgrupo);
$grupo=$fila["grupo"];
include("grupo_sol_new.php"); 
}

?>
</div> 

<?php
include (FOOTER);  
?>