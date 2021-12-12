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
      	 alert("Ingrese Password"); 
      	 document.logi.contra.focus(); 
      	 return 0; 
	}
	if (document.logi.id_sucursal.value.length==0)
	{ 
      	 alert("Seleccione Sucursal"); 
      	 document.logi.id_sucursal.focus(); 
      	 return 0; 
	}
	if (document.logi.id_periodo.value.length==0)
	{ 
      	 alert("Seleccione una cosecha"); 
      	 document.logi.id_periodo.focus(); 
      	 return 0; 
	}

alert("Muchas gracias Verificando Datos");
 
	divFormulario = document.getElementById('success_message');
	
     user=document.logi.user.value;
	contra=document.logi.contra.value;
	id_sucursal=document.logi.id_sucursal.value;
	id_periodo=document.logi.id_periodo.value;
	des_periodo=document.logi.id_periodo[document.logi.id_periodo.selectedIndex].text;
	enviar=document.logi.enviar.value;
	

	ajax=objetoAjax();
	ajax.open("POST", "autentificar.php");
	divFormulario.innerHTML = '<img src="loading.gif" align="middle" />Comprobando Clave...';
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
	   ajax.send("user="+user+"&contra="+contra+"&id_sucursal="+id_sucursal+"&id_periodo="+id_periodo+"&des_periodo="+des_periodo)	
		
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

function clear_report()
{
	frame = document.getElementById('consul_reporte');
	frame.innerHTML="";		
			
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
function elimina_reque_paq(id_conf_paq,id_paquete){
	
	
	requerimiento=document.reque.requerimiento.value;
	
	
	
	if (confirm('Estas completamente seguro de eliminar este requerimiento: '+requerimiento+''))
	{
	
	  divFormularios = document.getElementById('contenido');
	
	ajax=objetoAjax();



ajax.open("POST", "elimina_reque.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormularios.innerHTML = ajax.responseText
			//divFormulario2.innerHTML = ajax.responseText
			//divFormulario2.style.display="block";
			divFormularios.style.display="block";
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("id_conf_paq="+id_conf_paq+"&id_paquete="+id_paquete)



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
	{
        if(ctrl[i].checked)
        { 
        		 
         	return ctrl[i].value;
        }
   }
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



function presenta(id_menu){
	
	
	divFormulario = document.getElementById('contenido');
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_pantalla.php");
	divFormulario.innerHTML = '<img src="session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("id_menu="+id_menu)

}

function presenta2(id_menu){
	
	d="../";
	divFormulario = document.getElementById('contenido');
	
	ajax=objetoAjax();
	ajax.open("POST", "../serv_pantalla.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("id_menu="+id_menu+"&d="+d)

}



function perfiles(){


if (document.captura.nom_perfil.value.length==0)
	{ 
      	 alert("Nombre de perfil no puede ser vacio"); 
      	 document.captura.nom_perfil.focus(); 
      	 return 0; 
	}
	if (document.captura.desc.value.length==0)
	{ 
      	 alert("Descripcion de perfil no puede ser vacio"); 
      	 document.captura.desc.focus(); 
      	 return 0; 
	}


	alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('contenido');

	
	nom_perfil=document.captura.nom_perfil.value;
	desc=document.captura.desc.value;
	
	
	
	enviar=document.captura.enviar.value;
	
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_perfiles.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			//document.captura.nom_perfil.value="";
			//document.captura.desc.value="";
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("nom_perfil="+nom_perfil+"&desc="+desc+"&enviar="+enviar)

}

function perfiles_m(){


if (document.captura.nom_perfil.value.length==0)
	{ 
      	 alert("Nombre de perfil no puede ser vacio"); 
      	 document.captura.nom_perfil.focus(); 
      	 return 0; 
	}
	if (document.captura.desc.value.length==0)
	{ 
      	 alert("Descripcion de perfil no puede ser vacio"); 
      	 document.captura.desc.focus(); 
      	 return 0; 
	}


	alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('contenido');

	
	nom_perfil=document.captura.nom_perfil.value;
	desc=document.captura.desc.value;
	perfil_id=document.captura.perfil_id.value;
	
	
	enviar=document.captura.enviar.value;
	
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_perfiles.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("nom_perfil="+nom_perfil+"&desc="+desc+"&enviar="+enviar+"&perfil_id="+perfil_id)

}
function usuarios(){


if (document.captura.nombre.value.length==0)
	{ 
      	 alert("Nombre de usuario no puede ser vacio"); 
      	 document.captura.nombre.focus(); 
      	 return 0; 
	}
	if (document.captura.iniciales.value.length==0)
	{ 
      	 alert("Iniciales de usuario no puede ser vacio"); 
      	 document.captura.iniciales.focus(); 
      	 return 0; 
	}
	
	if (document.captura.perfil.value.length==0)
	{ 
      	 alert("Perfil de usuario no puede ser vacio"); 
      	 document.captura.perfil.focus(); 
      	 return 0; 
	}
	
	if (document.captura.id_sucursal.value.length==0)
	{ 
      	 alert("Sucursal no puede ser vacio"); 
      	 document.captura.id_sucursal.focus(); 
      	 return 0; 
	}
	
	
	if (document.captura.usuario.value.length==0)
	{ 
      	 alert("Usuario no puede ser vacio"); 
      	 document.captura.usuario.focus(); 
      	 return 0; 
	}
	if (document.captura.contra.value.length==0)
	{ 
      	 alert("Password no puede ser vacio"); 
      	 document.captura.contra.focus(); 
      	 return 0; 
	}
	
	if (document.captura.contra2.value.length==0)
	{ 
      	 alert("Password no puede ser vacio"); 
      	 document.captura.contra2.focus(); 
      	 return 0; 
	}
	
	contra=document.captura.contra.value;
	contra2=document.captura.contra2.value;
	
	if (contra!=contra2)
	{ 
      	 alert("Password debe coincidir"); 
      	 document.captura.contra.focus(); 
      	 return 0; 
	}
	
	
	alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('contenido');

	nombre=document.captura.nombre.value;
	iniciales=document.captura.iniciales.value;
	perfil=document.captura.perfil.value;
	usuario=document.captura.usuario.value;
	id_sucursal=document.captura.id_sucursal.value;
	
	
	enviar=document.captura.enviar.value;
	
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_usuario.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			/*document.captura.nombre.value="";
			document.captura.iniciales.value="";
			document.captura.perfil.value="";
			document.captura.usuario.value="";
			document.captura.contra.value="";
			document.captura.contra2.value="";
			document.captura.id_sucursal.value="";*/
			
			
			
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("nombre="+nombre+"&iniciales="+iniciales+"&perfil="+perfil+"&usuario="+usuario+"&contra="+contra+"&enviar="+enviar+"&id_sucursal="+id_sucursal)

}

function usuarios_m(){


if (document.captura.nombre.value.length==0)
	{ 
      	 alert("Nombre de usuario no puede ser vacio"); 
      	 document.captura.nombre.focus(); 
      	 return 0; 
	}
	if (document.captura.iniciales.value.length==0)
	{ 
      	 alert("Iniciales de usuario no puede ser vacio"); 
      	 document.captura.iniciales.focus(); 
      	 return 0; 
	}
	
	if (document.captura.perfil.value.length==0)
	{ 
      	 alert("Perfil de usuario no puede ser vacio"); 
      	 document.captura.perfil.focus(); 
      	 return 0; 
	}
	if (document.captura.usuario.value.length==0)
	{ 
      	 alert("Usuario no puede ser vacio"); 
      	 document.captura.usuario.focus(); 
      	 return 0; 
	}
	
	if (document.captura.contra.value.length==0)
	{ 
      	 alert("Password no puede ser vacio"); 
      	 document.captura.contra.focus(); 
      	 return 0; 
	}
	alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('contenido');
	

	nombre=document.captura.nombre.value;
	iniciales=document.captura.iniciales.value;
	perfil=document.captura.perfil.value;
	usuario=document.captura.usuario.value;
	contra=document.captura.contra.value;
	usuario_id=document.captura.usuario_id.value;
	
	enviar=document.captura.enviar.value;
	
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_usuario.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("nombre="+nombre+"&iniciales="+iniciales+"&perfil="+perfil+"&usuario="+usuario+"&usuario_id="+usuario_id+"&enviar="+enviar+"&contra="+contra)

}



function Pagina(nropagina){
	//donde se mostrará los registros
	divContenido = document.getElementById('consul_perfil');
	
	ajax=objetoAjax();
	//uso del medoto GET
	//indicamos el archivo que realizará el proceso de paginar
	//junto con un valor que representa el nro de pagina
	ajax.open("GET", "consul_perfiles.php?pag="+nropagina);
	divContenido.innerHTML= '<img src="loading.gif">';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divContenido.innerHTML = ajax.responseText
		}
	}
	//como hacemos uso del metodo GET
	//colocamos null ya que enviamos 
	//el valor por la url ?pag=nropagina
	ajax.send(null)
}

function Pagina_u(nropagina){
	//donde se mostrará los registros
	divContenido = document.getElementById('consul_usuario');
	
	ajax=objetoAjax();
	//uso del medoto GET
	//indicamos el archivo que realizará el proceso de paginar
	//junto con un valor que representa el nro de pagina
	ajax.open("GET", "consul_usuarios.php?pag="+nropagina);
	divContenido.innerHTML= '<img src="loading.gif">';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divContenido.innerHTML = ajax.responseText
		}
	}
	//como hacemos uso del metodo GET
	//colocamos null ya que enviamos 
	//el valor por la url ?pag=nropagina
	ajax.send(null)
}



function sucursales(){


if (document.captura.sucursal.value.length==0)
	{ 
      	 alert("Nombre de sucursal no puede ser vacio"); 
      	 document.captura.sucursal.focus(); 
      	 return 0; 
	}
	if (document.captura.direccion.value.length==0)
	{ 
      	 alert("Direccion no puede ser vacio"); 
      	 document.captura.direccion.focus(); 
      	 return 0; 
	}
	
	if (document.captura.telefono.value.length==0)
	{ 
      	 alert("Telefono no puede ser vacio"); 
      	 document.captura.telefono.focus(); 
      	 return 0; 
	}
	if (document.captura.cp.value.length==0)
	{ 
      	 alert("Codigo postal no puede ser vacio"); 
      	 document.captura.cp.focus(); 
      	 return 0; 
	}
	if (document.captura.idsede.value.length==0)
	{ 
      	 alert("Sede no puede ser vacio"); 
      	 document.captura.idsede.focus(); 
      	 return 0; 
	}
	
	if (document.captura.idencargado.value.length==0)
	{ 
			 alert("Encargado no puede ser vacio"); 
      	 document.captura.idencargado.focus(); 
      	 return 0; 
	}
	
	
	
	alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('contenido');

	sucursal=document.captura.sucursal.value;
	direccion=document.captura.direccion.value;
	telefono=document.captura.telefono.value;
	cp=document.captura.cp.value;
	idsede=document.captura.idsede.value;
	idencargado=document.captura.idencargado.value;
	
	enviar=document.captura.enviar.value;
	
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_sucursal.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
			
			
			
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("sucursal="+sucursal+"&direccion="+direccion+"&telefono="+telefono+"&cp="+cp+"&idsede="+idsede+"&idencargado="+idencargado+"&enviar="+enviar)

}


function sucursales_m(){


if (document.captura.sucursal.value.length==0)
	{ 
      	 alert("Nombre de sucursal no puede ser vacio"); 
      	 document.captura.sucursal.focus(); 
      	 return 0; 
	}
	if (document.captura.direccion.value.length==0)
	{ 
      	 alert("Direccion no puede ser vacio"); 
      	 document.captura.direccion.focus(); 
      	 return 0; 
	}
	
	if (document.captura.telefono.value.length==0)
	{ 
      	 alert("Telefono no puede ser vacio"); 
      	 document.captura.telefono.focus(); 
      	 return 0; 
	}
	if (document.captura.cp.value.length==0)
	{ 
      	 alert("Codigo postal no puede ser vacio"); 
      	 document.captura.cp.focus(); 
      	 return 0; 
	}
	if (document.captura.idsede.value.length==0)
	{ 
      	 alert("Sede no puede ser vacio"); 
      	 document.captura.idsede.focus(); 
      	 return 0; 
	}
	
	if (document.captura.idencargado.value.length==0)
	{ 
			 alert("Encargado no puede ser vacio"); 
      	 document.captura.idencargado.focus(); 
      	 return 0; 
	}
	
	
	
	alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('contenido');

	sucursal=document.captura.sucursal.value;
	direccion=document.captura.direccion.value;
	telefono=document.captura.telefono.value;
	cp=document.captura.cp.value;
	idsede=document.captura.idsede.value;
	idencargado=document.captura.idencargado.value;
	sucursal_id=document.captura.sucursal_id.value;
	
	enviar=document.captura.enviar.value;
	
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_sucursal.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
			
			
			
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("sucursal="+sucursal+"&direccion="+direccion+"&telefono="+telefono+"&cp="+cp+"&idsede="+idsede+"&idencargado="+idencargado+"&enviar="+enviar+"&sucursal_id="+sucursal_id)

}



function Pagina_sucu(nropagina){
	//donde se mostrará los registros
	divContenido = document.getElementById('consul_sucursal');
	
	ajax=objetoAjax();
	//uso del medoto GET
	//indicamos el archivo que realizará el proceso de paginar
	//junto con un valor que representa el nro de pagina
	ajax.open("GET", "consul_sucursales.php?pag="+nropagina);
	divContenido.innerHTML= '<img src="loading.gif">';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divContenido.innerHTML = ajax.responseText
		}
	}
	//como hacemos uso del metodo GET
	//colocamos null ya que enviamos 
	//el valor por la url ?pag=nropagina
	ajax.send(null)
}




