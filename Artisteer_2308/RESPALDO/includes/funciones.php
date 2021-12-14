<?php


	function cambiarFormatoFecha($fecha)
{ 
list($dia,$mes,$anio)=explode("/",$fecha); 
return $anio."-".$mes."-".$dia; 
} 


function preparar_consulta($consulta)
	{
		$mq_activado = get_magic_quotes_gpc();
		if(function_exists("mysql_real_escape_string"))
		{
			if($mq_activado)
			{
				$consulta = stripslashes($consulta);
			}
			$consulta = mysql_real_escape_string($consulta);
		}
		else
		{
			if(!$mq_activado)
			{
				$consulta = addslashes($consulta);
			}
		}
		return $consulta;
	}
	
	
	?>