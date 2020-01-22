<?php
// phpinfo ();
require_once SITEROOT . 'sys/core/ClassLoader.php';

$classloader = new sys\core\ClassLoader ();
$classloader->register ();

use sys\core\Registry;
use sys\core\Request;
use sys\libs\common\ErrorLog;

$registry = Registry::getInstance ();
new ErrorLog ();

$request = new Request ();

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
  </body>
</html>
