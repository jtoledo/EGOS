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
$id_usuario=$_SESSION["usuario"];
$nom_asesor=get_asesor($id_usuario);
$comprueba=get_exits_sol($_SESSION['mov_sucursal'],$_SESSION['cosecha_sel']);
if($comprueba==1)
include("solicitud_m.php"); 
else
include("solicitud_new.php"); 

?>
</div> 

<?php
include (FOOTER);  
?>