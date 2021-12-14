<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 

session_start();
$id_usuario=$_SESSION["usuario"];


$descripcion=$_POST["descripcion"];
$valor=$_POST["valor"];
$fregistro=$_POST["fregistro"];
$marca=$_POST["marca"];
$modelo=$_POST["modelo"];
$estado_actual=$_POST["estado_actual"];
$valuador=$_POST["valuador"];
$no_serie=$_POST["no_serie"];
$no_factura=$_POST["no_factura"];
$dia=$_POST["dia"];
$mes=$_POST["mes"];
$ano=$_POST["ano"];


$enviar=$_POST["enviar"];

$idcliente=$_POST["idcliente"]; 
$idgtia=$_POST["idgtia"];  //solo cuando va ser modificacion

$f_factura="$dia-$mes-$ano";
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
	
		$sql= "SET datestyle TO postgres, dmy; select nuevo_garantiasp('$idcliente','$descripcion','$valor','$fregistro','$marca','$modelo','$estado_actual','$valuador','$no_serie','$no_factura','$f_factura','$id_usuario')";

				$query = pg_query($con,$sql);	
				
				//registra logs
				$usuario=$_SESSION["nombre_u"];
				$sql="select registrar_logs(1,'{$idcliente}','cc_gtias_prendarias','A','{$usuario}',
				'Alta de garantias Prendarias del cliente:'||(select nombre||' '||ap_paterno||' '||ap_materno from cc_clientes where idcliente={$idcliente}));";
				$querytmp = pg_query($con,$sql);

				while($row = pg_fetch_row($query))
                        { 
						$resultado=$row[0];
						$consulta=1;
						
						}
	
	
		if($consulta>0)
		{
		
		//echo $resultado;
		
		$idgtia=substr($resultado,1,(strlen($resultado)));
		$idgtia = substr($idgtia, 0,-1);
		$idgtia=trim($idgtia);
		
		echo "<div  align='center'><strong><font color='#003300'>Registro ingresado exitosamente</font></strong></div>";
		
		 $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_gtias_prendarias where idgtia='$idgtia'  order by descripcion desc";
	   $id_query = pg_query($con,$consulta);
	
	
		while( $fila= pg_fetch_array($id_query) )
		   {
	 
		$idcliente=$fila["idcliente"];	 
		$idgtia=$fila["idgtia"];
	 
		 $descripcion=$fila["descripcion"];
		 $valor=$fila["valor"];
		 $fregistro=$fila["fregistro"];  //fecha de valuacion
		 
		 $marca=$fila["marca"];
		 $modelo=$fila["modelo"];
		 $estado_actual=$fila["estado_actual"]; 
		 $valuador=$fila["valuador"];
		 
		 $no_serie=$fila["no_serie"];
		 
		 $no_factura=$fila["no_factura"];
		 $f_factura=$fila["f_factura"];
		 
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
		include("f_garantiasp_m.php");
		
		
		
		
		}
			
			
			else
		{
		echo "Error en el registro intente de nuevo mas tarde";
		$modif=0;
		include("f_garantiasp_m.php");
		}
	
	
	
	
	}


	
	
	if($enviar=="MODIFICAR")
	{
	

	$sql = "set datestyle to 'dmy'; UPDATE cc_gtias_prendarias SET idcliente='$idcliente',descripcion='$descripcion',valor='$valor',fregistro='$fregistro',marca='$marca',modelo='$modelo',estado_actual='$estado_actual',valuador='$valuador',no_serie='$no_serie',no_factura='$no_factura',f_factura='$f_factura',usuario='$id_usuario' WHERE idgtia='$idgtia'";

$consulta=pg_query($con, $sql); 
if($consulta>0)
		{
		echo "<div align='center'><strong><font color='#003300'>Registro modificado exitosamente</font></strong></div>";
		
		 $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_gtias_prendarias where idgtia='$idgtia'  order by descripcion desc";
	   $id_query = pg_query($con,$consulta);
	
				//registra logs
				$usuario=$_SESSION["nombre_u"];
				$sql="select registrar_logs(1,'{$idcliente}','cc_gtias_prendarias','M','{$usuario}',
				'Modificacion de garantias Prendarias del cliente:'||(select nombre||' '||ap_paterno||' '||ap_materno from cc_clientes where idcliente={$idcliente}));";
				$querytmp = pg_query($con,$sql);
	
		while( $fila= pg_fetch_array($id_query) )
		   {
	 
		$idcliente=$fila["idcliente"];	 
		$idgtia=$fila["idgtia"];
	 
		 $descripcion=$fila["descripcion"];
		 $valor=$fila["valor"];
		 $fregistro=$fila["fregistro"];  //fecha de valuacion
		 
		 $marca=$fila["marca"];
		 $modelo=$fila["modelo"];
		 $estado_actual=$fila["estado_actual"]; 
		 $valuador=$fila["valuador"];
		 
		 $no_serie=$fila["no_serie"];
		 
		 $no_factura=$fila["no_factura"];
		 $f_factura=$fila["f_factura"];
		 
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
		include("f_garantiasp_m.php");
		}
		else
		{
		echo "Error en el registro intente de nuevo mas tarde";
		$modif=0;
		include("f_garantiasp_m.php");
		}
	}

	



?>