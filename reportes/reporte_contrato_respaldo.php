<?php 
ob_start(); 
require_once('../TCPDF/tcpdf/config/lang/eng.php');
require_once('../TCPDF/tcpdf/tcpdf.php');
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
$con=conectarse();
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

//$pdf->setPageOrientation("l");

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Software development');
$pdf->SetTitle('CONTRATO DE CREDITO');
$pdf->SetSubject('otro');
$pdf->SetKeywords('otro');


$pdf->setPrintHeader(false); //elimina header
$pdf->setPrintFooter(false); //elimina footer


// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "EXPORTADORA DE GRANOS Y OLEAGINOSAS DEL SURESTE S.A. DE C.V.", "EGO-910528-HX9 \n CARRETERA A NVA. ALEMANIA, KM. 2.5, COL. ".utf8_encode("BUROCRÁTICA").", TAPACHULA, CHIAPAS.");

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetMargins(2,2,2);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(7);

//set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetAutoPageBreak(TRUE, 2);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '',8);

// add a page
$pdf->AddPage();

$idcredito=$_GET["idcredito"];
$fila_credito=get_credito_m($idcredito);
$fila_sol=get_solicitud_m($fila_credito["idsolicitud"]);
$fila_cliente=get_cliente($fila_sol["idcliente"]);					
$nombre_cliente=$fila_cliente["ap_paterno"]." ".$fila_cliente["ap_materno"]." ".$fila_cliente["nombre"];
$monto=$fila_credito["monto"];
$letra = explode(".",$monto);
$entero=$letra[0];
$decimal=$letra[1];
$resultado = convertir_letra($entero);
$monto_letra="(  $resultado PESOS $decimal/100 MONEDA NACIONAL  )";


$idlocalidad=$fila_cliente["idlocalidad"];
$idmunicipio=$fila_cliente["idmunicipio"];
$idestado=$fila_cliente["idestado"];
$idcolonia=$fila_cliente["idcolonia"];

$fila_localidad=get_localidad($idlocalidad);
$fila_municipio=get_municipio($idmunicipio);
$fila_estado=get_estado($idestado);
$fila_colonia=get_colonia($idcolonia);

$localidad=$fila_localidad["localidad"];
$estado=$fila_estado["estado"];
$municipio=$fila_municipio["municipio"];

$ubicacion="$localidad del municipio de $municipio del estado de $estado";

$fecha=date("d-m-Y");




?>

