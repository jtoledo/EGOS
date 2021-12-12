<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 

session_start();
$id_usuario=$_SESSION["usuario"];


$descripcion=$_POST["descripcion"];
$valor=$_POST["valor"];
$fvaluacion=$_POST["fvaluacion"];
$registro=$_POST["registro"];
$libro=$_POST["libro"];
$tomo=$_POST["tomo"];
$seccion=$_POST["seccion"];
$volumen=$_POST["volumen"];
$superficie=$_POST["superficie"];
$dia=$_POST["dia"];
$mes=$_POST["mes"];
$ano=$_POST["ano"];
$antecedentes=$_POST["antecedentes"];

$enviar=$_POST["enviar"];

$idcliente=$_POST["idcliente"]; 
$idgtia=$_POST["idgtia"];  //solo cuando va ser modificacion

$fregistro="$dia-$mes-$ano";
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
	
		$sql= "SET datestyle TO postgres, dmy; select nuevo_garantiash('$idcliente','$descripcion','$valor','$fvaluacion','$registro','$libro','$tomo','$seccion','$volumen','$superficie','$fregistro','$antecedentes','$id_usuario')";

				$query = pg_query($con,$sql);
								
				//registrar logs
				$usuario=$_SESSION["nombre_u"];
				$sql="select registrar_logs(1,'{$idcliente}','cc_gtias_hipotecarias','A','{$usuario}',
				'Alta de Recursos {$fvaluacion} para cliente ID: {$idcliente}');";
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
			
			
			else
		{
		echo "Error en el registro intente de nuevo mas tarde";
		$modif=0;
		include("f_garantiash_m.php");
		}
	
	
	
	
	}


	
	
	if($enviar=="MODIFICAR")
	{
	

	$sql = "set datestyle to 'dmy'; UPDATE cc_gtias_hipotecarias SET idcliente='$idcliente',descripcion='$descripcion',valor='$valor',fvaluacion='$fvaluacion',registro='$registro',libro='$libro',tomo='$tomo',seccion='$seccion',volumen='$volumen',superficie='$superficie',fregistro='$fregistro',antecedentes='$antecedentes',usuario='$id_usuario' WHERE idgtia='$idgtia'";

$consulta=pg_query($con, $sql); 

//registrar logs
$usuario=$_SESSION["nombre_u"];
$sql="select registrar_logs(1,'{$idcliente}','cc_gtias_hipotecarias','M','{$usuario}',
'Modificacion de Recursos {$fvaluacion} para cliente ID: {$idcliente}');";
$querytmp = pg_query($con,$sql);	

if($consulta>0)
		{
		echo "<div align='center'><strong><font color='#003300'>Registro modificado exitosamente</font></strong></div>";
		
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
		else
		{
		echo "Error en el registro intente de nuevo mas tarde";
		$modif=0;
		include("f_garantiash_m.php");
		}
	}

	



?>