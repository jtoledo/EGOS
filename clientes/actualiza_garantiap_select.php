<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 


$idgtia = $_POST["idgtia"];
$form = $_POST["form"];

//$form = $_POST["form"];

$con=conectarse();

$errores = validar_campos_obligatorios(array($idgtia));	
	
	if(!empty($errores))
	{
		$band=1;
	}
	
	
	if($band==1 and $form==1)
	{
	
		 $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_gtias_prendarias where idgtia='$idgtia'  order by descripcion desc";
	   $id_query = pg_query($con,$consulta);
	
	
		while( $fila= pg_fetch_array($id_query) )
		   {
	 
		$idcliente=$fila["idcliente"];	 
		$idgtia=$fila["idgtia"];
	 
		 $descripcion=$fila["descripcion"];
		 $valor=$fila["valor"];
		 $fregistro=$fila["fregistro"];  //fecha de valuacion
		 
		 $marca=$fila["marca"];
		 $modelo=$fila["modelo"];
		 $estado_actual=$fila["estado_actual"]; 
		 $valuador=$fila["valuador"];
		 
		 $no_serie=$fila["no_serie"];
		 
		 $no_factura=$fila["no_factura"];
		 $f_factura=$fila["f_factura"];
		 
		}
		
		
		
		$consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_clientes  WHERE idcliente='$idcliente'";
	   	  $id_query = pg_query($con,$consulta);
	
	
		while( $fila= pg_fetch_array($id_query) )
		   {
	 
		 $nom_cliente=$fila["nombre"];
		 $a_paterno=$fila["ap_paterno"];
		 $a_materno=$fila["ap_materno"];
		
		  
		  $nom_completo=$nom_cliente." ".$a_paterno." ".$a_materno;
		  
		  $idcliente=$fila["idcliente"];
		  
		
		   }
		
		
		$modif=0;
		include("f_garantiasp_m.php");
		
		
		
	
	
	
		
	
	}
	
	if($nuevo==1)
	{
	
	$consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_clientes  WHERE idcliente='$cliente_id'";
	   	  $id_query = pg_query($con,$consulta);
	
	
		while( $fila= pg_fetch_array($id_query) )
		   {
	 
		 $nom_cliente=$fila["nombre"];
		 $a_paterno=$fila["ap_paterno"];
		 $a_materno=$fila["ap_materno"];
		
		  
		  $nom_completo=$nom_cliente." ".$a_paterno." ".$a_materno;
		  
		  $idcliente=$fila["idcliente"];
		  
		
		   }
	
	include("f_garantiasp_new.php");
	$modif=0;
	}







?>