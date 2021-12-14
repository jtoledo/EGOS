<script language="javascript" src="../calendario/popcalendar.js"></script> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"[]>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!--<META http-equiv=Refresh content="20; URL=../inicio.php"> fomra para refrescar en cierto tiempo la pagina-->

    <title>EGOS SII 1.0</title>
	
	<!-- libreria para la barra fisheyes-->
		<script type="text/javascript" src="../dojo/mootools.v1.1.js"></script>
		<script type="text/javascript" src="../dojo/shCore.js"></script>
		<script type="text/javascript" src="../dojo/ifisheye.js"></script> 	
		<script type="text/javascript" >

			var Page = {
				initialize: function() {
				dp.SyntaxHighlighter.HighlightAll('usage_include');
				dp.SyntaxHighlighter.HighlightAll('usage_initialize');
				dp.SyntaxHighlighter.HighlightAll('usage_xhtml');

				new SmoothScroll({
					transition: Fx.Transitions.backOut,
					fps: 60,
					duration: 1500
				});

				new iFishEye({
					container: $("iFishEye_example_1"),
					targetImageClass: ".iFishEyeImg",
					targetCaptionClass: ".iFishEyeCaption",					
					dimThumb: {width:20, height:20},
					dimFocus: {width:36, height:36},	
					eyeRadius: 192,
					pupilRadius: 50,				
					useAxis: 'x',					
					norm: "L1",
					blankPath: "images/blank.gif",
					onEyeOver: Class.empty,
					onEyeOut: Class.empty,
					onPupilOver: Class.empty,
					onPupilOut: Class.empty
					
				});

				new iFishEye({
					container: $("iFishEye_example_2"),
					targetImageClass: ".iFishEyeImg_2",
					targetCaptionClass: ".iFishEyeCaption_2",
					useAxis: 'y',
					norm: "L2"
				});

				new iFishEye({
					container: $("iFishEye_example_3"),
					targetImageClass: ".iFishEyeImg_3",
					targetCaptionClass: ".iFishEyeCaption_3",
					useAxis: "both",
					norm: "L2"
				});
			}
		};

		window.addEvent("domready", Page.initialize);
	  </script>		
	  <script type="text/javascript" >
				  
	  </script>
	
    <link rel="stylesheet" href="../style_login.css" type="text/css" media="screen" />
<!--	<link rel="stylesheet" href="../css/forms.css" type="text/css" media="screen" />-->
	<link rel="stylesheet" href="../css/42709536/files/faary.css" type="text/css" />
	<link rel="stylesheet" href="../css/42709536/files/formulario.css" type="text/css" />
  
  			<!--dojo toolkit-->
  		  <script src="../dojo/dojo.xd.js" djConfig="parseOnLoad: true"></script>
        <script type="text/javascript">
				dojo.require("dijit.form.FilteringSelect");
		
		  </script>
   <!--Hoja de estilo dojo-->
   <link rel="stylesheet" type="text/css" href="../dojo/claro.css"/>   
	

   
   <!--<script type="text/javascript" src="../js/jquery1.7.2.min.js"></script>-->
    
    <!--SECCION DE LOS COMPONENTES DEL LOGIN DEL SISTEMA-->
    <link rel="stylesheet" href="../css/style_login_original.css" type="text/css" media="screen"/>
    <style>
            a.back{
                width:184px;
                height:32px;
                position:absolute;
                bottom:10px;
                left:10px;
                background:transparent url(back.png) no-repeat top left;
            }
            a.switchstyle{
                width:184px;
                height:32px;
                position:absolute;
                top:10px;
                left:10px;
                background:transparent url(switchstyle.png) no-repeat top left;
            }
        </style>
         <!-- The JavaScript -->
        
    <!--FIN  DE LOS COMPLEMENTOS DE LOGIN DEL SISTEMA EGOS-->
    
    
    <script type="text/javascript" src="../script.js"></script>
	
	<script type="text/javascript" src="../js/valida.js"></script>
	<script type="text/javascript" src="../js/ajax.js"></script>
	<script type="text/javascript" src="../js/ajaxs.js"></script>

	
	
<link href="../css/ventana-modal.css" rel="stylesheet" type="text/css">
<!--[if lt IE 7]>
<link href="../css/ventan-modal-ie.css" rel="stylesheet" type="text/css">
<![endif]-->


		
	
<script type="text/javascript" src="../js/ventana-modal.js"></script>
<script type="text/javascript">

function referencias(idcliente) {
	abrirVentana("edicion_refe.php?idcliente="+idcliente, 800, 400, "ventana-modal");
}

function referencias_per(idcliente) {
	abrirVentana("edicion_ref_per.php?idcliente="+idcliente, 800, 400, "ventana-modal");
}


/*function ver_imagen(idcliente,idconcepto) {
	abrirVentana("imagen.php?idcliente="+idcliente+"&idconcepto="+idconcepto, 800, 400, "ventana-modal");
}*/

function ver_imagen(idcliente,idconcepto) {
	abrirVentana2("imagen.php?idcliente="+idcliente+"&idconcepto="+idconcepto, 700, 400, "ventana-modal");
}

function ver_cliente(idsolicitud) {
	abrirVentana2("consulta_clientes.php?idsolicitud="+idsolicitud, 900, 400, "ventana-modal");
}

function ver_solicitud(idsolicitud) {
	abrirVentana2("consulta_solicitud.php?idsolicitud="+idsolicitud, 980, 400, "ventana-modal");
}

function ver_expediente(idsolicitud) {
	abrirVentana2("consulta_expediente.php?idsolicitud="+idsolicitud, 950, 570, "ventana-modal");
}

