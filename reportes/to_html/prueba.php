<?php
 include("html_to_doc.inc.php");
 
 $htmltodoc= new HTML_TO_DOC();
 
 $htmltodoc->createDoc("reporte_requerimientos.php","test");
 $htmltodoc->createDocFromURL(true,"test");
?>