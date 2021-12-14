<?php
session_start();
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
$id_usuario=$_SESSION["usuario"];
$nombre=$_POST["nombre"];
$a_paterno=$_POST["a_paterno"];
$a_materno=$_POST["a_materno"];
$genero=$_POST["genero"];
$rfc=$_POST["rfc"];
$ife=$_POST["ife"];
$curp=$_POST["curp"];

$lugar_nac=$_POST["lugar_nac"];
$idestado=$_POST["estado"];
$idmunicipio=$_POST["municipio"];
$idlocalidad=$_POST["localidad"];
$idcolonia=$_POST["colonia"];
$domicilio=$_POST["domicilio"];
$cod_postal=$_POST["cod_postal"];

$estado_civil=$_POST["estado_civil"];
$regimen_conyugal=$_POST["regimen_conyugal"];
$nombre_conyugue=$_POST["nombre_conyugue"];
$integrantes=$_POST["integrantes"];
$tel_fijo=$_POST["tel_fijo"];
$tel_movil=$_POST["tel_movil"];
$email=$_POST["email"];
$id_tipo=$_POST["id_tipo"];
$f_registro=$_POST["f_registro"];
$clv_fira=$_POST["clv_fira"];
$clv_ha=$_POST["clv_ha"];
$id_cuenta=$_POST["id_cuenta"];
$idcuenta_ant=(isset($_POST["id_cuenta_ant"])?$_POST["id_cuenta_ant"]:0);
$idestrato=$_POST["idestrato"];
$tipo_cliente=$_POST['cliente'];

$cli_ver=$_POST["cli_ver"];

$idgrupo=$_POST["id_grupo"];

$enviar=$_POST["enviar"];


$dia=$_POST["dia"];
$mes=$_POST["mes"];
$ano=$_POST["ano"];
$fecha_nac="$dia-$mes-$ano";
$idcliente=$_POST["idcliente"]; //solo cuando va ser modificacion

$num_productor=$_POST["num_productor"]; //solo cuando va ser modificacion


if($integrantes=="")
$integrantes="null";


if($regimen_conyugal=="")
{
$regimen_conyugal="null";
}



$persona_fisica=1;


//solo no validamos id_para modificar

$con=conectarse();

/*$errores = validar_campos_obligatorios(array($sucursal,$direccion,$telefono,$cp,$idsede,$idencargado,$enviar));	
	
	if(!empty($errores))
	{
		$band=1;
	}*/


