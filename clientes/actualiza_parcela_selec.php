<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 


$id_parcela = $_POST["id_parcela"];

$form = $_POST["form"];

//$form = $_POST["form"];

$con=conectarse();

$errores = validar_campos_obligatorios(array($id_parcela));	
	
	if(!empty($errores))
	{
		$band=1;
	}
	
	
	if($band==1 and $form==1)
	{
	
		 $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_parcelas  WHERE id_parcela='$id_parcela'";
	   	  $id_query = pg_query($con,$consulta);
	
	
		while( $fila= pg_fetch_array($id_query) )
		   {
	 
		 $id_parcela=$fila["id_parcela"];
		 $idcliente=$fila["idcliente"];
		 $f_registro=$fila["f_registro"];
		 $desc_predio=$fila["desc_predio"];
		 $idestado=$fila["idestado"];
		 $idmunicipio=$fila["idmunicipio"];
		 $idlocalidad=$fila["idlocalidad"];
		 $idcolonia=$fila["idcolonia"];
		 $id_catalogo=$fila["id_catalogo"];
		 $super_esp=$fila["super_esp"];
		 $num_predio=$fila["num_predio"];
		 $color=$fila["color"];
		 $textura=$fila["textura"];
		 $estruct=$fila["estruct"];
		 $poro=$fila["poro"];
		 $perme=$fila["perme"];
		 $prof_efe=$fila["prof_efe"];
		 $temp=$fila["temp"];
		 $lluvia=$fila["lluvia"];
		 $hume_aire=$fila["hume_aire"];
		 $vientos=$fila["vientos"];
		 $brillo_solar=$fila["brillo_solar"];
		 $nubosidad=$fila["nubosidad"];
		 $st_hec=$fila["st_hec"];
		 $st_area=$fila["st_area"];
		 $st_centi=$fila["st_centi"];
		 $st_deci=$fila["st_deci"];
		 
		 
		  $sc_hec=$fila["sc_hec"];
		 $sc_area=$fila["sc_area"];
		 $sc_centi=$fila["sc_centi"];
		 $sc_deci=$fila["sc_deci"];
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
		include("f_parcelas.php");
		
		
		
	
	
	
		
	
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
	
	include("f_parcelas_new.php");
	$modif=0;
	}







?>