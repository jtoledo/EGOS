<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
$orden=1; //ESPECIFICAR CUANDO ESTA DENTRO DE UNA CARPETA
$d="../"; //ESPECIFICAR PARA EL RECORRIDO DE MENU

$id_periodo = $_POST["id_periodo"];
$fecha_i = $_POST["fecha_i"];
$fecha_f = $_POST["fecha_f"];
$id_catalogo = $_POST["id_catalogo"];
$id_tonga = $_POST["id_tonga"];
$id_almacen = $_POST["id_almacen"];
$enviar = $_POST["enviar"];
$form = $_POST["form"];
$con=conectarse();

$errores = validar_campos_obligatorios(array($id_periodo,$fecha_i,$fecha_f,$id_catalogo,$enviar,$form));	
	
	if(!empty($errores))
	{
		$band=1;
	}
	
	
	if($band==1 and $form==1 and $enviar=="GENERAR")
	{
	   
	   
	  ?> 
      <table border="0">
      <tr><td align="center">
	   <?php
	   
	   $img='<img src="'.$d.'images/excel.png" alt="nota"  width="40px" height="40px">';

echo '<a href="'.$d.'reportes/r_compras_tonga.php?id_periodo='.$id_periodo.'&fecha_i='.$fecha_i.'&fecha_f='.$fecha_f.'&id_catalogo='.$id_catalogo.'&id_tonga='.$id_tonga.'&id_almacen='.$id_almacen.'" >  <strong><span class="Estilo1">

'.$img.'

</span></strong>  </a>';


	?></td>
   
    </tr>
    <tr>
    <th align="center">Reporte de Compras</th>
    </tr>
    </table>
    <?php



	}
	
	



?>
