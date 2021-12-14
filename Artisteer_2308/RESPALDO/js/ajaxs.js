function objetoAjax()
{
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





function serializa(array)
{
  var serial=array[1];
  for (i=2; i<array.length; i++)
   serial += '|' + array[i];
   return serial;
}

function autentifica()
{
	
	if (document.logi.user.value.length==0)
	{ 
      	 alert("Usuario no puede ser vacio"); 
      	 document.logi.user.focus(); 
      	 return 0; 
	}
    if (document.logi.contra.value.length==0)
	{ 
      	 alert("Ingresa una contraseña"); 
      	 document.logi.contra.focus(); 
      	 return 0; 
	}
	
alert("Muchas gracias Verificando Datos");
 	
	divFormulario = document.getElementById('respuesta');
        user=document.logi.user.value;
	contra=document.logi.contra.value;
	enviar=document.logi.enviar.value;
	
	ajax=objetoAjax();
	ajax.open("POST", "autentificar.php");
	divFormulario.innerHTML = '<img src="loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function()
	{
	    if (ajax.readyState==4) 
               {
		if(ajax.responseText==1)
                     document.location.href="../inicio.php";            	
	        else
                divFormulario.innerHTML = ajax.responseText
                         }
         }
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ajax.send("user="+user+"&contra="+contra)	
		
}



function valida_cliente()
{
	
	if (document.captura.nombre.value.length==0)
	{ 
      	 alert("Nombre del cliente no puede ser vacio"); 
      	 document.captura.nombre.focus(); 
      	 return 0; 
	}
    if (document.captura.rfc.value.length==0)
	{ 
      	 alert("Rfc no puede ser vacio o ingresa rfc sin homo clave"); 
      	 document.captura.rfc.focus(); 
      	 return 0; 
	}
	if (document.captura.dire.value.length==0)
	{ 
      	 alert("Direcci\u00f3n no puede ser vacio"); 
      	 document.captura.dire.focus(); 
      	 return 0; 
	}
    if (document.captura.ciudad.value.length==0)
	{ 
      	 alert("Ciudad no puede ser vacio"); 
      	 document.captura.ciudad.focus(); 
      	 return 0; 
	}
	if (document.captura.estado.value.length==0)
	{ 
      	 alert("Estado no puede ser vacio"); 
      	 document.captura.estado.focus(); 
      	 return 0; 
	}
	if (document.captura.cp.value.length==0)
	{ 
      	 alert("Codigo postal no puede ser vacio"); 
      	 document.captura.cp.focus(); 
      	 return 0; 
	}
	if (document.captura.colonia.value.length==0)
	{ 
      	 alert("Colonia no puede ser vacio"); 
      	 document.captura.colonia.focus(); 
      	 return 0; 
	}
	if (document.captura.tel.value.length==0)
	{ 
      	 alert("Telefono no puede ser vacio"); 
      	 document.captura.tel.focus(); 
      	 return 0; 
	}
	
	if (document.captura.fech_captura.value.length==0)
	{ 
      	 alert("Fecha no puede ser vacio"); 
      	 document.captura.fech_captura.focus(); 
      	 return 0; 
	}

    alert("Muchas gracias la informacion ha sido enviada");
 	
	divFormulario = document.getElementById('cliente');
    nombre=document.captura.nombre.value;
	
	rfc=document.captura.rfc.value;
	dire=document.captura.dire.value;
	ciudad=document.captura.ciudad.value;
	tel=document.captura.tel.value;
	fech_captura=document.captura.fech_captura.value;
	estado=document.captura.estado.value;
	cp=document.captura.cp.value;
	colonia=document.captura.colonia.value;
	enviar=document.captura.enviar.value;
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_clientes.php");
	divFormulario.innerHTML = '<img src="loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			if(ajax.responseText>0)
			document.location.href="f_factura.php?rfc="+rfc;
			else
			divFormulario.innerHTML = ajax.responseText
								
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("nombre="+nombre+"&rfc="+rfc+"&dire="+dire+"&ciudad="+ciudad+"&tel="+tel+"&fech_captura="+fech_captura+"&enviar="+enviar+"&estado="+estado+"&cp="+cp+"&colonia="+colonia)

}

 
//E N V I O   D E   DA T O S   D E   F A C T U R A

function guarda_fac()
{
	
  var tbl = document.getElementById('tblSample');
  var lastRow = tbl.rows.length;
  var iteracion = lastRow;
  
  var cant_id,descrip_id,pre_id,importe_id,cant_dat,descrip_dat,pre_dat;
  var cantidad= new Array();
  var descripcion=new Array();
  var p_uni=new Array();
  var importe=new Array();
  
for(i=1;i<iteracion;i++)
  {
		 
    cant_id = "cantidad"+i; 
    descrip_id = "descripcion"+i;  
    pre_id = "p_uni"+i;
    importe_id = "importe"+i;

 if(document.getElementById(cant_id).value.length==0)
     {
	   alert("Cantidad no puede ser vacio"); 
	   document.getElementById(cant_id).focus();
	   return 0;
	 }
	 
 if(document.getElementById(descrip_id).value.length==0)
     {
	   alert("Descripcion no puede ser vacio"); 
	   document.getElementById(descrip_id).focus();
	   return 0;
	 }

 if(document.getElementById(pre_id).value.length==0)
     {
	   alert("Precio unitario no puede ser vacio"); 
	   document.getElementById(pre_id).focus();
	   return 0;
	 }	 
	   
 	   
    cant_dat = document.getElementById(cant_id).value;
	descrip_dat = document.getElementById(descrip_id).value;
    pre_dat = document.getElementById(pre_id).value; 
	
	cantidad[i]=cant_dat;
    descripcion[i]=descrip_dat;
    p_uni[i]=pre_dat;
    importe[i]=cant_dat*pre_dat;
	
}

cant=serializa(cantidad);
descrip=serializa(descripcion);
p_u=serializa(p_uni);
imp=serializa(importe);

if (document.captura2.fech_captura.value.length==0)
	{ 
      	 alert("Fecha no puede ser vacio"); 
      	 document.captura2.fech_captura.focus(); 
      	 return 0; 
	}

alert("Gracias Procesando Impresion");

divFormulario = document.getElementById('factura');

id_cliente=document.captura2.id_cliente.value;
folio=document.captura2.folio.value;
subtotal=document.captura2.subtotal.value;
iva=document.captura2.iva.value;
total=document.captura2.total.value;
fech_captura=document.captura2.fech_captura.value;
enviar=document.captura2.enviar.value;

    ajax=objetoAjax();
	ajax.open("POST", "serv_factura.php");
	divFormulario.innerHTML = '<img src="loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
      	}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("descrip="+descrip+"&id_cliente="+id_cliente+"&folio="+folio+"&cant="+cant+"&p_u="+p_u+"&imp="+imp+"&iva="+iva+"&subtotal="+subtotal+"&total="+total+"&fech_captura="+fech_captura+"&enviar="+enviar)

}



