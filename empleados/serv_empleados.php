<?
include("../includes/funciones.php");
include("../mysql/conexion.php");

$nombre = preparar_consulta(htmlentities($_POST["nombre"],ENT_QUOTES,"UTF-8"));
$ap_paterno = preparar_consulta(htmlentities($_POST["ap_paterno"],ENT_QUOTES,"UTF-8"));
$ap_materno = preparar_consulta(htmlentities($_POST["ap_materno"],ENT_QUOTES,"UTF-8"));
$sexo = preparar_consulta(htmlentities($_POST["sexo"],ENT_QUOTES,"UTF-8"));
/*$rfc = preparar_consulta(htmlentities($_POST["rfc"],ENT_QUOTES,"UTF-8"));
$curp = preparar_consulta(htmlentities($_POST["curp"],ENT_QUOTES,"UTF-8"));

$dire = preparar_consulta(htmlentities($_POST["dire"],ENT_QUOTES,"UTF-8"));
$cod_postal = preparar_consulta(htmlentities($_POST["cod_postal"],ENT_QUOTES,"UTF-8"));
$email = preparar_consulta(htmlentities($_POST["email"],ENT_QUOTES,"UTF-8"));*/
$id_perfil = preparar_consulta(htmlentities($_POST["id_perfil"],ENT_QUOTES,"UTF-8"));

$id_empleado = preparar_consulta(htmlentities($_POST["id_empleado"],ENT_QUOTES,"UTF-8"));

$enviar = preparar_consulta(htmlentities($_POST["enviar"],ENT_QUOTES,"UTF-8"));




$fecha = time();
 $dia = date("d", $fecha);
 $mes = date("m", $fecha);
 $ano = date("Y", $fecha);
$fech_captura=$ano.'-'.$mes.'-'.$dia;

	if($enviar=="MODIFICAR")
	{
	
	$sql="UPDATE empleado set nombre='$nombre',ap_paterno='$ap_paterno',ap_materno='$ap_materno',sexo='$sexo' where id_empleado='$id_empleado'";
	$consulta=mysql_query($sql);
	if($consulta>0)
	echo "Modificacion exitosa";
	else
	echo "Error al modificar".mysql_error();

	}

	if($enviar=="GUARDAR")
	{
	
	$sql="insert into empleado (nombre,ap_paterno,ap_materno,sexo,id_perfil,fech_captura) values('$nombre','$ap_paterno','$ap_materno','$sexo','$id_perfil','$fech_captura')";
	$consulta=mysql_query($sql);
	if($consulta>0)
	echo "Registro exitoso";
	else
	echo "Error en el registro".mysql_error();
	}





?>