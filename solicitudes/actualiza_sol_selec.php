<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
$idcliente = $_POST["idcliente"];
$form = $_POST["form"];

session_start();
$id_usuario=$_SESSION["usuario"];


$con=conectarse();

$errores = validar_campos_obligatorios(array($idcliente));	
	
	if(!empty($errores))
	{
		$band=1;
	}
	
	
	if($band==1 and $form==1)
	{
	    $stock=get_tipo_cliente($idcliente);
		if($stock==2)
		{
		echo 0;
//		exit;
		}
		
		if($stock!=2)
		{
			$fila=get_exits_sol_cliente($idcliente,$_SESSION['mov_sucursal'],$_SESSION['cosecha_sel']);// comprueba si el cliente tiene solicitudes si no tiene lo manda a crear una nueva solicitud
			if($fila!=0)
			{
			$fila=get_solicitud_m($fila["idsolicitud"]);  
			$modif=1;
			include("solicitud_m.php");
			}
			else
			{
				
			$nom_asesor=get_asesor($id_usuario);
			include("solicitud_new.php"); 
			}
		}

	
	}
	




?>