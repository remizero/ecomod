<?php
//phpinfo ();
require_once SITEROOT . 'sys/core/ClassLoader.php';

$classloader = new sys\core\ClassLoader ();
$classloader->register ();

use sys\core\Request;
use sys\core\Registry;
use sys\libs\common\ErrorLog;

$registry = Registry::getInstance ();
new ErrorLog ();

var_dump ( $_REQUEST );
var_dump ( $_SERVER );
var_dump ( $_ENV );
var_dump ( $_FILES );
//phpinfo ();

$request = new Request ();

$request->getUrl ();

/*
var_dump ( '$request->isGet ' . $request->isGet () );
var_dump ( '$request->isHead ' . $request->isHead () );
var_dump ( '$request->isOption ' . $request->isOption () );
var_dump ( '$request->isPost ' . $request->isPost () );
var_dump ( '$request->isPut ' . $request->isPut () );
var_dump ( '$request->isXmlHttpRequest ' . $request->isXmlHttpRequest () );

    <script type="text/javascript" src="http://localhost/ecomod/indexes/EnviarAjax.js"></script>
$request->getQuery ();

*/
/*
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Insert title here</title>
    <script type="text/javascript" src="http://localhost/ecomod/indexes/Ajax.js"></script>
  </head>
  <body>
    <div id="responsephp"></div>
    <button onclick="sendRequest();">Send Simple Ajax Request</button>
  </body>
</html>*/
?>