// 		C  L  I  E  N  T  E  S

function modif_cliente(){
	
	if (document.captura.nombre.value.length==0)
	{ 
      	 alert("Nombre del cliente no puede ser vacio"); 
      	 document.captura.nombre.focus(); 
      	 return 0; 
	}
	
	

    if (document.captura.rfc.value.length==0)
	{ 
      	 alert("Rfc no puede ser vacio o ingresa rfc sin homo clave"); 
      	 document.captura.rfc.focus(); 
      	 return 0; 
	}
	if (document.captura.dire.value.length==0)
	{ 
      	 alert("Direcci\u00f3n no puede ser vacio"); 
      	 document.captura.dire.focus(); 
      	 return 0; 
	}
    if (document.captura.ciudad.value.length==0)
	{ 
      	 alert("Ciudad no puede ser vacio"); 
      	 document.captura.ciudad.focus(); 
      	 return 0; 
	}
	if (document.captura.estado.value.length==0)
	{ 
      	 alert("Estado no puede ser vacio"); 
      	 document.captura.estado.focus(); 
      	 return 0; 
	}
	
	if (document.captura.tel.value.length==0)
	{ 
      	 alert("Telefono no puede ser vacio"); 
      	 document.captura.tel.focus(); 
      	 return 0; 
	}
	
	if (document.captura.fech_captura.value.length==0)
	{ 
      	 alert("Fecha no puede ser vacio"); 
      	 document.captura.fech_captura.focus(); 
      	 return 0; 
	}

	
	alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('cliente');
	 
	 id_cliente=document.captura.id_cliente.value;
	 nombre=document.captura.nombre.value;
	
	rfc=document.captura.rfc.value;
	dire=document.captura.dire.value;
	ciudad=document.captura.ciudad.value;
	estado=document.captura.estado.value;
	
	tel=document.captura.tel.value;
	fech_captura=document.captura.fech_captura.value;
	enviar=document.captura.enviar.value;
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_clientes.php");
	divFormulario.innerHTML = '<img src="loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			//divFormulario.style.display="block";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("nombre="+nombre+"&rfc="+rfc+"&dire="+dire+"&ciudad="+ciudad+"&tel="+tel+"&fech_captura="+fech_captura+"&enviar="+enviar+"&id_cliente="+id_cliente+"&estado="+estado)
}

