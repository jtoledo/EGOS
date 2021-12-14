<?
ob_start();
include("../includes/constantes.php");
include("conexion.php"); 
$user=$_POST['user'];
$contra=$_POST['contra'];

$usuarios=pg_query("SELECT * FROM usuarios WHERE user_name='$user' and pass='$contra' ");
if($user_ok = pg_fetch_array($usuarios)) 
{
   $id_perfil=$user_ok["id_perfil"];
   $id_user=$user_ok["id_usuario"];
   
   $consulta="SELECT * FROM perfiles where id_perfil='$id_perfil'";
   $id_query = pg_query($consulta);
    	while( $fila= pg_fetch_array($id_query) )
            {  
			  $perfil=$fila["nom_perfil"];
					}

	$consulta="SELECT * FROM usuarios where id_usuario='$id_user'";
    $id_query = pg_query($consulta);
      	while( $fila= pg_fetch_array($id_query) )
            {  
	  		  $nombre=$fila["user_name"];
					}
     
    $consulta="SELECT * FROM empleado WHERE id_empleado='$id_user'";
	 $query=pg_query($consulta);
	   while($row=pg_fetch_array($query))
	       {
		       $id_empresa=$row["id_empresa"];
			    }


$_SESSION['usuario'] = $user_ok["id_usuario"];
$_SESSION['tipo'] = $user_ok["id_perfil"];
$_SESSION['nombre'] = $nombre;
$_SESSION['perfil'] = $perfil;
$_SESSION["id_empresa"]=$id_empresa;

echo "1";
 }
else
echo "Error Usuario o Contrase&ntilde;a Incorrectos Verifica Tus Datos";

?>

