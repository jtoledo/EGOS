<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 


$cliente_id = $_POST["cliente_id"];
$form = $_POST["form"];

$con=conectarse();

$errores = validar_campos_obligatorios(array($cliente_id,$form));	
	
	if(!empty($errores))
	{
		$band=1;
	}
	
	
	if($band==1 and $form==1)
	{
	
		$consulta=" SET datestyle TO postgres, dmy; SELECT *,(select idgrupo from rela_grupo where idcliente=c.idcliente) as idgrupo FROM cc_clientes c  WHERE idcliente='$cliente_id'";
	   	  $id_query = pg_query($con,$consulta);
	
	
		while( $fila= pg_fetch_array($id_query) )
		   {
	 
		 $nom_cliente=$fila["nombre"];
		 $a_paterno=$fila["ap_paterno"];
		 $a_materno=$fila["ap_materno"];
		 $rfc=$fila["rfc"];
		 $curp=$fila["curp"];
		 $fecha_nac=$fila["f_nac_const"]; 
		 $domicilio=$fila["domicilio"];
		 $cod_postal=$fila["codigo_postal"];
		 $genero=$fila["masculino"];
		 $idcolonia=$fila["idcolonia"];
		 $idmunicipio=$fila["idmunicipio"];
		 $idestado=$fila["idestado"];
		 $idlocalidad=$fila["idlocalidad"];
		 //$id_agrupacion=$fila["id_agrupacion"];
		 $ife=$fila["ife"];
		 $tel_fijo=$fila["telefono1"];
		 $tel_movil=$fila["telefono2"];
		 $email=$fila["email"];
		// $tipo_cliente=$fila["tipo_cliente"];
		 $lugar_nac=$fila["lugar_nacimiento"];
		 $regimen_conyugal=$fila["regimen_conyugal"];
		 $nombre_conyugue=$fila["nombre_conyuge"];
		 $integrantes_familia=$fila["integrantes_familia"];
		 $f_registro=$fila["f_registro"];
		 $clv_fira=$fila["clv_fira"];
		 $clv_ha=$fila["clv_ha"];
		  $idcuenta=$fila["idcuenta"];
		  $idcuenta_ant=$fila["idctaanticipoprov"];
		  $idestrato=$fila["idestrato"];
		   $tipo_cliente= $fila["tipo_cliente"];
		  $idcliente=$fila["idcliente"];
		   $id_tipo=$fila["id_tipo"];
		    $estado_civil=$fila["estado_civil"];
			$num_productor=$fila["num_productor"];
			$cli_ver=$fila["idverificacion"];
			$idgrupo=$fila["idgrupo"];
		}
		$modif=1;  //valida que no se vuelva a consultar por defeto la tabla de usuarios
	
	
	
		include("f_m_s.php");
	
	}
	
	if($form==2)
	{
	include("f_new_s.php");
	$modif=0;
	}







?>