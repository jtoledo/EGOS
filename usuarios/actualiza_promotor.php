<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 


$idpromotor = $_POST["idpromotor"];
$form = $_POST["form"];

$con=conectarse();

$errores = validar_campos_obligatorios(array($idpromotor,$form));	
	
	if(!empty($errores))
	{
		$band=1;
	}
	
	
	if($band==1 and $form==1)
	{
	
		$fila=get_promotor_m($idpromotor);
						   $modif=1;
						   
		$a_paterno=$fila["ap_paterno"];
		 $a_materno=$fila["ap_materno"];
		 $nom_promo=$fila["nombre"];
		 $rfc=$fila["rfc"];
		 $curp=$fila["curp"];
		 $genero=$fila["masculino"];
		 $idcolonia=$fila["idcolonia"];
		 $idmunicipio=$fila["idmunicipio"];
		 $idestado=$fila["idestado"];
		 $idlocalidad=$fila["idlocalidad"];
		 $domicilio=$fila["domicilio"];
		 $codigo_postal=$fila["codigo_postal"];
	     $email=$fila["email"];
		 $f_nacimiento=$fila["f_nacimiento"];
		 $f_ingreso=$fila["f_ingreso"];
    	 $activo=$fila["activo"];
		 $telefono=$fila["telefono"];
		 $estado_civil=$fila["estado_civil"];
		 $dep_economico=$fila["dep_economico"];
		  $idpromotor=$fila["idpromotor"];
		  $uid=$fila["uid"];
						   
						   include("f_m_promotor.php");
						

	}
	
	if($form==2)
	{
	include("f_new_promotor.php");
	}







?>