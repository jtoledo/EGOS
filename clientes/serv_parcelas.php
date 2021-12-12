<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 

session_start();
$id_usuario=$_SESSION["usuario"];


$f_registro=$_POST["f_registro"];
$desc_predio=$_POST["desc_predio"];
$idestado=$_POST["estado"];
$idmunicipio=$_POST["municipio"];
$idlocalidad=$_POST["localidad"];
$idcolonia=$_POST["colonia"];
$id_catalogo=$_POST["id_cafe"];
$super_esp=$_POST["super_esp"];
$num_predio=$_POST["num_predio"];
$color=$_POST["color"];
$textura=$_POST["textura"];
$estruct=$_POST["estruct"];

$temp=$_POST["temp"];
$lluvia=$_POST["lluvia"];

$poro=$_POST["poro"];
$perme=$_POST["perme"];
$prof_efe=$_POST["prof_efe"];
$hume_aire=$_POST["hume_aire"];
$vientos=$_POST["vientos"];
$brillo_solar=$_POST["brillo_solar"];
$nubosidad=$_POST["nubosidad"];
$enviar=$_POST["enviar"];

$st_hec=$_POST["st_hec"];
$st_area=$_POST["st_area"];
$st_centi=$_POST["st_centi"];
$st_deci=$_POST["st_deci"];


$sc_hec=$_POST["sc_hec"];
$sc_area=$_POST["sc_area"];
$sc_centi=$_POST["sc_centi"];
$sc_deci=$_POST["sc_deci"];



$idcliente=$_POST["idcliente"]; 
$id_parcela=$_POST["id_parcela"];  //solo cuando va ser modificacion


/*function convertir($cheq_fecha){
    list($d,$m,$a)=explode("/",$cheq_fecha);
    return $a."-".$m."-".$d;
};
$f_registro= convertir($f_registro);
$fecha_nac= convertir($fecha_nac);*/


$con=conectarse();

/*$errores = validar_campos_obligatorios(array($sucursal,$direccion,$telefono,$cp,$idsede,$idencargado,$enviar));	
	
	if(!empty($errores))
	{
		$band=1;
	}*/


if($enviar=="GUARDAR" /*and $band==1*/)
	{
	
		$sql= "SET datestyle TO postgres, dmy; select nuevo_parcelas('$idcliente','$f_registro','$desc_predio','$idestado','$idmunicipio','$idlocalidad','$idcolonia','$id_catalogo','$super_esp','$num_predio','$color','$textura','$estruct','$poro','$perme','$prof_efe','$temp','$lluvia','$hume_aire','$vientos','$brillo_solar','$nubosidad','$id_usuario','$st_hec','$st_area','$st_centi','$st_deci','$sc_hec','$sc_area','$sc_centi','$sc_deci');";
		
		$query = pg_query($con,$sql);	
				
				//registra logs
				$usuario=$_SESSION["nombre_u"];
				$sql="select registrar_logs(1,'{$idcliente}','cc_parcelas','A','{$usuario}',
				'Alta de Parcelas #{$num_predio} del cliente:'||(select nombre||' '||ap_paterno||' '||ap_materno from cc_clientes where idcliente={$idcliente}));";
				$querytmp = pg_query($con,$sql);

				while($row = pg_fetch_row($query))
            { 
						$resultado=$row[0];
						$consulta=1;
						//insertar registro en cc_parcela_cosecha		
						$sqlparcela="insert into cc_parcela_cosecha(id_parcela,id_periodo,id_catalogo,cosecha_esp_kg)
						 values({$resultado}, {$_SESSION['cosecha_sel']} ,{$id_catalogo},{$super_esp});";
						$queryparcela = pg_query($con,$sqlparcela);	
				}
	
	
		if($consulta>0)
		{
		
		//echo $resultado;
		
		$id_parcela=substr($resultado,1,(strlen($resultado)));
		$id_parcela = substr($id_parcela, 0,-1);
		$id_parcela=trim($id_parcela);
		
		echo "<div  align='center'><strong><font color='#003300'>Registro ingresado exitosamente</font></strong></div>";
		
		 $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_parcelas where id_parcela='$id_parcela' ";
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

		 $temp=$fila["temp"];
		 $lluvia=$fila["lluvia"];
		 
		 
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
			
			
			else
		{
		echo "Error en el registro intente de nuevo mas tarde";
		$modif=0;
		include("f_parcelas.php");
		}
	
	
	
	
	}


	
	
	if($enviar=="MODIFICAR")
	{
	

	$sql = "set datestyle to 'dmy'; UPDATE cc_parcelas SET idcliente='$idcliente',f_registro='$f_registro',desc_predio='$desc_predio',idlocalidad='$idlocalidad',idmunicipio='$idmunicipio',idestado='$idestado',idcolonia='$idcolonia',id_catalogo='$id_catalogo',super_esp='$super_esp',num_predio='$num_predio',color='$color',textura='$textura',estruct='$estruct',poro='$poro',perme='$perme',prof_efe='$prof_efe',temp='$temp',lluvia='$lluvia',hume_aire='$hume_aire',vientos='$vientos',brillo_solar='$brillo_solar', nubosidad='$nubosidad',usuario='$id_usuario', st_hec='$st_hec', st_area='$st_area', st_centi='$st_centi', st_deci='$st_deci' , sc_hec='$sc_hec', sc_area='$sc_area', sc_centi='$sc_centi', sc_deci='$sc_deci' WHERE id_parcela='$id_parcela'";

	$consulta=pg_query($con, $sql);

				//registra logs
				$usuario=$_SESSION["nombre_u"];
				$sql="select registrar_logs(1,'{$idcliente}','cc_parcelas','M','{$usuario}',
				'Modificacion de Parcelas #{$num_predio} del cliente:'||(select nombre||' '||ap_paterno||' '||ap_materno from cc_clientes where idcliente={$idcliente}));";
				$querytmp = pg_query($con,$sql);

if($consulta>0)
		{
		echo "<div align='center'><strong><font color='#003300'>Registro modificado exitosamente</font></strong></div>";
		
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
		 
		 $temp=$fila["temp"];
		 $lluvia=$fila["lluvia"];
		 
		 
		  $sc_hec=$fila["sc_hec"];
		 $sc_area=$fila["sc_area"];
		 $sc_centi=$fila["sc_centi"];
		 $sc_deci=$fila["sc_deci"];
		 
		 $sqlparcela="update cc_parcela_cosecha set cosecha_esp_kg={$super_esp}
		 where id_parcela={$id_parcela} and id_periodo={$_SESSION['cosecha_sel']} and id_catalogo={$id_catalogo} ;";
		 $queryparcela = pg_query($con,$sqlparcela);
		
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
		else
		{
		echo "Error en el registro intente de nuevo mas tarde";
		$modif=0;
		include("f_parcelas.php");
		}
	}

	



?>