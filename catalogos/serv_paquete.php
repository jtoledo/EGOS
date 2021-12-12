<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 

session_start();
$id_usuario=$_SESSION["usuario"];


$nom_paquete=$_POST["nom_paquete"];
$descripcion_paquete=$_POST["descripcion_paquete"];
$fecha_paq=$_POST["fecha_paq"];

$enviar=$_POST["enviar"];

$ingre_hec=$_POST["ingre_hec"];
$iduni=$_POST["iduni"];
$precio_hec=$_POST["precio_hec"];
$smg=$_POST["smg"];


$id_paquete=$_POST["id_paquete"]; 




$con=conectarse();

/*$errores = validar_campos_obligatorios(array($sucursal,$direccion,$telefono,$cp,$idsede,$idencargado,$enviar));	
	
	if(!empty($errores))
	{
		$band=1;
	}*/


if($enviar=="GUARDAR" /*and $band==1*/)
	{
	
		$sql= "SET datestyle TO postgres, dmy; select nuevo_paquete('$nom_paquete','$descripcion_paquete','$fecha_paq','$id_usuario','$ingre_hec','$iduni','$precio_hec','$smg')";

				$query = pg_query($con,$sql);	
				
				
				//registrar logs
				$usuario=$_SESSION["nombre_u"];
				$sql="select registrar_logs(1,currval('paquete_tec_id_paquete_seq')::text,'paquete_tec','A','{$usuario}',
				'Alta de paquete tecnologico: {$nom_paquete}');";
				$querytmp = pg_query($con,$sql);

				while($row = pg_fetch_row($query))
                        { 
						$resultado=$row[0];
						$consulta=1;
						
						}
	
	
		if($consulta>0)
		{
		
		//echo $resultado;
		
		$id_paquete=substr($resultado,1,(strlen($resultado)));
		$id_paquete = substr($id_paquete, 0,-1);
		$id_paquete=trim($id_paquete);
		
		echo "<div  align='center'><strong><font color='#003300'>Registro ingresado exitosamente</font></strong></div>";
		
		  $fila=get_paquete_tec_m($id_paquete);
	   
	     $id_paquete=$fila["id_paquete"];
		 $nom_paquete=$fila["nom_paquete"];
		 $descripcion_paquete=$fila["descripcion_paquete"];
		 $fecha_paq=$fila["fecha_paq"];
		  $ingre_hec=$fila["ingre_hec"];
		 $iduni=$fila["iduni"];
		 $precio_hec=$fila["precio_hec"];
		 $smg=$fila["smg"];

		
		$modif=1;
		include("paquete_m.php");
		
		
		
		
		
		}
			
			
			else
		{
	echo "Error en el registro intente de nuevo mas tarde";
		include("paquete_new.php");
		}
	
	
	
	
	}


	
	
	if($enviar=="MODIFICAR")
	{
	

	$sql = "set datestyle to 'dmy'; UPDATE paquete_tec SET nom_paquete='$nom_paquete',descripcion_paquete='$descripcion_paquete',fecha_paq='$fecha_paq',usuario='$id_usuario',ingre_hec='$ingre_hec',iduni='$iduni',precio_hec='$precio_hec', smg='$smg' WHERE id_paquete='$id_paquete'";

$consulta=pg_query($con, $sql); 

//registrar logs
$usuario=$_SESSION["nombre_u"];
$sql="select registrar_logs(1,'{$id_paquete}','paquete_tec','M','{$usuario}',
'Modificar paquete tecnologico: {$nom_paquete}');";
$querytmp = pg_query($con,$sql);


if($consulta>0)
		{
		echo "<div align='center'><strong><font color='#003300'>Registro modificado exitosamente</font></strong></div>";
		
		  $fila=get_paquete_tec_m($id_paquete);
	   
	     $id_paquete=$fila["id_paquete"];
		 $nom_paquete=$fila["nom_paquete"];
		 $descripcion_paquete=$fila["descripcion_paquete"];
		 $fecha_paq=$fila["fecha_paq"];
		 $ingre_hec=$fila["ingre_hec"];
		 $iduni=$fila["iduni"];
		 $precio_hec=$fila["precio_hec"];
		 $smg=$fila["smg"];

		
		$modif=1;
		include("paquete_m.php");
		
		}
		else
		{
		echo "Error en el registro intente de nuevo mas tarde";
		include("paquete_new.php");
		}
	}

	



?>