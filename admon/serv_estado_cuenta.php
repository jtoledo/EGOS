<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
$orden=1; //ESPECIFICAR CUANDO ESTA DENTRO DE UNA CARPETA
$d="../"; //ESPECIFICAR PARA EL RECORRIDO DE MENU

$idgrupo = $_POST["idgrupo"];
$idcliente = $_POST["idcliente"];
$fecha_f = $_POST["fecha_f"];
$enviar = $_POST["enviar"];
$form = $_POST["form"];
$con=conectarse();

$errores = validar_campos_obligatorios(array($fecha_f,$enviar,$fecha_i));	
$errores_cliente = validar_campos_obligatorios(array($fecha_f,$enviar,$form,$idcliente));
$errores_grupo = validar_campos_obligatorios(array($fecha_f,$enviar,$form,$idgrupo));	
	
	if(!empty($errores))
	{
		$band=1;
	}
	if(!empty($errores_cliente))
	{
		$band_cliente=1;
	}
	if(!empty($errores_grupo))
	{
		$band_grupo=1;
	}


	
	if($band==1 and $form==1 and $enviar=="GENERAR")//GENERA REPORTE GENERAL DE ESTADO  DE CUENTA
	{
	   
	   
	  ?> 
      <table border="0">
      <tr>
    <td align="center">
     <?php
	   
	   $img='<img src="'.$d.'images/excel.png" alt="estado cuenta"  title="Estado de cuenta">';

echo '<a href="'.$d.'reportes/r_estado_cuenta.php?fecha_f='.$fecha_f.'" >  <strong><span class="Estilo1">

'.$img.'

</span></strong>  </a>';


	?>
    </td>
    </tr>
    <tr>
   <th align="center">Estado de cuenta general</th>
    </tr>
    </table>
    <?php



	}
	if($band_cliente==1 and $form==2 and $enviar=="GENERAR")//GENERA REPORTE PERSONAL DEL PRODUCTOR
	{
	   
	   
	  ?> 
      <table border="0">
      <tr>
    <td align="center">
     <?php
	   
	   $img='<img src="'.$d.'images/excel.png" alt="estado cuenta"  title="Estado de cuenta">';

echo '<a href="'.$d.'reportes/r_estado_cuenta_pro.php?fecha_f='.$fecha_f.'&idcliente='.$idcliente.'" >  <strong><span class="Estilo1">

'.$img.'

</span></strong>  </a>';


	?>
    </td>
    </tr>
    <tr>
   <th align="center">Estado de cuenta x Productor</th>
    </tr>
    </table>
    <?php



	}
	
if($band_grupo==1 and $form==3 and $enviar=="GENERAR")//GENERA REPORTE PERSONAL DEL PRODUCTOR
	{
	   
	   
	  ?> 
      <table border="0">
      <tr>
    <td align="center">
     <?php
	   
	   $img='<img src="'.$d.'images/excel.png" alt="estado cuenta"  title="Estado de cuenta">';

echo '<a href="'.$d.'reportes/r_estado_cuenta_grup.php?fecha_f='.$fecha_f.'&idgrupo='.$idgrupo.'" >  <strong><span class="Estilo1">

'.$img.'

</span></strong>  </a>';


	?>
    </td>
    </tr>
    <tr>
   <th align="center">Estado de cuenta x Grupo</th>
    </tr>
    </table>
    <?php



	}


?>
