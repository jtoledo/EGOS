<?php require("../includes/session.php");?>
<?php verificar_sesion(); ?>
<?php
/*$id_usuario=$_SESSION["usuario"];
$nombre=$_SESSION["nombre"];
$perfil=$_SESSION["perfil"];
$id_perfil=$_SESSION["id_perfil"];
*///$usuario_id=$_GET["usuario_id"];
$orden=1; //ESPECIFICAR CUANDO ESTA DENTRO DE UNA CARPETA
$d="../"; //ESPECIFICAR PARA EL RECORRIDO DE MENU
$titulo="SISTEMA INTEGRAL DE INFORMACION";
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php");
require(CABECERA);
?>

<br />
 
 

<div id="contenido" align="left" style="padding:0px 0px 0px 20px">

 <?php include("f_m_u.php"); ?>
  
  </div>
 
  <div id="consul_usuario" align="center">
  </div> 
   
   
   
   






 



   
<?php
include (FOOTER);  
?>