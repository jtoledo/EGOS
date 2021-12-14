<?php
include("../includes/funciones.php");
include("../mysql/conexion.php");
$titulo="Edicion de Empleados";
include(CABECERA);
?>

<?
if($_GET["id_empleado"])
{
$id_empleado = preparar_consulta(htmlentities($_GET["id_empleado"],ENT_QUOTES,"UTF-8"));

$sql="SELECT * from empleado where id_empleado='$id_empleado'";
$consulta=mysql_query($sql);

	while($fila=mysql_fetch_array($consulta))
	{
	$nombre=$fila["nombre"];
	$ap_paterno=$fila["ap_paterno"];
	$ap_materno=$fila["ap_materno"];
	/*$rfc=$fila["rfc"];
	$curp=$fila["curp"];*/
	$sexo=$fila["sexo"];
	/*$dire=$fila["dire"];
	$cod_postal=$fila["cod_postal"];
	$email=$fila["email"];*/
	$id_perfil=$fila["id_perfil"];
	/*$id_sucursal=$fila["id_empresa"];
	$telefono=$fila["telefono"];*/
	}

}
?>			

<form name="captura" action="" onSubmit="modif_empleados(); return false">
  <div align="center">
  <input type="hidden" name="id_empleado" value="<? echo $id_empleado; ?>" />
  <table class="Record art-article" >
    <tr>
      <th > Nombre de empleado</th>
        <td ><input type="text" name="nombre" size="20" maxlength="200" value="<? echo $nombre; ?>" id="nombre" onChange="conMayusculas(this)"></td>
      </tr>
    
    <tr>
      <th > Apellido Paterno</th>
        <td><input type="text" name="ap_paterno" size="20" maxlength="200" value="<? echo $ap_paterno; ?>" id="ap_paterno" onChange="conMayusculas(this)"></td>
      </tr>
    <tr>
      <th > Apellido Materno</th>
        <td ><input type="text" name="ap_materno" size="20" maxlength="200" value="<? echo $ap_materno; ?>" id="ap_materno" onChange="conMayusculas(this)"></td>
      </tr>
    
 
    <tr>
      <th>
        
        G&eacute;nero      </th>
				          <td >
					          
				            <select name="sexo">
				              <option value="">Seleccione</option>
				              <option value="Hombre">Masculino</option>
				              <option value="Mujer">Femenino</option>
			                </select>				      </td>
	            </tr>	
    
    
 
    
    <tr >
      <td colspan="2"><center>
        <input class="art-button" type="submit" name="enviar" id="enviar" value="MODIFICAR" >               
        </center>      </td>
      </tr>
  </table>
  </div>
</form>
<div id="modif_empleados"></div>

 <?
$back=5;
include(FOOTER);

?>