function alta_cliente(){
	
	if (document.captura.nombre.value.length==0)
	{ 
      	 alert("Nombre del cliente no puede ser vacio"); 
      	 document.captura.nombre.focus(); 
      	 return 0; 
	}
    if (document.captura.rfc.value.length==0)
	{ 
      	 alert("Rfc no puede ser vacio o ingresa rfc sin homo clave"); 
      	 document.captura.rfc.focus(); 
      	 return 0; 
	}
	if (document.captura.ciudad.value.length==0)
	{ 
      	 alert("Ciudad no puede ser vacio"); 
      	 document.captura.ciudad.focus(); 
      	 return 0; 
	}
	if (document.captura.estado.value.length==0)
	{ 
      	 alert("Estado no puede ser vacio"); 
      	 document.captura.estado.focus(); 
      	 return 0; 
	}
	if (document.captura.dire.value.length==0)
	{ 
      	 alert("Direcci\u00f3n no puede ser vacio"); 
      	 document.captura.dire.focus(); 
      	 return 0; 
	}
    
	
	
	
	if (document.captura.tel.value.length==0)
	{ 
      	 alert("Telefono no puede ser vacio"); 
      	 document.captura.tel.focus(); 
      	 return 0; 
	}
	
	if (document.captura.fech_captura.value.length==0)
	{ 
      	 alert("Fecha no puede ser vacio"); 
      	 document.captura.fech_captura.focus(); 
      	 return 0; 
	}

    alert("Muchas gracias la informacion ha sido enviada");
 	
	divFormulario = document.getElementById('cliente');
    nombre=document.captura.nombre.value;
	
	rfc=document.captura.rfc.value;
	dire=document.captura.dire.value;
	ciudad=document.captura.ciudad.value;
	tel=document.captura.tel.value;
	fech_captura=document.captura.fech_captura.value;
	estado=document.captura.estado.value;

	
	enviar=document.captura.enviar.value;
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_clientes.php");
	divFormulario.innerHTML = '<img src="loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			document.captura.nombre.value="";
			document.captura.rfc.value="";
			document.captura.dire.value="";
			document.captura.ciudad.value="";
			document.captura.estado.value="";
			document.captura.tel.value="";
			document.captura.fech_captura.value="";
			
					
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("nombre="+nombre+"&rfc="+rfc+"&dire="+dire+"&ciudad="+ciudad+"&tel="+tel+"&fech_captura="+fech_captura+"&enviar="+enviar+"&estado="+estado)

}


