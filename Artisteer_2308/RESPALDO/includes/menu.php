	<ul class="art-menu">
					

<li>
                			<a href="#" class="active"><span class="l"></span><span class="r"></span><span class="t">Inicio</span></a>
                		</li>

					<li>
                			<a href="#"><span class="l"></span><span class="r"></span><span class="t">CARTERAS
							
							</span></a>
							
							<ul>


						
					
					<?
					
					
					
					$consulta="SELECT * FROM perfiles,perfiles_usr,usuarios,menu where perfiles.id_perfil=perfiles_usr.id_perfil and
					
					perfiles_usr.id_perfil=usuarios.id_perfil 
					
					and menu.id_menu=perfiles_usr.id_menu
					and usuarios.id_perfil='$id_perfil'
					and usuarios.id_usuario='$id_usuario'
					
					
					 order by menu.id_menu";
                     	$id_query = mysql_query($consulta);
                     	while( $fila= mysql_fetch_array($id_query) )
                        {  
						
						$opcion=$fila["opcion"];
						$link=$fila["link"];
						
								
								
								
				
						?>
						
						
						
						
						
							
                			<li><a href="<? echo $link; ?>"><? echo $opcion; ?></a></li>
                			
						
							
							
							
                			
							
							
							
						<?							
								
						

						
						}
	
	

	?>
</ul></li>
					
					</ul>