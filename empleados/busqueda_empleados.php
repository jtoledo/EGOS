<?php
include("../mysql/conexion.php");
$titulo="Busqueda de Empleados";
include(CABECERA);
?>

<div align="center">			
<form name="captura" method="post"  action="busqueda_empleados.php">
<table class="Record art-article" >
  <tr>
    <th> Nombre de Empleado</th>
    <td ><input type="text" name="nombre" size="20" maxlength="200" value="" id="nombre" onChange="conMayusculas(this)"></td>
  </tr>
  <tr >
    <td ><center>
      <input class="art-button" type="submit" name="buscador" id="buscador" value="BUSCAR" >
      </center>
      
      </td>
      <td>
     
    
	  <a href="alta_empleados.php" class="art-button">AGREGAR EMPLEADO</a>
      </td>
      
  </tr>
</table> 
 </form>
</div>
<div align="center">	
  <?
		 $criterio=1;
		 $nom="Limpiar";
      echo '<a href="busqueda_empleados.php?criterio='.$criterio.'" >  <strong><span class="Estilo1">'.$nom.'</span></strong>  </a>';
      ?>
  <br />
  <?
  include("../mysql/conexion.php");

if ($_POST['buscador'])
{ 
$nombre = $_POST['nombre'];
if(empty($nombre))
{
echo "Debe ingresar alguna Busqueda";
}
else{
if($nombre!="")
$sql = "SELECT * FROM empleado WHERE nombre LIKE '$nombre%' LIMIT 10";
$result = mysql_query($sql); 
$total = mysql_num_rows($result);
if ($registro = mysql_fetch_array($result)){ 
echo "Resultados Encontrados: ";
?>
  <table class="Record art-article" >
    <tr>
      
	  <th >Nombre </th>
	 
	  
	   <th >Perfil </th>
	  
      </tr>
    <?
do { 
?>
    <tr>
      <td>
        <b><? 
	
	$nombre=$registro["nombre"]; 
	$ap_paterno=$registro["ap_paterno"]; 
	$ap_materno=$registro["ap_materno"]; 
	$id_empleado=$registro["id_empleado"];
	$nombre="$nombre $ap_paterno $ap_materno";
	
	$id_perfil=$registro["id_perfil"];
	
	
echo '<a href="modif_empleados.php?id_empleado='.$id_empleado.'" >  <strong><span class="Estilo1">'.$nombre.'</span></strong>  </a>';		
		
	
	
	
	?></b>
        </td> 
      
	 
	 
      <td>
<?
$sql="select * from perfiles where id_perfil='$id_perfil'";
	  $consulta=mysql_query($sql);
	  while($fila_p=mysql_fetch_array($consulta))
	  {
	  $descripcion=$fila_p["nom_perfil"];
	  }
	  
	  echo utf8_decode($descripcion);



?>
	  </td>
	  
	  
	  
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
include("paginacion_empleados.php");
}
else{
include("paginacion_empleados.php");
}
}


?>  
                                        
</div>  
 <?
$back=1;
include(FOOTER);

?>