<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"[]>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>EGOS SII 1.0</title>


    <link rel="stylesheet" href="style_inicio.css" type="text/css" media="screen" />
    <!--[if IE 6]><link rel="stylesheet" href="../style.ie6.css" type="text/css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" href="../style.ie7.css" type="text/css" media="screen" /><![endif]-->


    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="script.js"></script>
	<link rel="stylesheet" type="text/css" href="css/default.css" />
	
	
	
	
	
	
	<link href="css/ventana-modal.css" rel="stylesheet" type="text/css">
	<link href="tablas.css" rel="stylesheet" type="text/css">

    
	
	<script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="script.js"></script>
	<script type="text/javascript" src="js/ajax.js"></script>
		<script type="text/javascript" src="js/ajaxs.js"></script>
		<script type="text/javascript" src="js/valida.js"></script>
		
		
		
	
<!--MENU DESPLEGABLE-->
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>-->
		<script type="text/javascript">		
			$(document).ready(function(){ // Script del Navegador
				$("ul.subnavegador").hide();				
				$("a.desplegable").toggle(
					function() { 
						$(this).parent().find("ul.subnavegador").slideDown('fast'); 
					},
					function() { 
						$(this).parent().find("ul.subnavegador").slideUp('fast'); 
					}				
				);	
			});
		</script>	

<!--FIN DE MENU-->


<!--SEGUNDA OPCION DE MENU DESPLEGABLE-->
<style>
.menu_list { 
width: 155px; /* Ancho del menÃº */
}
.menu_head {
padding: 5px 5px;
color:#FFFFFF; /* Color de las pestaÃ±as principales */
cursor: pointer;
position: relative;
margin:1px;
margin-left:0;
margin-right:0;
font-weight:bold;
  	
background-color:#62651A; /* Color de fondo */
background-image: url(images/flecha-abajo.png);
background-position:center right;
background-repeat:no-repeat;



}
.menu_body {
display:none;
}


</style>

<!--<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js' type='text/javascript'/></script>-->

<script type='text/javascript'>
//<![CDATA[
//------------------------------
// Developed by Roshan Bhattarai 
// Visit http://roshanbh.com.np for this script and more.
// This notice MUST stay intact for legal use
// ---------------------------------
$(document).ready(function()
{
$("#firstpane p.menu_head").click(function()
{
$(this).css({backgroundImage:"url(images/flecha-arriba.pngs)"}).next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
$(this).siblings().css({backgroundImage:"url(images/flecha-abajo.pngs)"});
});


$("#secondpane p.menu_head").mouseover(function()
{
$(this).css({backgroundImage:"url(images/flecha-arriba.png)"}).next("div.menu_body").slideDown(500).siblings("div.menu_body").slideUp("slow");
$(this).siblings().css({backgroundImage:"url(images/flecha-abajo.png)"});
});
});

//]]>
</script>




<!--FIN DE MENU-->





</head>
<body>
<div id="art-main">
    <div class="cleared reset-box"></div>
    <div class="art-header">
        <div class="art-header-position">
            <div class="art-header-wrapper">
                <div class="cleared reset-box"></div>
                <div class="art-header-inner">
                <script type="text/javascript" src="swfobject.js"></script>
                <script type="text/javascript">
                jQuery((function (swf) {
                    return function () {
                        swf.switchOffAutoHideShow();
                        swf.registerObject("art-flash-object", "9.0.0", "expressInstall.swf");
                    }
                })(swfobject));
                </script>
                <div id="art-flash-area">
                <div id="art-flash-container">
                <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="992" height="248" id="art-flash-object">
                    <param name="movie" value="images/flash.swf" />
                    <param name="quality" value="high" />
                	<param name="scale" value="default" />
                	<param name="wmode" value="transparent" />
                	<param name="flashvars" value="color1=0xFFFFFF&amp;alpha1=.30&amp;framerate1=24&amp;loop=true&amp;wmode=transparent" />
                    <param name="swfliveconnect" value="true" />
                    <!--[if !IE]>-->
                    <object type="application/x-shockwave-flash" data="images/flash.swf" width="992" height="248">
                        <param name="quality" value="high" />
                	    <param name="scale" value="default" />
                	    <param name="wmode" value="transparent" />
                	    <param name="flashvars" value="color1=0xFFFFFF&amp;alpha1=.30&amp;framerate1=24&amp;loop=true&amp;wmode=transparent" />
                        <param name="swfliveconnect" value="true" />
                    <!--<![endif]-->
                      	<div class="art-flash-alt"><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></div>
                    <!--[if !IE]>-->
                    </object>
                    <!--<![endif]-->
                </object>
                </div>
                </div>
                <div class="art-logo">
                                 <h1 class="art-logo-name"><a href="#"><?php echo utf8_encode($titulo); ?></a></h1>
                                                 <h2 class="art-logo-text">EXPORTADORA DE GRANOS Y OLEAGINOSAS DEL SURESTE S.A DE C.V</h2>
                  </div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="cleared reset-box"></div>
    <div class="art-box art-sheet">
        <div class="art-box-body art-sheet-body">
            <div class="art-layout-wrapper">
                <div class="art-content-layout">
                    <div class="art-content-layout-row">
                        <div class="art-layout-cell art-sidebar1">

<div class="art-box art-vmenublock">
    <div class="art-box-body art-vmenublock-body">
                <div class="art-bar art-vmenublockheader">
                    <h3 class="t">CARTERAS</h3>
                </div>
                <div class="art-box art-vmenublockcontent">
                    <div class="art-box-body art-vmenublockcontent-body">
    
	
	
		
			<?php 
			
			include("includes/menu.php"); 
			
			?>
					
			
	
				
	
	
                
                                		<div class="cleared"></div>
                    </div>
                </div>
		<div class="cleared"></div>
    </div>
</div>

                          <div class="cleared"></div>
                        </div>
                        <div class="art-layout-cell art-content">
<div class="art-box art-post">
    <div class="art-box-body art-post-body">
<div class="art-post-inner art-article">
                                
								
								
								<table border="0">

 <tr>
   <td colspan="10" width="117" height="52"><h2 class="art-postheader"><div align="left">SII - EGOS</div> 
								
</tr>
<tr>								
	</h2></td>
  <!-- <td width="66"></td> -->
    <td width="45"><img style="WIDTH: 40px; HEIGHT: 40px" id="Image1" title="usuario actual registrado" alt="usuario" src="images/usuario_registrado.png" /></td>
    <td width="67"><div align="center"><strong>Usuario :</strong></div></td>
    <td width="31"><div align="center"><?php echo nom($_SESSION["nombre_u"]); ?></div></td>
    <td width="103"><div align="center"><strong>Perfil :</strong></div></td>
    <td width="97">
      <div align="left">
        <?php


echo nom($_SESSION["perfil"]);
?>
      </div></td>
  
   <td width="97"><div align="center"><strong>Sucursal :</strong></div></td>
    <td width="97"><?php


$s_sucursal=get_session_sucursal();
echo nom($s_sucursal["sucursal"]);

?></td>
  <td><div align="center"><strong>Cosecha :</strong></div></td>
  <td><?php echo nom($_SESSION["cosecha_des"]); ?></td>
    <td width="45"><div align="right">
		<a href="<?php echo $d; ?>session/logout.php"><img width="40px" height="40px" src="<?php echo $d; ?>dummies/cerrar_session.png" title="Cerrar Sesi&oacute;n" width="60" height="60"></a>
</div></td>
 </tr>
	</table>
								
                                                              
															  
															    
                <div class="art-postcontent">