function actualiza_usu(form){


	if(form==1)
	{
	
		if (document.cliente.usuario_id.value.length==0)
			{ 
				 alert("Nombre de usuario no puede ser vacio"); 
				 document.cliente.usuario_id.focus(); 
				 return 0; 
			}
	
	
	usuario_id=document.cliente.usuario_id.value;
	
	}

	//alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('contenido');

	
	

	
	
	
	//enviar=document.captura.enviar.value;
	
	
	
	ajax=objetoAjax();
	ajax.open("POST", "actualiza_formu.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

if(form==1)
ajax.send("usuario_id="+usuario_id+"&form="+form)
if(form==2)
ajax.send("form="+form)

}

function actualiza_perfil(form){


	if(form==1)
	{
	
		if (document.perfil.perfil_id.value.length==0)
			{ 
				 alert("Perfil no puede ser vacio"); 
				 document.perfil.perfil_id.focus(); 
				 return 0; 
			}
	
	
	perfil_id=document.perfil.perfil_id.value;
	
	}

	//alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('contenido');

	
	

	
	
	
	//enviar=document.captura.enviar.value;
	
	
	
	ajax=objetoAjax();
	ajax.open("POST", "actualiza_formu_p.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

if(form==1)
ajax.send("perfil_id="+perfil_id+"&form="+form)
if(form==2)
ajax.send("form="+form)

}


function actualiza_sucursal(form){


	if(form==1)
	{
	
		if (document.sucursal.sucursal_id.value.length==0)
			{ 
				 alert("Sucursal no puede ser vacio"); 
				 document.sucursal.sucursal_id.focus(); 
				 return 0; 
			}
	
	
	sucursal_id=document.sucursal.sucursal_id.value;
	
	}

	//alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('contenido');

	
	

	
	
	
	//enviar=document.captura.enviar.value;
	
	
	
	ajax=objetoAjax();
	ajax.open("POST", "actualiza_formu_s.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

if(form==1)
ajax.send("sucursal_id="+sucursal_id+"&form="+form)
if(form==2)
ajax.send("form="+form)

}


function clientes_alta_egos(form_m){
	
	if (document.captura.nombre.value.length==0)
	{ 
      	 alert("Nombre  no puede ser vacio"); 
      	 document.captura.nombre.focus(); 
      	 return 0; 
	}
	if (document.captura.a_paterno.value.length==0)
	{ 
      	 alert("Apellido Paterno no puede ser vacio"); 
      	 document.captura.a_paterno.focus(); 
      	 return 0; 
	}
	if (document.captura.a_materno.value.length==0)
	{ 
      	 alert("Apellido Materno no puede ser vacio"); 
      	 document.captura.a_materno.focus(); 
      	 return 0; 
	}
	if (document.captura.dia.value.length==0)
	{ 
      	 alert(" Dia de nacimiento no puede ser vacio"); 
      	 document.captura.dia.focus(); 
      	 return 0; 
	}
	if (document.captura.mes.value.length==0)
	{ 
      	 alert(" Mes de nacimiento no puede ser vacio"); 
      	 document.captura.mes.focus(); 
      	 return 0; 
	}
	if (document.captura.ano.value.length==0)
	{ 
      	 alert(" Año de nacimiento no puede ser vacio"); 
      	 document.captura.ano.focus(); 
      	 return 0; 
	}
	
	if (document.captura.genero.value.length==0)
	{ 
      	 alert(" Genero no puede ser vacio"); 
      	 document.captura.genero.focus(); 
      	 return 0; 
	}
	
	if (document.captura.rfc.value.length==0)
	{ 
      	 alert(" RFC no puede ser vacio"); 
      	 document.captura.rfc.focus(); 
      	 return 0; 
	}
	if (document.captura.ife.value.length==0)
	{ 
      	 alert("IFE no puede ser vacio"); 
      	 document.captura.ife.focus(); 
      	 return 0; 
	}
	
	if (document.captura.curp.value.length==0)
	{ 
      	 alert(" Curp no puede ser vacio"); 
      	 document.captura.curp.focus(); 
      	 return 0; 
	}
	
	
	if (document.captura.lugar_nac.value.length==0)
	{ 
      	 alert(" Lugar de nacimiento no puede ser vacio"); 
      	 document.captura.lugar_nac.focus(); 
      	 return 0; 
	}
	
	
	if (document.captura.estado.value.length==0)
	{ 
      	 alert("Nombre del estado no puede ser vacio"); 
      	 document.captura.estado.focus(); 
      	 return 0; 
	}
	if (document.captura.municipio.value.length==0)
	{ 
      	 alert("Nombre del municipio no puede ser vacio"); 
      	 document.captura.municipio.focus(); 
      	 return 0; 
	}
	if (document.captura.localidad.value.length==0)
	{ 
      	 alert("Nombre de localidad no puede ser vacio"); 
      	 document.captura.localidad.focus(); 
      	 return 0; 
	}
	
	if (document.captura.colonia.value.length==0)
	{ 
      	 alert("Nombre de colonia no puede ser vacio"); 
      	 document.captura.colonia.focus(); 
      	 return 0; 
	}
	
	if (document.captura.domicilio.value.length==0)
	{ 
      	 alert(" Domicilio no puede ser vacio"); 
      	 document.captura.domicilio.focus(); 
      	 return 0; 
	}
	
	if (document.captura.cod_postal.value.length==0)
	{ 
      	 alert("Codigo postal no puede ser vacio"); 
      	 document.captura.cod_postal.focus(); 
      	 return 0; 
	}
	
	if (document.captura.estado_civil.value.length==0)
	{ 
      	 alert("Estado civil no puede ser vacio"); 
      	 document.captura.estado_civil.focus(); 
      	 return 0; 
	}
	
			
			
	if(document.captura.regimen_conyugal.disabled == false)
	{
		regimen_conyugal=document.captura.regimen_conyugal.value;
		
		if (document.captura.regimen_conyugal.value.length==0)
			{ 
			 alert("Regimen conyugal no puede ser vacio"); 
			 document.captura.regimen_conyugal.focus(); 
			 return 0; 
			}
		
		
	}
	
	
	if(document.captura.nombre_conyugue.disabled ==false)
	{
		
	nombre_conyugue=document.captura.nombre_conyugue.value;
		
		if (document.captura.nombre_conyugue.value.length==0)
			{ 
			// alert("Nombre de conyugue no puede ser vacio"); 
			 //document.captura.nombre_conyugue.focus(); 
			 //return 0; 
			 nombre_conyugue="";
			}
		
		
	}
	
	
	if(document.captura.regimen_conyugal.disabled == true)
	{
		regimen_conyugal='';
	}
	
	if(document.captura.nombre_conyugue.disabled == true)
	{
		nombre_conyugue='';
	}
	
	
	if (document.captura.id_tipo.value.length==0)
	{ 
      	 alert("Tipo de cliente no puede ser vacio"); 
      	 document.captura.id_tipo.focus(); 
      	 return 0; 
	}
	
	if (document.captura.f_registro.value.length==0)
	{ 
      	 alert("Fecha de registgro no puede ser vacio"); 
      	 document.captura.f_registro.focus(); 
      	 return 0; 
	}
	
	
	if (document.captura.idestrato.value.length==0)
	{ 
      	 alert("Estrato no puede ser vacio"); 
      	 document.captura.idestrato.focus(); 
      	 return 0; 
	}
   if (document.captura.cliente.value.length==0)
	{ 
      	 alert("Debe seleccionar antes una opcion en el campo cliente"); 
      	 document.captura.cliente.focus(); 
      	 return 0; 
	}
  
  else {

		if (document.captura.cliente.value!=3) {
			if (document.captura.id_cuenta.value.length==0) {
				alert("Debe seleccionar una cuenta contable"); 
      	 	document.captura.id_cuenta.focus(); 
      	 	return 0; 
			}
		
			if (document.captura.id_cuenta_ant.value.length==0) {
				alert("Debe seleccionar una cuenta contable para los Anticipos"); 
      	 	document.captura.id_cuenta_ant.focus(); 
      	 	return 0;
			}
		}
	}

if(form_m==1)
	{
	
		idcliente=document.captura.idcliente.value;
	}



alert("Muchas gracias la informacion ha sido enviada");


	divFormulario = document.getElementById('contenido');
	
	
	
	
	
	
	nombre=document.captura.nombre.value;
	a_paterno=document.captura.a_paterno.value;
	a_materno=document.captura.a_materno.value;
	genero=document.captura.genero.value;
	rfc=document.captura.rfc.value;
	ife=document.captura.ife.value;
	curp=document.captura.curp.value;		
	dia=document.captura.dia.value;
	mes=document.captura.mes.value;
	ano=document.captura.ano.value;
	
	lugar_nac=document.captura.lugar_nac.value;
	estado=document.captura.estado.value;
	municipio=document.captura.municipio.value;
	localidad=document.captura.localidad.value;
	domicilio=document.captura.domicilio.value;
	cod_postal=document.captura.cod_postal.value;
	estado_civil=document.captura.estado_civil.value;
	integrantes=document.captura.integrantes.value;
	tel_fijo=document.captura.tel_fijo.value;
	tel_movil=document.captura.tel_movil.value;
	email=document.captura.email.value;
	id_tipo=document.captura.id_tipo.value;
	f_registro=document.captura.f_registro.value;
	clv_fira=document.captura.clv_fira.value;
	clv_ha=document.captura.clv_ha.value;
	id_cuenta=document.captura.id_cuenta.value;
	idestrato=document.captura.idestrato.value;
	cliente=document.captura.cliente.value;
	//alert(cliente);	
	colonia=document.captura.colonia.value;
	num_productor=document.captura.num_productor.value;
	
	cli_ver=document.captura.cli_verificacion.value;	
	
	id_grupo=document.captura.idgrupo.value;
	id_cuenta_ant=document.captura.id_cuenta_ant.value;

	enviar=document.captura.enviar.value;

	
	ajax=objetoAjax();
	ajax.open("POST", "serv_cliente.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
	
			
			if(ajax.responseText==0)
			{
			alert("Rfc ya esta repetido para un cliente verique...");
			}
			if(ajax.responseText==1)
			{
			alert("Ife ya esta repetido para un cliente verique...");
			}
			if(ajax.responseText==2)
			{
			alert("Curp ya esta repetido para un cliente verique...");
			}
			if(ajax.responseText==3)
			{
			alert("El nombre del productor que intenta guardar ya Existe...");
			}
			if(ajax.responseText!=0  && ajax.responseText!=1 && ajax.responseText!=2 && ajax.responseText!=3 )
			{
				divFormulario.innerHTML = ajax.responseText
			
			}
			
			//divFormulario.style.display="block";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");


if(form_m==1)
{
	
	//Modifica un cliente
	
	ajax.send("nombre="+nombre+"&a_paterno="+a_paterno+"&a_materno="+a_materno+"&genero="+genero+"&rfc="+rfc+"&ife="+ife+"&curp="+curp+"&dia="+dia+"&lugar_nac="+lugar_nac+"&estado="+estado+"&municipio="+municipio+"&localidad="+localidad+"&domicilio="+domicilio+"&cod_postal="+cod_postal+"&estado_civil="+estado_civil+"&regimen_conyugal="+regimen_conyugal+"&nombre_conyugue="+nombre_conyugue+"&integrantes="+integrantes+"&tel_fijo="+tel_fijo+"&tel_movil="+tel_movil+"&email="+email+"&id_tipo="+id_tipo+"&f_registro="+f_registro+"&clv_fira="+clv_fira+"&clv_ha="+clv_ha+"&id_cuenta="+id_cuenta+"&id_cuenta_ant="+id_cuenta_ant+"&idestrato="+idestrato+"&idcliente="+idcliente+"&colonia="+colonia+"&enviar="+enviar+"&mes="+mes+"&ano="+ano+"&cli_ver="+cli_ver+"&id_grupo="+id_grupo+"&num_productor="+num_productor+"&cliente="+cliente);

}
if(form_m==2)
{
	//insertar un nuevo cliente
	
	
ajax.send("nombre="+nombre+"&a_paterno="+a_paterno+"&a_materno="+a_materno+"&genero="+genero+"&rfc="+rfc+"&ife="+ife+"&curp="+curp+"&dia="+dia+"&lugar_nac="+lugar_nac+"&estado="+estado+"&municipio="+municipio+"&localidad="+localidad+"&domicilio="+domicilio+"&cod_postal="+cod_postal+"&estado_civil="+estado_civil+"&regimen_conyugal="+regimen_conyugal+"&nombre_conyugue="+nombre_conyugue+"&integrantes="+integrantes+"&tel_fijo="+tel_fijo+"&tel_movil="+tel_movil+"&email="+email+"&id_tipo="+id_tipo+"&f_registro="+f_registro+"&clv_fira="+clv_fira+"&clv_ha="+clv_ha+"&id_cuenta="+id_cuenta+"&id_cuenta_ant="+id_cuenta_ant+"&idestrato="+idestrato+"&colonia="+colonia+"&enviar="+enviar+"&mes="+mes+"&ano="+ano+"&cli_ver="+cli_ver+"&id_grupo="+id_grupo+"&num_productor="+num_productor+"&cliente="+cliente);
}



}


function actualiza_cliente(form){


	if(form==1)
	{
	
		if (document.captura.cliente_id.value.length==0)
			{ 
				 alert("Cliente no puede ser vacio"); 
				 document.captura.cliente_id.focus(); 
				 return 0; 
			}
	
	
	cliente_id=document.captura.cliente_id.value;
	
	}

	//alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('contenido');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_formu_s.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

if(form==1)
ajax.send("cliente_id="+cliente_id+"&form="+form)
if(form==2)
ajax.send("form="+form)

}

function atras_cliente(cliente_id){

form=1;
	//alert("Muchas gracias la informacion ha sido enviada");
	

	divFormulario = document.getElementById('contenido');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_formu_s.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	


ajax.send("cliente_id="+cliente_id+"&form="+form)


}



function actualiza_parcela(idcliente){


		//alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('contenido');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_parcela.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			

						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("idcliente="+idcliente)

}

function actualiza_parcela_selec(form){


		//alert("Muchas gracias la informacion ha sido enviada");
	
	id_parcela=document.captura.id_parcelas.value;
	
	divFormulario = document.getElementById('contenido');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_parcela_selec.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			

						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("id_parcela="+id_parcela+"&form="+form)

}

function nuevo_parcela(idcliente,nuevo){


		//alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('contenido');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_parcela.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			

						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("idcliente="+idcliente+"&nuevo="+nuevo)

}







function parcelas_alta_egos(form_m){
	
	if (document.captura.f_registro.value.length==0)
	{ 
      	 alert("Fecha no puede ser vacio"); 
      	 document.captura.f_registro.focus(); 
      	 return 0; 
	}
	if (document.captura.desc_predio.value.length==0)
	{ 
      	 alert("Descripcion de predio no puede ser vacio"); 
      	 document.captura.desc_predio.focus(); 
      	 return 0; 
	}
	
	if (document.captura.estado.value.length==0)
	{ 
      	 alert("Nombre del estado no puede ser vacio"); 
      	 document.captura.estado.focus(); 
      	 return 0; 
	}
	if (document.captura.municipio.value.length==0)
	{ 
      	 alert("Nombre del municipio no puede ser vacio"); 
      	 document.captura.municipio.focus(); 
      	 return 0; 
	}
	if (document.captura.localidad.value.length==0)
	{ 
      	 alert("Nombre de localidad no puede ser vacio"); 
      	 document.captura.localidad.focus(); 
      	 return 0; 
	}
	
	if (document.captura.colonia.value.length==0)
	{ 
      	 alert("Nombre de colonia no puede ser vacio"); 
      	 document.captura.colonia.focus(); 
      	 return 0; 
	}
	
	if (document.captura.id_cafe.value.length==0)
	{ 
      	 alert("Cafe no puede ser vacio"); 
      	 document.captura.id_cafe.focus(); 
      	 return 0; 
	}
	
	if (document.captura.st_hec.value.length==0)
	{ 
      	 alert("Numero de hectarias no puede ser vacio"); 
      	 document.captura.st_hec.focus(); 
      	 return 0; 
	}
	if (document.captura.st_area.value.length==0)
	{ 
      	 alert("Numero de areas no puede ser vacio"); 
      	 document.captura.st_area.focus(); 
      	 return 0; 
	}
	if (document.captura.st_centi.value.length==0)
	{ 
      	 alert("Numero de centi areas no puede ser vacio"); 
      	 document.captura.st_centi.focus(); 
      	 return 0; 
	}
	if (document.captura.st_deci.value.length==0)
	{ 
      	 alert("Numero de centecimos de centi areas no puede ser vacio"); 
      	 document.captura.st_deci.focus(); 
      	 return 0; 
	}
	if (document.captura.sc_hec.value.length==0)
	{ 
      	 alert("Numero de hectarias no puede ser vacio"); 
      	 document.captura.sc_hec.focus(); 
      	 return 0; 
	}
	if (document.captura.sc_area.value.length==0)
	{ 
      	 alert("Numero de areas no puede ser vacio"); 
      	 document.captura.sc_area.focus(); 
      	 return 0; 
	}
	if (document.captura.sc_centi.value.length==0)
	{ 
      	 alert("Numero de centi areas no puede ser vacio"); 
      	 document.captura.sc_centi.focus(); 
      	 return 0; 
	}
	if (document.captura.sc_deci.value.length==0)
	{ 
      	 alert("Numero de centecimos de centi areas no puede ser vacio"); 
      	 document.captura.sc_deci.focus(); 
      	 return 0; 
	}
	
	
	
	/*
	
	if (document.captura.super_esp.value.length==0)
	{ 
      	 alert("Superficie esperada no puede ser vacio"); 
      	 document.captura.super_esp.focus(); 
      	 return 0; 
	}
	
	
	if (document.captura.num_predio.value.length==0)
	{ 
      	 alert("Numero de predio no puede ser vacio"); 
      	 document.captura.num_predio.focus(); 
      	 return 0; 
	}
	
	if (document.captura.color.value.length==0)
	{ 
      	 alert("Color no puede ser vacio"); 
      	 document.captura.color.focus(); 
      	 return 0; 
	}
	
	if (document.captura.textura.value.length==0)
	{ 
      	 alert("Textura no puede ser vacio"); 
      	 document.captura.textura.focus(); 
      	 return 0; 
	}
	
	
	if (document.captura.estruct.value.length==0)
	{ 
      	 alert("Estructura no puede ser vacio"); 
      	 document.captura.estruct.focus(); 
      	 return 0; 
	}
	
	if (document.captura.poro.value.length==0)
	{ 
      	 alert("Porosidad no puede ser vacio"); 
      	 document.captura.poro.focus(); 
      	 return 0; 
	}
	
	
	if (document.captura.perme.value.length==0)
	{ 
      	 alert("Permeabilidad no puede ser vacio"); 
      	 document.captura.perme.focus(); 
      	 return 0; 
	}
	
	if (document.captura.prof_efe.value.length==0)
	{ 
      	 alert("Profundidad efectiva no puede ser vacio"); 
      	 document.captura.prof_efe.focus(); 
      	 return 0; 
	}
	
	if (document.captura.temp.value.length==0)
	{ 
      	 alert("Temperatura no puede ser vacio"); 
      	 document.captura.temp.focus(); 
      	 return 0; 
	}
	
	if (document.captura.lluvia.value.length==0)
	{ 
      	 alert("Lluvia no puede ser vacio"); 
      	 document.captura.lluvia.focus(); 
      	 return 0; 
	}
	
	if (document.captura.hume_aire.value.length==0)
	{ 
      	 alert("Humedad de aire no puede ser vacio"); 
      	 document.captura.hume_aire.focus(); 
      	 return 0; 
	}
	
	if (document.captura.vientos.value.length==0)
	{ 
      	 alert("Vientos no puede ser vacio"); 
      	 document.captura.vientos.focus(); 
      	 return 0; 
	}
	
	if (document.captura.brillo_solar.value.length==0)
	{ 
      	 alert("Brillo solar no puede ser vacio"); 
      	 document.captura.brillo_solar.focus(); 
      	 return 0; 
	}
	if (document.captura.nubosidad.value.length==0)
	{ 
      	 alert("Nubosidad no puede ser vacio"); 
      	 document.captura.nubosidad.focus(); 
      	 return 0; 
	}
	*/

/*para validar check box	
for(var i = 0; i < captura.c.length; i++)
{ 
if(captura.c[i].checked)
return true; 
} 
alert('Debes seleccionar al menos una opcion'); 
return 0; 
*/
if(form_m==1)
	{
	
	id_parcela=document.captura.id_parcela.value;
	
	}



alert("Muchas gracias la informacion ha sido enviada");




	divFormulario = document.getElementById('contenido');
	
	
	
	
	
	
	idcliente=document.captura.idcliente.value;
	f_registro=document.captura.f_registro.value;
	desc_predio=document.captura.desc_predio.value;
	estado=document.captura.estado.value;
	municipio=document.captura.municipio.value;
	localidad=document.captura.localidad.value;
	colonia=document.captura.colonia.value;
	id_cafe=document.captura.id_cafe.value;
	
	st_hec=document.captura.st_hec.value;
	st_area=document.captura.st_area.value;
	st_centi=document.captura.st_centi.value;
	st_deci=document.captura.st_deci.value;
	
	sc_hec=document.captura.sc_hec.value;
	sc_area=document.captura.sc_area.value;
	sc_centi=document.captura.sc_centi.value;
	sc_deci=document.captura.sc_deci.value;
	
	
	
	super_esp=document.captura.super_esp.value;
	num_predio=document.captura.num_predio.value;
	color=document.captura.color.value;
	textura=document.captura.textura.value;
	estruct=document.captura.estruct.value;
	poro=document.captura.poro.value;
	perme=document.captura.perme.value;
	prof_efe=document.captura.prof_efe.value;
	temp=document.captura.temp.value;
	lluvia=document.captura.lluvia.value;
	hume_aire=document.captura.hume_aire.value;
	vientos=document.captura.vientos.value;
	brillo_solar=document.captura.brillo_solar.value;
	nubosidad=document.captura.nubosidad.value;
	
	
	enviar=document.captura.enviar.value;
	
	
	
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_parcelas.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			//divFormulario.style.display="block";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");


if(form_m==1) //modificar   //escirbir st
{
	
	//alert("aca estamos");
	
ajax.send("f_registro="+f_registro+"&desc_predio="+desc_predio+"&estado="+estado+"&municipio="+municipio+"&localidad="+localidad+"&colonia="+colonia+"&id_cafe="+id_cafe+"&super_esp="+super_esp+"&num_predio="+num_predio+"&color="+color+"&textura="+textura+"&estruct="+estruct+"&poro="+poro+"&perme="+perme+"&prof_efe="+prof_efe+"&temp="+temp+"&lluvia="+lluvia+"&hume_aire="+hume_aire+"&vientos="+vientos+"&brillo_solar="+brillo_solar+"&nubosidad="+nubosidad+"&idcliente="+idcliente+"&id_parcela="+id_parcela+"&enviar="+enviar+"&st_hec="+st_hec+"&st_area="+st_area+"&st_centi="+st_centi+"&st_deci="+st_deci+"&sc_hec="+sc_hec+"&sc_area="+sc_area+"&sc_centi="+sc_centi+"&sc_deci="+sc_deci);

}
if(form_m==2)
{
	//alert("aca estamos2");
	
ajax.send("f_registro="+f_registro+"&desc_predio="+desc_predio+"&estado="+estado+"&municipio="+municipio+"&localidad="+localidad+"&colonia="+colonia+"&id_cafe="+id_cafe+"&super_esp="+super_esp+"&num_predio="+num_predio+"&color="+color+"&textura="+textura+"&estruct="+estruct+"&poro="+poro+"&perme="+perme+"&prof_efe="+prof_efe+"&temp="+temp+"&lluvia="+lluvia+"&hume_aire="+hume_aire+"&vientos="+vientos+"&brillo_solar="+brillo_solar+"&nubosidad="+nubosidad+"&idcliente="+idcliente+"&enviar="+enviar+"&st_hec="+st_hec+"&st_area="+st_area+"&st_centi="+st_centi+"&st_deci="+st_deci+"&sc_hec="+sc_hec+"&sc_area="+sc_area+"&sc_centi="+sc_centi+"&sc_deci="+sc_deci);
}



}






function carga_select(tabla){

	
	if(tabla=='cc_estados')
	{
    divFormulario = document.getElementById('municipios');
	campo=document.captura.estado.value;
	
	}
	
	if(tabla=='cc_municipios')
	{
    divFormulario = document.getElementById('localidades');
	campo=document.captura.municipio.value;
	
	
	}
	
	if(tabla=='cc_localidades')
	{
    divFormulario = document.getElementById('colonias');
	campo=document.captura.localidad.value;
	
	
	}
	
	if(tabla=='cc_ptrequerimientos')
	{
    divFormulario = document.getElementById('contenido');
	//limpiar = document.getElementById('form_reque');
	campo=document.captura.idproceso.value;
	
	//limpiar.innerHTML = "";
	}
	
	
	/*lo = document.getElementById('lo');
	co = document.getElementById('co');*/

	ajax=objetoAjax();
	ajax.open("POST", "action.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText;
			
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	
ajax.send("tabla="+tabla+"&campo="+campo)


}

function carga_select_localidad(tabla){

	
	if(tabla=='cc_estados')
	{
    divFormulario = document.getElementById('municipios');
	campo=document.captura.estado.value;
	
	}
	
	if(tabla=='cc_municipios')
	{
    divFormulario = document.getElementById('localidades');
	campo=document.captura.municipio.value;
	
	
	}
	
	if(tabla=='cc_localidades')
	{
    divFormulario = document.getElementById('colonias');
	campo=document.captura.localidad.value;
	
	
	}
	
	
	/*lo = document.getElementById('lo');
	co = document.getElementById('co');*/

	ajax=objetoAjax();
	ajax.open("POST", "action_localidad.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText;
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	
ajax.send("tabla="+tabla+"&campo="+campo)


}


function carga_select_modal(tabla){

	
	if(tabla=='cc_estados')
	{
    divFormulario = document.getElementById('municipios');
	campo=document.captura_lo.estado.value;
	
	}
	
	if(tabla=='cc_municipios')
	{
    divFormulario = document.getElementById('localidades');
	campo=document.captura_lo.municipio.value;
	
	
	}
	
	if(tabla=='cc_localidades')
	{
    divFormulario = document.getElementById('colonias');
	campo=document.captura_lo.localidad.value;
	
	
	}
	
	
	

	ajax=objetoAjax();
	ajax.open("POST", "action_modal.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	
ajax.send("tabla="+tabla+"&campo="+campo)


}






function verifica_estado(){

	
	
	
	
   
	estado_civil=document.captura.estado_civil.value;
	
	
    if(estado_civil==1)
	{
		document.captura.regimen_conyugal.disabled =true;
		document.captura.nombre_conyugue.disabled =true;
		
	}
	    if(estado_civil==2)
	{
		document.captura.regimen_conyugal.disabled =false;
		document.captura.nombre_conyugue.disabled =false;
		
	}
	    if(estado_civil==3)
	{
		document.captura.regimen_conyugal.disabled =true;
		document.captura.nombre_conyugue.disabled =true;
		
	}

    if(estado_civil==4)
	{
		document.captura.regimen_conyugal.disabled =true;
		document.captura.nombre_conyugue.disabled =true;
		
	}
	    if(estado_civil==5)
	{
		document.captura.regimen_conyugal.disabled =true;
		document.captura.nombre_conyugue.disabled =false;
		
	}




}


function actualiza_gtia_hipo(idcliente){


		//alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('contenido');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_garantias.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("idcliente="+idcliente)

}

function actualiza_gtia_prenda(idcliente){


		//alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('contenido');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_garantias_prenda.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("idcliente="+idcliente)

}



function actualiza_garantiah_selec(form){


		//alert("Muchas gracias la informacion ha sido enviada");
	
	idgtia=document.captura.idgtias.value;
	
	divFormulario = document.getElementById('contenido');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_garantiah_select.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("idgtia="+idgtia+"&form="+form)

}
function actualiza_garantiap_selec(form){


		//alert("Muchas gracias la informacion ha sido enviada");
	
	idgtia=document.captura.idgtias.value;
	
	divFormulario = document.getElementById('contenido');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_garantiap_select.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("idgtia="+idgtia+"&form="+form)

}

function garantiash_alta_egos(form_m){
	
	if (document.captura.descripcion.value.length==0)
	{ 
      	 alert("Descripcion no puede ser vacio"); 
      	 document.captura.descripcion.focus(); 
      	 return 0; 
	}
	if (document.captura.valor.value.length==0)
	{ 
      	 alert("Valor comercial no puede ser vacio"); 
      	 document.captura.valor.focus(); 
      	 return 0; 
	}
	
	if (document.captura.fvaluacion.value.length==0)
	{ 
      	 alert("Fecha de valuacion no puede ser vacio"); 
      	 document.captura.fvaluacion.focus(); 
      	 return 0; 
	}
	if (document.captura.registro.value.length==0)
	{ 
      	 alert("Num de registro no puede ser vacio"); 
      	 document.captura.registro.focus(); 
      	 return 0; 
	}
	if (document.captura.libro.value.length==0)
	{ 
      	 alert("Libro no puede ser vacio"); 
      	 document.captura.libro.focus(); 
      	 return 0; 
	}
	
	if (document.captura.tomo.value.length==0)
	{ 
      	 alert("Tomo no puede ser vacio"); 
      	 document.captura.tomo.focus(); 
      	 return 0; 
	}
	
	if (document.captura.seccion.value.length==0)
	{ 
      	 alert("Seccion no puede ser vacio"); 
      	 document.captura.seccion.focus(); 
      	 return 0; 
	}
	
	if (document.captura.volumen.value.length==0)
	{ 
      	 alert("Volumen no puede ser vacio"); 
      	 document.captura.volumen.focus(); 
      	 return 0; 
	}
	
	if (document.captura.superficie.value.length==0)
	{ 
      	 alert("Superficie  no puede ser vacio"); 
      	 document.captura.superficie.focus(); 
      	 return 0; 
	}
	
	
	if (document.captura.dia.value.length==0)
	{ 
      	 alert("dia no puede ser vacio"); 
      	 document.captura.dia.focus(); 
      	 return 0; 
	}
	if (document.captura.mes.value.length==0)
	{ 
      	 alert("mes no puede ser vacio"); 
      	 document.captura.mes.focus(); 
      	 return 0; 
	}
	if (document.captura.ano.value.length==0)
	{ 
      	 alert("year no puede ser vacio"); 
      	 document.captura.ano.focus(); 
      	 return 0; 
	}
	
	
	if (document.captura.antecedentes.value.length==0)
	{ 
      	 alert("Antecedentes no puede ser vacio"); 
      	 document.captura.antecedentes.focus(); 
      	 return 0; 
	}
	
	

/*para validar check box	
for(var i = 0; i < captura.c.length; i++)
{ 
if(captura.c[i].checked)
return true; 
} 
alert('Debes seleccionar al menos una opcion'); 
return 0; 
*/
if(form_m==1)
	{
	
	idgtia=document.captura.idgtia.value;
	
	}



alert("Muchas gracias la informacion ha sido enviada");




	divFormulario = document.getElementById('contenido');
	
	
	
	
	
	
	idcliente=document.captura.idcliente.value;
	descripcion=document.captura.descripcion.value;
	valor=document.captura.valor.value;
	fvaluacion=document.captura.fvaluacion.value;
	registro=document.captura.registro.value;
	libro=document.captura.libro.value;
	tomo=document.captura.tomo.value;
	seccion=document.captura.seccion.value;
	volumen=document.captura.volumen.value;
	superficie=document.captura.superficie.value;
	dia=document.captura.dia.value;
	mes=document.captura.mes.value;
	ano=document.captura.ano.value;
	antecedentes=document.captura.antecedentes.value;
	
	
	
	enviar=document.captura.enviar.value;
	
	
	
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_garantias_h.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			//divFormulario.style.display="block";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");


if(form_m==1) //modificar
{
	
	//alert("aca estamos");
ajax.send("descripcion="+descripcion+"&valor="+valor+"&fvaluacion="+fvaluacion+"&registro="+registro+"&libro="+libro+"&tomo="+tomo+"&seccion="+seccion+"&volumen="+volumen+"&superficie="+superficie+"&dia="+dia+"&mes="+mes+"&ano="+ano+"&antecedentes="+antecedentes+"&enviar="+enviar+"&idcliente="+idcliente+"&idgtia="+idgtia);

}
if(form_m==2)
{
	//alert("aca estamos2");
	
ajax.send("descripcion="+descripcion+"&valor="+valor+"&fvaluacion="+fvaluacion+"&registro="+registro+"&libro="+libro+"&tomo="+tomo+"&seccion="+seccion+"&volumen="+volumen+"&superficie="+superficie+"&dia="+dia+"&mes="+mes+"&ano="+ano+"&antecedentes="+antecedentes+"&enviar="+enviar+"&idcliente="+idcliente);
}



}







function garantiasp_alta_egos(form_m){
	
	if (document.captura.descripcion.value.length==0)
	{ 
      	 alert("Descripcion no puede ser vacio"); 
      	 document.captura.descripcion.focus(); 
      	 return 0; 
	}
	if (document.captura.valor.value.length==0)
	{ 
      	 alert("Valor comercial no puede ser vacio"); 
      	 document.captura.valor.focus(); 
      	 return 0; 
	}
	
	if (document.captura.fregistro.value.length==0)
	{ 
      	 alert("Fecha de valuacion no puede ser vacio"); 
      	 document.captura.fregistro.focus(); 
      	 return 0; 
	}
	if (document.captura.valuador.value.length==0)
	{ 
      	 alert("Valuador no puede ser vacio"); 
      	 document.captura.valuador.focus(); 
      	 return 0; 
	}
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
	
	if (document.captura.estado_actual.value.length==0)
	{ 
      	 alert("Estado actual no puede ser vacio"); 
      	 document.captura.estado_actual.focus(); 
      	 return 0; 
	}
	
	if (document.captura.no_serie.value.length==0)
	{ 
      	 alert("Num de serie no puede ser vacio"); 
      	 document.captura.no_serie.focus(); 
      	 return 0; 
	}
	
	
	
	
	if (document.captura.dia.value.length==0)
	{ 
      	 alert("dia no puede ser vacio"); 
      	 document.captura.dia.focus(); 
      	 return 0; 
	}
	if (document.captura.mes.value.length==0)
	{ 
      	 alert("mes no puede ser vacio"); 
      	 document.captura.mes.focus(); 
      	 return 0; 
	}
	if (document.captura.ano.value.length==0)
	{ 
      	 alert("year no puede ser vacio"); 
      	 document.captura.ano.focus(); 
      	 return 0; 
	}
	
	
	if (document.captura.no_factura.value.length==0)
	{ 
      	 alert("Numero de factura no puede ser vacio"); 
      	 document.captura.no_factura.focus(); 
      	 return 0; 
	}
	
	

/*para validar check box	
for(var i = 0; i < captura.c.length; i++)
{ 
if(captura.c[i].checked)
return true; 
} 
alert('Debes seleccionar al menos una opcion'); 
return 0; 
*/
if(form_m==1)
	{
	
	idgtia=document.captura.idgtia.value;
	
	}



alert("Muchas gracias la informacion ha sido enviada");




	divFormulario = document.getElementById('contenido');
	
	
	
	
	
	
	idcliente=document.captura.idcliente.value;
	descripcion=document.captura.descripcion.value;
	valor=document.captura.valor.value;
	fregistro=document.captura.fregistro.value;
	marca=document.captura.marca.value;
	modelo=document.captura.modelo.value;
	estado_actual=document.captura.estado_actual.value;
	valuador=document.captura.valuador.value;
	no_serie=document.captura.no_serie.value;
	no_factura=document.captura.no_factura.value;
	dia=document.captura.dia.value;
	mes=document.captura.mes.value;
	ano=document.captura.ano.value;
	
	
	
	
	enviar=document.captura.enviar.value;
	
	
	
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_garantias_p.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			//divFormulario.style.display="block";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");


if(form_m==1) //modificar
{
	
	//alert("aca estamos");
ajax.send("descripcion="+descripcion+"&valor="+valor+"&fregistro="+fregistro+"&marca="+marca+"&modelo="+modelo+"&estado_actual="+estado_actual+"&valuador="+valuador+"&no_serie="+no_serie+"&no_factura="+no_factura+"&dia="+dia+"&mes="+mes+"&ano="+ano+"&enviar="+enviar+"&idcliente="+idcliente+"&idgtia="+idgtia);

}
if(form_m==2)
{
	//alert("aca estamos2");
	
ajax.send("descripcion="+descripcion+"&valor="+valor+"&fregistro="+fregistro+"&marca="+marca+"&modelo="+modelo+"&estado_actual="+estado_actual+"&valuador="+valuador+"&no_serie="+no_serie+"&no_factura="+no_factura+"&dia="+dia+"&mes="+mes+"&ano="+ano+"&enviar="+enviar+"&idcliente="+idcliente);
}



}


function nuevo_gtiasp(idcliente,nuevo){


		//alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('contenido');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_garantias_prenda.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("idcliente="+idcliente+"&nuevo="+nuevo)

}


function nuevo_gtiash(idcliente,nuevo){


		//alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('contenido');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_garantias.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("idcliente="+idcliente+"&nuevo="+nuevo)

}

function add_localidad(){


	if (document.captura.estado.value.length==0)
	{ 
      	 alert("Estado no puede ser vacio"); 
      	 document.captura.estado.focus(); 
      	 return 0; 
	}
	if (document.captura.municipio.value.length==0)
	{ 
      	 alert("Municipio no puede ser vacio"); 
      	 document.captura.municipio.focus(); 
      	 return 0; 
	}
	if (document.captura.localidad.value.length==0)
	{ 
      	 alert("Localidad no puede ser vacio"); 
      	 document.captura.localidad.focus(); 
      	 return 0; 
	}


		alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('contenido');
	
	estado=document.captura.estado.value;
	municipio=document.captura.municipio.value;
	localidad=document.captura.localidad.value;
	enviar=document.captura.enviar.value;
	
	
	

	ajax=objetoAjax();
	ajax.open("POST", "serv_estados.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			document.captura.localidad.value="";
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("estado="+estado+"&municipio="+municipio+"&localidad="+localidad+"&enviar="+enviar)

}

function add_colonia(){


	if (document.captura.estado.value.length==0)
	{ 
      	 alert("Estado no puede ser vacio"); 
      	 document.captura.estado.focus(); 
      	 return 0; 
	}
	if (document.captura.municipio.value.length==0)
	{ 
      	 alert("Municipio no puede ser vacio"); 
      	 document.captura.municipio.focus(); 
      	 return 0; 
	}
	if (document.captura.localidad.value.length==0)
	{ 
      	 alert("Localidad no puede ser vacio"); 
      	 document.captura.localidad.focus(); 
      	 return 0; 
	}
	if (document.captura.colonia.value.length==0)
	{ 
      	 alert("Colonia no puede ser vacio"); 
      	 document.captura.colonia.focus(); 
      	 return 0; 
	}


		alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('contenido');
	
	estado=document.captura.estado.value;
	municipio=document.captura.municipio.value;
	idlocalidad=document.captura.localidad.value;
	colonia=document.captura.colonia.value;
	enviar=document.captura.enviar.value;
	
	
	

	ajax=objetoAjax();
	ajax.open("POST", "serv_estados.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			document.captura.colonia.value="";
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("estado="+estado+"&municipio="+municipio+"&idlocalidad="+idlocalidad+"&colonia="+colonia+"&enviar="+enviar)

}



function add_unidad(){


	if (document.captura.unidad.value.length==0)
	{ 
      	 alert("Unidad de medida no puede ser vacio"); 
      	 document.captura.unidad.focus(); 
      	 return 0; 
	}
	


		alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('contenido');
	
	unidad=document.captura.unidad.value;
	
	enviar=document.captura.enviar.value;
	
	
	

	ajax=objetoAjax();
	ajax.open("POST", "serv_unidades.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			document.captura.unidad.value="";
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("unidad="+unidad+"&enviar="+enviar)

}
function add_proceso(){


	if (document.captura.proceso.value.length==0)
	{ 
      	 alert("Proceso no puede ser vacio"); 
      	 document.captura.proceso.focus(); 
      	 return 0; 
	}
	


		alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('contenido');
	
	proceso=document.captura.proceso.value;
	
	enviar=document.captura.enviar.value;
	
	
	

	ajax=objetoAjax();
	ajax.open("POST", "serv_procesos.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			document.captura.proceso.value="";
			document.captura.proceso.focus(); 
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("proceso="+proceso+"&enviar="+enviar)

}


function actualiza_requerimiento(form,idrequerimiento){



if(form==3)
	{
	
	id_paquete=document.captura.id_paquete.value;
	
	}

	
	//alert(idrequerimiento)

	//alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('contenido');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_formu_reque.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

if(form==1)
ajax.send("idrequerimiento="+idrequerimiento+"&form="+form)
if(form==2)
ajax.send("form="+form)
if(form==3)
ajax.send("idrequerimiento="+idrequerimiento+"&form="+form+"&id_paquete="+id_paquete)


}
function actualiza_requerimiento_select(idproceso,form){


	if(form==1)
	{
	
		if (document.captura.idrequerimiento.value.length==0)
			{ 
				 alert("requerimiento no puede ser vacio"); 
				 document.captura.idrequerimiento.focus(); 
				 return 0; 
			}
	
	
	idrequerimiento=document.captura.idrequerimiento.value;
	
	}
	
	

	//alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('contenido');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_formu_reque.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

if(form==1)
ajax.send("idrequerimiento="+idrequerimiento+"&form="+form)
if(form==2)
ajax.send("idproceso="+idproceso+"&form="+form)

}







function add_reque(form_m){
	
	
	
	
	
	if (document.reque.requerimiento.value.length==0)
	{ 
      	 alert("Nombre de requerimiento no puede ser vacio"); 
      	 document.reque.requerimiento.focus(); 
      	 return 0; 
	}
	if (document.reque.iduni.value.length==0)
	{ 
      	 alert("Unidad de servicio no puede ser vacio"); 
      	 document.reque.iduni.focus(); 
      	 return 0; 
	}
	
	if (document.reque.cantidad.value.length==0)
	{ 
      	// alert("Cantidad no puede ser vacio"); 
      	 document.reque.cantidad.value=0; 
      	 //return 0; 
	}
	if (document.reque.ciclos.value.length==0)
	{ 
      	 //alert("Ciclos no puede ser vacio"); 
      	 document.reque.ciclos.value=0; 
      	 //return 0; 
	}
	if (document.reque.total_ciclos.value.length==0)
	{ 
      	 //alert("Total de ciclos no puede ser vacio"); 
      	 document.reque.total_ciclos.value=0; 
      	 //return 0; 
	}
	if (document.reque.un.value.length==0)
	{ 
      //	 alert("UN no puede ser vacio"); 
      	 document.reque.un.value=0;
      	// return 0; 
	}
	if (document.reque.total.value.length==0)
	{ 
      	// alert("Total no puede ser vacio"); 
      	 document.reque.total.value=0;
      	 //return 0; 
	}
	if (document.reque.porciento_produ.value.length==0)
	{ 
      	// alert("Porcentaje de productor no puede ser vacio"); 
      	 document.reque.porciento_produ.value=0;
      	// return 0; 
	}
	if (document.reque.cuota_credi.value.length==0)
	{ 
      	// alert("Cuota de credito no puede ser vacio"); 
      	 document.reque.cuota_credi.value=0;
      	// return 0; 
	}
	if (document.reque.aporta_produ.value.length==0)
	{ 
      	// alert("Aportacion de productor no puede ser vacio"); 
      	 document.reque.aporta_produ.value=0;
      	// return 0; 
	}
	

if(form_m==1)
	{
	
	idrequerimiento=document.reque.idrequerimiento.value;
	
	}


idproceso=document.reque.idproceso.value;
	requerimiento=document.reque.requerimiento.value;
	iduni=document.reque.iduni.value;
	cantidad=document.reque.cantidad.value;
	ciclos=document.reque.ciclos.value;
	total_ciclos=document.reque.total_ciclos.value;
	un=document.reque.un.value;
	total=document.reque.total.value;
	porciento_produ=document.reque.porciento_produ.value;
	cuota_credi=document.reque.cuota_credi.value;
	aporta_produ=document.reque.aporta_produ.value;
alert("Muchas gracias la informacion ha sido enviada");




	divFormulario = document.getElementById('contenido');
	
	
	
	
	enviar=document.reque.enviar.value;
	
	
	
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_requerimiento.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			//divFormulario.style.display="block";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");


if(form_m==1) //modificar
{
	
	//alert("aca estamos");
ajax.send("idproceso="+idproceso+"&requerimiento="+requerimiento+"&iduni="+iduni+"&cantidad="+cantidad+"&ciclos="+ciclos+"&total_ciclos="+total_ciclos+"&un="+un+"&total="+total+"&porciento_produ="+porciento_produ+"&cuota_credi="+cuota_credi+"&aporta_produ="+aporta_produ+"&enviar="+enviar+"&idrequerimiento="+idrequerimiento);

}
if(form_m==2)
{
	//alert("aca estamos2");
	
ajax.send("idproceso="+idproceso+"&requerimiento="+requerimiento+"&iduni="+iduni+"&cantidad="+cantidad+"&ciclos="+ciclos+"&total_ciclos="+total_ciclos+"&un="+un+"&total="+total+"&porciento_produ="+porciento_produ+"&cuota_credi="+cuota_credi+"&aporta_produ="+aporta_produ+"&enviar="+enviar);
}



}


function llenar_campo(){


cantidad=document.reque.cantidad.value;
ciclos=document.reque.ciclos.value;
un=document.reque.un.value;
porciento_produ=document.reque.porciento_produ.value;

	total_ciclos=cantidad*ciclos;
	
	
	
	document.reque.total_ciclos.value=total_ciclos;
	un=total_ciclos*un;
	document.reque.total.value=un;
	
	
	total=	document.reque.total.value;
	
	porciento_produ=(porciento_produ*total)/100;
	
	
	cuota_credi=total-porciento_produ;
	
	
	document.reque.cuota_credi.value=cuota_credi;
	document.reque.aporta_produ.value=porciento_produ;
	
	
	
	

}





function actualiza_productos_selec(form){


		//alert("Muchas gracias la informacion ha sido enviada");
	
	idproducto=document.captura.idproductos.value;
	
	divFormulario = document.getElementById('contenido');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_productos.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("idproducto="+idproducto+"&form="+form)

}




function productos_alta_egos(form_m){
	
	if (document.captura.producto.value.length==0)
	{ 
      	 alert("Descripcion no puede ser vacio"); 
      	 document.captura.producto.focus(); 
      	 return 0; 
	}
	if (document.captura.id_tipo.value.length==0)
	{ 
      	 alert("Tipo de credito no puede ser vacio"); 
      	 document.captura.id_tipo.focus(); 
      	 return 0; 
	}
	
	if (document.captura.idper.value.length==0)
	{ 
      	 alert("Periodo no puede ser vacio"); 
      	 document.captura.idper.focus(); 
      	 return 0; 
	}
	if (document.captura.plazo.value.length==0)
	{ 
      	 alert("Plazo no puede ser vacio"); 
      	 document.captura.plazo.focus(); 
      	 return 0; 
	}
	if (document.captura.id_pago.value.length==0)
	{ 
      	 alert("Modalidad no puede ser vacio"); 
      	 document.captura.id_pago.focus(); 
      	 return 0; 
	}
	
	if (document.captura.interes_normal.value.length==0)
	{ 
      	 alert("Interes normal no puede ser vacio"); 
      	 document.captura.interes_normal.focus(); 
      	 return 0; 
	}
	
	if (document.captura.interes_moratorio.value.length==0)
	{ 
      	 alert("Interes moratorio no puede ser vacio"); 
      	 document.captura.interes_moratorio.focus(); 
      	 return 0; 
	}
	
	
	

/*para validar check box	
for(var i = 0; i < captura.c.length; i++)
{ 
if(captura.c[i].checked)
return true; 
} 
alert('Debes seleccionar al menos una opcion'); 
return 0; 
*/
if(form_m==1)
	{
	
	idproducto=document.captura.idproducto.value;
	
	}



alert("Muchas gracias la informacion ha sido enviada");




	divFormulario = document.getElementById('contenido');
	
	
	
	
	
	
	producto=document.captura.producto.value;
	id_tipo=document.captura.id_tipo.value;
	idper=document.captura.idper.value;
	plazo=document.captura.plazo.value;
	id_pago=document.captura.id_pago.value;
	interes_normal=document.captura.interes_normal.value;
	interes_moratorio=document.captura.interes_moratorio.value;
	enviar=document.captura.enviar.value;
	
	
	
	
	
	var valorSeleccionado="";
for(i=0; i <document.captura.interes_mensual.length; i++){
if(document.captura.interes_mensual[i].checked){
valorSeleccionado = document.captura.interes_mensual[i].value;
}
}
if(valorSeleccionado ==""){
alert("Seleccione una opción");
return 0;
}
	
	
	interes_mensual=valorSeleccionado;
	
	
	
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_productos.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			//divFormulario.style.display="block";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");


if(form_m==1) //modificar
{
	
	//alert("aca estamos");
ajax.send("producto="+producto+"&id_tipo="+id_tipo+"&idper="+idper+"&plazo="+plazo+"&id_pago="+id_pago+"&interes_normal="+interes_normal+"&interes_moratorio="+interes_moratorio+"&idproducto="+idproducto+"&enviar="+enviar+"&interes_mensual="+interes_mensual);

}
if(form_m==2)
{
	//alert("aca estamos2");
	
ajax.send("producto="+producto+"&id_tipo="+id_tipo+"&idper="+idper+"&plazo="+plazo+"&id_pago="+id_pago+"&interes_normal="+interes_normal+"&interes_moratorio="+interes_moratorio+"&enviar="+enviar+"&interes_mensual="+interes_mensual);
}



}


function nuevo_producto(form){


		//alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('contenido');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_productos.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("form="+form)

}




function actualiza_articulos_selec(form){

	
	idarticulos=document.captura.idarticulos.value;
	
		
	divFormulario = document.getElementById('precios_update');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_articulos_selec.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	
	ajax.send("idarticulos="+idarticulos+"&form="+form)
	


}





function actualiza_paquete_selec(form){


		//alert("Muchas gracias la informacion ha sido enviada");
	
	
	
	if(form==1)
	{
	id_paquete=document.captura.id_paquetes.value;
	}
	
	
	
	
	
	divFormulario = document.getElementById('contenido');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_paquete_selec.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	
if(form==1)
	{
ajax.send("id_paquete="+id_paquete+"&form="+form)
	}
	if(form!=1)
	{
ajax.send("form="+form)
	}


}








function paquete_alta_egos(form_m){
	
	if (document.captura.nom_paquete.value.length==0)
	{ 
      	 alert("Nombre del paquete no puede ser vacio"); 
      	 document.captura.nom_paquete.focus(); 
      	 return 0; 
	}
	if (document.captura.descripcion_paquete.value.length==0)
	{ 
      	 alert("Descripcion de paquete no puede ser vacio"); 
      	 document.captura.descripcion_paquete.focus(); 
      	 return 0; 
	}
	
	if (document.captura.ingre_hec.value.length==0)
	{ 
      	 alert("Ingreso por hectaria no puede ser vacio"); 
      	 document.captura.ingre_hec.focus(); 
      	 return 0; 
	}
	if (document.captura.iduni.value.length==0)
	{ 
      	 alert("Unidad no puede ser vacio"); 
      	 document.captura.iduni.focus(); 
      	 return 0; 
	}
	if (document.captura.precio_hec.value.length==0)
	{ 
      	 alert("Precio x hectaria no puede ser vacio"); 
      	 document.captura.precio_hec.focus(); 
      	 return 0; 
	}
	
	if (document.captura.fecha_paq.value.length==0)
	{ 
      	 alert("Fecha de paquete no puede ser vacio"); 
      	 document.captura.fecha_paq.focus(); 
      	 return 0; 
	}
	if (document.captura.smg.value.length==0)
	{ 
      	 alert("Salario minimo no puede ser vacio"); 
      	 document.captura.smg.focus(); 
      	 return 0; 
	}
	
	

/*para validar check box	
for(var i = 0; i < captura.c.length; i++)
{ 
if(captura.c[i].checked)
return true; 
} 
alert('Debes seleccionar al menos una opcion'); 
return 0; 
*/
if(form_m==1)
	{
	
	id_paquete=document.captura.id_paquete.value;
	
	}



alert("Muchas gracias la informacion ha sido enviada");




	divFormulario = document.getElementById('contenido');
	
	
	
	
	
	
	nom_paquete=document.captura.nom_paquete.value;
	descripcion_paquete=document.captura.descripcion_paquete.value;
	ingre_hec=document.captura.ingre_hec.value;
	iduni=document.captura.iduni.value;
	precio_hec=document.captura.precio_hec.value;
	fecha_paq=document.captura.fecha_paq.value;
	smg=document.captura.smg.value;
	
	
	
	
	
	enviar=document.captura.enviar.value;
	
	
	
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_paquete.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			//divFormulario.style.display="block";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");


if(form_m==1) //modificar
{
	
	//alert("aca estamos");
ajax.send("nom_paquete="+nom_paquete+"&descripcion_paquete="+descripcion_paquete+"&fecha_paq="+fecha_paq+"&enviar="+enviar+"&id_paquete="+id_paquete+"&ingre_hec="+ingre_hec+"&iduni="+iduni+"&precio_hec="+precio_hec+"&smg="+smg);

}
if(form_m==2)
{
	//alert("aca estamos2");
	
ajax.send("nom_paquete="+nom_paquete+"&descripcion_paquete="+descripcion_paquete+"&fecha_paq="+fecha_paq+"&enviar="+enviar+"&ingre_hec="+ingre_hec+"&iduni="+iduni+"&precio_hec="+precio_hec+"&smg="+smg);
}



}

function actualiza_paquete_selec(form){


		//alert("Muchas gracias la informacion ha sido enviada");
	
	
	
	if(form==1)
	{
	id_paquete=document.captura.id_paquetes.value;
	}
	
	
	
	
	
	divFormulario = document.getElementById('contenido');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_paquete_selec.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	
if(form==1)
	{
ajax.send("id_paquete="+id_paquete+"&form="+form)
	}
	if(form!=1)
	{
ajax.send("form="+form)
	}


}


function add_select_req(id_paquete,form){


		//alert("Muchas gracias la informacion ha sido enviada");
	
	
	
	
	divFormulario = document.getElementById('contenido');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_paquete_selec.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	
if(form==3)
	{
ajax.send("id_paquete="+id_paquete+"&form="+form)
	}
	if(form!=1)
	{
ajax.send("form="+form)
	}
	
	if(form==4)
	{
ajax.send("id_paquete="+id_paquete+"&form="+form)
	}


}








function atras_paquete(id_paquete){

form=4;
	//alert("Muchas gracias la informacion ha sido enviada");
	

	divFormulario = document.getElementById('contenido');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_formu_reque.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	


ajax.send("id_paquete="+id_paquete+"&form="+form)


}




function add_reque_paq(form_m){
	
	if (document.reque.requerimiento.value.length==0)
	{ 
      	 alert("Nombre de requerimiento no puede ser vacio"); 
      	 document.reque.requerimiento.focus(); 
      	 return 0; 
	}
	if (document.reque.iduni.value.length==0)
	{ 
      	 alert("Unidad de servicio no puede ser vacio"); 
      	 document.reque.iduni.focus(); 
      	 return 0; 
	}
	
	if (document.reque.cantidad.value.length==0)
	{ 
      	// alert("Cantidad no puede ser vacio"); 
      	 document.reque.cantidad.value=0; 
      	 //return 0; 
	}
	if (document.reque.ciclos.value.length==0)
	{ 
      	 //alert("Ciclos no puede ser vacio"); 
      	 document.reque.ciclos.value=0; 
      	 //return 0; 
	}
	if (document.reque.total_ciclos.value.length==0)
	{ 
      	 //alert("Total de ciclos no puede ser vacio"); 
      	 document.reque.total_ciclos.value=0; 
      	 //return 0; 
	}
	if (document.reque.un.value.length==0)
	{ 
      //	 alert("UN no puede ser vacio"); 
      	 document.reque.un.value=0;
      	// return 0; 
	}
	if (document.reque.total.value.length==0)
	{ 
      	// alert("Total no puede ser vacio"); 
      	 document.reque.total.value=0;
      	 //return 0; 
	}
	if (document.reque.porciento_produ.value.length==0)
	{ 
      	// alert("Porcentaje de productor no puede ser vacio"); 
      	 document.reque.porciento_produ.value=0;
      	// return 0; 
	}
	if (document.reque.cuota_credi.value.length==0)
	{ 
      	// alert("Cuota de credito no puede ser vacio"); 
      	 document.reque.cuota_credi.value=0;
      	// return 0; 
	}
	if (document.reque.aporta_produ.value.length==0)
	{ 
      	// alert("Aportacion de productor no puede ser vacio"); 
      	 document.reque.aporta_produ.value=0;
      	// return 0; 
	}
	

if(form_m==1)
	{
	
	id_conf_paq=document.reque.id_conf_paq.value;
	
	}


id_paquete=document.reque.id_paquete.value;


idrequerimiento=document.reque.idrequerimiento.value;


	idproceso=document.reque.idproceso.value;
	requerimiento=document.reque.requerimiento.value;
	iduni=document.reque.iduni.value;
	cantidad=document.reque.cantidad.value;
	ciclos=document.reque.ciclos.value;
	total_ciclos=document.reque.total_ciclos.value;
	un=document.reque.un.value;
	total=document.reque.total.value;
	porciento_produ=document.reque.porciento_produ.value;
	cuota_credi=document.reque.cuota_credi.value;
	aporta_produ=document.reque.aporta_produ.value;
alert("Muchas gracias la informacion ha sido enviada");




	divFormulario = document.getElementById('contenido');
	
	
	
	
	enviar=document.reque.enviar.value;
	
	
	
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_requerimiento_paq.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			//divFormulario.style.display="block";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");


if(form_m==1) //modificar
{
	
	//alert("aca estamos");
ajax.send("idproceso="+idproceso+"&requerimiento="+requerimiento+"&iduni="+iduni+"&cantidad="+cantidad+"&ciclos="+ciclos+"&total_ciclos="+total_ciclos+"&un="+un+"&total="+total+"&porciento_produ="+porciento_produ+"&cuota_credi="+cuota_credi+"&aporta_produ="+aporta_produ+"&enviar="+enviar+"&idrequerimiento="+idrequerimiento+"&id_paquete="+id_paquete+"&id_conf_paq="+id_conf_paq);

}
if(form_m==2)
{
	//alert("aca estamos2");
	
ajax.send("idproceso="+idproceso+"&requerimiento="+requerimiento+"&iduni="+iduni+"&cantidad="+cantidad+"&ciclos="+ciclos+"&total_ciclos="+total_ciclos+"&un="+un+"&total="+total+"&porciento_produ="+porciento_produ+"&cuota_credi="+cuota_credi+"&aporta_produ="+aporta_produ+"&enviar="+enviar+"&idrequerimiento="+idrequerimiento+"&id_paquete="+id_paquete);
}



}






function add_select_reque_paq(id_conf_paq,form){


		//alert("Muchas gracias la informacion ha sido enviada");
	
	
	
	
	divFormulario = document.getElementById('contenido');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_paquete_selec_paq.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	
if(form==1)
	{
ajax.send("id_conf_paq="+id_conf_paq+"&form="+form)
	}
	


}

function digitalizar_doc(){
	
	if (document.form1.tipo_documento.value.length==0)
	{ 
      	 alert("Nombre de documento no puede ser vacio"); 
      	 document.form1.tipo_documento.focus(); 
      	 return 0; 
	}
	
	if (document.form1.archivo.value.length==0)
	{ 
      	 alert("Archivo no ha sido seleccionado"); 
      	 document.form1.archivo.focus(); 
      	 return 0; 
	}
	
	
	alert("Guardando Documento....");
		document.form1.submit(); 
	
	

}

function actualiza_grupo_solicitud_selec(form,idgrupo){


		//alert("Muchas gracias la informacion ha sido enviada");
	if(form==1)
	{
	idsolgrupo=document.captura.idsolgrupo.value;
	}
	
	divFormulario = document.getElementById('contenido');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_grupo_selec.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	
if(form==1)
ajax.send("idsolgrupo="+idsolgrupo+"&form="+form)
if(form==2)
ajax.send("form="+form+"&idgrupo="+idgrupo)

}



function valida_modarticulos(form_m) {
	
  
	if (document.captura.precio.value.length==0)
	{ 
      	 alert("Verifique que el campo de precio no se encuentren vacios o Menor a $0.00"); 
      	 document.captura.precio.focus(); 
      	 return 0; 
	}
	
	clv_precio=document.captura.clv_precio.value;	
	
   precio=document.captura.precio.value;
	idarticulo=document.captura.idarticulos.value;
	precio_ant=document.captura.precio_ant.value;
	
	ren_max=document.captura.ren_max.value;
	ren_min=document.captura.ren_min.value;
	man_max=document.captura.man_max.value;
	man_min=document.captura.man_min.value;
	hum_max=document.captura.hum_max.value;
	hum_min=document.captura.hum_min.value;
	man_sec=document.captura.man_sec.value;
	hum_max=document.captura.hum_max.value;
	fle_bul=	document.captura.fle_bul.value;
	mani_bul=	document.captura.mani_bul.value;
	sec_caj=	document.captura.sec_caj.value;
	
	
	
	if(precio>(parseFloat(precio_ant)+5)) 
	{
		alert("El precio que esta asignado esta muy arriba de los parametros establecidos, Verifique!!");	
	}	
	
	ajax=objetoAjax();
	ajax.open("POST", "ser_catprecio.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			listar_catalogo();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");



	ajax.send("idarticulos="+idarticulo+"&clv_precio="+clv_precio+"&precio="+precio+"&ren_max="+ren_max+"&ren_min="+ren_min+"&man_max="+man_max+"&man_min="+man_min+"&hum_max="+hum_max+"&hum_min="+hum_min+"&man_sec="+man_sec+"&fle_bul="+fle_bul+"&mani_bul="+mani_bul+"&sec_caj="+sec_caj);

	
}



function listar_catalogo() {
	


	divFormulario = document.getElementById('lp');

	divFormulario.innerHTML = "ajax.responseText";
	ajax=objetoAjax();
	ajax.open("POST", "actualiza_lp.php");
	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText;

		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send();
}

function grupo_alta_egos(form_m){
	
	if (document.captura.grupo.value.length==0)
	{ 
      	 alert("Nombre de grupo no puede ser vacio"); 
      	 document.captura.grupo.focus(); 
      	 return 0; 
	}
	/*
	if (document.captura.email.value.length==0)
	{ 
      	 alert("Correo de grupo no puede ser vacio"); 
      	 document.captura.email.focus(); 
      	 return 0; 
	}
	*/
	if (document.captura.domicilio.value.length==0)
	{ 
      	 alert("Domicilio no puede ser vacio"); 
      	 document.captura.domicilio.focus(); 
      	 return 0; 
	}
	
	
	if (document.captura.estado.value.length==0)
	{ 
      	 alert("Nombre del estado no puede ser vacio"); 
      	 document.captura.estado.focus(); 
      	 return 0; 
	}
	if (document.captura.municipio.value.length==0)
	{ 
      	 alert("Nombre del municipio no puede ser vacio"); 
      	 document.captura.municipio.focus(); 
      	 return 0; 
	}
	if (document.captura.localidad.value.length==0)
	{ 
      	 alert("Nombre de localidad no puede ser vacio"); 
      	 document.captura.localidad.focus(); 
      	 return 0; 
	}
	
	if (document.captura.colonia.value.length==0)
	{ 
      	 alert("Nombre de colonia no puede ser vacio"); 
      	 document.captura.colonia.focus(); 
      	 return 0; 
	}
	
	if (document.captura.idcliente.value.length==0)
	{ 
      	 alert("Nombre de representante no puede ser vacio"); 
      	 document.captura.idcliente.focus(); 
      	 return 0; 
	}
	
	if (document.captura.fecha_activacion.value.length==0)
	{ 
      	 alert("Fecha de activacion total no puede ser vacio"); 
      	 document.captura.fecha_activacion.focus(); 
      	 return 0; 
	}
	
if(form_m==1)
	{
	
	idgrupo=document.captura.idgrupo.value;
	
	}



alert("Muchas gracias la informacion ha sido enviada");




	divFormulario = document.getElementById('contenido');
	
	
	
	
	
	
	
	grupo=document.captura.grupo.value;
	email=document.captura.email.value;
	domicilio=document.captura.domicilio.value;
	estado=document.captura.estado.value;
	municipio=document.captura.municipio.value;
	localidad=document.captura.localidad.value;
	colonia=document.captura.colonia.value;
	idcliente=document.captura.idcliente.value;
	fecha_activacion=document.captura.fecha_activacion.value;
	
	enviar=document.captura.enviar.value;
	
	
	
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_grupo.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			//divFormulario.style.display="block";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");


if(form_m==1) //modificar
{
	
	//alert("aca estamos");
ajax.send("grupo="+grupo+"&estado="+estado+"&municipio="+municipio+"&localidad="+localidad+"&colonia="+colonia+"&idcliente="+idcliente+"&fecha_activacion="+fecha_activacion+"&idgrupo="+idgrupo+"&email="+email+"&domicilio="+domicilio+"&enviar="+enviar);

}
if(form_m==2)
{
	//alert("aca estamos2");
	
ajax.send("grupo="+grupo+"&estado="+estado+"&municipio="+municipio+"&localidad="+localidad+"&colonia="+colonia+"&idcliente="+idcliente+"&fecha_activacion="+fecha_activacion+"&enviar="+enviar+"&email="+email+"&domicilio="+domicilio);
}



}




function actualiza_grupo_add(idgrupo,form){


		//alert("Muchas gracias la informacion ha sido enviada");

	
	divFormulario = document.getElementById('contenido');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_grupo_selec.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("idgrupo="+idgrupo+"&form="+form)


}


function atras_grupo(idgrupo,form){


	//alert("Muchas gracias la informacion ha sido enviada");
	

	divFormulario = document.getElementById('contenido');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_grupo_selec.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	


ajax.send("idgrupo="+idgrupo+"&form="+form)


}

function mas_add_grup(idcliente,form){


	//alert("Muchas gracias la informacion ha sido enviada");
	
	idgrupo=document.captura.idgrupo.value;
	
	
	
	
	
	divFormulario = document.getElementById('mas');

	ajax=objetoAjax();
	ajax.open("POST", "serv_add_produ.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	


ajax.send("idgrupo="+idgrupo+"&idcliente="+idcliente+"&form="+form)


}
function menos_add_grup(id_rela,form){


	//alert("Muchas gracias la informacion ha sido enviada");
	
	idgrupo=document.captura.idgrupo.value;
	divFormulario = document.getElementById('menos');

	ajax=objetoAjax();
	ajax.open("POST", "serv_add_produ.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	


ajax.send("idgrupo="+idgrupo+"&id_rela="+id_rela+"&form="+form)


}

function agrega_pro_grupo(idgrupo,idcliente){
	
	
	//requerimiento=document.reque.requerimiento.value;
	
	
	
	if (confirm('Estas completamente seguro de agregar Productor'))
	{
	
	  divFormularios = document.getElementById('contenido');
	
	ajax=objetoAjax();



ajax.open("POST", "add_produ.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormularios.innerHTML = ajax.responseText
			//divFormulario2.innerHTML = ajax.responseText
			//divFormulario2.style.display="block";
			divFormularios.style.display="block";
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("idgrupo="+idgrupo+"&idcliente="+idcliente)



}
}

function del_pro_grupo(idgrupo,id_rela){
	
	
	//requerimiento=document.reque.requerimiento.value;
	
	
	
	if (confirm('Estas completamente seguro de Eliminar Productor'))
	{
	
	  divFormularios = document.getElementById('contenido');
	
	ajax=objetoAjax();



ajax.open("POST", "del_produ.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormularios.innerHTML = ajax.responseText
			//divFormulario2.innerHTML = ajax.responseText
			//divFormulario2.style.display="block";
			divFormularios.style.display="block";
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("idgrupo="+idgrupo+"&id_rela="+id_rela)



}
}


function promotores_alta_egos(form_m){
	
	if (document.captura.nombre.value.length==0)
	{ 
      	 alert("Nombre  no puede ser vacio"); 
      	 document.captura.nombre.focus(); 
      	 return 0; 
	}
	if (document.captura.a_paterno.value.length==0)
	{ 
      	 alert("Apellido Paterno no puede ser vacio"); 
      	 document.captura.a_paterno.focus(); 
      	 return 0; 
	}
	if (document.captura.a_materno.value.length==0)
	{ 
      	 alert("Apellido Materno no puede ser vacio"); 
      	 document.captura.a_materno.focus(); 
      	 return 0; 
	}
	
	if (document.captura.dia.value.length==0)
	{ 
      	 alert(" Dia de nacimiento no puede ser vacio"); 
      	 document.captura.dia.focus(); 
      	 return 0; 
	}
	if (document.captura.mes.value.length==0)
	{ 
      	 alert(" Mes de nacimiento no puede ser vacio"); 
      	 document.captura.mes.focus(); 
      	 return 0; 
	}
	if (document.captura.ano.value.length==0)
	{ 
      	 alert(" Year de nacimiento no puede ser vacio"); 
      	 document.captura.ano.focus(); 
      	 return 0; 
	}
	
	
	
	
	if (document.captura.genero.value.length==0)
	{ 
      	 alert(" Genero no puede ser vacio"); 
      	 document.captura.genero.focus(); 
      	 return 0; 
	}
	
	if (document.captura.rfc.value.length==0)
	{ 
      	 alert(" RFC no puede ser vacio"); 
      	 document.captura.rfc.focus(); 
      	 return 0; 
	}
	
	
	if (document.captura.curp.value.length==0)
	{ 
      	 alert(" Curp no puede ser vacio"); 
      	 document.captura.curp.focus(); 
      	 return 0; 
	}
	
	if (document.captura.telefono.value.length==0)
	{ 
      	 alert("Telefono no puede ser vacio"); 
      	 document.captura.telefono.focus(); 
      	 return 0; 
	}
		
	if (document.captura.activo.value.length==0)
	{ 
      	 alert(" Estatus no puede ser vacio"); 
      	 document.captura.activo.focus(); 
      	 return 0; 
	}
	
	
	if (document.captura.estado.value.length==0)
	{ 
      	 alert("Nombre del estado no puede ser vacio"); 
      	 document.captura.estado.focus(); 
      	 return 0; 
	}
	if (document.captura.municipio.value.length==0)
	{ 
      	 alert("Nombre del municipio no puede ser vacio"); 
      	 document.captura.municipio.focus(); 
      	 return 0; 
	}
	if (document.captura.localidad.value.length==0)
	{ 
      	 alert("Nombre de localidad no puede ser vacio"); 
      	 document.captura.localidad.focus(); 
      	 return 0; 
	}
	
	if (document.captura.colonia.value.length==0)
	{ 
      	 alert("Nombre de colonia no puede ser vacio"); 
      	 document.captura.colonia.focus(); 
      	 return 0; 
	}
	
	if (document.captura.codigo_postal.value.length==0)
	{ 
      	 alert("Codigo postal no puede ser vacio"); 
      	 document.captura.codigo_postal.focus(); 
      	 return 0; 
	}
	if (document.captura.dep_economico.value.length==0)
	{ 
      	 alert("Dep economico no puede ser vacio"); 
      	 document.captura.dep_economico.focus(); 
      	 return 0; 
	}
	
	if (document.captura.domicilio.value.length==0)
	{ 
      	 alert(" Domicilio no puede ser vacio"); 
      	 document.captura.domicilio.focus(); 
      	 return 0; 
	}
	
	
	
	if (document.captura.estado_civil.value.length==0)
	{ 
      	 alert("Estado civil no puede ser vacio"); 
      	 document.captura.estado_civil.focus(); 
      	 return 0; 
	}
	
	
	if (document.captura.email.value.length==0)
	{ 
      	 alert("Email no puede ser vacio"); 
      	 document.captura.email.focus(); 
      	 return 0; 
	}
	
	if (document.captura.f_ingreso.value.length==0)
	{ 
      	 alert("Fecha de ingreso no puede ser vacio"); 
      	 document.captura.f_ingreso.focus(); 
      	 return 0; 
	}
	
	if (document.captura.iniciales.value.length==0)
	{ 
      	 alert("Iniciales no puede ser vacio"); 
      	 document.captura.iniciales.focus(); 
      	 return 0; 
	}
	
	if (document.captura.usuario.value.length==0)
	{ 
      	 alert("Usuario no puede ser vacio"); 
      	 document.captura.usuario.focus(); 
      	 return 0; 
	}
	if (document.captura.contra.value.length==0)
	{ 
      	 alert("Password no puede ser vacio"); 
      	 document.captura.contra.focus(); 
      	 return 0; 
	}
	if (document.captura.contra2.value.length==0)
	{ 
      	 alert("Password no puede ser vacio"); 
      	 document.captura.contra2.focus(); 
      	 return 0; 
	}
	if (document.captura.id_sucursal.value.length==0)
	{ 
      	 alert("Sucursal no puede ser vacio"); 
      	 document.captura.id_sucursal.focus(); 
      	 return 0; 
	}
	
	
	contra=document.captura.contra.value;
	contra2=document.captura.contra2.value;
	
	if (contra!=contra2)
	{ 
      	 alert("Password debe coincidir"); 
      	 document.captura.contra.focus(); 
      	 return 0; 
	}
	

if(form_m==1)
	{
	
	idpromotor=document.captura.idpromotor.value;
	usuario_id=document.captura.usuario_id.value;
	
	}



alert("Muchas gracias la informacion ha sido enviada");




	divFormulario = document.getElementById('contenido');
	
	
	
	
	
	
	nombre=document.captura.nombre.value;
	a_paterno=document.captura.a_paterno.value;
	a_materno=document.captura.a_materno.value;
	dia=document.captura.dia.value;
	mes=document.captura.mes.value;
	ano=document.captura.ano.value;
	genero=document.captura.genero.value;
	rfc=document.captura.rfc.value;
	curp=document.captura.curp.value;		
	telefono=document.captura.telefono.value;
	activo=document.captura.activo.value;
	estado=document.captura.estado.value;
	municipio=document.captura.municipio.value;
	localidad=document.captura.localidad.value;
	colonia=document.captura.colonia.value;
	codigo_postal=document.captura.codigo_postal.value;
	dep_economico=document.captura.dep_economico.value;
	domicilio=document.captura.domicilio.value;
	estado_civil=document.captura.estado_civil.value;
	email=document.captura.email.value;
	f_ingreso=document.captura.f_ingreso.value;
	usuario=document.captura.usuario.value;
	iniciales=document.captura.iniciales.value;
	id_sucursal=document.captura.id_sucursal.value;
	/*contra=document.captura.contra.value;
	contra2=document.captura.contra2.value;
*/
	enviar=document.captura.enviar.value;
	
	
	
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_promotor.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
			
			//divFormulario.style.display="block";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");


if(form_m==1)
{
	
	//alert("aca estamos");
ajax.send("nombre="+nombre+"&a_paterno="+a_paterno+"&a_materno="+a_materno+"&dia="+dia+"&mes="+mes+"&ano="+ano+"&genero="+genero+"&rfc="+rfc+"&curp="+curp+"&telefono="+telefono+"&activo="+activo+"&estado="+estado+"&municipio="+municipio+"&localidad="+localidad+"&colonia="+colonia+"&codigo_postal="+codigo_postal+"&dep_economico="+dep_economico+"&domicilio="+domicilio+"&estado_civil="+estado_civil+"&email="+email+"&f_ingreso="+f_ingreso+"&usuario="+usuario+"&contra="+contra+"&contra2="+contra2+"&enviar="+enviar+"&idpromotor="+idpromotor+"&usuario_id="+usuario_id+"&iniciales="+iniciales+"&id_sucursal="+id_sucursal);

}
if(form_m==2)
{
	//alert("aca estamos2");
	
ajax.send("nombre="+nombre+"&a_paterno="+a_paterno+"&a_materno="+a_materno+"&dia="+dia+"&mes="+mes+"&ano="+ano+"&genero="+genero+"&rfc="+rfc+"&curp="+curp+"&telefono="+telefono+"&activo="+activo+"&estado="+estado+"&municipio="+municipio+"&localidad="+localidad+"&colonia="+colonia+"&codigo_postal="+codigo_postal+"&dep_economico="+dep_economico+"&domicilio="+domicilio+"&estado_civil="+estado_civil+"&email="+email+"&f_ingreso="+f_ingreso+"&usuario="+usuario+"&contra="+contra+"&contra2="+contra2+"&enviar="+enviar+"&iniciales="+iniciales+"&id_sucursal="+id_sucursal);
}



}

function actualiza_promotor(form){


	if(form==1)
	{
	
		if (document.captura.promotor_id.value.length==0)
			{ 
				 alert("Promotor no puede ser vacio"); 
				 document.captura.promotor_id.focus(); 
				 return 0; 
			}
	
	
	idpromotor=document.captura.promotor_id.value;
	
	}

	//alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('contenido');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_promotor.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

if(form==1)
ajax.send("idpromotor="+idpromotor+"&form="+form)
if(form==2)
ajax.send("form="+form)

}


function actualiza_sol_cliente(idcliente,form){


	//alert("Muchas gracias la informacion ha sido enviada");
	
//	idgrupo=document.captura.idgrupo.value;

if(idcliente=="")
{
 alert("Elije a un cliente"); 
 document.captura.idcliente.focus(); 
 return 0; 
				 
}

	divFormulario = document.getElementById('contenido');
	carga = document.getElementById('carga');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_sol_selec.php");
	carga.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			if(ajax.responseText==0)
			{
			 alert("Lo sentimos este cliente es Proveedor No cuenta con los permisos para solicitud de credito");
			 document.captura.idcliente.focus(); 
			carga.innerHTML = '';
			 document.captura.idcliente.value=""; 
			 return 0; 
			 
			}
			else
			{
			
			divFormulario.innerHTML = ajax.responseText
			}
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	


ajax.send("idcliente="+idcliente+"&form="+form)


}

function add_parcela_sol(id_parcela,form,idcliente){

divFormulario = document.getElementById('add_parcela');

	if(id_parcela=="")
{
 alert("Selecciona una Parcela"); 
// document.captura.id_parcela.focus(); 
 divFormulario.innerHTML = "";
 return 0; 
				 
}
	
//	alert(idcliente);
	
	

	ajax=objetoAjax();
	ajax.open("POST", "serv_actualiza.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText

			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	


ajax.send("idcliente="+idcliente+"&id_parcela="+id_parcela+"&form="+form)


}


function agrega_parcela_sol(id_parcela,idcliente){
if(id_parcela=="")
{
 alert("Selecciona una Parcela"); 

 return 0; 
				 
}	
	
	//requerimiento=document.reque.requerimiento.value;
	
	
	
	if (confirm('Estas completamente seguro de agregar Parcela'))
	{
	
	  divFormularios = document.getElementById('add_parcela_select');
	  divSc_t = document.getElementById('sc_t');
	
	ajax=objetoAjax();



ajax.open("POST", "add_select.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			
			if(ajax.responseText==0)
			{
			alert("Esta parcela ya esta repetida");
			}
			else
			{
									
			data = ajax.responseText.split("-");
			//document.getElementById("myDiv").innerHTML = datadata[0];
			divFormularios.innerHTML = data[0].replace(":","-");
			divSc_t.innerHTML = data[1].replace(/:/g,"-");
			
			document.captura.id_paquete.value="";
			document.captura.ingre_cosecha.value="";
			document.captura.costo_cosecha.value="";
			document.captura.ingre_bruto.value="";
			document.captura.ingre_neto.value="";
			document.captura.otrosgastos.value="";
			document.captura.otrosingresos.value="";
			document.captura.monto.value="";
			
			//divFormularios.innerHTML = ajax.responseText
			divFormularios.style.display="block";
			}
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("id_parcela="+id_parcela+"&idcliente="+idcliente)



}
}

function del_parcela_sol(id_parcela,idcliente){
	
	if(id_parcela=="")
{
 alert("Selecciona una Parcela"); 

 return 0; 
				 
}	
	
	//requerimiento=document.reque.requerimiento.value;
	
	
	
	if (confirm('Estas completamente seguro de eliminar Parcela'))
	{
	
	  divFormularios = document.getElementById('add_parcela_select');
	   divSc_t = document.getElementById('sc_t');
	
	ajax=objetoAjax();



ajax.open("POST", "del_select.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			
			if(ajax.responseText==0) //mando un error
			{
			alert("Ah ocurrido un error intentelo otra vez");
			}
			else
			{
			data = ajax.responseText.split("-");
			//document.getElementById("myDiv").innerHTML = datadata[0];
			divFormularios.innerHTML = data[0];
			divSc_t.innerHTML = data[1];
			document.captura.id_paquete.value="";
			document.captura.ingre_cosecha.value="";
			document.captura.costo_cosecha.value="";
			document.captura.ingre_bruto.value="";
			document.captura.ingre_neto.value="";
			document.captura.otrosgastos.value="";
			document.captura.otrosingresos.value="";
			document.captura.monto.value="";
			
			
			//divFormularios.innerHTML = ajax.responseText
			divFormularios.style.display="block";
			}
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("id_parcela="+id_parcela+"&idcliente="+idcliente)



}
}


function update_g_p(form,idcliente){

if(form=="")
{
 alert("Seleccione"); 

 return 0; 
				 
}	
if(form==1)
{
msj="Propias";
divFormulario = document.getElementById('update_garantias_p');
clean_aval = document.getElementById('cliente_aval');
alert("Buscando.. Garantias Prendarias "+msj+"");
}
if(form==2)
{
msj="De aval";
divFormulario = document.getElementById('cliente_aval');
clean_aval = document.getElementById('update_garantias_p');
//clean_aval2 = document.getElementById('gara_add_p');

alert("Buscando.. Aval Prendario");
}
if(form==4)
{
msj="Propias";
divFormulario = document.getElementById('update_garantias_h');
clean_aval = document.getElementById('cliente_aval_h');
alert("Buscando.. Garantias Hipotecarias "+msj+"");
}
if(form==5)
{
msj="De aval";
divFormulario = document.getElementById('cliente_aval_h');
clean_aval = document.getElementById('update_garantias_h');
alert("Buscando.. Aval Hipotecario");
}
	
	
//	idgrupo=document.captura.idgrupo.value;

	//divFormulario = document.getElementById('update_garantias_p');
	
	

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_sol_gara.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Buscando garantias...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			clean_aval.innerHTML ="";
			/*if(form==2)
			clean_aval2.innerHTML ="";*/
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	


ajax.send("idcliente="+idcliente+"&form="+form)


}

function update_g_avales(idaval,idcliente,form){

if(idaval=="")
{
 alert("Seleccione aval"); 

 return 0; 
				 
}	
if(form==3)
{
msj="de Aval Prendario";
divFormulario = document.getElementById('update_garantias_p');
//clean_aval = document.getElementById('cliente_aval');
alert("Buscando.. Garantias  "+msj+"");
}

if(form==6)
{
msj="de Aval Hipotecario";
divFormulario = document.getElementById('update_garantias_h');
//clean_aval = document.getElementById('cliente_aval');
alert("Buscando.. Garantias  "+msj+"");
}

	

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_sol_gara.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Buscando garantias...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	


ajax.send("idcliente="+idcliente+"&idaval="+idaval+"&form="+form)


}


function add_garantia_prenda(idgtia_p,form){
	
	if(idgtia_p=="")
{
 alert("Seleccione Garantia"); 
 return 0; 
				 
}
	
	if(form==1)
	msj="Garantia Prendaria Propia";
	
	
	if (confirm("Desea agregar "+msj+" "))
	{
	
	  if(form==1)
	  {
	  divFormularios = document.getElementById('gara_add_p');
	  }
	
		ajax=objetoAjax();



ajax.open("POST", "add_sol_gara.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			
			if(ajax.responseText==0) //mando un error
			{
			alert("Esta garantia ya ha sido agregada");
			}
			else
			{
			divFormularios.innerHTML = ajax.responseText
			//divFormulario2.innerHTML = ajax.responseText
			//divFormulario2.style.display="block";
			divFormularios.style.display="block";
			}
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("idgtia_p="+idgtia_p+"&form="+form)



}
}

function del_gara_selec(idgtia_p,form){
	
	if(idgtia_p=="")
{
 alert("Seleccione Garantia"); 
 return 0; 
				 
}
	
	if(form==1)
	msj="Garantia Prendaria Propia";
	
	
	if (confirm("Desea Eliminar de la lista "+msj+" "))
	{
	
	  if(form==1)
	  {
	  divFormularios = document.getElementById('gara_add_p');
	  }
	
		ajax=objetoAjax();



ajax.open("POST", "del_select_gara_p.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			
			if(ajax.responseText==0) //mando un error
			{
			alert("Ocurrio un error no se ha podido eliminar de la lista consulte con el admon del sistema");
			}
			else
			{
			divFormularios.innerHTML = ajax.responseText
			//divFormulario2.innerHTML = ajax.responseText
			//divFormulario2.style.display="block";
			divFormularios.style.display="block";
			}
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("idgtia_p="+idgtia_p+"&form="+form)



}
}

function add_garantia_hipo(idgtia_h,form){
	
	if(idgtia_h=="")
{
 alert("Seleccione Garantia Hipotecaria"); 
 return 0; 
				 
}
	
	if(form==1)
	msj="Garantia Hipotecaria Propia";
	
	
	if (confirm("Desea agregar "+msj+" "))
	{
	
	  if(form==1)
	  {
	  divFormularios = document.getElementById('hipo_add_h');
	  }
	
		ajax=objetoAjax();



ajax.open("POST", "add_sol_hipo.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			
			if(ajax.responseText==0) //mando un error
			{
			alert("Esta garantia ya ha sido agregada");
			}
			else
			{
			divFormularios.innerHTML = ajax.responseText
			//divFormulario2.innerHTML = ajax.responseText
			//divFormulario2.style.display="block";
			divFormularios.style.display="block";
			}
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("idgtia_h="+idgtia_h+"&form="+form)



}
}

function del_gara_selec_hipo(idgtia_h,form){
	
	if(idgtia_h=="")
{
 alert("Seleccione Garantia Hipotecaria"); 
 return 0; 
				 
}
	
	if(form==1)
	msj="Garantia Hipotecaria Propia";
	
	
	if (confirm("Desea Eliminar de la lista "+msj+" "))
	{
	
	  if(form==1)
	  {
	  divFormularios = document.getElementById('hipo_add_h');
	  }
	
		ajax=objetoAjax();



ajax.open("POST", "del_select_gara_h.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			
			if(ajax.responseText==0) //mando un error
			{
			alert("Ocurrio un error no se ha podido eliminar de la lista consulte con el admon del sistema");
			}
			else
			{
			divFormularios.innerHTML = ajax.responseText
			//divFormulario2.innerHTML = ajax.responseText
			//divFormulario2.style.display="block";
			divFormularios.style.display="block";
			}
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("idgtia_h="+idgtia_h+"&form="+form)



}
}

function procesa_paquete_tec(id_paquete,form,idcliente){
	
	if(id_paquete=="")
{
 alert("Seleccione Paquete tecnologico"); 
 return 0; 
				 
}
	
	//if(form==1)
	//msj="Garantia Hipotecaria Propia";
	
	
	if (confirm("Desea calcular  Costo de cosecha"))
	{
	
	  if(form==1)
	  {
	  divIngre_cosecha = document.getElementById('ingreso_cosecha');
	  divCosto_cosecha = document.getElementById('costo_cosecha');
	  divIngre_bruto = document.getElementById('ingreso_bruto');
	  divIngre_neto = document.getElementById('ingreso_neto');
	  divMonto = document.getElementById('update_monto');
	  
	  }
	
		ajax=objetoAjax();



ajax.open("POST", "procesa_paquete_tec.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			
			if(ajax.responseText==0) //mando un error
			{
			//alert("Ocurrio un error  Seleccione las parcelas del productor");
			alert("Precausion este productor no tiene parcelas ingresadas !!!");
			//document.captura.id_paquete.value="";	
			}
			else
			{
			
			data = ajax.responseText.split("#");
			
			divIngre_cosecha.innerHTML = data[0];
			divCosto_cosecha.innerHTML = data[1];
			divIngre_bruto.innerHTML = data[2];
			divIngre_neto.innerHTML = data[3];
			divMonto.innerHTML = data[4];

			divIngre_cosecha.style.display="block";
			}
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("id_paquete="+id_paquete+"&form="+form+"&idcliente="+idcliente)



}
else
{
document.captura.id_paquete.value="";	
}


}

function update_monto()
{
	
	
	
	if (confirm("Desea calcular  Ingreso NETO"))
	{
	divIngre_neto = document.getElementById('ingreso_neto');
	 
	
	
	ingre_bruto=document.captura.ingre_bruto.value;
	

	if (document.captura.otrosgastos.value.length==0)
	{ 
      	
      	otrosgastos=0;
	}
	if (document.captura.otrosingresos.value.length==0)
	{ 
      	
      	otrosingresos=0;
	}
	if (document.captura.otrosgastos.value>0)
	{ 
      	
      	otrosgastos=document.captura.otrosgastos.value;
	}
	if (document.captura.otrosingresos.value>0)
	{ 
      	
      	otrosingresos=document.captura.otrosingresos.value;
	}

	
		ajax=objetoAjax();



ajax.open("POST", "ser_otros_gastos.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			
			if(ajax.responseText==0) //mando un error
			{
			alert("Ocurrio un error  acuda con admon del sistema");
			document.captura.otrosgastos.value="";	
			document.captura.otrosingresos.value="";	
			}
			else
			{
			
		divIngre_neto.innerHTML = ajax.responseText
		
			}
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("otrosgastos="+otrosgastos+"&ingre_bruto="+ingre_bruto+"&otrosingresos="+otrosingresos)



	}
	


}

function valida_solicitudes(form_m){
	
	//form =1 modificar
	//form =2 guardar
	
	if(document.captura.nom_asesor.value=='0')
	{
			 alert("Usted no es un Asesor. Necesita ser un Asesor para poder agregar solicitudes."); 
      	 return 0; 
	}	
	if (document.captura.fecha_registro.value.length==0)
	{ 
      	 alert("Fecha de la solicitud no puede ser vacio"); 
      	 document.captura.fecha_registro.focus(); 
      	 return 0; 
	}
	
	if (document.captura.idcliente.value.length==0)
	{ 
      	 alert("Cliente no puede ser vacio"); 
      	 document.captura.idcliente.focus(); 
      	 return 0; 
	}
	
	if (document.captura.experiencia.value.length==0)
	{ 
      	 alert("Experiencia no puede ser vacio"); 
      	 document.captura.experiencia.focus(); 
      	 return 0; 
	}
	
	
	if (document.captura.idgiro.value.length==0)
	{ 
      	 alert("Giro no puede ser vacio"); 
      	 document.captura.idgiro.focus(); 
      	 return 0; 
	}
	if (document.captura.destino.value.length==0)
	{ 
      	 alert("Destino no puede ser vacio"); 
      	 document.captura.destino.focus(); 
      	 return 0; 
	}
	/*
	if (document.captura.id_parcelas.length<2)
	{ 
      	 alert("Parcelas del cliente no puede ser vacio"); 
      	 document.captura.id_parcelas.focus(); 
      	 return 0; 
	}*/
	if (document.captura.idproducto.value.length==0)
	{ 
      	 alert("Producto Financiero no puede ser vacio"); 
      	 document.captura.idproducto.focus(); 
      	 return 0; 
	}
	if (document.captura.idcon_inv.value.length==0)
	{ 
      	 alert("Concepto de inversion no puede ser vacio"); 
      	 document.captura.idcon_inv.focus(); 
      	 return 0; 
	}
	if (document.captura.monto.value.length==0)
	{ 
      	 alert("Monto solicitado no puede ser vacio"); 
      	 document.captura.monto.focus(); 
      	 return 0; 
	}

	/*if (document.captura.monto_parafinanciera.value.length==0)
	{ 
      	 alert("Monto solicitado no puede ser vacio"); 
      	 document.captura.monto_parafinanciera.focus(); 
      	 return 0; 
	}*/
	
	if (document.captura.id_paquete.value.length==0)
	{ 
      	 alert("Paquete tecnologico no puede ser vacio"); 
      	 document.captura.id_paquete.focus(); 
      	 return 0; 
	}
	if (document.captura.t_sol.value.length==0)
	{ 
      	 alert("Tipo de solicitud no puede ser vacio"); 
      	 document.captura.t_sol.focus(); 
      	 return 0; 
	}
	/*
	if (document.captura.otrosgastos.value.length==0)
	{ 
      	 alert("Otros gastos no puede ser vacio"); 
      	 document.captura.otrosgastos.focus(); 
      	 return 0; 
	}
	if (document.captura.descripcionotrosgts.value.length==0)
	{ 
      	 alert("Descripcion de otros gastos no puede ser vacio"); 
      	 document.captura.descripcionotrosgts.focus(); 
      	 return 0; 
	}
	if (document.captura.otrosingresos.value.length==0)
	{ 
      	 alert("Otros ingresos no puede ser vacio"); 
      	 document.captura.otrosingresos.focus(); 
      	 return 0; 
	}
	if (document.captura.descripcionotrosing.value.length==0)
	{ 
      	 alert("Descripcionn de otros ingresos no puede ser vacio"); 
      	 document.captura.descripcionotrosing.focus(); 
      	 return 0; 
	}
	*/
	if(form_m==1)
	{
	
	idsolicitud=document.captura.idsolicitud.value;
	
	}



alert("La solicitud sera validad en unos momentos");




	Resultado = document.getElementById('contenido');
	
	
	
	
	
	
	
	fecha_registro=document.captura.fecha_registro.value;
	idcliente=document.captura.idcliente.value;
	experiencia=document.captura.experiencia.value;
	idgiro=document.captura.idgiro.value;
	destino=document.captura.destino.value;
	idproducto=document.captura.idproducto.value;
	idcon_inv=document.captura.idcon_inv.value;
	monto=document.captura.monto.value;
	monto_finan=document.captura.monto_parafinanciera.value;
	id_paquete=document.captura.id_paquete.value;
	otrosgastos=document.captura.otrosgastos.value;
	descripcionotrosgts=document.captura.descripcionotrosgts.value;
	otrosingresos=document.captura.otrosingresos.value;
	descripcionotrosing=document.captura.descripcionotrosing.value;
	t_sol=document.captura.t_sol.value;
	
	if (document.captura.gar_liq_porcentaje.value.length==0)
	{ 
      	gar_liq_porcentaje=0;
	}
	if (document.captura.gar_liq_porcentaje.value.length>0)
	{
	gar_liq_porcentaje=document.captura.gar_liq_porcentaje.value;
	}
	enviar=document.captura.enviar.value;
	
	
	
	
	
	ajax=objetoAjax();
	ajax.open("POST", "procesa_solicitudes.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			
			if(ajax.responseText==0) //mando un error por campos necesarios
			{
			alert("Ocurrio un error  acuda con admon del sistema");
			
			}
			
			else
			{
			
			//data = ajax.responseText.split("-");
			Resultado.innerHTML =ajax.responseText;
			//alert(data[0]);
			//
			//divCosto_cosecha.innerHTML = data[1];	
			//divIngre_neto.innerHTML = ajax.responseText
		
			}
			
			
			//divFormulario.style.display="block";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");


if(form_m==1) //modificar
{
	

ajax.send("monto_finan="+monto_finan+"&fecha_registro="+fecha_registro+"&idcliente="+idcliente+"&experiencia="+experiencia+"&idgiro="+idgiro+"&destino="+destino+"&idproducto="+idproducto+"&idcon_inv="+idcon_inv+"&monto="+monto+"&id_paquete="+id_paquete+"&otrosgastos="+otrosgastos+"&descripcionotrosgts="+descripcionotrosgts+"&otrosingresos="+otrosingresos+"&descripcionotrosing="+descripcionotrosing+"&enviar="+enviar+"&gar_liq_porcentaje="+gar_liq_porcentaje+"&idsolicitud="+idsolicitud+"&t_sol="+t_sol);

}
if(form_m==2)
{
	
ajax.send("monto_finan="+monto_finan+"&fecha_registro="+fecha_registro+"&idcliente="+idcliente+"&experiencia="+experiencia+"&idgiro="+idgiro+"&destino="+destino+"&idproducto="+idproducto+"&idcon_inv="+idcon_inv+"&monto="+monto+"&id_paquete="+id_paquete+"&otrosgastos="+otrosgastos+"&descripcionotrosgts="+descripcionotrosgts+"&otrosingresos="+otrosingresos+"&descripcionotrosing="+descripcionotrosing+"&enviar="+enviar+"&gar_liq_porcentaje="+gar_liq_porcentaje+"&t_sol="+t_sol);
}

}

function actualiza_sol_nuevo(idcliente){


	divFormulario = document.getElementById('contenido');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_sol_nuevo.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("idcliente="+idcliente)

}


function actualiza_sol_cliente_modif(idsolicitud,idcliente,form){


	divFormulario = document.getElementById('contenido');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_sol_nuevo.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("idcliente="+idcliente+"&idsolicitud="+idsolicitud+"&form="+form)

}


function rellena_campo(idref,idcliente,form){
if(idref=="")
{
	alert("Referencia bancaria no puede ser vacia");
	return 0;
}


	divFormulario = document.getElementById('contenido_banco');

	ajax=objetoAjax();
	ajax.open("POST", "update_referencias.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("idref="+idref+"&idcliente="+idcliente+"&form="+form)

}

function add_referencia_banco(form){


if (document.captura.banco.value.length==0)
	{ 
      	 alert("Banco no puede ser vacio"); 
      	 document.captura.banco.focus(); 
      	 return 0; 
	}
	if (document.captura.sucursal.value.length==0)
	{ 
      	 alert("Sucursal no puede ser vacio"); 
      	 document.captura.sucursal.focus(); 
      	 return 0; 
	}
	
	if (document.captura.direccion.value.length==0)
	{ 
      	 alert("Direccion no puede ser vacio"); 
      	 document.captura.direccion.focus(); 
      	 return 0; 
	}
	if (document.captura.telefono.value.length==0)
	{ 
      	 alert("Telefono no puede ser vacio"); 
      	 document.captura.telefono.focus(); 
      	 return 0; 
	}
	
	if (document.captura.tipo_cuenta.value.length==0)
	{ 
      	 alert("Tipo de cuenta no puede ser vacio"); 
      	 document.captura.tipo_cuenta.focus(); 
      	 return 0; 
	}
	if (document.captura.no_cuenta.value.length==0)
	{ 
      	 alert("Num de cuenta no puede ser vacio"); 
      	 document.captura.no_cuenta.focus(); 
      	 return 0; 
	}
	if (document.captura.contacto.value.length==0)
	{ 
      	 alert("Contacto no puede ser vacio"); 
      	 document.captura.contacto.focus(); 
      	 return 0; 
	}
	
	alert("Referencia Bancaria sera agregada en unos momentos..");
	
	divFormulario = document.getElementById('update_ref_banco_modal');
	

	banco=document.captura.banco.value;
	sucursal=document.captura.sucursal.value;
	direccion=document.captura.direccion.value;
	telefono=document.captura.telefono.value;
	tipo_cuenta=document.captura.tipo_cuenta.value;
	no_cuenta=document.captura.no_cuenta.value;
	contacto=document.captura.contacto.value;
	
	
	enviar=document.captura.enviar.value;
	
	
	
	ajax=objetoAjax();
	ajax.open("POST", "add_select_ref.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			document.captura.banco.value="";
			document.captura.sucursal.value="";
			document.captura.direccion.value="";
			document.captura.telefono.value="";
			document.captura.tipo_cuenta.value="";
			document.captura.no_cuenta.value="";
		    document.captura.contacto.value="";
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("banco="+banco+"&sucursal="+sucursal+"&direccion="+direccion+"&telefono="+telefono+"&tipo_cuenta="+tipo_cuenta+"&enviar="+enviar+"&no_cuenta="+no_cuenta+"&contacto="+contacto)

}


function del_select_ref_banco(indice,form){
if(indice=="")
{
	alert("Referencia bancaria no puede ser vacia");
	return 0;
}


if(form==1)
{
divFormulario = document.getElementById('update_ref_banco_modal');
}
if(form==3)
{
divFormulario = document.getElementById('update_ref_banco');
}


if (confirm("Esta seguro de eliminar esta referencia bancaria ?"))
{

	ajax=objetoAjax();
	ajax.open("POST", "add_select_ref.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("indice="+indice+"&form="+form)

}

}

function add_referencia_personal(form){


if (document.captura.nombre.value.length==0)
	{ 
      	 alert("Nombre no puede ser vacio"); 
      	 document.captura.nombre.focus(); 
      	 return 0; 
	}
	if (document.captura.direccion.value.length==0)
	{ 
      	 alert("Direccion no puede ser vacio"); 
      	 document.captura.direccion.focus(); 
      	 return 0; 
	}
	

	if (document.captura.telefono.value.length==0)
	{ 
      	 alert("Telefono no puede ser vacio"); 
      	 document.captura.telefono.focus(); 
      	 return 0; 
	}
	

	alert("Referencia Personal sera agregada en unos momentos..");
	
	divFormulario = document.getElementById('update_ref_per_modal');
	

	nombre=document.captura.nombre.value;
	direccion=document.captura.direccion.value;
	telefono=document.captura.telefono.value;
	
	
	enviar=document.captura.enviar.value;
	
	
	
	ajax=objetoAjax();
	ajax.open("POST", "add_select_ref_per.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			document.captura.nombre.value="";
		    document.captura.direccion.value="";
			document.captura.telefono.value="";
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("nombre="+nombre+"&direccion="+direccion+"&telefono="+telefono+"&enviar="+enviar)

}

function del_select_ref_personal(indice,form){
if(indice=="")
{
	alert("Referencia Personal no puede ser vacia");
	return 0;
}


if(form==1)
{
divFormulario = document.getElementById('update_ref_per_modal');
}
if(form==3)
{
divFormulario = document.getElementById('update_ref_per');
}


if (confirm("Esta seguro de eliminar esta referencia Personal ?"))
{

	ajax=objetoAjax();
	ajax.open("POST", "add_select_ref_per.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("indice="+indice+"&form="+form)

}

}

function update_solicitud_grupal(idgrupo,form){
	
	if(idgrupo=="")
	{
		alert("Debe seleccionar un Grupo");
		return 0;
	}
	

	divFormulario = document.getElementById('solicitudes_grupos');

	ajax=objetoAjax();
	ajax.open("POST", "update_solicitudes_grupo.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//divFormulario.innerHTML = ajax.responseText
			
			
			
			data = ajax.responseText.split("*");
			divFormulario.innerHTML = data[0];
			//divSc_t.innerHTML = data[1];
			
			document.captura.grupo.value=data[1];
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	
if(form==1)
	{
ajax.send("idgrupo="+idgrupo+"&form="+form)
	}
	


}

function grupo_alta_solicitud_egos(form_m){
	
	if (document.captura.idgrupo.value.length==0)
	{ 
      	 alert("Nombre de grupo no puede ser vacio"); 
      	 document.captura.idgrupo.focus(); 
      	 return 0; 
	}
	
	
	if (document.captura.fecha_activacion.value.length==0)
	{ 
      	 alert("Fecha de activacion total no puede ser vacio"); 
      	 document.captura.fecha_activacion.focus(); 
      	 return 0; 
	}
	
	if (document.captura.idproducto.value.length==0)
	{ 
      	 alert("Producto Financiero no puede ser vacio"); 
      	 document.captura.idproducto.focus(); 
      	 return 0; 
	}
	
if(form_m==1)
	{
	
	idsolgrupo=document.captura.idsolgrupo.value;
	
	}



alert("Muchas gracias la informacion ha sido enviada");




	divFormulario = document.getElementById('contenido');
	
	
	
	
	
	
	
	idgrupo=document.captura.idgrupo.value;
	fecha_activacion=document.captura.fecha_activacion.value;
	idproducto=document.captura.idproducto.value;
	
	enviar=document.captura.enviar.value;
	
	
	
	
	
	ajax=objetoAjax();
	ajax.open("POST", "serv_sol_grupo.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			//divFormulario.style.display="block";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");


if(form_m==1) //modificar
{
	
	//alert("aca estamos");
ajax.send("idgrupo="+idgrupo+"&fecha_activacion="+fecha_activacion+"&idproducto="+idproducto+"&enviar="+enviar+"&idsolgrupo="+idsolgrupo);

}
if(form_m==2)
{
ajax.send("idgrupo="+idgrupo+"&fecha_activacion="+fecha_activacion+"&idproducto="+idproducto+"&enviar="+enviar);
}
}

function add_sol_grupal(idsolicitud,form){
	
	if(idsolicitud=="")
{
 alert("Seleccione Solicitud"); 
 return 0; 
				 
}
	
	if(form==1)
	msj="Solicitud Individual";
	
	
	if (confirm("Desea agregar "+msj+" "))
	{
	
	  if(form==1)
	  {
	  divFormularios = document.getElementById('contenido');
	  idsolgrupo=document.captura.idsolgrupo.value;
	  
	  }
	
		ajax=objetoAjax();



ajax.open("POST", "add_sol_grupos.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			
			if(ajax.responseText==0) //mando un error
			{
			alert("Esta solicitud ya ha sido agregado");
			}
			else
			{
			divFormularios.innerHTML = ajax.responseText
			//divFormulario2.innerHTML = ajax.responseText
			//divFormulario2.style.display="block";
			divFormularios.style.display="block";
			}
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("idsolicitud="+idsolicitud+"&idsolgrupo="+idsolgrupo+"&form="+form)



}
}
function add_sol_grupal_del(idrelasol,form){
	
	if(idrelasol=="")
{
 alert("Seleccione Solicitud a Eliminar"); 
 return 0; 
				 
}
	
	if(form==2)
	msj="Solicitud Individual";
	
	
	if (confirm("Desea Eliminar "+msj+" "))
	{
	
	  if(form==2)
	  {
	  divFormularios = document.getElementById('contenido');
	  idsolgrupo=document.captura.idsolgrupo.value;
	  
	  }
	
		ajax=objetoAjax();



ajax.open("POST", "add_sol_grupos.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			
			if(ajax.responseText==0) //mando un error
			{
			alert("Esta solicitud ya no esta en tramite no es posible desagrupar");
			}
			else
			{
			divFormularios.innerHTML = ajax.responseText
			//divFormulario2.innerHTML = ajax.responseText
			//divFormulario2.style.display="block";
			divFormularios.style.display="block";
			}
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("idrelasol="+idrelasol+"&idsolgrupo="+idsolgrupo+"&form="+form)



}
}
function update_solicitud_grupal_update(idsolgrupo,form){
	
	if(idsolgrupo=="")
	{
		alert("Debe seleccionar una Solicitud Grupal");
		return 0;
	}
	

	divFormulario = document.getElementById('contenido');

	ajax=objetoAjax();
	ajax.open("POST", "update_solicitudes_grupo.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//divFormulario.innerHTML = ajax.responseText
			
			
			
			data = ajax.responseText.split("*");
			divFormulario.innerHTML = data[0];
			
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	
ajax.send("idsolgrupo="+idsolgrupo+"&form="+form)

}

function update_solicitud_grupal_update_div(idgrupo,form){
	
	if(idgrupo=="")
	{
		alert("Debe seleccionar un Grupo");
		return 0;
	}
	

	divFormulario = document.getElementById('contenido');

	ajax=objetoAjax();
	ajax.open("POST", "update_solicitudes_grupo.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//divFormulario.innerHTML = ajax.responseText
			
			
			
			data = ajax.responseText.split("*");
			divFormulario.innerHTML = data[0];
			//divSc_t.innerHTML = data[1];
			
			
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("idgrupo="+idgrupo+"&form="+form)
	


}

function actualiza_grupo_selec(form){


		//alert("Muchas gracias la informacion ha sido enviada");
	if(form==1)
	{
	idgrupo=document.captura.idgrupos.value;
	}
	
	divFormulario = document.getElementById('contenido');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_grupo_selec.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	
if(form==1)
ajax.send("idgrupo="+idgrupo+"&form="+form)
if(form==2)
ajax.send("form="+form)

}

function actualiza_sol_expediente(idcliente,form){

if(idcliente=="")
{
 alert("Selecciona  un cliente"); 
 document.captura.idcliente.focus(); 
 return 0; 
				 
}

	divFormulario = document.getElementById('update_sol');
	//carga = document.getElementById('carga');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_expediente_selec.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			

			divFormulario.innerHTML = ajax.responseText
			
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	


ajax.send("idcliente="+idcliente+"&form="+form)


}
function actualiza_detalle_cliente_solicitud(idsolicitud,form){
if(idsolicitud=="")
{
 alert("Selecciona  Solicitud"); 
 document.captura.idsolicitud.focus(); 
 return 0; 
				 
}

	divFormulario = document.getElementById('detalles');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_expediente_selec.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("idsolicitud="+idsolicitud+"&form="+form)

}

function entrega_doc(id,valor,form,idsolicitud){
	if (confirm('Cambiando status del documento'))
	{
		if(document.getElementById(''+id+'').checked)
		{
		estatus=1;
		}
		else
		{
		estatus=0;
		}
	 
			divFormulario = document.getElementById('detalles');
			ajax=objetoAjax();
			ajax.open("POST", "actualiza_expediente_selec.php");
				divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
			ajax.onreadystatechange=function() {
				if (ajax.readyState==4) {
					
					if(ajax.responseText==0)
					{
						alert("Ocurrio un problema acuda con el admon del sistema");
						return 0;
					}
					else
					{
					divFormulario.innerHTML = ajax.responseText
					//alert (estatus);
					//divFormulario.style.display="block";
					}
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("valor="+valor+"&form="+form+"&idsolicitud="+idsolicitud+"&estatus="+estatus)
	}

}

function envia_comite(idsolicitud){

	form=5;
	divFormulario = document.getElementById('detalles');

if (confirm('Estas completamente seguro de enviar a comite'))
	{

				ajax=objetoAjax();
				ajax.open("POST", "actualiza_expediente_selec.php");
				divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
				ajax.onreadystatechange=function() {
					if (ajax.readyState==4) {
						divFormulario.innerHTML = ajax.responseText
						
						
									
					}
				}
				ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				
			
			ajax.send("idsolicitud="+idsolicitud+"&form="+form)
	}

}

function actualiza_perfil_permiso(form){


	if(form==1)
	{
	
		if (document.captura.perfil_ids.value.length==0)
			{ 
				 alert("Perfil no puede ser vacio"); 
				 document.captura.perfil_ids.focus(); 
				 return 0; 
			}
	
	
	perfil_id=document.captura.perfil_ids.value;
	
	}

	//alert("Muchas gracias la informacion ha sido enviada");
	
	divFormulario = document.getElementById('contenido');

	
	

	
	
	
	//enviar=document.captura.enviar.value;
	
	
	
	ajax=objetoAjax();
	ajax.open("POST", "actualiza_formu_p.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

if(form==1)
ajax.send("perfil_id="+perfil_id+"&form="+form)
if(form==2)
ajax.send("form="+form)

}

function asigna_permisos(){

	if (confirm('Esta Seguro de Asignar este Permiso !!'))
	{

		if (document.captura.id_menu.value.length==0)
			{ 
				 alert("Permiso a asignar no puede ser vacio"); 
				 document.captura.id_menu.focus(); 
				 return 0; 
			}


var	form=2; //para asignar perfiles
	divFormulario = document.getElementById('contenido');
	
	perfil_id=document.captura.perfil_id.value;
	id_menu=document.captura.id_menu.value;
	
	
	
	
	
	ajax=objetoAjax();
	ajax.open("POST", "actualiza_formu_p.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			if(ajax.responseText==0)
			{
				alert("Acuda con admon del sistema ha ocurrido un error !!");
			}
			else
			{
			divFormulario.innerHTML = ajax.responseText;
			}
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("perfil_id="+perfil_id+"&form="+form+"&id_menu="+id_menu)
	
	}

}

function elimina_perfil_usr(perfil_id,id_permiso)
{
	if (confirm('Esta Seguro de ELIMINAR Permiso !!!!'))
	{

		


var	form=3; //elimina permiso
	divFormulario = document.getElementById('contenido');
	
	
	ajax=objetoAjax();
	ajax.open("POST", "actualiza_formu_p.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			if(ajax.responseText==0)
			{
				alert("Acuda con admon del sistema ha ocurrido un error !!");
			}
			else
			{
			divFormulario.innerHTML = ajax.responseText;
			}
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("perfil_id="+perfil_id+"&form="+form+"&id_permiso="+id_permiso)
	
	}
}