function alta_clientef(){
	
	if (document.captura.nombre.value.length==0)
	{ 
      	 alert("Nombre del cliente no puede ser vacio"); 
      	 document.captura.nombre.focus(); 
      	 return 0; 
	}
    if (document.captura.rfc.value.length==0)
	{ 
      	 alert("Rfc no puede ser vacio o ingresa rfc sin homo clave"); 
      	 document.captura.rfc.focus(); 
      	 return 0; 
	}
	if (document.captura.dire.value.length==0)
	{ 
      	 alert("Direcci\u00f3n no puede ser vacio"); 
      	 document.captura.dire.focus(); 
      	 return 0; 
	}
    if (document.captura.ciudad.value.length==0)
	{ 
      	 alert("Ciudad no puede ser vacio"); 
      	 document.captura.ciudad.focus(); 
      	 return 0; 
	}
	if (document.captura.estado.value.length==0)
	{ 
      	 alert("Estado no puede ser vacio"); 
      	 document.captura.estado.focus(); 
      	 return 0; 
	}
	if (document.captura.cp.value.length==0)
	{ 
      	 alert("Codigo postal no puede ser vacio"); 
      	 document.captura.cp.focus(); 
      	 return 0; 
	}
	if (document.captura.colonia.value.length==0)
	{ 
      	 alert("Colonia no puede ser vacio"); 
      	 document.captura.colonia.focus(); 
      	 return 0; 
	}
	if (document.captura.tel.value.length==0)
	{ 
      	 alert("Telefono no puede ser vacio"); 
      	 document.captura.tel.focus(); 
      	 return 0; 
	}
	
	if (document.captura.fech_captura.value.length==0)
	{ 
      	 alert("Fecha no puede ser vacio"); 
      	 document.captura.fech_captura.focus(); 
      	 return 0; 
	}

    alert("Muchas gracias la informacion ha sido enviada");
 	
	divFormulario = document.getElementById('cliente');
    nombre=document.captura.nombre.value;
	var bandera=1;
	rfc=document.captura.rfc.value;
	dire=document.captura.dire.value;
	ciudad=document.captura.ciudad.value;
	tel=document.captura.tel.value;
	fech_captura=document.captura.fech_captura.value;
	estado=document.captura.estado.value;
	cp=document.captura.cp.value;
	colonia=document.captura.colonia.value;
	enviar=document.captura.enviar.value;
	
	
	ajax=objetoAjax();
	ajax.open("POST", "../clientes/serv_clientes.php");
	divFormulario.innerHTML = '<img src="loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			document.captura.nombre.value="";
			
			document.captura.rfc.value="";
			document.captura.dire.value="";
			document.captura.ciudad.value="";
			document.captura.estado.value="";
			document.captura.cp.value="";
			document.captura.colonia.value="";
			document.captura.tel.value="";
			document.captura.fech_captura.value="";
			
					
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("bandera="+bandera+"&nombre="+nombre+"&rfc="+rfc+"&dire="+dire+"&ciudad="+ciudad+"&tel="+tel+"&fech_captura="+fech_captura+"&enviar="+enviar+"&estado="+estado+"&cp="+cp+"&colonia="+colonia)

}

function buscar_rfc(){
	
	if (document.captura.rfc.value.length==0)
	{ 
		 alert("RFC no puede ser vacio"); 
      	 document.captura.rfc.focus(); 
      	 return 0; 
	}
	
	
	
	alert("RFC sera comprobado en el sistema espere un momento....");
	
	divFormulario = document.getElementById('envio');
	
	
	rfc=document.captura.rfc.value;
	rfc=trim(rfc); 
	enviar=document.captura.enviar.value;
	
	
	ajax=objetoAjax();
	ajax.open("POST", "facturas/serv_factura.php");
	divFormulario.innerHTML = '<img src="facturas/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			//divFormulario.innerHTML = ajax.responseText
			//rfc2=ajax.responseText;

var resultado=ajax.responseText;
		
			if(resultado==1)
			document.location.href="facturas/f_factura.php?rfc="+rfc;
			else
			document.location.href="facturas/f_cliente.php?rfc="+rfc;
			
		
			
			//document.location.href="modif_perfil.php?id_perfil="+id_perfil;
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("rfc="+rfc+"&enviar="+enviar)

}


// DATOS DE EMPLEADOS 


