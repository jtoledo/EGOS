<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
$orden=1; //ESPECIFICAR CUANDO ESTA DENTRO DE UNA CARPETA
$d="../"; //ESPECIFICAR PARA EL RECORRIDO DE MENU

$idgrupo = $_POST["idgrupo"];
$fecha_i = $_POST["fecha_i"];
$fecha_f = $_POST["fecha_f"];
$enviar = $_POST["enviar"];
$form = $_POST["form"];
$con=conectarse();

$errores = validar_campos_obligatorios(array($idgrupo,$fecha_i,$fecha_f,$enviar));	
	
	if(!empty($errores))
	{
		$band=1;
	}
	
	
	if($band==1 and $form==1 and $enviar=="GENERAR")
	{
	   
	   
	  ?> 
      <table border="0">
      <tr><td>
	   <?php
	   
	   $img='<img src="'.$d.'dummies/pdf.png" alt="nota" style="WIDTH: 100px; HEIGHT: 100px">';

echo '<a href="'.$d.'reportes/reporte_solicitud_fecha.php?idgrupo='.$idgrupo.'&fecha_i='.$fecha_i.'&fecha_f='.$fecha_f.'" >  <strong><span class="Estilo1">

'.$img.'

</span></strong>  </a>';


	?></td>
    <td>
     <?php
	   
	   $img='<img src="'.$d.'dummies/pdf.png" alt="nota" style="WIDTH: 100px; HEIGHT: 100px">';

echo '<a href="'.$d.'reportes/reporte_credito_fecha.php?idgrupo='.$idgrupo.'&fecha_i='.$fecha_i.'&fecha_f='.$fecha_f.'" >  <strong><span class="Estilo1">

'.$img.'

</span></strong>  </a>';


	?>
    </td>
    </tr>
    <tr>
    <th align="center">Solicitudes</th><th align="center">Cr&eacute;ditos Autorizados</th>
    </tr>
    </table>
    <?php



	}
	
	



?>
