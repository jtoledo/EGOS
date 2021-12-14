function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
  		}
	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

function modif_unidad(){
	
	if (document.captura.nom_uni.value.length==0)
	{ 
      	 alert("Nombre de la unidad no puede ser vacio"); 
      	 document.captura.nom_uni.focus(); 
      	 return 0; 
	}
	alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('unidad');
	nom_uni=document.captura.nom_uni.value;
	id_unidad=document.captura.id_unidad.value;
	enviar=document.captura.enviar.value;
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_unidad.php");
	divFormulario.innerHTML = '<img src="loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			//divFormulario.style.display="block";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("nom_uni="+nom_uni+"&id_unidad="+id_unidad+"&enviar="+enviar)

}

function alta_unidad(){
	
	if (document.captura.nom_uni.value.length==0)
	{ 
      	 alert("Nombre de la unidad no puede ser vacio"); 
      	 document.captura.nom_uni.focus(); 
      	 return 0; 
	}
	alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('unidad');
	nom_uni=document.captura.nom_uni.value;
	enviar=document.captura.enviar.value;
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_unidad.php");
	divFormulario.innerHTML = '<img src="loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			document.captura.nom_uni.value="";
			//divFormulario.style.display="block";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("nom_uni="+nom_uni+"&enviar="+enviar)

}



function alta_mano(){
	
	if (document.captura.concep.value.length==0)
	{ 
      	 alert("Mano de obra no puede ser vacio"); 
      	 document.captura.concep.focus(); 
      	 return 0; 
	}
	alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('mano');
	concep=document.captura.concep.value;
	enviar=document.captura.enviar.value;
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_mano.php");
	divFormulario.innerHTML = '<img src="loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			limpia_mano();
			//divFormulario.style.display="block";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("concep="+concep+"&enviar="+enviar)

}
function modif_mano(){
	
	if (document.captura.concep.value.length==0)
	{ 
      	 alert("Nombre de mano de obra no puede ser vacio"); 
      	 document.captura.concep.focus(); 
      	 return 0; 
	}
	alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('mano');
	concep=document.captura.concep.value;
	id_ayuda=document.captura.id_ayuda.value;
	enviar=document.captura.enviar.value;
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_mano.php");
	divFormulario.innerHTML = '<img src="loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			//divFormulario.style.display="block";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("concep="+concep+"&id_ayuda="+id_ayuda+"&enviar="+enviar)

}

function limpia_mano()
{
	document.captura.concep.value="";
}