function alta_empleados(){
	
	if (document.captura.nombre.value.length==0)
	{ 
      	 alert("Nombre de empleado no puede ser vacio"); 
      	 document.captura.nombre.focus(); 
      	 return 0; 
	}
	if (document.captura.ap_paterno.value.length==0)
	{ 
      	 alert("Apellido paterno no puede ser vacio"); 
      	 document.captura.ap_paterno.focus(); 
      	 return 0; 
	}
	if (document.captura.ap_materno.value.length==0)
	{ 
      	 alert("Apellido materno no puede ser vacio"); 
      	 document.captura.ap_materno.focus(); 
      	 return 0; 
	}
/*	if (document.captura.rfc.value.length==0)
	{ 
      	 alert("RFC de empleado no puede ser vacio"); 
      	 document.captura.rfc.focus(); 
      	 return 0; 
	}
	if (document.captura.curp.value.length==0)
	{ 
      	 alert("Curp no puede ser vacio"); 
      	 document.captura.curp.focus(); 
      	 return 0; 
	}*/
	/*if (document.captura.sexo.value.length==0)
	{ 
      	 alert("Genero no puede ser vacio"); 
      	 document.captura.sexo.focus(); 
      	 return 0; 
	}
	if (document.captura.dire.value.length==0)
	{ 
			 alert("Direccion no puede ser vacio"); 
      	 document.captura.dire.focus(); 
      	 return 0; 
	}

	if (document.captura.cod_postal.value.length==0)
	{ 
      	 alert("Codigo postal no puede ser vacio"); 
      	 document.captura.cod_postal.focus(); 
      	 return 0; 
	}
	if (document.captura.email.value.length==0)
	{ 
      	 alert("Email no puede ser vacio"); 
      	 document.captura.email.focus(); 
      	 return 0; 
	}*/
	if (document.captura.sexo.value.length==0)
	{ 
      	 alert("Genero no puede ser vacio"); 
      	 document.captura.sexo.focus(); 
      	 return 0; 
	}
	if (document.captura.id_perfil.value.length==0)
	{ 
      	 alert("Perfil de usuario no puede ser vacio"); 
      	 document.captura.id_perfil.focus(); 
      	 return 0; 
	}
	
	alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('empleados');
	nombre=document.captura.nombre.value;
	ap_paterno=document.captura.ap_paterno.value;
	ap_materno=document.captura.ap_materno.value;
	sexo=document.captura.sexo.value;
	/*rfc=document.captura.rfc.value;
	curp=document.captura.curp.value;
	
	dire=document.captura.dire.value;
	cod_postal=document.captura.cod_postal.value;
	email=document.captura.email.value;*/
	id_perfil=document.captura.id_perfil.value;
	
	enviar=document.captura.enviar.value;
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_empleados.php");
	divFormulario.innerHTML = '<img src="loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			limpia_empleados();
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("nombre="+nombre+"&ap_paterno="+ap_paterno+"&ap_materno="+ap_materno+"&id_perfil="+id_perfil+"&enviar="+enviar+"&sexo="+sexo)

}
function limpia_empleados()
{
			document.captura.nombre.value="";
			document.captura.ap_paterno.value="";
			document.captura.ap_materno.value="";
			
			document.captura.sexo.value="";
			
			document.captura.id_perfil.value="";
			
			
}
function modif_empleados(){
	
	if (document.captura.nombre.value.length==0)
	{ 
      	 alert("Nombre de empleado no puede ser vacio"); 
      	 document.captura.nombre.focus(); 
      	 return 0; 
	}
	if (document.captura.ap_paterno.value.length==0)
	{ 
      	 alert("Apellido paterno no puede ser vacio"); 
      	 document.captura.ap_paterno.focus(); 
      	 return 0; 
	}
	if (document.captura.ap_materno.value.length==0)
	{ 
      	 alert("Apellido materno no puede ser vacio"); 
      	 document.captura.ap_materno.focus(); 
      	 return 0; 
	}

	if (document.captura.sexo.value.length==0)
	{ 
      	 alert("Genero no puede ser vacio"); 
      	 document.captura.sexo.focus(); 
      	 return 0; 
	}
	
	
	alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('modif_empleados');
	nombre=document.captura.nombre.value;
	ap_paterno=document.captura.ap_paterno.value;
	ap_materno=document.captura.ap_materno.value;
	sexo=document.captura.sexo.value;
	
	
	
	id_empleado=document.captura.id_empleado.value;
	
	enviar=document.captura.enviar.value;
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_empleados.php");
	divFormulario.innerHTML = '<img src="loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			//divFormulario.style.display="block";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("nombre="+nombre+"&ap_paterno="+ap_paterno+"&ap_materno="+ap_materno+"&sexo="+sexo+"&enviar="+enviar+"&id_empleado="+id_empleado)

}


