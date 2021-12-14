<?php
session_start();
$orden=1; //ESPECIFICAR CUANDO ESTA DENTRO DE UNA CARPETA
$d="../"; //ESPECIFICAR PARA EL RECORRIDO DE MENU
$titulo="SISTEMA INTEGRAL DE INFORMACION";
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php");
require(CABECERA_MODAL);
$con=conectarse();

$idsolicitud=$_GET["idsolicitud"];

		 $expediente=recupera_expediente($idsolicitud);
		 
		 ?>
         <div align="center">
         <?php
		 consulta_expediente_autorizacion($expediente["idexpediente"],$idsolicitud); //mostramos consulta
		 ?>
         </div>
         <?php




include (FOOTER_MODAL);  
?>