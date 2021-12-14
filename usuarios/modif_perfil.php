<?php require("../includes/session.php");?>
<?php verificar_sesion(); ?>
<?php
/*$id_usuario=$_SESSION["usuario"];
$nombre=$_SESSION["nombre"];
$perfil=$_SESSION["perfil"];
$id_perfil=$_SESSION["id_perfil"];
*/$perfil_id=$_GET["perfil_id"];
$orden=1; //ESPECIFICAR CUANDO ESTA DENTRO DE UNA CARPETA
$d="../"; //ESPECIFICAR PARA EL RECORRIDO DE MENU
$titulo="SISTEMA INTEGRAL DE INFORMACION";
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php");

require(CABECERA);

?>


<div id="contenido" align="center">

  <?php include("f_m_p.php"); ?>

</div>
 <div id="consul_perfiles" align="center">
  </div> 
 



   
<?php
include (FOOTER);  
?>