if($enviar=="GUARDAR" /*and $band==1*/)
	{
	

		$bloquea_rfc=get_bloqueo_rfc($rfc);
		if($bloquea_rfc==1){echo 0; exit;}
		$bloquea_ife=get_bloqueo_ife($ife);
		if($bloquea_ife==1){echo 1; exit;}
		$bloquea_curp=get_bloqueo_curp($curp);
		if($bloquea_curp==1){echo 2; exit;}
		$bloquea_nombre=get_bloqueo_nombre(trim($nombre)." ".trim($a_paterno)." ".trim($a_materno));
		if($bloquea_nombre==1){echo 3; exit;}

		$idcuenta_ant=($idcuenta_ant!=""?$idcuenta_ant:'0');	
		if($id_cuenta=="")
		{
	
			$sql= "begin; SET datestyle TO postgres, dmy; select nuevo_clientes('$tipo_cliente','$persona_fisica','$rfc','".trim($a_paterno)."','".trim($a_materno)."','".trim($nombre)."','$genero','$curp','$idestado','$idmunicipio','$idlocalidad','$idcolonia','$domicilio','$cod_postal','$email','$tel_fijo','$tel_movil','$fecha_nac','$estado_civil',$regimen_conyugal,'$nombre_conyugue',$integrantes,'$lugar_nac','$f_registro','$ife',null,'$idcuenta_ant','$id_usuario','$clv_fira','$clv_ha','$idestrato','$id_tipo','$num_productor','$cli_ver');";
		}
		else
		{
			$sql= "begin; SET datestyle TO postgres, dmy; select nuevo_clientes('$tipo_cliente','$persona_fisica','$rfc','".trim($a_paterno)."','".trim($a_materno)."','".trim($nombre)."','$genero','$curp','$idestado','$idmunicipio','$idlocalidad','$idcolonia','$domicilio','$cod_postal','$email','$tel_fijo','$tel_movil','$fecha_nac','$estado_civil',$regimen_conyugal,'$nombre_conyugue',$integrantes,'$lugar_nac','$f_registro','$ife','$id_cuenta','$idcuenta_ant','$id_usuario','$clv_fira','$clv_ha','$idestrato','$id_tipo','$num_productor','$cli_ver');";
		}

		//agregar el grupo verificar si tiene id de grupo
				
				if($idgrupo!='') {
					$sql.="insert into rela_grupo(idgrupo,idcliente,fecha_add,status,usuario) 
					values('$idgrupo',currval('cc_clientes_idcliente_seq'),now()::date,true,'$id_usuario') returning idcliente;";
						
				}
				$sql.=" commit; select currval('cc_clientes_idcliente_seq') as cliente;";
			
		$query = pg_query($con,$sql);	
		
			
		//registra logs
		$usuario=$_SESSION["nombre_u"];
		$sql="select registrar_logs(1,currval('cc_clientes_idcliente_seq')::TEXT,'cc_clientes','A','{$usuario}',
		'Alta de datos personales del cliente: {$a_paterno} {$a_materno} {$nombre}');";
		$querytmp = pg_query($con,$sql);
		
		while($row = pg_fetch_row($query))
      { 
				$resultado=$row[0];
				$consulta=1;

		}
	
	
		if($consulta>0)
		{
		
		//echo $resultado;
			//echo $resultado;
			//$cliente_id=substr($resultado,1,(strlen($resultado)));
			//$cliente_id = substr($cliente_id, 0,-1);
			$cliente_id=trim($resultado);
		   
		   
			echo "<div  align='center'><strong><font color='#003300'>Registro ingresado exitosamente</font></strong></div>";
		
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
		      $tipo_cliente=$fila["tipo_cliente"];
		 		$idcliente=$fila["idcliente"];
		   	$id_tipo=$fila["id_tipo"];
		    	$estado_civil=$fila["estado_civil"];
				$num_productor=$fila["num_productor"];
				$cli_ver=$fila["idverificacion"];
				$idgrupo=$fila["idgrupo"];
			}
			$modif=1;
			include("f_m_s.php");
	 }
	 else
	 {
		echo "Error en el registro intente de nuevo mas tarde";
		$modif=0;
		include("f_new_s.php");
	 }
	
}


	
	
	if($enviar=="MODIFICAR")
	{
	
		$bloquea_rfc=get_bloqueo_rfc_m($rfc,$idcliente);
		if($bloquea_rfc==1){echo 0; exit;}
		
		$bloquea_ife=get_bloqueo_ife_m($ife,$idcliente);
		if($bloquea_ife==1){echo 1; exit;}

		$bloquea_curp=get_bloqueo_curp_m($curp,$idcliente);
		if($bloquea_curp==1){echo 2; exit;}
	
		$bloquea_nombre=get_bloqueo_nombre_m(trim($nombre)." ".trim($a_paterno)." ".trim($a_materno),$idcliente);
		if($bloquea_nombre==1){echo 3; exit;}



		//$regimen_conyugal=NULL;	
		if($id_cuenta=="")
		{	
			$idcuenta_ant=($idcuenta_ant!=""?$idcuenta_ant:'0');			
			$sql = "begin; set datestyle to 'dmy'; UPDATE cc_clientes SET idverificacion='$cli_ver',tipo_cliente=$tipo_cliente,idctaanticipoprov=$idcuenta_ant,nombre='".trim($nombre)."',ap_paterno='".trim($a_paterno)."',ap_materno='".trim($a_materno)."',masculino='$genero',rfc='$rfc',ife='$ife',curp='$curp',f_nac_const='$fecha_nac',lugar_nacimiento='$lugar_nac',idlocalidad='$idlocalidad',idmunicipio='$idmunicipio',idestado='$idestado',idcolonia='$idcolonia',domicilio='$domicilio',codigo_postal='$cod_postal',estado_civil='$estado_civil',regimen_conyugal=$regimen_conyugal,nombre_conyuge='$nombre_conyugue',integrantes_familia=$integrantes,telefono1='$tel_fijo',telefono2='$tel_movil',email='$email',id_tipo='$id_tipo',f_registro='$f_registro',clv_fira='$clv_fira',clv_ha='$clv_ha',idcuenta=null,idestrato='$idestrato', num_productor='$num_productor' WHERE idcliente='$idcliente';";
		}
		else
		{
			$idcuenta_ant=($idcuenta_ant!=""?$idcuenta_ant:'0');			
			$sql = "begin; set datestyle to 'dmy'; UPDATE cc_clientes SET idverificacion='$cli_ver',tipo_cliente=$tipo_cliente,idctaanticipoprov=$idcuenta_ant,nombre='".trim($nombre)."',ap_paterno='".trim($a_paterno)."',ap_materno='".trim($a_materno)."',masculino='$genero',rfc='$rfc',ife='$ife',curp='$curp',f_nac_const='$fecha_nac',lugar_nacimiento='$lugar_nac',idlocalidad='$idlocalidad',idmunicipio='$idmunicipio',idestado='$idestado',idcolonia='$idcolonia',domicilio='$domicilio',codigo_postal='$cod_postal',estado_civil='$estado_civil',regimen_conyugal=$regimen_conyugal,nombre_conyuge='$nombre_conyugue',integrantes_familia=$integrantes,telefono1='$tel_fijo',telefono2='$tel_movil',email='$email',id_tipo='$id_tipo',f_registro='$f_registro',clv_fira='$clv_fira',clv_ha='$clv_ha',idcuenta='$id_cuenta',idestrato='$idestrato', num_productor='$num_productor' WHERE idcliente='$idcliente';";

		}
		
		if($row = pg_fetch_row(pg_query($con, "select * from rela_grupo where idcliente='$idcliente'")))
      { 
					if($idgrupo!='') {
							$sql.="update rela_grupo set idgrupo='$idgrupo',usuario='$id_usuario' where idcliente='$idcliente';";
					}else {
							$sql.="delete from rela_grupo where idcliente='$idcliente';";	
						
					}					
								
						
		}else {
					if($idgrupo!='') {
						$sql.="insert into rela_grupo(idgrupo,idcliente,fecha_add,status,usuario) 
						values('$idgrupo','$idcliente',now()::date,true,'$id_usuario');";							
					}	
					
		}
	
		$sql.="commit;";	
		$consulta=pg_query($con, $sql); 

		$usuario=$_SESSION["nombre_u"];
		$sql="select registrar_logs(1,'{$idcliente}','cc_clientes','M','{$usuario}',
		'Modificacion de datos personales del cliente: {$a_paterno} {$a_materno} {$nombre}');";
		$querytmp = pg_query($con,$sql);
				
		if($consulta>0)
		{

			
			echo "<div align='center'><strong><font color='#003300'>Registro modificado exitosamente</font></strong></div>";
		
		  	$consulta=" SET datestyle TO postgres, dmy; SELECT *,(select idgrupo from rela_grupo where idcliente=c.idcliente) as idgrupo FROM cc_clientes  c WHERE idcliente='$idcliente'";
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
		  		$tipo_cliente=$fila["tipo_cliente"];
		  		$idcliente=$fila["idcliente"];
		   	$id_tipo=$fila["id_tipo"];
		    	$estado_civil=$fila["estado_civil"];
				$num_productor=$fila["num_productor"];
				$cli_ver=$fila["idverificacion"];
				$idgrupo=$fila["idgrupo"];
			}
		
			$modif=1;
			include("f_m_s.php");
		}
		else
		{
			echo "Error en el registro intente de nuevo mas tarde";
			$modif=0;
			include("f_m_s.php");
		}
	}


?>