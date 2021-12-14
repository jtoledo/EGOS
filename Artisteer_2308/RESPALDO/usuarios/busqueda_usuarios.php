<?
include("../mysql/conexion.php");
$titulo="Usuarios";
include(CABECERA);
?>
<div align="center">
  		
    <form name="captura" method="post"  action="busqueda_usuarios.php">
     <table >	 
      <tr>
        <td >Usuario:</td>
        <td ><input type="text" name="usuario" size="20" maxlength="200" value="" id="usuario" onChange="conMayusculas(this)"/></td>
      </tr>
      <tr >
        <td ><center>
          <input class="art-button" type="submit" name="buscador" id="buscador" value="BUSCAR" >
          </center>      </td>
        <td>
            
            
            
          <a href="alta_usuarios.php" class="art-button">AGREGAR USUARIO</a>        </td>
  </tr>
   </table>
     </form>
 
</div>
<div align="center">	
  <?
		 $criterio=1;
		 $nom="Limpiar";
      echo '<a href="busqueda_usuarios.php?criterio='.$criterio.'" >  <strong><span class="Estilo1">'.$nom.'</span></strong>  </a>';
      ?>
  <br />
  <?
  include("../mysql/conexion.php");

if ($_POST['buscador'])
{ 
$user = $_POST['usuario'];
if(empty($user))
{
echo "Debe ingresar alguna Busqueda";
}
else{
if($user!="")
$sql = "SELECT * FROM usuarios,empleado,perfiles WHERE usuarios.user_name LIKE '$user%' and usuarios.id_usuario=empleado.id_empleado and  perfiles.id_perfil=usuarios.id_perfil LIMIT 10";
$result = mysql_query($sql); 
$total = mysql_num_rows($result);
if ($registro = mysql_fetch_array($result)){ 
echo "Resultados Encontrados: ";
?>
  <table class="Record art-article" >
    <tr>
      
	    <td>Nombre</td>
   		<td width="51" class="th">RFC</td>
        <td width="110" class="th">Direcci&oacute;n</td>
		<td width="31" class="th">Perfil</td>
        <th width="47" class="th">Usuario</th>
    </tr>
    <?
do { 
?>
    <tr > 
        
       <td width="169">
        <b><? 
	
	$nombre=$registro["nombre"]." ".$registro["ap_paterno"]." ".$registro["ap_materno"];
	$rfc=$registro["rfc"];
	$direccion=$registro["dire"];		
	$nom_perfil=$registro["nom_perfil"];
	$usua=$registro["user_name"];
	$id_usuario=$registro["id_usuario"];
  echo '<a href="modif_usuarios.php?id_usuario='.$id_usuario.'" >  <strong><span class="Estilo1">'.$nombre.'</span></strong>  </a>';		
		
	
	
	
	?></b>        </td> 
      <td><? echo utf8_decode($rfc); ?></td>
      <td><? echo utf8_decode($direccion); ?></td>
      <td><? echo utf8_decode($nom_perfil); ?></td>
      <td><div align="center"><? echo utf8_decode($usua); ?></div></td>
    </tr>
    <?
} while ($registro = mysql_fetch_array($result)); 
?>
  </table>

<?
echo "<p>Resultados: $total</p>";
} else { 
// En caso de no encontrar resultados
echo "No se encontraron resultados "; 
}
}
}

else 

{
if ($_GET["criterio"]!="")
{
include("paginacion_usuarios.php");
}
else{
include("paginacion_usuarios.php");
}
}


?>  
                                        
</div>  
 <?
$back=1;
include(FOOTER);

?>
