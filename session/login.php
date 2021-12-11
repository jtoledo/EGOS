<?php
$titulo="Bienvenido";
include ("../includes/constantes.php");
include ("../includes/funciones.php");
include("conexion.php"); 
if(!isset($_SESSION["usuario"])) 
{
$orden=0;
$titulo="Identificacion de Usuario";
include (CABECERA);  
$con=conectarse();
?>

 <div id="contact">
            <h1>Identificaci&oacute;n de Usuario</h1>
            <form id="ContactForm"  name="logi" action="" onSubmit="autentifica(); return false">
                <p>
                    <label>Usuario</label>
                    <input id="user" name="user" class="inplaceError" maxlength="120" type="text" autocomplete="off"/>
					<span class="error" style="display:none;"></span>
                </p>
                <p>
                    <label>Contrase&ntilde;a</label>
                    <input id="contra" name="contra" class="inplaceError" maxlength="120" type="password" autocomplete="off"/>
					<span class="error" style="display:none;"></span>
                </p>
                <p align="right">
                     <table border="0" width="81%">
                     <tr>
								<td>Sucursal</td> 
								<td>Cosecha</td>                    
                     </tr>
                     <tr>
								<td><?php get_sucursal_selec(0); ?> </td>
								<td><?php get_sel_cosecha(0); ?>  </td>								
								                     
                     </tr>       
                  </table>
                         
                    
               
                    
                </p>
                  <p></p> 
               
                <p class="submit">
                   
                    <input class="send" type="submit" name="enviar"  value="ENVIAR"  > 
                    
                    
                    <span id="loader" class="loader" style="display:none;"></span>
						  <span id="success_message" class="success"></span>
                </p>
				<input id="newcontact" name="newcontact" type="hidden" value="1"></input>
            </form>
        </div>
   
<?php
include(FOOTER);  
}
else
{
header("Location: ../inicio.php");
}
?>