<table width="100%" border="0" cellpadding="4" cellspacing="0">
 <tr><td colspan="3">CONTRATO DE APERTURA DE CREDITO DE HABILITACION O AVIO, QUE CELEBRAN POR UNA PARTE EXPORTADORA DE GRANOS Y OLEAGINOSAS DEL SURESTE, S.A. DE C.V., REPRESENTADA EN ESTE ACTO POR SU ADMINISTRADOR UNICO Y APODERADO LEGAL EL SE&Ntilde;ORCPA.JORGE ARTURO VARELA ROSALESEN LO SUCESIVO Y PARA TODOS LOS EFECTOS DE ESTE CONTRATO SE DENOMINARA &quot;LA ACREDITANTE&quot;; Y POR LA OTRA PARTE EL (LA) SE&Ntilde;OR(A)<?php echo $nombre_cliente; ?> EN LO SUCESIVO Y PARA TODOS LOS EFECTOS DE ESTE CONTRATO SE DENOMINARA &quot;EL ACREDITADO&quot;, COMPARECE ADEMAS EL SE&Ntilde;OR ____________________, EN SU CARACTER DE &quot;AVALISTA&quot;, CONTRATO EL CUAL SUJETAN AL TENOR DE LAS SIGUIENTES DECLARACIONES Y CLAUSULAS:</td></tr>
 
  <tr>
    <td width="50%" colspan="2" align="justify" style="border-right-style:solid;"><div align="center">DECLARACIONES</div>
      I.- Declara &quot;LA ACREDITANTE&quot;, por conducto de su representante legal que: <br />
      a) Su representada es una persona moral legalmente constituida conforme a la Legislaci&oacute;n Mercantil Mexicana Vigente, con plena capacidad jur&iacute;dica para
      celebrar el presente contrato y cuyos datos y antecedentes constan en la ESCRITURA PUBLICA NUMERO 5651, VOLUMEN 83, DE FECHA 11 DE JUNIO DE 
      1991, PASADA ANTE LA FE DEL LICENCIADO JORGE CRUZ TOLEDO TRUJILLO, NOTARIO PUBLICO NUMERO 27 DEL ESTADO E INSCRITA BAJO EL 
      NUMERO 561 LIBRO 2 DE LA SECCION QUINTA DEL REGISTRO PUBLICO DE LA PROPIEDAD DEL COMERCIO DE TAPACHULA, CHIAPAS, CON 
      FECHA 27 DE JUNIO DEL A&Ntilde;O DE SU OTORGAMIENTO. <br />
      b) Cuenta con facultades suficientes para celebrar a nombre y representaci&oacute;n de su poderdante el presente contrato y obligarla en los t&eacute;rminos que a 
      continuaci&oacute;n se mencionan, mismas que constan en el documento se&ntilde;alado en el inciso anterior y que a la fecha no le han sido revocadas ni restringidas de 
      forma alguna. <br />
      c) Conf echa 28/10/2009 celebr&oacute; contrato de apertura de HABILITACION O AVIO con BANCO DEL BAJIO SA Instituci&oacute;n de Banca M&uacute;ltiple, en adelante EL 
      BANCO,mismo que se ratific&oacute; ante la fe del Licenciado LIC. ALEJANDRO MONCADA ALVAREZ Cuyo destino es el otorgamiento de cr&eacute;ditos de habilitaci&oacute;n o 
      av&iacute;o a productores de los Estratos PD1 y PD2, al amparo del programa de operaciones con Agentes Parafinancieros dentro del esquema OPERACIONES 
      CON INTERMEDIACION FINANCIERA ENTRE EL BANCO DESCONTATARIO Y LOS BENEFICIARIOS FINALES que han instituido los FIDEICOMISOS 
      INSTITUIDOS EN RELACI&Oacute;N CON LA AGRICULTURA (FIRA) para apoyo a la cosecha, acopio y beneficiado de caf&eacute;, de conformidad con la normatividad de 
      FIRA. <br />
      d) Que mediante CONVENIO MODIFICATORIO de fecha 19/11/2008, la fecha de vencimiento se&ntilde;alada en la CLAUSULA TERCERA. PLAZO del CONTRATO 
      DE APERTURA DE CREDITO DE HABILITACION O AVIO mencionado en el inciso c) precedente, se prorrog&oacute; al 20 de Enero de 2012, dejando subsistentes el 
      resto del clausulado. <br />
      e) Que mediante CONVENIO MODIFICATORIO DE fecha 28/10/2009, se convino entre las partes contratantes la modificaci&oacute;n de diversas cl&aacute;usulas al 
      CONTRATO DE APERTURA DE CREDITO DE HABILITACION O AVIO indicado en el inciso c) precedente, en el que, entre otras modificaciones otorgadas,
      se acord&oacute; la de prorrogar la fecha de vencimiento del contrato indicado al 20/01/2014. <br />
      f) Que dicho cr&eacute;dito ser&aacute; descontado al amparo de las l&iacute;neas de fondeo otorgadas por el FIRA como intermediario del BANCO DE MEXICO. <br />
      II.- Declara &quot;EL(LOS) ACREDITADO(S)&quot; que: <br />
      a) Es una persona f&iacute;sica, agricultor dedicado a la producci&oacute;n de caf&eacute;, con plena capacidad legal para celebrar el presente contrato y obligarse en los t&eacute;rminos 
      del mismo. <br />
      b).- Que la informaci&oacute;n personal as&iacute; como los datos e informaci&oacute;n relativos a su condici&oacute;n de productor de caf&eacute;, del(los) predio(s) en que la desarrolla, 
      domicilio, etc., as&iacute; como las condiciones de contrataci&oacute;n del cr&eacute;dito que se le otorga, se encuentran consignados al reverso de este contrato, mismos que 
      reconoce como ciertos y propios de &eacute;l, de su explotaci&oacute;n y del contrato celebrado con &quot;LA ACREDITANTE&quot;. <br />
      III.- Declara el(los) &quot;DEUDOR(ES) SOLIDARIO(S) Y AVALISTA(S)&quot; que:: <br />
      a) Es(son) persona(s) f&iacute;sica(s), con plena capacidad legal para celebrar el presente contrato y obligarse en los t&eacute;rminos del mismo. <br />
      b) Tiene(n) inter&eacute;s en el otorgamiento del cr&eacute;dito a favor de &quot;EL(LOS) ACREDITADO(S)&quot; raz&oacute;n por la cual comparece(n) a la celebraci&oacute;n del presente contrato. <br />
      IV.- Que, con independencia de la forma en que se escriba, min&uacute;sculas o may&uacute;sculas, negritas o subrayadas o de cualquier otra forma, cuando se mencione en 
      este contrato &quot;LA ACREDITANTE&quot; se har&aacute; referencia a EGOS, S. A. de C. V.; &quot;EL ACREDITADO&quot; se referir&aacute; expresamente al(los) se&ntilde;or(es):<?php echo $nombre_cliente; ?> y el(los) DEUDOR(ES) SOLIDARIO(S) Y AVALISTA(S), se har&aacute; referencia expresa al (los se&ntilde;or(es): 
      <div align="center">C L A U S U L A S</div> 
        PRIMERA: APERTURA DE CREDITO: &quot;LA ACREDITANTE&quot; otorga a &quot;EL ACREDITADO&quot; un cr&eacute;dito de habilitaci&oacute;n o av&iacute;o hasta por la cantidad de $ 
        <?php echo number_format($monto,2)." ($monto_letra)"; ?>cantidad que no contempla intereses, comisiones y gastos que origine su ejercicio y disposic&oacute;on que 
        deber&aacute; cubrir &quot;EL ACREDITADO&quot; en los t&eacute;rminos y condiciones aqui establecidos. <br />
        SEGUNDA. OBJETO: &quot;EL ACREDITADO&quot; se obliga a destinar el importe del cr&eacute;dito que se le otorga &uacute;nica y exclusivamente como apoyo al CAPITAL DE 
        TRABAJO para el desarrollo y realizaci&oacute;n de las labores de corte, beneficio y acarreo, en el predio cuyas de su propiedad o posesi&oacute;n cuyas caracter&iacute;sticas y 
        superficie est&aacute;n consignadas al reverso de este contrato.
        EL ACREDITADO&quot; se obliga adem&aacute;s a aportar con recursos propios, la cantidad : $ 16,280.70 (DIECISEIS MIL DOSCIENTOS OCHENTA PESOS 70/100 
        M.N.) como contribuci&oacute;n personal para complementar los importes necesarios para desarrollar a cabalidad las labores se&ntilde;aladas en el p&aacute;rrafo anterior para las 
        cuales le fue proporcionado el cr&eacute;dito y as&iacute; consolidar totalmente el proyecto. <br />
        TERCERA: PLAZO. El plazo de duraci&oacute;n de este Contrato es de 180 (ciento ochenta) d&iacute;as, el cual comenzar&aacute; a correr a partir de la fecha de firma del presente contrato. <br />
        CUARTA: DISPOSICI&Oacute;N DEL CR&Eacute;DITO. &quot;EL ACREDITADO&quot; podr&aacute; disponer del cr&eacute;dito concedido mediante la suscripci&oacute;n de un s&oacute;lo pagar&eacute; a favor de &quot;LA 
        ACREDITANTE&quot;, dentro de un plazo que no exceder&aacute; de 90 noventa d&iacute;as naturales a partir de la firma de este contrato. El referido pagar&eacute; ser&aacute; de tipo causal 
        y, en consecuencia, no constituye novaci&oacute;n, modificaci&oacute;n o extinci&oacute;n de las obligaciones que &quot;EL ACREDITADO&quot; ha contra&iacute;do a favor de &quot;LA ACREDITANTE&quot;        en este Contrato. En caso de que por cualquier causa se d&eacute; por terminado este Contrato o se declare su vencimiento anticipado, en los mismos t&eacute;rminos, &quot;LA 
        ACREDITANTE&quot; podr&aacute; dar por vencido anticipadamente el pagar&eacute;. <br />
        El pagar&eacute; mediante el cual &quot;EL ACREDITADO&quot; disponga del financiamiento contratado, se otorgar&aacute; por un plazo m&aacute;ximo de 180 (ciento ochenta) d&iacute;as pero, en 
        ning&uacute;n caso, la fecha de vencimiento de dicho instrumento mercantil podr&aacute; exceder del de la vigencia de este contrato se&ntilde;alado en la CLAUSULA TERCERA . <br />
        PLAZO. <br />
        QUINTA: FECHA DE PAGO. &quot;EL ACREDITADO&quot; se obliga a reintegrar a &quot;LA CREDITANTE&quot; el importe total de la disposici&oacute;n que se realice al amparo del 
        cr&eacute;dito que se otorga a trav&eacute;s del presente instrumento m&aacute;s sus intereses y, en su caso, los gastos que corresponda, precisamente en la fecha en que se pacte el vencimiento del pagar&eacute; mediante el cual se disponga del financiamiento aqu&iacute; contratado. El monto y la fecha de pago de la disposici&oacute;n se har&aacute;n constar en 
        el pagar&eacute; que &quot;EL ACREDITADO&quot; suscriba para acreditar las disposiciones.<br />
        SEXTA: LUGAR Y FORMA DE PAGO DEL CR&Eacute;DITO. Todas las cantidades que &quot;EL ACREDITADO&quot; deba pagar por concepto de capital, comisiones e intereses, ser&aacute;n pagaderas en el domicilio de &quot;LA ACREDITANTE&quot;, mismo que se establece en la Cl&aacute;usula D&eacute;cimo Octava del presente contrato, en d&iacute;as y 
        horas h&aacute;biles sin necesidad de requerimiento o cobro previos.<br />
        S&Eacute;PTIMA: INTERESES: &quot;EL ACREDITADO&quot;, se obliga a pagar a &quot;LA ACREDITANTE&quot; por concepto de Intereses: <br />
        A) INTERESES ORDINARIOS: A.1 Para el caso de que los recursos con los que &quot;LA ACREDITANTE&quot; proporcione el financiamiento objeto de este contrato a &quot;EL ACREDITADO&quot;, provengan 
        de fondos proporcionados directamente por EL BANCO: <br />
        &quot;EL ACREDITADO&quot; se obliga a pagar Intereses Ordinarios sobre Saldos Insolutos, a raz&oacute;n de la tasa fija o variable que determinen las partes en la car&aacute;tula 
        anexa, de acuerdo a lo siguiente: <br /> TASA FIJA.- Si las partes acuerdan mutuamente la aplicaci&oacute;n de una tasa fija, &eacute;sta se expresar&aacute; en el apartado de TASA FIJA y se indicar&aacute;n los PUNTOS 
        PORCENTUALES que de manera mensual se aplicar&aacute;n a los saldos insolutos que &quot;LA ACREDITADA&quot; mantenga insolutos con &quot;LA ACREDITANTE&quot;. <br />
        TASA VARIABLE.- Si las partes acuerdan la aplicaci&oacute;n de una tasa variable sobre los saldos insolutos a cargo de &quot;EL ACREDITADO&quot;, &eacute;sta se expresar&aacute; en el 
        apartado TASA VARIABLE y se indicar&aacute;n los PUNTOS PORCENTUALES que se adicionar&aacute;n al promedio aritm&eacute;tico diario de la &quot;Tasa de Referencia&quot; del 
        periodo de c&oacute;mputo de los intereses. Para los efectos de este punto se entender&aacute; por &quot;Tasa de Referencia&quot; la tasa anual de Inter&eacute;s Interbancaria de Equilibrio 
        (TIIE) a plazo de 28 d&iacute;as, que publica peri&oacute;dicamente el Banco de M&eacute;xico en el Diario Oficial de la Federaci&oacute;n. 
        La tasa de inter&eacute;s ser&aacute; modificable hacia el alza o hacia la baja, conforme a las variaciones de la Tasa de Referencia y se ajustara autom&aacute;ticamente. &quot;EL 
        ACREDITADO&quot; desde ahora se compromete expresamente a pagar intereses conforme a la nueva tasa desde el momento en que se &eacute;sta ajuste conforme a lo <br />
        expresado en este aparatado. <br />
        A.2 Para el caso de que los recursos con los que &quot;LA ACREDITANTE&quot; proporcione el financiamiento objeto de este contrato a &quot;EL ACREDITADO&quot;, provengan 
        de fondos descontados por EL BANCO de los recursos otorgados por el FIRA:        &quot;EL ACREDITADO&quot; se obliga a pagar intereses ordinarios sobre Saldos Insolutos, a raz&oacute;n de la tasa fija o variable que determinen las partes en la car&aacute;tula 
        anexa, de acuerdo a lo siguiente: <br />
        TASA FIJA.- Si las partes acuerdan mutuamente la aplicaci&oacute;n de una tasa fija, &eacute;sta se expresar&aacute; en el apartado de TASA FIJA y se indicar&aacute;n los PUNTOS 
        PORCENTUALES que de manera mensual se aplicar&aacute;n a los saldos insolutos que &quot;LA ACREDITADA&quot; mantenga insolutos con &quot;LA ACREDITANTE&quot;. <br />
        TASA VARIABLE.- Si las partes acuerdan la aplicaci&oacute;n de una tasa variable sobre los saldos insolutos a cargo de &quot;EL ACREDITADO&quot;, &eacute;sta se expresar&aacute; en el 
        apartado TASA VARIABLE y se indicar&aacute;n los PUNTOS PORCENTUALES que se adicionar&aacute;n al promedio aritm&eacute;tico diario de la &quot;Tasa de Referencia&quot; del 
        periodo de c&oacute;mputo de los intereses. Para los efectos de este punto se entender&aacute; por &quot;Tasa de Referencia&quot; la tasa anual de Inter&eacute;s Interbancaria de Equilibrio 
        (TIIE) a plazo de 28 d&iacute;as, que publica peri&oacute;dicamente el Banco de M&eacute;xico en el Diario Oficial de la Federaci&oacute;n. 
        La tasa de inter&eacute;s ser&aacute; modificable hacia el alza o hacia la baja, conforme a las variaciones de la Tasa de Referencia y se ajustara autom&aacute;ticamente. &quot;EL 
        ACREDITADO&quot; desde ahora se compromete expresamente a pagar intereses conforme a la nueva tasa desde el momento en que se &eacute;sta ajuste conforme a lo <br />
        expresado en este aparatado. <br />
        A.3 Para el caso de que los recursos con los que &quot;LA ACREDITANTE&quot; proporcione el financiamiento objeto de este contrato a &quot;EL ACREDITADO&quot;, provengan 
        directamente de sus propios fondos o de cualquier otra fuente de fondeo de origen nacional o internacional: <br />
        &quot;EL ACREDITADO&quot; se obliga a pagar intereses ordinarios sobre Saldos Insolutos, a raz&oacute;n de la tasa fija o variable que determinen las partes en la car&aacute;tula 
        anexa, de acuerdo a lo siguiente: <br />
        TASA FIJA.- Si las partes acuerdan mutuamente la aplicaci&oacute;n de una tasa fija, &eacute;sta se expresar&aacute; en el apartado de TASA FIJA y se indicar&aacute;n los PUNTOS 
        PORCENTUALES que de manera mensual se aplicar&aacute;n a los saldos insolutos que &quot;LA ACREDITADA&quot; mantenga insolutos con &quot;LA ACREDITANTE&quot;. <br />
        TASA VARIABLE.- Si las partes acuerdan la aplicaci&oacute;n de una tasa variable sobre los saldos insolutos a cargo de &quot;EL ACREDITADO&quot;, &eacute;sta se expresar&aacute; en el 
        apartado TASA VARIABLE y se indicar&aacute;n los PUNTOS PORCENTUALES que se adicionar&aacute;n al promedio aritm&eacute;tico diario de la &quot;Tasa de Referencia&quot; del 
        periodo de c&oacute;mputo de los intereses. Para los efectos de este punto se entender&aacute; por &quot;Tasa de Referencia&quot; la tasa anual de Inter&eacute;s Interbancaria de Equilibrio 
        (TIIE) a plazo de 28 d&iacute;as, que publica peri&oacute;dicamente el Banco de M&eacute;xico en el Diario Oficial de la Federaci&oacute;n. La tasa de inter&eacute;s ser&aacute; modificable hacia el alza <br />
        o hacia la baja, conforme a las variaciones de la Tasa de Referencia y se ajustara autom&aacute;ticamente. &quot;EL ACREDITADO&quot; desde ahora se compromete 
        expresamente a pagar intereses conforme a la nueva tasa desde el momento en que se &eacute;sta ajuste conforme a lo expresado en este aparatado. 
        Cualquiera que sea la Tasa de Intereses Ordinarios que se asuma como obligaci&oacute;n de pago para &quot;EL ACREDITADO&quot;, estos, 
        los Intereses Ordinarios, se calcular&aacute;n dividiendo la tasa anual de inter&eacute;s aplicable a la operaci&oacute;n entre 360 y multiplicando el resultado obtenido por el n&uacute;mero 
        de d&iacute;as del periodo que devenguen los intereses. 
        Para el caso de que por cualquier causa la &quot;Tasa de Referencia&quot; a que aluden los puntos A-1, A-2 y A-3, dejase de existir, &quot;EL ACREDITADO&quot; se compromete 
        a pagar los Intereses Ordinarios conforme a instrumento financiero que la sustituya y decrete el Banco de M&eacute;xico, los Intereses Ordinarios calculados conforme 
        al nuevo instrumento se calcular&aacute;n a partir de que &eacute;ste entre en vigor o sea publicado el Acuerdo respectivo en el Diario Oficial de la Federaci&oacute;n. En este caso, 
        los PUNTOS PORCENTUALES que se adicionar&aacute;n al instrumento financiero que sustituya a la &quot;Tasa de Referencia&quot; para establecer la nueva Tasa de <br />
        Intereses Ordinarios, se le har&aacute;n saber al &quot;ACREDITADO&quot; por &quot;LA ACREDITANTE&quot;; &quot;EL ACREDITADO&quot; se compromete formalmente a pagar los Intereses 
        Ordinarios conforme a la nueva tasa que de esta forma se determine y establezca. 
        Cualquiera que sea la Tasa de Intereses Ordinarios que se asuma como obligaci&oacute;n de pago para &quot;EL ACREDITADO&quot; incluyendo para estos efectos el supuesto 
        establecido en el p&aacute;rrafo inmediato anterior, los intereses resultantes se computar&aacute;n mensualmente y se pagar&aacute;n efectivamente el &uacute;ltimo d&iacute;a de cada mes. 
        FINANCIAMIENTO ADICIONAL PARA EL PAGO DE INTERESES. No obstante lo pactado en el p&aacute;rrafo inmediato anterior, si llegada la fecha de pago de los <br />
        Intereses Ordinarios &quot;EL ACREDITADO&quot;, por cualquier circunstancia no los liquida, &quot;LA ACREDITANTE&quot; podr&aacute; otorgarle un Financiamiento Adicional para el 
        pago de dichos intereses, Los recursos para otorgar el Financiamiento Adicional a que se refiere este p&aacute;rrafo, provendr&aacute;n invariablemente de la misma fuente 
        de recursos con que se otorga el Cr&eacute;dito de Habilitaci&oacute;n o Av&iacute;o, por lo que se sujetar&aacute;n a los t&eacute;rminos y condiciones establecidas en esta cl&aacute;usula, en el 
        entendido que el monto total de los intereses devengados se ir&aacute; acumulando a la suerte principal en la fecha de pago de los mismos, pasando a formar parte 
        de la base de c&oacute;mputo de intereses del mes siguiente y as&iacute; sucesivamente hasta que ocurra un vencimiento del principal o una recuperaci&oacute;n anticipada, por lo 
        que el monto total que se hubiere generado con motivo de dicho financiamiento adicional ser&aacute; pagadero conjuntamente con la suerte principal. &quot;EL 
        ACREDITADO&quot; solicita expresamente y faculta a &quot;LA ACREDITANTE&quot; desde este momento para que en cada fecha de pago de intereses le otorgue el 
        financiamiento adicional para el pago de los mismos a que se refiere el p&aacute;rrafo anterior, aceptando los t&eacute;rminos y condiciones all&iacute; referidas. <br /> B) INTERESES MORATORIOS: <br />
        En el supuesto de que &quot;EL ACREDITADO&quot; incurriese en mora en el cumplimiento oportuno de sus obligaciones de pago contra&iacute;das en el presente Contrato, 
        pagar&aacute; a &quot;LA ACREDITANTE&quot; en concepto de Intereses Moratorios sobre el capital vencido incluyendo en el mismo todas las cantidades generadas por el 
        Financiamiento Adicional, el importe que resulte de multiplicar el total del saldo insoluto y vencido por una tasa igual a la que se obtenga de multiplicar por 2 
        dos la tasa de Intereses Ordinarios. Dichos Intereses Moratorios se causar&aacute;n desde la fecha en que &quot;EL ACREDITADO&quot; incurra en el incumplimiento o mora <br />
        hasta la total liquidaci&oacute;n de los adeudos que se mantengan insolutos. Lo anterior ser&aacute; sin perjuicio de que &quot;LA ACREDITANTE&quot; pueda dar por vencido el 
        adeudo anticipadamente en los t&eacute;rminos de este Contrato. <br />
        OCTAVA: &quot;DEUDOR SOLIDARIO Y AVALISTA&quot;: Para garantizar el cumplimiento de todas y cada una de las obligaciones derivadas de este contrato, de la Ley
        o de resoluciones judiciales dictadas en favor de &quot;LA ACREDITANTE&quot; a cargo de &quot;EL ACREDITADO&quot;, en este acto el(los) se&ntilde;or(es)<?php echo $nombre_cliente; ?> se constituyen en &quot;EL DEUDOR SOLIDARIO Y AVALISTA&quot;; en lo personal y por su propio derecho, manifiesta(n) su absoluta conformidad en 
        constituirse como tal(es) en favor de &quot;EL ACREDITADO&quot;, garantizando de manera absoluta, solidaria e incondicional el pago total del cr&eacute;dito dispuesto por &quot;EL 
        ACREDITADO&quot; a su vencimiento, as&iacute; como las dem&aacute;s obligaciones contra&iacute;das por &eacute;ste conforme al presente contrato, firmando con tal car&aacute;cter en el pagar&eacute;     que se suscriba para respaldar la disposici&oacute;n efectuada. </td>
    <td width="50%" align="justify"><br />NOVENA: GARANT&Iacute;A ESPEC&Iacute;FICA. En los t&eacute;rminos de los art&iacute;culos 321 trescientos veintiuno, 322 trescientos veintid&oacute;s y 334 trescientos treinta
      y cuatro fracci&oacute;n V quinta 336 trescientos treinta y seis de la Ley General de T&iacute;tulos y Operaciones de Cr&eacute;dito, todas las obligaciones que
      deriven del presente Contrato, incluyendo en ellas sus accesorios, as&iacute; como los gastos y costas en caso de juicio, quedar&aacute;n garantizadas 
      simult&aacute;nea o separadamente con las materias primas y materiales adquiridos y con los frutos, productos o artefactos que se obtengan con el 
      cr&eacute;dito, aunque &eacute;stos sean futuros o pendientes, para lo cual &quot;EL ACREDITADO&quot; constituye expresamente en este acto GARANTIA 
      PRENDARIA en primer lugar y grado de preferencia en favor de &quot;LA ACREDITANTE&quot; sobre los bienes que constituyen el destino del presente 
      contrato, espec&iacute;ficamente, &quot;EL ACREDITADO&quot; constituye PRENDA en primer lugar y grado de preferencia a favor de &quot;LA ACREDITANTE&quot;, 
      sobre 2,700.00 kilogramos de cafe en presentacion de:ROBUSTA mismos que son el producto de la cosecha en su parcela cuyos datos y 
      caracter&iacute;sticas se detallan al reverso de este contrato, y que es objeto del presente financiamiento. La PRENDA deber&aacute; depositarla en el 
      domicilio de &quot;LA ACREDITANTE&quot;, que se se&ntilde;ala en la Cl&aacute;usula DECIMO OCTAVA de este nstrumento y subsistir&aacute; hasta en tanto sean 
      cubiertas todas las obligaciones que se deriven del mismo por parte del &quot;ACREDITADO&quot;. Las partes contratantes convienen expresamente en 
      que &quot;LA ACREDITANTE&quot; podr&aacute; disponer libremente de la PRENDA y venderla para liquidar las obligaciones a cargo del &quot;ACREDITADO&quot; cuando      &eacute;ste de cualquier manera y en cualquier momento incumpla con lo pactado en este contrato; llegado su vencimiento o, cuando el precio de venta 
      del caf&eacute; del tipo y presentaci&oacute;n sobre el que se constituye la PRENDA, alcance un nivel de precio de $ 4.83 (CUATRO PESOS 83/100 M.N.) <br />
      por kilogramo, en la plaza en que se constituy&oacute; la PRENDA, por lo que en estos casos, &quot;LA ACREDITANTE&quot; se obliga a devolver &quot;AL
      ACREDITADO&quot; la diferencia entre el precio al que fuere vendida la PRENDA y las obligaciones a su cargo pendientes de liquidar y a favor de      &quot;LA ACREDITANTE&quot; cuando as&iacute; fuere posible. 
      Ambas partes contratantes convienen expresamente que para el caso de que la PRENDA por cualquier raz&oacute;n llegare a venderse, tendr&aacute;      preferencia en su compra &quot;LA ACREDITANTE&quot;. Las partes convienen en que para efectos de identificaci&oacute;n de los bienes que se dejaren en 
      PRENDA, bastar&aacute;n los documentos que &quot;LA ACREDITANTE&quot; entregue al &quot;ACREDITADO&quot;, incluso en lo relacionado con sus condiciones y 
      calidades al momento de que &quot;EL ACREDITADO&quot; los entregue a &quot;LA ACREDITANTE&quot;. 
      El incumplimiento por parte de &quot;EL ACREDITADO&quot; de lo establecido en esta cl&aacute;usula, dar&aacute; lugar a la inmediata rescisi&oacute;n del contrato.
      D&Eacute;CIMA: SEGURO. &quot;EL ACREDITADO&quot; se obliga a contratar por su cuenta, dentro de los 30 treinta d&iacute;as naturales que sigan a la fecha de firma 
      del presente instrumento un seguro amplio contra da&ntilde;os o p&eacute;rdida total que ampare los bienes que constituyen PRENDA y garant&iacute;a de este 
      cr&eacute;dito, designando en la p&oacute;liza que se contrate como &uacute;nico beneficiario con car&aacute;cter de irrevocable a BANCO DEL BAJIO, S. A., debiendo 
      acreditar los t&eacute;rminos de dicha contrataci&oacute;n a satisfacci&oacute;n de &quot;LA ACREDITANTE&quot; y quedando la p&oacute;liza respectiva a resguardo de &eacute;sta. El 
      importe del seguro referido no deber&aacute; ser menor al total del financiamiento que se le otorgue o del valor de venta de la producci&oacute;n estimada 
      considerada en la cl&aacute;usula Novena del presente contrato, de tal manera que en todo momento se encuentren garantizados el capital, intereses y 
      dem&aacute;s prestaciones y accesorios legales. En la p&oacute;liza de seguro se har&aacute; constar expresamente para los efectos del art&iacute;culo 109 ciento nueve de 
      la Ley Sobre el Contrato de Seguro, que &quot;EL ACREDITADO&quot; ha obtenido el importe de este Contrato, quedando obligado a dar oportunamente el 
      aviso de siniestro a la compa&ntilde;&iacute;a aseguradora, en las formas aprobadas y con copia a &quot;LA ACREDITANTE&quot;. En caso de que ya exista seguro 
      sobre los bienes mencionados, &quot;EL ACREDITADO&quot; se obliga a llevar a cabo las gestiones necesarias para consignar en la p&oacute;liza 
      correspondiente como &uacute;nico beneficiario en forma irrevocable a BANCO DEL BAJIO, S. A. por el monto total del cr&eacute;dito concedido m&aacute;s sus 
      accesorios y/o su saldo insoluto, debiendo entregar a &quot;LA ACREDITANTE&quot; la p&oacute;liza en el plazo aqu&iacute; consignado. 
      Esta obligaci&oacute;n estar&aacute; sujeta a exigencia previa de &quot;LA ACREDITANTE&quot; al &quot;ACREDITADO&quot; y podr&aacute; ser dispensada por aquella en su caso.<br />
      D&Eacute;CIMA PRIMERA: CONDICIONES Durante la vigencia del presente Contrato &quot;EL ACREDITADO&quot; deber&aacute; cumplir con las siguientes 
      condiciones:<br /> a) Aportar las cantidades se&ntilde;aladas en la CLAUSULA SEGUNDA. OBJETO, del presente contrato, como recursos necesarios para 
      complementar el importe de la inversi&oacute;n total del proyecto; b) Proporcionar, en su caso, a &quot;LA ACREDITANTE&quot; cuando &eacute;sta lo solicite, los 
      estados de contabilidad, documentos y dem&aacute;s informaci&oacute;n relativa a su explotaci&oacute;n; <br />
      c) Cuando sea necesario a juicio de &quot;LA ACREDITANTE&quot;,
      cubrir los gastos que genere el interventor designado por EL BANCO, EL FIRA o &quot;LA ACREDITANTE&quot;, el cual vigilar&aacute; el destino y debida 
      aplicaci&oacute;n del cr&eacute;dito; d) No contraer con ning&uacute;n tercero otros pasivos hasta en tanto este cr&eacute;dito est&eacute; totalmente pagado, salvo que &quot;LA
      ACREDITANTE&quot; previamente otorgue su permiso por escrito. 
      e) Conservar y mantener en condiciones eficientes de servicio su maquinaria, 
      equipo y, en general, todos los elementos de producci&oacute;n que pertenezcan a su empresa. 
      f) No arrendar, vender, gravar o enajenar los bienes que
      constituyan su empresa y mucho menos la garant&iacute;a espec&iacute;fica constituida en PRENDA en el presente Contrato; <br />
      g) Contribuir con la preservaci&oacute;n 
      del entorno ecol&oacute;gico y la de las especies animales y vegetales que coexisten en su explotaci&oacute;n; acatar&aacute; a tales efectos, las disposiciones 
      relativas del Ordenamiento Ecol&oacute;gico Federal, Estatal y Local y evitara el uso inmoderado de productos qu&iacute;micos, la depredaci&oacute;n de su medio y 
      la tala de especies maderables; <br />h) Deber&aacute; permitir en cualquier momento, el acceso a sus instalaciones, libros contables y documentos de 
      control de su explotaci&oacute;n a las personas que designen EL BANCO, EL FIRA o &quot;LA ACREDITANTE&quot;, as&iacute; como a aquellas personas que se lo 
      requieran por parte de la SECRETARIA DE AGRICULTURA, GANADERIA, DESARROLLO RURAL, PESCA Y ALIMENTACION (SAGARPA) o 
      de cualquier otra entidad nacional o extranjera que de cualquier forma hayan intervenido en el otorgamiento del financiamiento mediante el que <br />
      se le otorga el cr&eacute;dito y proporcionarles de inmediato toda la informaci&oacute;n que le soliciten; i) Deber&aacute; entregar a &quot;LA ACREDITANTE&quot; de manera 
      inmediata los bienes que constituir&aacute;n garant&iacute;a en este contrato se&ntilde;alados en la CLAUSULA NOVENA. GARANTIA ESPECIFICA.
      D&Eacute;CIMA SEGUNDA: CAUSAS DE VENCIMIENTO ANTICIPADO. Ambas partes aceptan que el presente Contrato se dar&aacute; por vencido <br />
      anticipadamente y el cr&eacute;dito dispuesto ser&aacute; exigible de inmediato en su totalidad incluyendo intereses m&aacute;s sus accesorios legales, cuando &quot;EL 
      ACREDITADO&quot; incurra en cualquiera de los siguientes casos: a) Si deja de pagar oportunamente tanto el capital como los intereses o los gastos 
      que se causen en virtud de este Contrato; b) Si vende, enajena, arrienda, cambia de lugar o constituye alg&uacute;n gravamen sobre los bienes dados 
      en garant&iacute;a, especialmente los que diere en PRENDA; c) Si los bienes materia de la garant&iacute;a fueren objeto de embargo total o parcial, ya sea de 
      orden civil, mercantil, fiscal, laboral, administrativo o de cualquier otra &iacute;ndole o si el valor de dichas garant&iacute;as se redujera por la causa que fuere 
      en m&aacute;s de un 20% veinte por ciento; d) Si abandona la administraci&oacute;n del negocio o no la atiende con el debido cuidado y eficiencia; e) Si se 
      presentan conflictos o situaciones de cualquier naturaleza que afecten el buen funcionamiento de su empresa o menoscaben las garant&iacute;as
      establecidas; f) Si no entrega a &quot;LA ACREDITANTE&quot; la informaci&oacute;n contable y financiera, que le sea solicitada; g) Si no da las facilidades 
      necesarias al interventor que designe EL BANCO, EL FIRA o &quot;LA ACREDITANTE&quot; para el cumplimiento de su cometido o si no paga 
      puntualmente su remuneraci&oacute;n y los gastos que dicha intervenci&oacute;n origine; j) Si en cualquier tiempo y por cualquier motivo se denuncia el 
      presente Contrato por &quot;LA ACREDITANTE&quot;; i) Si no cumple con cualesquiera de las obligaciones contenidas en el presente Contrato, en especial <br />
      y sin que sea limitativo, las contenidas en la CLAUSULA DECIMA PRIMERA.CONDICIONES y NOVENA. GARANTIA ESPECIFICA de este <br />
      contrato; j) Por cualquier otra causa estipulada en el presente Contrato o derivada de ley.<br />
      D&Eacute;CIMA TERCERA: RESTRICCI&Oacute;N Y DENUNCIA. &quot;LA ACREDITANTE&quot; en los t&eacute;rminos del art&iacute;culo 294 doscientos noventa y cuatro de la Ley 
      General de T&iacute;tulos y Operaciones de Cr&eacute;dito, se reserva expresamente el derecho de restringir el plazo o el importe del cr&eacute;dito abierto o ambos 
      a la vez o denunciar este Contrato, mediante simple comunicaci&oacute;n escrita dirigida a &quot;EL ACREDITADO&quot; ante dos testigos, para lo cual &eacute;ste 
      expresa su conformidad, en cuyo caso se extinguir&aacute; el cr&eacute;dito en la parte no dispuesta. En caso de que el importe del cr&eacute;dito se restrinja, &quot;EL 
      ACREDITADO&quot; no podr&aacute; disponer del resto del capital seg&uacute;n lo establecido en este Contrato.
      D&Eacute;CIMA CUARTA: DESCUENTO. &quot;EL ACREDITADO&quot; en los t&eacute;rminos del art&iacute;culo 299 doscientos noventa y nueve de la Ley General de T&iacute;tulos 
      y Operaciones de Cr&eacute;dito autoriza a &quot;LA ACREDITANTE&quot; y/o EL BANCO y/o EL FIRA para ceder o descontar, a&uacute;n antes del vencimiento del 
      presente contrato, los derechos a su favor derivados de &eacute;ste y del pagar&eacute; que documente la disposici&oacute;n.<br />
      D&Eacute;CIMA QUINTA: VIGILANCIA. &quot;LA ACREDITANTE&quot; y/o EL BANCO y/o EL FIRA, conjunta o individualmente tendr&aacute;n la facultad durante todo 
      el tiempo de vigencia del cr&eacute;dito, de designar a un interventor que cuide el exacto cumplimiento de las obligaciones de &quot;EL ACREDITADO&quot;, principalmente en lo que se refiere a la vigilancia de la inversi&oacute;n de fondos, del debido funcionamiento de la empresa y del cuidado y 
      conservaci&oacute;n de las garant&iacute;as otorgadas.
      El sueldo y los gastos que &quot;LA ACREDITANTE&quot; autorice al interventor ser&aacute;n cubiertos por &quot;EL ACREDITADO&quot;, para lo cual este expresa su 
      consentimiento. 
      D&Eacute;CIMA SEXTA.- FUENTE DE FONDEO. Las partes acuerdan que el presente cr&eacute;dito podr&aacute; financiarse con recursos provenientes 
      directamente de BANCO DEL BAJIO, S. A., Instituci&oacute;n de Banca M&uacute;ltiple, quien a su vez podr&aacute; tambi&eacute;n obtener los recursos de los <br />
      FIDEICOMISOS INSTITUIDOS EN RELACI&Oacute;N CON LA AGRICULTURA (FIRA), como fiduciario del BANCO DE MEXICO, o de cualquier otra 
      fuente de fondeo nacional o del extranjero, p&uacute;blica o privada, por lo cual &quot;EL ACREDITADO&quot; reconoce y expresamente acepta que el presente 
      contrato se ajustar&aacute; a las siguientes condiciones: 1. Que en el proyecto de inversi&oacute;n se cumplir&aacute; con el ordenamiento ecol&oacute;gico, la preservaci&oacute;n, 
      reestructuraci&oacute;n y mejoramiento del ambiente; la protecci&oacute;n de las &aacute;reas naturales, la flora y fauna silvestres y acu&aacute;ticas; el aprovechamiento 
      racional de los elementos naturales; la previsi&oacute;n y el control de la contaminaci&oacute;n del aire, agua y suelos; as&iacute; como las dem&aacute;s disposiciones 
      previstas en la Ley General del Equilibrio Ecol&oacute;gico y Protecci&oacute;n al Ambiente. 2. &quot;EL ACREDITADO&quot; podr&aacute; efectuar pagos anticipados en 
      reembolso del cr&eacute;dito, previa autorizaci&oacute;n de &quot;LA ACREDITANTE&quot;, sujeto a lo siguiente, a) la notificaci&oacute;n de pagar anticipadamente ser&aacute; <br />
      irrevocable y deber&aacute; ser hecha en forma escrita, por lo menos con 5 cinco d&iacute;as de anticipaci&oacute;n a la fecha del pago anticipado; b) cada anticipo 
      parcial deber&aacute; ser por una cantidad m&iacute;nima equivalente al 30% treinta por ciento de la amortizaci&oacute;n que haya solicitado liquidar antes de su 
      vencimiento, sin incluir intereses y accesorios; c) Dichas cantidades se aplicar&aacute;n primero al pago gastos, luego de intereses devengados a la 
      fecha del pago y despu&eacute;s al pago del saldo insoluto del cr&eacute;dito; d) los gastos, comisiones y penalizaciones que lleguen a generarse como <br />
      consecuencia del pago anticipado y que EL FIRA y/o BANCO DEL BAJIO, S. A. Instituci&oacute;n de Banca M&uacute;ltiple le apliquen a &quot;LA ACREDITANTE&quot;, 
      estar&aacute;n a su cargo, debiendo cubrirlos conjuntamente con el importe del pago anticipado. 3. &quot;LA ACREDITANTE&quot;, y/o BANCO DEL BAJIO, S. A. 
      Y/O FIRA podr&aacute;n efectuar en cualquier momento inspecciones a los bienes que se adquieran con motivo del presente cr&eacute;dito, a exigir balances o <br />
      estados de contabilidad y pedir datos o documentos, con el prop&oacute;sito de cerciorarse de la correcta aplicaci&oacute;n y uso del cr&eacute;dito, quedando 
      obligado &quot;EL ACREDITADO&quot; a otorgar las facilidades necesarias para verificar el buen funcionamiento de su empresa y conservar en <br />
      condiciones de servicio su maquinaria, equipo y todos los elementos de producci&oacute;n, as&iacute; como a tener a disposici&oacute;n de &quot;LA ACREDITANTE&quot; los 
      comprobantes de las inversiones realizadas con el importe del cr&eacute;dito. 4. En caso de que se desv&iacute;en los recursos obtenidos hacia objetos no 
      previstos en el programa de inversi&oacute;n o falsee la informaci&oacute;n, proporcionando documentaci&oacute;n cualitativa o cuantitativa que resulte ap&oacute;crifa, 
      incompleta o alterada o no cuente con los documentos que acrediten la aplicaci&oacute;n del cr&eacute;dito en la forma convenida en este Contrato o bien, no 
      se satisface debidamente alguna de ellas, quedar&aacute; obligado a: a) reintegrar el importe total de las sumas dispuestas insolutas a la fecha en que 
      FIRA y/o BANCO DEL BAJIO, S. A. Instituci&oacute;n de Banca M&uacute;ltiple soliciten el rescate o bien, se solicite la cancelaci&oacute;n del cr&eacute;dito otorgado; b) a 
      cubrir una pena convencional equivalente a multiplicar por 3 tres, la tasa de inter&eacute;s ordinaria prevista en la CLAUSULA SEPTIMA. INTERESES <br />
      de este Contrato, seg&uacute;n se opte por la tasa de inter&eacute;s fija o variable con efecto retroactivo a la fecha de redescuento ante EL FIRA, 
      deduci&eacute;ndose los intereses ordinarios pagados. c) En caso de que se hiciere por anticipado el pago del saldo insoluto de su cr&eacute;dito, en fecha <br />
      posterior a una visita de supervisi&oacute;n y &eacute;sta resultara desfavorable, consider&aacute;ndose que hubo desv&iacute;o de recursos, falseo de informaci&oacute;n o 
      incumplimiento de condiciones, &quot;LA ACREDITANTE&quot; se reserva la facultad de proceder de acuerdo a lo pactado en el p&aacute;rrafo anterior. &quot;EL 
      ACREDITADO&quot; se obliga a tener a disposici&oacute;n de &quot;LA ACREDITANTE&quot;, los comprobantes de las inversiones que realiz&oacute; con el importe del 
      cr&eacute;dito. 
      D&Eacute;CIMA S&Eacute;PTIMA: LEYES APLICABLES, JURISDICCI&Oacute;N Y PROCEDIMIENTO JUDICIAL. Para el conocimiento de cualquier controversia que 
      se llegue a suscitar con motivo de la interpretaci&oacute;n, cumplimiento y ejecuci&oacute;n del presente Contrato, las partes estar&aacute;n a lo dispuesto por la Ley <br />
      de Instituciones de Cr&eacute;dito, la Ley General de T&iacute;tulos y Operaciones de Cr&eacute;dito y dem&aacute;s leyes aplicables. Asimismo, en caso de proceder judicialmente, las partes contratantes renuncian expresamente a cualquier jurisdicci&oacute;n que pudiera corresponderles por raz&oacute;n territorial y se <br />
      someten a la competencia de los Tribunales de la Ciudad de Tapachula de C&oacute;rdova y Ord&oacute;&ntilde;ez, Chiapas.      &quot;LA ACREDITANTE&quot; se reserva la facultad de obtener el cobro de los saldos a cargo de &quot;EL ACREDITADO&quot; ejercitando la v&iacute;a ejecutiva
      mercantil o la que en su caso corresponda sin sujeci&oacute;n de orden, en la inteligencia de que si se sigue dicha v&iacute;a ejecutiva &quot;LA ACREDITANTE&quot;      podr&aacute; se&ntilde;alar los bienes suficientes para embargo sin sujetarse al orden que establece el art&iacute;culo 1395 mil trescientos noventa y cinco del 
      C&oacute;digo de Comercio, tomando en cuenta adem&aacute;s que en ning&uacute;n caso podr&aacute; &quot;EL ACREDITADO&quot; ser nombrado como depositario de los bienes, 
      pudiendo en cambio el depositario nombrado por &quot;LA ACREDITANTE&quot; tomar posesi&oacute;n sin necesidad de otorgar fianza. Asimismo, se conviene <br />
      expresamente que el ejercicio de alguna de estas acciones no implicar&aacute; la p&eacute;rdida de la otra y que todas las que competan a &quot;LA 
      ACREDITANTE&quot; permanecer&aacute;n &iacute;ntegras en tanto no sea liquidada la totalidad del cr&eacute;dito y sus accesorios a cargo de &quot;EL ACREDITADO&quot;, <br />
      conservando las garant&iacute;as constituidas y su preferencia, a&uacute;n cuando los bienes gravados sean se&ntilde;alados para la pr&aacute;ctica de la ejecuci&oacute;n.D&Eacute;CIMA OCTAVA.- DOMICILIOS. Para los efectos judiciales y extrajudiciales relativos al presente Contrato, &quot;LA ACREDITANTE&quot; se&ntilde;ala como domicilio el ubicado en CARRETERA 
      A NUEVA ALEMANIA KM 2.5, COL. BUROCRATICA; TAPACHULA DE CORDOVA Y ORDO&Ntilde;EZ, CHIAPAS; y &quot;EL ACREDITADO&quot; se&ntilde;ala como su domicilio el ubicado en la 
      localidad <?php echo $ubicacion; ?>. En caso de que &quot;EL ACREDITADO&quot; cambie de domicilio, deber&aacute; notificar <br />
      dicho cambio por escrito a &quot;LA ACREDITANTE&quot; y en caso contrario, los emplazamientos y dem&aacute;s diligencias judiciales o extrajudiciales se practicar&aacute;n en el domicilio se&ntilde;alado en <br />
      D&Eacute;CIMA NOVENA.- GASTOS. &quot;EL ACREDITADO&quot; se obliga a pagar todos los derechos, gastos, honorarios e impuestos que origine la celebraci&oacute;n de este Contrato, incluyendo los relativos a su ratificaci&oacute;n ante Fedatario P&uacute;blico y su inscripci&oacute;n en el Registro P&uacute;blico del Comercio. 
      VIG&Eacute;SIMA.- CASO FORTUITO. &quot;EL ACREDITADO&quot; se obliga al cumplimiento del presente Contrato a&uacute;n en caso fortuito o de fuerza mayor, en t&eacute;rminos de lo dispuesto por el 
      art&iacute;culo 2111 dos mil ciento once del C&oacute;digo Civil para el Distrito Federal y sus correlativos de cualquier Estado de la Rep&uacute;blica. <br />
      Enterados de su contenido, alcances y fuerza legales se firma el presente Contrato por las partes que en &eacute;l intervienen, ante la presencia de dos testigos y en tres tantos, en <br />
    Tapachula de C&oacute;rdova y Ord&oacute;&ntilde;ez <?php echo $fecha; ?> <!--el d&iacute;a25 de Noviembre del 2011--></td>
  </tr>
  <tr>
    <td align="center" width="34%">&quot;LA ACREDITANTE&quot;</td>
    <td align="center" width="33%">&quot;EL ACREDITADO&quot;</td>
    <td align="center" width="33%">&quot;EL AVALISTA&quot;</td>
  </tr>
  <tr>
    <td align="center" width="34%">EXPORTADORA DE GRANOS Y OLEAGINOSAS DEL SURESTE, S.A. DE C.V.</td>
    <td align="center" width="33%"><?php echo $nombre_cliente; ?></td>
    <td align="center" width="33%"></td>
  </tr>
 
  <tr>
    <td colspan="3">1.- C.P.A JORGE ARTURO VARELA ROSALES</td>
  </tr>
  <tr>
    <td colspan="3">2.- C.P. ALVARO PUIG COTA.</td>
  </tr>
  <tr>
    <td colspan="3" align="center"><strong>ORGANIZACI&Oacute;N: OCTAVIO VELAZQUEZ ROBLERO        REGISTRO NUM 1440</strong></td>
  </tr>
  
  
</table>



  





<?php
$html=ob_get_contents(); 
ob_end_clean(); 

$pdf->writeHTML($html, true, 0, true, 0);

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('Contrato_credito.pdf', 'D');

?>

