<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"[]>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
    <!--
    Created by Artisteer v3.1.0.46558
    Base template (without user's data) checked by http://validator.w3.org : "This page is valid XHTML 1.0 Transitional"
    -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>SII-EGOS 1.0</title>



    <link rel="stylesheet" href="style_inicio.css" type="text/css" media="screen" />
    <!--[if IE 6]><link rel="stylesheet" href="style.ie6.css" type="text/css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" href="style.ie7.css" type="text/css" media="screen" /><![endif]-->

    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="script.js"></script>
	<link rel="stylesheet" type="text/css" href="css/default.css" />
	
	
	
	
	
	
	<link href="css/ventana-modal.css" rel="stylesheet" type="text/css">
	<link href="tablas.css" rel="stylesheet" type="text/css">

    
	<script type="text/javascript" src="valida.js"></script>
	<script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="script.js"></script>
	<script type="text/javascript" src="js/ajax.js"></script>
		<script type="text/javascript" src="js/ajaxs.js"></script>
		<script type="text/javascript" src="js/valida.js"></script>
		
		
		<link href="calendario-jquery/calendario_dw/calendario_dw-estilos.css" type="text/css" rel="STYLESHEET">
<script type="text/javascript" src="calendario-jquery/calendario_dw/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="calendario-jquery/calendario_dw/calendario_dw.js"></script>
  <script type="text/javascript">
$(document).ready(function()
{
   $(".campofecha").calendarioDW();
})
</script>  

	
	
	
	
	
	
	
	
	
<!--MENU DESPLEGABLE-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
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
width: 180px; /* Ancho del menú */
}
.menu_head {
padding: 5px 10px;
color:#000000; /* Color de las pestañas principales */
cursor: pointer;
position: relative;
margin:1px;
margin-left:0;
margin-right:0;
font-weight:bold;
background-color:#CCCC33; /* Color de fondo */
background-image: url(images/flecha-abajo.png);
background-position:center right;
background-repeat:no-repeat;
}
.menu_body {
display:none;
}
.menu_body a{
display:block;
color:#333333; /* Color de los enlaces */
background-color:#FFFFCC; /* Color de fondo de los enlaces */
padding-left:10px;
font-weight:bold;
text-decoration:none;
}
.menu_body a:hover{
color: #000000; /* Color de los enlaces al pasar el cursor */
text-decoration:underline;
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
$(this).css({backgroundImage:"url(images/flecha-arriba.png)"}).next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
$(this).siblings().css({backgroundImage:"url(images/flecha-abajo.png)"});
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
                    <param name="movie" value="../images/flash.swf" />
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
                                 <h1 class="art-logo-name"><a href="#">SISTEMA INTEGRAL DE INFORMACIÓN</a></h1>
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
<div class="art-box art-block">
    <div class="art-box-body art-block-body">
                <div class="art-bar art-blockheader">
                    <h3 class="t">Navegaci&oacute;n</h3>
                </div>
                <div class="art-box art-blockcontent">
                    <div class="art-box-body art-blockcontent-body">
                
				
				
				
				
				
				<ul class="navegador">
			<li><a href="#"  class="desplegable" title="Opci&oacute;n 1">CABECERA</a>
				<ul class="subnavegador">
					<li><a href="#" title="Ir a Sub-Opci&oacute;n 3-1">Productore</a></li>
					<li><a href="#" title="Ir a Sub-Opci&oacute;n 3-2">Proveedores</a></li>			
					<li><a href="#" title="Ir a Sub-Opci&oacute;n 3-3">Grupos</a></li>
					<li><a href="#" title="Ir a Sub-Opci&oacute;n 3-4">Estado de Cuenta</a></li>
				</ul>
			</li>
			<li><a href="#"  class="desplegable" title="Opci&oacute;n 2">CATALOGOS</a>
			
				<ul class="subnavegador">
					<li><a href="#" title="Ir a Sub-Opci&oacute;n 3-1">Cafe</a></li>
					<li><a href="#" title="Ir a Sub-Opci&oacute;n 3-2">Tara</a></li>			
					<li><a href="#" title="Ir a Sub-Opci&oacute;n 3-3">Estrato</a></li>
					<li><a href="#" title="Ir a Sub-Opci&oacute;n 3-4">Colonias</a></li>
				</ul>
			
			</li>
			<li><a href="#" class="desplegable" title="Opci&oacute;n 3">CREDITOS</a>
				<ul class="subnavegador">
					<li><a href="http://www.google.es" title="Ir a Sub-Opci&oacute;n 3-1">Sub-Opci&oacute;n 3-1</a></li>
					<li><a href="#" title="Ir a Sub-Opci&oacute;n 3-2">Sub-Opci&oacute;n 3-2</a></li>			
					<li><a href="#" title="Ir a Sub-Opci&oacute;n 3-3">Sub-Opci&oacute;n 3-3</a></li>
					<li><a href="#" title="Ir a Sub-Opci&oacute;n 3-4">Sub-Opci&oacute;n 3-4</a></li>
				</ul>
			</li>	
			<li><a href="#" class="desplegable" title="Opci&oacute;n 4">REPORTES</a>			
				<ul class="subnavegador">
					<li><a href="#" title="Ir a Sub-Opci&oacute;n 3-1">Sub-Opci&oacute;n 3-1</a></li>
					<li><a href="#" title="Ir a Sub-Opci&oacute;n 3-2">Sub-Opci&oacute;n 3-2</a></li>			
					<li><a href="#" title="Ir a Sub-Opci&oacute;n 3-3">Sub-Opci&oacute;n 3-3</a></li>
					<li><a href="#" title="Ir a Sub-Opci&oacute;n 3-4">Sub-Opci&oacute;n 3-4</a></li>
				</ul>
			</li>
			
			<li><a href="#" class="desplegable" title="Opci&oacute;n 3">COMPRAS</a>
			<li><a href="#" class="desplegable" title="Opci&oacute;n 3">SESION</a>
			<li><a href="#" class="desplegable" title="Opci&oacute;n 3">PAGOS</a>
			<li><a href="#" class="desplegable" title="Opci&oacute;n 3">CAJA</a>
			
		</ul>
				
				
		
		
		
				
				
				
				
				
				
				              
                                		<div class="cleared"></div>
                    </div>
                </div>
		<div class="cleared"></div>
    </div>
</div>
<div class="art-box art-vmenublock">
    <div class="art-box-body art-vmenublock-body">
                <div class="art-bar art-vmenublockheader">
                    <h3 class="t">FAVORITOS</h3>
                </div>
                <div class="art-box art-vmenublockcontent">
                    <div class="art-box-body art-vmenublockcontent-body">
    
	
	
	<div id="firstpane" class="menu_list">

<p class="menu_head">Pestaña 1</p>
<div class="menu_body">
<a href="URL del enlace">Sub pestaña 1</a>
<a href="URL del enlace">Sub pestaña 2</a>
<a href="URL del enlace">Sub pestaña 3</a> 
</div>

<p class="menu_head">Pestaña 2</p>
<div class="menu_body">
<a href="URL del enlace">Sub pestaña 1</a>
<a href="URL del enlace">Sub pestaña 2</a>
<a href="URL del enlace">Sub pestaña 3</a> 
</div>

<p class="menu_head">Pestaña 3</p>
<div class="menu_body">
<a href="URL del enlace">Sub pestaña 1</a>
<a href="URL del enlace">Sub pestaña 2</a>
<a href="URL del enlace">Sub pestaña 3</a> 
</div>


</div>		
<div class="menu_list" id="secondpane">

<p class="menu_head">Pestaña 1</p>
<div class="menu_body">
<a href="URL del enlace">Sub pestaña 1</a>
<a href="URL del enlace">Sub pestaña 2</a>
<a href="URL del enlace">Sub pestaña 3</a> 
</div>

<p class="menu_head">Pestaña 2</p>
<div class="menu_body">
<a href="URL del enlace">Sub pestaña 1</a>
<a href="URL del enlace">Sub pestaña 2</a>
<a href="URL del enlace">Sub pestaña 3</a> 
</div>

<p class="menu_head">Pestaña 3</p>
<div class="menu_body">
<a href="URL del enlace">Sub pestaña 1</a>
<a href="URL del enlace">Sub pestaña 2</a>
<a href="URL del enlace">Sub pestaña 3</a> 
</div>


</div>				
	
				
	
	
                
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
                                <h2 class="art-postheader"><DIV align="left">SII - EGOS</DIV> </h2>
                                                              
															  
															    
                <div class="art-postcontent">


  <p>
	<span class="art-button-wrapper">
		<span class="art-button-l"> </span>
		<span class="art-button-r"> </span>
		<a class="readon art-button" href="javascript:void(0)">V 1.0</a>
	</span>
  </p>

                </div>
                <div class="cleared"></div>
                                <div class="art-postmetadatafooter">
                                        <div class="art-postfootericons art-metadata-icons">
                       
                    </div>
                                    </div>
                </div>

		<div class="cleared"></div>
    </div>
</div>
<div class="art-box art-post">
    <div class="art-box-body art-post-body">
<div class="art-post-inner art-article">
                                
                                                               
                <div class="art-postcontent">