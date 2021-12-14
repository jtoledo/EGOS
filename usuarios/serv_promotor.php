<?php
session_start();
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 

$id_usuario=$_SESSION["usuario"];

$nombre=$_POST["nombre"];
$a_paterno=$_POST["a_paterno"];
$a_materno=$_POST["a_materno"];
$dia=$_POST["dia"];
$mes=$_POST["mes"];
$ano=$_POST["ano"];
$genero=$_POST["genero"];
$rfc=$_POST["rfc"];
$curp=$_POST["curp"];
$telefono=$_POST["telefono"];
$activo=$_POST["activo"];
$idestado=$_POST["estado"];
$idmunicipio=$_POST["municipio"];
$idlocalidad=$_POST["localidad"];
$idcolonia=$_POST["colonia"];
$codigo_postal=$_POST["codigo_postal"];
$dep_economico=$_POST["dep_economico"];
$domicilio=$_POST["domicilio"];
$estado_civil=$_POST["estado_civil"];
$email=$_POST["email"];
$f_ingreso=$_POST["f_ingreso"];
$iniciales = $_POST["iniciales"];

$id_sucursal_modif = $_POST["id_sucursal"];

$usuario_modif = $_POST["usuario"];
$contra = $_POST["contra"];
$contra2 = $_POST["contra2"];

$enviar=$_POST["enviar"];

$f_nacimiento="$dia-$mes-$ano";

$idpromotor=$_POST["idpromotor"]; //solo cuando va ser modificacion
$usuario_id=$_POST["usuario_id"];// campo que modifica u_usuarios
$fecha_cambio=date("d-m-Y");

$contra = sha1(trim($contra));
//$contra2 = sha1(trim($contra2));
if($contra!=$contra2)
{
$bloq=1;
}

$nom_usuario="$nombre $a_paterno $a_materno";
$id_perfil_statico=25; //solo para promotores estatico

$con=conectarse();

if($enviar=="GUARDAR" and $bloq==1)
	{
	
 $idrol=16;
 $permisos_personalizados=1;
 $eliminado=1;
 $bloqueado=1;



$sql_u= "SET datestyle TO postgres, dmy; select nuevo_usuario('$nom_usuario','$idrol','$usuario_modif','$iniciales','$id_perfil_statico','$contra','$id_sucursal_modif')";

				$query_u = pg_query($con,$sql_u);
				
				//registra logs
				$usuario=$_SESSION["nombre_u"];
				$sql="select registrar_logs(1,currval('cc_promotores_idasesor_seq')::text,'cc_promotores','A','{$usuario}',
				'Alta de promotor  : {$nom_usuario}');";
				$querytmp = pg_query($con,$sql);		

				while($row = pg_fetch_row($query_u))
                        { 
						$resultado_u=$row[0];
						$consulta_u=1;
						
						}

					if($consulta_u>0)
						{
						
						//echo $resultado;
						
						$usuario_id=substr($resultado_u,1,(strlen($resultado_u)));
						$usuario_id = substr($usuario_id, 0,-1);
						
						
						
						
							$sql= "SET datestyle TO postgres, dmy; select nuevo_promotor('$a_paterno','$a_materno','$nombre','$rfc','$curp','$genero','$idestado','$idmunicipio','$idlocalidad','$idcolonia','$domicilio','$codigo_postal','$email','$f_nacimiento','$f_ingreso','$activo','$telefono',$estado_civil,'$dep_economico','$usuario_id','$fecha_cambio','$id_usuario')";

				$query = pg_query($con,$sql);	

				while($row = pg_fetch_row($query))
                        { 
						$resultado=$row[0];
						$consulta=1;
						
						}
	
	
		if($consulta>0)
		{
		
		//echo $resultado;
		
		$idpromotor=substr($resultado,1,(strlen($resultado)));
		$idpromotor = substr($idpromotor, 0,-1);
		$idpromotor=trim($idpromotor);
		
		echo "<div  align='center'><strong><font color='#003300'>Registro ingresado exitosamente</font></strong></div>";
		
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
			
			
			else
		{
		echo "Error en el registro intente de nuevo mas tarde";
		
		include("f_new_promotor.php");
		}
						
						
						
						
						
						}


	
	
	
	
	
	
	
	}


	
	
	if($enviar=="MODIFICAR")
	{
	



//$regimen_conyugal=NULL;	

	$sql = "set datestyle to 'dmy'; UPDATE cc_promotores SET nombre='$nombre',ap_paterno='$a_paterno',ap_materno='$a_materno',rfc='$rfc',curp='$curp',masculino='$genero',idlocalidad='$idlocalidad',idmunicipio='$idmunicipio',idestado='$idestado',idcolonia='$idcolonia',domicilio='$domicilio',codigo_postal='$codigo_postal',email='$email',f_nacimiento='$f_nacimiento',f_ingreso='$f_ingreso',activo='$activo',telefono='$telefono',estado_civil='$estado_civil',dep_economico='$dep_economico',uid='$usuario_id', usuario_modif='$id_usuario' WHERE idpromotor='$idpromotor'";

$consulta=pg_query($con, $sql); 


//registra logs
$usuario=$_SESSION["nombre_u"];
$sql="select registrar_logs(1,'{$idpromotor}','cc_promotores','M','{$usuario}',
'Modificacion de promotor  : {$nombre} {$a_paterno}');";
$querytmp = pg_query($con,$sql);		

if($consulta>0)
		{
		
		$sql_u="set datestyle to 'dmy'; UPDATE u_usuarios SET nombre='$nom_usuario', usuario='$usuario_modif', iniciales='$iniciales', id_perfil='$id_perfil_statico', contra='$contra', id_sucursal='$id_sucursal_modif' WHERE uid='$usuario_id'";
		
		$consulta_u=pg_query($con, $sql_u); 
		
					if($consulta_u>0)
					{
					
						echo "<div align='center'><strong><font color='#003300'>Registro modificado exitosamente</font></strong></div>";
						
						 
						
							
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
		
		}
		else
		{
		echo "Error en el registro intente de nuevo mas tarde";
		
		include("f_new_promotor.php");
		}
	}

	



?>