function eliminar(id_cliente,id_servicio){
	
	if (confirm('Estas completamente seguro de eliminar este SERVICIO'))
	{
	
	divFormularios = document.getElementById('obras');
	
	ajax=objetoAjax();



ajax.open("POST", "del_obras.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormularios.innerHTML = ajax.responseText
			//divFormulario2.innerHTML = ajax.responseText
			//divFormulario2.style.display="block";
			divFormularios.style.display="block";
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("id_cliente="+id_cliente+"&id_servicio="+id_servicio)



}
}


function agrega_material(){
	
	if (document.captura.id_material.value.length==0)
	{ 
      	 alert("Material no puede ser vacio"); 
      	 document.captura.id_material.focus(); 
      	 return 0; 
	}
	if (document.captura.id_unidad.value.length==0)
	{ 
      	 alert("Unidad de medida no puede ser vacio"); 
      	 document.captura.id_unidad.focus(); 
      	 return 0; 
	}
	alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('agrega_material');
	id_material=document.captura.id_material.value;
	id_unidad=document.captura.id_unidad.value;
	id_concepto=document.captura.id_concepto.value;
	id_pedido=document.captura.id_pedido.value;
	enviar=document.captura.enviar.value;
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_agrega_material.php");
	divFormulario.innerHTML = '<img src="loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			document.captura.id_material.value="";
			document.captura.id_unidad.value="";
			//divFormulario.style.display="block";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("id_material="+id_material+"&id_unidad="+id_unidad+"&id_concepto="+id_concepto+"&enviar="+enviar+"&id_pedido="+id_pedido)

}

function eliminar_material(id_cotizacion,id_concepto,id_pedido)
{
	
	if (confirm('Estas completamente seguro de eliminar este material'))
	{
	
	divFormularios = document.getElementById('agrega_material');
	
	ajax=objetoAjax();



ajax.open("POST", "del_material.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormularios.innerHTML = ajax.responseText
			//divFormulario2.innerHTML = ajax.responseText
			//divFormulario2.style.display="block";
			divFormularios.style.display="block";
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("id_cotizacion="+id_cotizacion+"&id_concepto="+id_concepto+"&id_pedido="+id_pedido)



}
}

function agrega_ayuda(){
	
	if (document.captura.id_ayuda.value.length==0)
	{ 
      	 alert("Mano de Obra no puede ser vacio"); 
      	 document.captura.id_ayuda.focus(); 
      	 return 0; 
	}
	if (document.captura.id_unidad.value.length==0)
	{ 
      	 alert("Unidad de medida no puede ser vacio"); 
      	 document.captura.id_unidad.focus(); 
      	 return 0; 
	}
	alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('agrega_material');
	id_ayuda=document.captura.id_ayuda.value;
	id_unidad=document.captura.id_unidad.value;
	id_concepto=document.captura.id_concepto.value;
	id_pedido=document.captura.id_pedido.value;
	enviar=document.captura.enviar.value;
	ayuda=1;
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_agrega_material.php");
	divFormulario.innerHTML = '<img src="loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			document.captura.id_ayuda.value="";
			document.captura.id_unidad.value="";
			//divFormulario.style.display="block";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("id_ayuda="+id_ayuda+"&id_unidad="+id_unidad+"&id_concepto="+id_concepto+"&enviar="+enviar+"&id_pedido="+id_pedido+"&ayuda="+ayuda)

}

function eliminar_ayuda(id_cotizacion,id_concepto,id_pedido)
{
	
	if (confirm('Estas completamente seguro de eliminar mano de obra'))
	{
	
	divFormularios = document.getElementById('agrega_material');
	ayuda=1;
	ajax=objetoAjax();



ajax.open("POST", "del_material.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormularios.innerHTML = ajax.responseText
			//divFormulario2.innerHTML = ajax.responseText
			//divFormulario2.style.display="block";
			divFormularios.style.display="block";
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("id_cotizacion="+id_cotizacion+"&id_concepto="+id_concepto+"&id_pedido="+id_pedido+"&ayuda="+ayuda)



}
}

function alta_perfil(){
	
	if (document.captura.nom_perfil.value.length==0)
	{ 
      	 alert("Nombre de perfil no puede ser vacio"); 
      	 document.captura.nom_perfil.focus(); 
      	 return 0; 
	}
	if (document.captura.descripcion.value.length==0)
	{ 
      	 alert("Descripcion no puede ser vacio"); 
      	 document.captura.descripcion.focus(); 
      	 return 0; 
	}
	alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('perfiles');
	nom_perfil=document.captura.nom_perfil.value;
	descripcion=document.captura.descripcion.value;
	enviar=document.captura.enviar.value;
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_perfiles.php");
	divFormulario.innerHTML = '<img src="loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			document.captura.nom_perfil.value="";
			document.captura.descripcion.value="";
			//divFormulario.style.display="block";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("nom_perfil="+nom_perfil+"&descripcion="+descripcion+"&enviar="+enviar)

}

function modif_perfil(){
	
	if (document.captura.nom_perfil.value.length==0)
	{ 
      	 alert("Nombre de perfil no puede ser vacio"); 
      	 document.captura.nom_perfil.focus(); 
      	 return 0; 
	}
	if (document.captura.descripcion.value.length==0)
	{ 
      	 alert("Descripcion no puede ser vacio"); 
      	 document.captura.descripcion.focus(); 
      	 return 0; 
	}
	alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('perfiles');
	nom_perfil=document.captura.nom_perfil.value;
	descripcion=document.captura.descripcion.value;
	id_perfil=document.captura.id_perfil.value;
	enviar=document.captura.enviar.value;
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_perfiles.php");
	divFormulario.innerHTML = '<img src="loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("nom_perfil="+nom_perfil+"&descripcion="+descripcion+"&enviar="+enviar+"&id_perfil="+id_perfil)

}

function agrega_perfil(){
	
	if (document.capturas.id_menu.value.length==0)
	{ 
      	 alert("Procesos no puede ser vacio"); 
      	 document.capturas.id_menu.focus(); 
      	 return 0; 
	}
	
	alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('permisos');
	id_perfil=document.capturas.id_perfil.value;
	id_menu=document.capturas.id_menu.value;
	enviar=document.capturas.enviar.value;
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_permisos.php");
	divFormulario.innerHTML = '<img src="loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			document.location.href="modif_perfil.php?id_perfil="+id_perfil;
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("id_perfil="+id_perfil+"&id_menu="+id_menu+"&enviar="+enviar)

}

function modif_usuario(){
	
	if (document.captura.user_name.value.length==0)
	{ 
      	 alert("Nombre de usuario no puede ser vacio"); 
      	 document.captura.user_name.focus(); 
      	 return 0; 
	}
	if (document.captura.pass.value.length==0)
	{ 
      	 alert("Password no puede ser vacio"); 
      	 document.captura.pass.focus(); 
      	 return 0; 
	}
	
	
	
	alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('usua');
	id_usuario=document.captura.id_usuario.value;
	user_name=document.captura.user_name.value;
	pass=document.captura.pass.value;
	enviar=document.captura.enviar.value;
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_usuario.php");
	divFormulario.innerHTML = '<img src="loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			//document.location.href="modif_perfil.php?id_perfil="+id_perfil;
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("id_usuario="+id_usuario+"&user_name="+user_name+"&pass="+pass+"&enviar="+enviar)

}

function agrega_usua(){
	
	if (document.captura.user_name.value.length==0)
	{ 
      	 alert("Nombre de usuario no puede ser vacio"); 
      	 document.captura.user_name.focus(); 
      	 return 0; 
	}
	if (document.captura.pass.value.length==0)
	{ 
      	 alert("Password no puede ser vacio"); 
      	 document.captura.pass.focus(); 
      	 return 0; 
	}
	
	
	
	alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('usua');
	id_usuario=document.captura.id_usuario.value;
	user_name=document.captura.user_name.value;
	pass=document.captura.pass.value;
	enviar=document.captura.enviar.value;
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_usuario.php");
	divFormulario.innerHTML = '<img src="loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			//document.location.href="modif_perfil.php?id_perfil="+id_perfil;
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("id_usuario="+id_usuario+"&user_name="+user_name+"&pass="+pass+"&enviar="+enviar)

}


function menu_fac()
{
	
	fac=document.captura.fac.value;

if(fac==1)
document.location.href='busqueda_fac.php';
if(fac==2)
document.location.href='bus_cliente.php';
if(fac==3)
document.location.href='bus_empleado.php';
if(fac==4)
document.location.href='bus_fecha.php';
}

//ELIMINA ESPACIOS VACIOS
function trim(cadena){
// USO: Devuelve un string como el 
// parámetro cadena pero quitando los
// espacios en blanco de los bordes.

var retorno=cadena.replace(/^\s+/g,'');
retorno=retorno.replace(/\s+$/g,'');
return retorno;
}
//FIN DE ESPACIOS VACIOS





function cancela_fac(id_factura){
	
	if (confirm('Estas completamente seguro de CANCELAR ESTA FACTURA'))
	{
	
	divFormularios = document.getElementById('cancela');
	//divFormulario2 = document.getElementById('actualiza');
	//id_cliente=document.captura2.id_cliente.value;
	//id_agrupacion=document.captura2.id_agrupacion.value;
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_cancela.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormularios.innerHTML = ajax.responseText
			//divFormulario2.innerHTML = ajax.responseText
			//divFormulario2.style.display="block";
			divFormularios.style.display="block";
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("id_factura="+id_factura)
	}
}