function alta_servicio()
{
	if (document.captura.nom_servicio.value.length==0)
	{ 
      	 alert("Nombre del servicio no puede ser vacio"); 
      	 document.captura.nom_servicio.focus(); 
      	 return 0; 
	}
	if (document.captura.fecha.value.length==0)
	{ 
      	 alert("Fecha no puede ser vacio"); 
      	 document.captura.fecha.focus(); 
      	 return 0; 
	}
	
	alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('servicio');
	id_cliente=document.captura.id_cliente.value;
	nom_servicio=document.captura.nom_servicio.value;
	fecha=document.captura.fecha.value;
	
	enviar=document.captura.enviar.value;
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_servicios.php");
	divFormulario.innerHTML = '<img src="loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			document.captura.nom_servicio.value="";
			document.captura.fecha.value="";
	        
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("nom_servicio="+nom_servicio+"&id_cliente="+id_cliente+"&fecha="+fecha+"&enviar="+enviar)	
	
}



function alta_equipo(){
	
	if (document.captura.marca.value.length==0)
	{ 
      	 alert("Marca no puede ser vacio"); 
      	 document.captura.marca.focus(); 
      	 return 0; 
	}
	if (document.captura.modelo.value.length==0)
	{ 
      	 alert("Modelo no puede ser vacio"); 
      	 document.captura.modelo.focus(); 
      	 return 0; 
	}
	if (document.captura.num_serie.value.length==0)
	{ 
      	 alert("Num de serie no puede ser vacio"); 
      	 document.captura.num_serie.focus(); 
      	 return 0; 
	}
	
	if (document.captura.id_tipo.value.length==0)
	{ 
      	 alert("Tipo de equipo no puede ser vacio"); 
      	 document.captura.id_tipo.focus(); 
      	 return 0; 
	}
	
	
	if (document.captura.descripcion_falla.value.length==0)
	{ 
      	 alert("Descripcion de falla no puede ser vacio"); 
      	 document.captura.descripcion_falla.focus(); 
      	 return 0; 
	}
	
	
	if (document.captura.contra.value.length==0)
	{ 
      	 alert("Password no puede ser vacio"); 
      	 document.captura.contra.focus(); 
      	 return 0; 
	}
	
	alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('concepto');
	
	id_servicio=document.captura.id_servicio.value;
	marca=document.captura.marca.value;
	modelo=document.captura.modelo.value;
	num_serie=document.captura.num_serie.value;
	id_tipo=document.captura.id_tipo.value;
	descripcion_falla=document.captura.descripcion_falla.value;
	contra=document.captura.contra.value;
	enviar=document.captura.enviar.value;
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_concepto.php");
	divFormulario.innerHTML = '<img src="loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			document.captura.marca.value="";
			document.captura.modelo.value="";
			document.captura.num_serie.value="";
			document.captura.id_tipo.value="";
			document.captura.descripcion_falla.value="";
			document.captura.contra.value="";
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("id_servicio="+id_servicio+"&marca="+marca+"&modelo="+modelo+"&num_serie="+num_serie+"&id_tipo="+id_tipo+"&descripcion_falla="+descripcion_falla+"&contra="+contra+"&enviar="+enviar)

}

