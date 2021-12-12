<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 


$cliente_id = $_POST["idcliente"];

$nuevo = $_POST["nuevo"];

//$form = $_POST["form"];

$con=conectarse();

$errores = validar_campos_obligatorios(array($cliente_id));	
	
	if(!empty($errores))
	{
		$band=1;
	}
	
	
	if($band==1 and $cliente_id!="" and $nuevo!=1)
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
		
		
		$sql="select * from cc_gtias_prendarias where idcliente='$idcliente'";
		$query=pg_query($con,$sql);
		if($fila=pg_fetch_array($query))
		{
		$modif=1;  //valida que existe parcelas de clientes
		include("f_garantiasp_m.php");
		}
		else
		{
		$modif=0;  //valida que existe parcelas de clientes
		include("f_garantiasp_new.php");
		}
		
		
		
	
	
	
		
	
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