	<div id="firstpane" class="menu_list">

<?php
			
if($orden==1)
{
$presenta="presenta2";
}
else
{	
$presenta="presenta";
}
					
					$estatus="0";
					$con=conectarse();
					
					
					$consulta="SELECT * FROM perfiles,perfiles_usr,u_usuarios,mnu_egos,estatus_menu where 
					perfiles.id_perfil=perfiles_usr.id_perfil 
					and perfiles_usr.id_perfil=u_usuarios.id_perfil 
					and mnu_egos.id=perfiles_usr.id_menu
					and mnu_egos.estatus=estatus_menu.valor
					and u_usuarios.id_perfil=".$_SESSION['id_perfil']."
					and u_usuarios.uid=".$_SESSION['usuario']."
					 order by mnu_egos.orden";
                     	$id_query=pg_query($con,$consulta); 
                     	while( $fila= pg_fetch_array($id_query))
                        {  
						
						$opcion=$fila["opciones"];
						$link=$fila["link"];
						$id=$fila["id"];
						
						


					?>
					<p class="menu_head" onclick="<?php echo $presenta; ?>(<?php echo $id; ?>); return false"><?php echo $opcion; ?></p>
					<div class="menu_body">
                    
					<?php
					$consul="SELECT * FROM mnu_egos where child='$id' and tipo='P' and estatus='1' order by opciones";
                     	$query=pg_query($con, $consul); 
                     	while( $row= pg_fetch_array($query) )
                        {  
						
						$enlace="{$d}{$row['link']}";						
					
					?>
					<a href="<?php echo $enlace; ?>" class="art-button"><? echo $row["opciones"]; ?></a>
						<?php
						}
						?>					
					
					</div>
					<?php
					}
					?>
					
					</div>			
	
	
	
	
	
	
	