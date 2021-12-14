<?php require("../includes/session.php");?>
<?php verificar_sesion(); ?>
<?php
/*$id_usuario=$_SESSION["usuario"];
$nombre=$_SESSION["nombre"];
$perfil=$_SESSION["perfil"];
$sucursal_id=$_GET["sucursal_id"];
$id_perfil=$_SESSION["id_perfil"];
*/$orden=1; //ESPECIFICAR CUANDO ESTA DENTRO DE UNA CARPETA
$d="../"; //ESPECIFICAR PARA EL RECORRIDO DE MENU
$titulo="SISTEMA INTEGRAL DE INFORMACION";
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php");

require(CABECERA);
/*$c_sucursal="SELECT * FROM cc_sucursales WHERE id='$sucursal_id'";
$query_c=pg_query($con,$c_sucursal);
while($row_sucursal=pg_fetch_array($query_c))
{
$sucursal=$row_sucursal["sucursal"];
$direccion=$row_sucursal["direccion"];
$telefono=$row_sucursal["telefono"];
$cp=$row_sucursal["cp"];
$idsede=$row_sucursal["idsede"];
$idencargado=$row_sucursal["idencargado"];

}
*/?>


<div id="contenido" align="center">

<?php 
if(isset($_GET["idcliente"]))
{

$idcliente=$_GET["idcliente"];

 $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_clientes  WHERE idcliente='$idcliente'";
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
		}
		
		$modif=1;
		include("f_m_s.php"); 

}
else
{
			$comparar=get_exit_cliente();
			if($comparar==1){
				include("f_m_s.php"); 
			}else{
			include("f_new_s.php"); 
			}
			
}







?>
</div> 



<div id="consul_sucursal">
  </div>




   
<?php
include (FOOTER);  
?>