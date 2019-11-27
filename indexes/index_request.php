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

/*
 * var_dump ( $_REQUEST );
 * var_dump ( $_SERVER );
 * var_dump ( $_ENV );
 * var_dump ( $_FILES );
 */
// phpinfo ();

$request = new Request ();
var_dump ( '$request->getUrl ()->toString ():    ' . $request->getUrl ()->toString () );
var_dump ( '$request->isPost:     ' . ( integer ) $request->isPost () );
var_dump ( '$request->isGet:     ' . ( integer ) $request->isGet () );
var_dump ( '$request->isHead:     ' . ( integer ) $request->isHead () );
var_dump ( '$request->isOption:     ' . ( integer ) $request->isOption () );
var_dump ( '$request->isPut:     ' . ( integer ) $request->isPut () );
var_dump ( '$request->isXmlHttpRequest:     ' . ( integer ) $request->isXmlHttpRequest () );


if ( $request->isPost () ) {

  var_dump ( $request->getPost ( "nombre" ) );
  var_dump ( $request->getPost ( "email" ) );
  var_dump ( $request->getRequest ( "nombre" ) );
  var_dump ( $request->getRequest ( "email" ) );
}

if ( $request->isGet () ) {

  var_dump ( $request->getGet ( "nombre" ) );
  var_dump ( $request->getGet ( "email" ) );
  var_dump ( $request->getRequest ( "nombre" ) );
  var_dump ( $request->getRequest ( "email" ) );
}


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
