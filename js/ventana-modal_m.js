/*
 * Static Class VentanaModal
 * 
 * Creado por Victor Manuel Merino Martinez
 * Version: 1.0
 *
 *
 * Metodos "publicos":
 *		- getInstancia()
 *		- setSize(Number: ancho, Number: alto)
 *		- setClaseVentana(String: nombreClase)
 *		- setSombra(Boolean: sombra)
 *		- setSombraSize(Number: sombraSize)
 *		- setClaseSombra(String: nombreClase)
 *		- setIdVentana(String: idVentana)
 *		- setClaseFondo(String: nombreClase)
 *		- setContenido(String: contenidoHtml)
 *		- mostrar()
 *		- cerrar()
 *
 * Metodos "privados":
 *		- inicializar()
 *		- redimensionar()
 *		- crear()
 *
 * Metodos de utilidades:
 *		- medio()
 *
 *
 *
 *
 */

var VentanaModal = {
	
	inicializado		: false,
	creado				: false,
	ancho				: 0,
	alto				: 0,
	sombra				: false,
	csombra				: null,
	tsombra				: 0,
	claseSombra			: "",
	ventana				: null,
	idVentana			: "",
	claseVentana		: "",
	MSIE				: false,
	fondo				: null,
	claseFondo			: "",
	
	getInstancia: function() {
		this.inicializar();
		this.crear();
		return this;
	},
	
	setSize: function(ancho, alto) {
		this.alto = parseInt(alto);
		this.ancho = parseInt(ancho);
		this.ventana.style.width = this.ancho + "px";
		this.ventana.style.height = this.alto + "px";
		this.csombra.style.width = this.ancho + "px";
		this.csombra.style.height = this.alto + "px";
		this.redimensionar();
		
	},
	
	setClaseVentana: function(nombreClaseVentana) {
		this.claseVentana = nombreClaseVentana;
		this.ventana.className = this.claseVentana;
	},
	
	setSombra: function(sombra) {
		if (sombra == true) {
			this.sombra = true;
			this.csombra.style.display = "inline";
		}
		else {
			this.sombra = false;
			this.csombra.style.display = "none";
		}
	},
	
	setSombraSize: function(tsombra) {
		this.tsombra = tsombra;
		this.redimensionar();
	},
	
	setClaseSombra: function(claseSombra) {
		this.claseSombra = claseSombra;
		this.csombra.className = this.claseSombra;
	},
	
	setIdVentana: function(id) {
		this.idVentana = id;
		this.ventana.id = this.idVentana;
	},
	
	setClaseFondo: function(claseFondo) {
		this.claseFondo = claseFondo;
		this.fondo.className = this.claseFondo;
	},
	
	setContenido: function(html) {
		this.ventana.innerHTML = html;
	},
	
	mostrar: function() {
		this.fondo.style.display = "inline";
		this.ventana.style.display = "inline";
		if (this.sombra)
			this.csombra.style.display = "inline";
	},

	cerrar: function(id_concepto,id_pedido) {
		document.location.href="agrega_materiales.php?id_concepto="+id_concepto+"&id_pedido="+id_pedido;
		this.ventana.style.display = "none";
		this.csombra.style.display = "none";
		this.fondo.style.display = "none";
	},
	
	cerrar_o: function(id_concepto,id_pedido) {
		document.location.href="agrega_ayuda.php?id_concepto="+id_concepto+"&id_pedido="+id_pedido;
		this.ventana.style.display = "none";
		this.csombra.style.display = "none";
		this.fondo.style.display = "none";
	},
	
	cerrar_con: function(id_obra) {
		document.location.href="../conceptos/alta_concepto.php?id_obra="+id_obra;
		this.ventana.style.display = "none";
		this.csombra.style.display = "none";
		this.fondo.style.display = "none";
	},
	
	cerrar_concep: function(id_obra) {
		document.location.href="../conceptos/alta_concepto.php?id_obra="+id_obra;
		this.ventana.style.display = "none";
		this.csombra.style.display = "none";
		this.fondo.style.display = "none";
	},
	
	cerrar_ayuda: function(id_concepto,id_pedido) {
		document.location.href="agrega_ayuda.php?id_concepto="+id_concepto+"&id_pedido="+id_pedido;
		this.ventana.style.display = "none";
		this.csombra.style.display = "none";
		this.fondo.style.display = "none";
	},
	
	medio: function(v1, v2) {
		if (isNaN(v1) && v1.indexOf("px") != -1)
			v1 = v1.replace("px", "");
		if (isNaN(v2) && v2.indexOf("px") != -1)
			v2 = v2.replace("px", "");
		var aux = parseInt(v1) / 2;
		aux = aux - (parseInt(v2) / 2);
		return parseInt(aux) * (+1);
	},
	
	inicializar: function() {
		if (this.inicializado) 
			return;
		window.onresize = function() {
			VentanaModal.redimensionar();
		};
		
		this.ancho = 300;
		this.alto = 200;
		this.sombra = true;
		this.tsombra = 5;
		this.claseSombra = "ventana-modal-sombra";
		this.claseFondo = "ventana-modal-fondo";
		this.claseVentana = "ventana-modal-ventana";
		
		if (navigator.userAgent.indexOf('MSIE') >= 0) 
			this.MSIE = true;
			
		this.inicializado = true;
		this.crear();
	},
	
	redimensionar: function() {
		var top = 0;
		var left = 0;
		var alto = 0;
		if (this.MSIE) {
			this.fondo.style.width = document.body.clientWidth;
      if (document.body.clientHeight)
				this.fondo.style.height = document.body.clientHeight;
			else if (document.documentElement)
				this.fondo.style.height = document.documentElement.clientHeight;
		}
		else {
			this.fondo.style.width = "100%";
			this.fondo.style.height = "100%";
		}
		if (this.MSIE) {
			top = this.medio(document.body.clientHeight, this.alto);
			left = this.medio(document.body.clientWidth, this.ancho);
		}
		else {
			top = this.medio(innerHeight, this.alto);
			left = this.medio(innerWidth, this.ancho);
		}
		this.ventana.style.top = top + "px";
		this.ventana.style.left = left + "px";
		this.csombra.style.top = (parseInt(top) + this.tsombra) + "px";
		this.csombra.style.left = (parseInt(left) + this.tsombra) + "px";
	},
	
	crear: function() {
		if (this.creado) 
			return;
		this.fondo = document.createElement("DIV");
		this.fondo.style.position = "absolute";
		this.fondo.style.left = "0px";
		this.fondo.style.top = "0px";
		this.fondo.style.display = "none";
		this.fondo.className = this.claseFondo;
		this.fondo.style.zIndex = 90000;
		this.fondo.style.textAlign = "center";
		document.body.appendChild(this.fondo);
		
		this.ventana = document.createElement("DIV");
		document.body.appendChild(this.ventana);
		this.ventana.style.display = "none";
		this.ventana.style.position = "absolute";
		//this.ventana.style.overflow = "auto";
		this.ventana.style.zIndex = 100000;
		this.ventana.style.width = this.ancho + "px";
		this.ventana.style.height = this.alto + "px";
		this.ventana.className = this.claseVentana;
		
		this.csombra = document.createElement("DIV");
		document.body.appendChild(this.csombra);
		this.csombra.style.display = "none";
		this.csombra.style.position = "absolute";
		this.csombra.style.zIndex = 95000;
		this.csombra.style.width = this.ancho + "px";
		this.csombra.style.height = this.alto + "px";
		this.csombra.className = this.claseSombra;
		
		this.creado = true;
		this.redimensionar();
	}
};

function abrirVentana(pagina, ancho, alto, nombre) {
    VentanaModal.inicializar();
    var html = ""
    + "<table cellpadding='3' cellspacing='0' border='0' class='ventana-modal-ventana'><tr><td class='ventana-modal-barra' align='right'>"
   
    + "</td></tr><tr><td>"
    + "<iframe name='" + nombre + "' src='" + pagina + "' width='100%' height='" + (parseInt(alto) - 30) + "' frameborder='0' scrolling='NO'></iframe>"
    + "</td></tr></table>";
    
    VentanaModal.setSize(ancho, alto);
    VentanaModal.setClaseVentana("");
    VentanaModal.setContenido(html);
	VentanaModal.mostrar();
	
}