function modif_equipo(){
	
	if (document.captura.marca.value.length==0)
	{ 
      	 alert("Marca no puede ser vacio"); 
      	 document.captura.marca.focus(); 
      	 return 0; 
	}
	if (document.captura.modelo.value.length==0)
	{ 
      	 alert("Modelo no puede ser vacio"); 
      	 document.captura.modelo.focus(); 
      	 return 0; 
	}
	if (document.captura.num_serie.value.length==0)
	{ 
      	 alert("Num de serie no puede ser vacio"); 
      	 document.captura.num_serie.focus(); 
      	 return 0; 
	}
	
	if (document.captura.id_tipo.value.length==0)
	{ 
      	 alert("Tipo de equipo no puede ser vacio"); 
      	 document.captura.id_tipo.focus(); 
      	 return 0; 
	}
	
	
	if (document.captura.descripcion_falla.value.length==0)
	{ 
      	 alert("Descripcion de falla no puede ser vacio"); 
      	 document.captura.descripcion_falla.focus(); 
      	 return 0; 
	}
	
	
	if (document.captura.contra.value.length==0)
	{ 
      	 alert("Password no puede ser vacio"); 
      	 document.captura.contra.focus(); 
      	 return 0; 
	}
	
	alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('equipo');
	
	id_equipo=document.captura.id_equipo.value;
	marca=document.captura.marca.value;
	modelo=document.captura.modelo.value;
	num_serie=document.captura.num_serie.value;
	id_tipo=document.captura.id_tipo.value;
	descripcion_falla=document.captura.descripcion_falla.value;
	contra=document.captura.contra.value;
	enviar=document.captura.enviar.value;
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_concepto.php");
	divFormulario.innerHTML = '<img src="loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("id_equipo="+id_equipo+"&marca="+marca+"&modelo="+modelo+"&num_serie="+num_serie+"&id_tipo="+id_tipo+"&descripcion_falla="+descripcion_falla+"&contra="+contra+"&enviar="+enviar)

}
function elimina_equipo(id_equipo,id_servicio){
	
	if (confirm('Estas completamente seguro de eliminar este Equipo'))
	{
	
	  divFormularios = document.getElementById('concepto');
	
	ajax=objetoAjax();



ajax.open("POST", "elimina_concepto.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormularios.innerHTML = ajax.responseText
			//divFormulario2.innerHTML = ajax.responseText
			//divFormulario2.style.display="block";
			divFormularios.style.display="block";
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("id_equipo="+id_equipo+"&id_servicio="+id_servicio)



}
}


function autoriza(){
	//divFormulario = document.getElementById('imprime');
	filtro=document.captura2.filtro.value;
//alert("");
if(filtro==1)
document.location.href='busqueda_g.php';
if(filtro==2)
document.location.href='busqueda_servicio.php';


}


function getRadioButtonSelectedValue(ctrl)
{
    for(i=0;i<ctrl.length;i++)
        if(ctrl[i].checked) return ctrl[i].value;
}

function alta_diagnostico(){
	
	
	$txt=document.getElementById('diagnostico').value;
	
	if ($txt==0)
	{ 
      	 alert("Diagnostico no puede ser vacio"); 
      	 document.getElementById('diagnostico').focus();
//		 document.captura.diagnostico.focus(); 
      	 return 0; 
	}
	if (document.captura.time_entrega.value.length==0)
	{ 
      	 alert("Tiempo de entrega no puede ser vacio"); 
      	 document.captura.time_entrega.focus(); 
      	 return 0; 
	}
	if (document.captura.costo_servicio.value.length==0)
	{ 
      	 alert("Costo de servicio no puede ser vacio"); 
      	 document.captura.costo_servicio.focus(); 
      	 return 0; 
	}
	
var s = "no"; 
with (document.captura)
{ 
for ( var i = 0; i < entra_garantia.length; i++ ) 
{ 
if ( entra_garantia[i].checked ) 
{ 
s= "si"; 

//window.alert("Ha seleccionado: \n" + entra_garantia[i].value); 
break; 
} 
} 
if ( s == "no" )
{ 
window.alert("Debe seleccionar si o no" ) ; 
return 0; 
} 
} 
 

	
	
	
	
	
	alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('diag');
	divFormulario2 = document.getElementById('borrar');
	
	id_equipo=document.captura.id_equipo.value;
	id_servicio=document.captura.id_servicio.value;
	diagnostico=document.captura.diagnostico.value;
	time_entrega=document.captura.time_entrega.value;
	costo_servicio=document.captura.costo_servicio.value;
//	entra_garantia=document.captura.entra_garantia.value;
	
	entra_garantia=getRadioButtonSelectedValue(document.captura.entra_garantia);
	
	enviar=document.captura.enviar.value;
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_diagnostico.php");
	divFormulario.innerHTML = '<img src="loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			divFormulario.innerHTML = ajax.responseText;
			
			document.captura.diagnostico.value="";
			document.captura.costo_servicio.value="";
			document.captura.entra_garantia.value="";
			divFormulario2.innerHTML="";
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("id_equipo="+id_equipo+"&id_servicio="+id_servicio+"&diagnostico="+diagnostico+"&time_entrega="+time_entrega+"&costo_servicio="+costo_servicio+"&entra_garantia="+entra_garantia+"&enviar="+enviar)

}


function modif_diagnostico(){
	
	
	$txt=document.getElementById('diagnostico').value;
	
	if ($txt==0)
	{ 
      	 alert("Diagnostico no puede ser vacio"); 
      	 document.getElementById('diagnostico').focus();
//		 document.captura.diagnostico.focus(); 
      	 return 0; 
	}
	if (document.captura.time_entrega.value.length==0)
	{ 
      	 alert("Tiempo de entrega no puede ser vacio"); 
      	 document.captura.time_entrega.focus(); 
      	 return 0; 
	}
	if (document.captura.costo_servicio.value.length==0)
	{ 
      	 alert("Costo de servicio no puede ser vacio"); 
      	 document.captura.costo_servicio.focus(); 
      	 return 0; 
	}
	
var s = "no"; 
with (document.captura)
{ 
for ( var i = 0; i < entra_garantia.length; i++ ) 
{ 
if ( entra_garantia[i].checked ) 
{ 
s= "si"; 
//window.alert("Ha seleccionado: \n" + entra_garantia[i].value); 
break; 
} 
} 
if ( s == "no" )
{ 
window.alert("Debe seleccionar si o no" ) ; 
return 0; 
} 
} 
 

	
	
	
	
	
	alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('diag');
	
	id_equipo=document.captura.id_equipo.value;
	id_servicio=document.captura.id_servicio.value;
	id_orden=document.captura.id_orden.value;
	diagnostico=document.captura.diagnostico.value;
	time_entrega=document.captura.time_entrega.value;
	costo_servicio=document.captura.costo_servicio.value;
	entra_garantia=getRadioButtonSelectedValue(document.captura.entra_garantia);
	
	enviar=document.captura.enviar.value;
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_diagnostico.php");
	divFormulario.innerHTML = '<img src="loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			divFormulario.innerHTML = ajax.responseText;
			
			/*document.captura.diagnostico.value="";
			document.captura.costo_servicio.value="";
			document.captura.entra_garantia.value="";*/
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("id_equipo="+id_equipo+"&id_servicio="+id_servicio+"&diagnostico="+diagnostico+"&time_entrega="+time_entrega+"&costo_servicio="+costo_servicio+"&entra_garantia="+entra_garantia+"&enviar="+enviar+"&id_orden="+id_orden)

}

function alta_garantia(){
	
	
	
	if (document.captura.num_factura.value.length==0)
	{ 
      	 alert("Numero de factura no puede ser vacio"); 
      	 document.captura.num_factura.focus(); 
      	 return 0; 
	}
	if (document.captura.descrip.value.length==0)
	{ 
      	 alert("Descripcion de garantia no puede ser vacio"); 
      	 document.captura.descrip.focus(); 
      	 return 0; 
	}
	if (document.captura.num_proveedor.value.length==0)
	{ 
      	 alert("Numero de proveedor no puede ser vacio"); 
      	 document.captura.num_proveedor.focus(); 
      	 return 0; 
	}
	
	if (document.captura.num_fac_compra.value.length==0)
	{ 
      	 alert("Numero de Factura de compra no puede ser vacio"); 
      	 document.captura.num_fac_compra.focus(); 
      	 return 0; 
	}
	
	
	alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('garantia');

	
	id_orden=document.captura.id_orden.value;
	num_factura=document.captura.num_factura.value;
	descrip=document.captura.descrip.value;
	num_proveedor=document.captura.num_proveedor.value;
	num_fac_compra=document.captura.num_fac_compra.value;
	
	
	
	enviar=document.captura.enviar.value;
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_garantia.php");
	divFormulario.innerHTML = '<img src="loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			divFormulario.innerHTML = ajax.responseText;
			
			/*document.captura.diagnostico.value="";
			document.captura.costo_servicio.value="";
			document.captura.entra_garantia.value="";*/
			divFormulario2.innerHTML="";
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("id_orden="+id_orden+"&num_factura="+num_factura+"&descrip="+descrip+"&num_proveedor="+num_proveedor+"&enviar="+enviar+"&num_fac_compra="+num_fac_compra)

}

function elimina_garantia(id_orden,id_garantia){
	
	if (confirm('Estas completamente seguro de eliminar esta Garantia'))
	{
	
	  divFormularios = document.getElementById('garantia');
	
	ajax=objetoAjax();



ajax.open("POST", "elimina_garantia.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormularios.innerHTML = ajax.responseText
			//divFormulario2.innerHTML = ajax.responseText
			//divFormulario2.style.display="block";
			divFormularios.style.display="block";
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("id_orden="+id_orden+"&id_garantia="+id_garantia)



}
}

