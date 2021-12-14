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
	
		$consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_gtias_hipotecarias where idgtia='$idgtia'  order by descripcion desc";
	   $id_query = pg_query($con,$consulta);
	
	
		while( $fila= pg_fetch_array($id_query) )
		   {
	 
		$idcliente=$fila["idcliente"];	 
		$idgtia=$fila["idgtia"];
	 
		 $descripcion=$fila["descripcion"];
		 $valor=$fila["valor"];
		 $fvaluacion=$fila["fvaluacion"];
		 $registro=$fila["registro"];
		 $libro=$fila["libro"];
		 $tomo=$fila["tomo"]; 
		 $seccion=$fila["seccion"];
		 $volumen=$fila["volumen"];
		 $superficie=$fila["superficie"];
		 $fregistro=$fila["fregistro"];
		 $antecedentes=$fila["antecedentes"];
		
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
		include("f_garantiash_m.php");
		
		
		
	
	
	
		
	
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
	
	include("f_garantiash_new.php");
	$modif=0;
	}







?>