//AGREGAMOS LA CUENTA CONTABLE DEL CLIENTE
function add_cuenta(form,frm) {
	abrirVentana2("b_ctas/buscador.php?form="+form+"&cliente="+frm.nombre.value.trim()+' '+frm.a_paterno.value.trim()+' '+frm.a_materno.value.trim() , 700, 500, "ventana-modal");
}
function add_cuenta_ant(form,frm) {
	abrirVentana2("b_ctas/buscador_ant.php?form="+form+"&cliente="+frm.nombre.value.trim()+' '+frm.a_paterno.value.trim()+' '+frm.a_materno.value.trim() , 700, 500, "ventana-modal");
}
function format_fecha(objeto)
{
		var cadena=objeto.value;

		if(cadena.length+1==3 || cadena.length+1==6)
		{
			objeto.value=objeto.value+'-';
		} 
}
function format_hora(objeto)
{
		var cadena=objeto.value;
		
		if(cadena.length+1==3)
		{			
			if(parseInt(cadena)>24)
			{
				alert("La hora que esta capturando no es valida!");
				objeto.value='';
			}else{			
				
				objeto.value=objeto.value+':';
			}
		} 
}
function  por_secado(frm,objeto_actual)
{
	var md,smd,by,vr,qm,tr,sm,total;
	md=0.00;
	smd=0.00;
	by=0.00;
	vr=0.00;
	qm=0.00;
	tr=0.00;
	sm=0.00;
	total=0.00;
	if(frm.maduro.value!="")	{	md=parseFloat(frm.maduro.value);}
	if(frm.smaduro.value!="")	{	smd=parseFloat(frm.smaduro.value);}
	if(frm.bayo.value!="")		{	by=parseFloat(frm.bayo.value);}
	if(frm.verde.value!="")		{	vr=parseFloat(frm.verde.value);}
	if(frm.quemado.value!="")	{	qm=parseFloat(frm.quemado.value);}
	if(frm.tierno.value!="")	{	tr=parseFloat(frm.tierno.value);	}
	if(frm.smata.value!="")		{	sm=parseFloat(frm.smata.value);	}
	total=md+smd+by+vr+qm+tr+sm;
	total=Math.round(total*100)/100; //redondeo a 2 decimales
	if(total>100){ 
		alert('El suma de los porcentaje excedió el 100%, Verifique!');		
		total=total - parseFloat(objeto_actual.value);		
		objeto_actual.value=0.00;
	}
	total=Math.round(total*100)/100;
	frm.totalp.value=total;
}
</script>

		
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
background-image: url(<?php echo $d; ?>images/flecha-abajo.png);
background-position:center right;
background-repeat:no-repeat;



}
.menu_body {
display:none;
}


</style>


<style>
a{
	text-decoration:underline;
	cursor:pointer;
}
</style>
<style>

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

<!--MENU FLOTANTE-->



<!--FIN DE MENU FLOTANTE-->

<link rel="stylesheet" href="../css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
		<script src="../js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>

<!--DIVIDIR 2 COKUMNAS LA PANTALLA-->
<style>
div.left{
float: left;
width: 45%;
}

div.right{
float: right;
width: 45%;
background-color:#CC6;
}
</style>
<!--FIN DE LA DIVISION-->








</head>
<body>



<div id="art-page-background-glare-wrapper">
    <div id="art-page-background-glare"></div>
</div>
<div id="art-main">
    <div class="cleared reset-box"></div>
    <div class="art-box art-sheet">
        <div class="art-box-body art-sheet-body">
            <div class="art-header">
                <div class="art-logo">
                                                 <h1 class="art-logo-name"><a href="#">SISTEMA INTEGRAL DE INFORMACI&Oacute;N</a></h1>
                                                                         <h2 class="art-logo-text">EXPORTADORA DE GRANOS Y OLEAGINOSAS DEL SURESTE S.A DE C.V</h2>
              </div>
                
            </div>
            <div class="cleared reset-box"></div>
            <div class="art-layout-wrapper">
                <div class="art-content-layout">
                    <div class="art-content-layout-row">
                        <div class="art-layout-cell art-sidebar1">
<div class="art-box art-vmenublock">
    <div class="art-box-body art-vmenublock-body">
                <div class="art-bar art-vmenublockheader">
                    <h3 class="t">Menú </h3>
                </div>
                <div class="art-box art-vmenublockcontent">
                    <div class="art-box-body art-vmenublockcontent-body">
                
				
				<br />
				
		
		
		
		<?php 
			if($orden==1)
			include("{$d}includes/menu.php"); 
			
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
                
				
				<?php
				if($orden==1)
				{
				?>
				  
				   <table border="0">

 <tr>
   <td width="90" height="40px"><h2 class="art-postheader"><div align="left">SII - EGOS</div> 
								
								
	</h2></td>
    <td width="40"><img style="WIDTH: 40px; HEIGHT: 40px" id="Image1" title="usuario actual registrado" alt="usuario" src="<?php echo $d; ?>images/usuario_registrado.png" /></td>
    <td width="67"><div align="center"><strong>Usuario :</strong></div></td>
    <td width="31"><div align="center"><?php echo nom($_SESSION["nombre_u"]); ?></div></td>
    <td width="50"><div align="center"><strong>Perfil :</strong></div></td>
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
    <td width="40"><div align="right">
		
        
        
        <a  href="<?php echo $d; ?>session/logout.php"><img width="40px" height="40px" src="<?php echo $d; ?>dummies/cerrar_session.png" title="Cerrar Sesi&oacute;n" width="60" height="60"></a>
        
        
        
</div></td>
 </tr>
	</table>             


				<?php
				}
				?>
                                                


                <div class="art-postcontent">

