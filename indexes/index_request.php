<?php
// phpinfo ();
use sys\core\Request;

$request = new Request ();
var_dump ( $request->getUrl ()->toString () );
$registry->add ( "request", $request );

var_dump ( $_SERVER [ 'SERVER_NAME' ] );
var_dump ( SITEROOT );

/*
 * <script type="text/javascript" src="http://localhost/ecomod/indexes/EnviarAjax.js"></script>
 * $request->getQuery ();
 */
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Página de prueba de la clase Request</title>
    <script type="module" src="http://localhost/ecomod/sys/libs/js/ajax/Ajax.js"></script>
    <script type="module" src="http://localhost/ecomod/sys/libs/js/ajax/AjaxCtrl.js"></script>
    <link rel="stylesheet" href="http://localhost/ecomod/indexes/estilos.css" />
  </head>
  <body>
  	<div id="contenido"></div>
  	<form action="index.php" method="post">
    	<label>Nombre: <input type="text" id="nombre" name="nombre" value="fili"></label><br>
    	<label>Email: <input type="text" id="email" name="email" value="filizaa@gmail.com"></label><br>
    	<input type="submit" value="Enviar">
		</form>
    <div id="responsephp"></div>
    <input type="hidden" id="oculto" name="oculto" value="1">
    <button id="ajaxBtn" >Send Simple Ajax Request</button>
    <a href="inicio.php">Inicio</a>
    <a href="portafolio.php">Portafolio</a>
    <a href="galeria.php">Galería</a>
    <a href="contacto.php">Contacto</a>
    
  </body>
</html>
