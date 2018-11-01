<?php

require_once 'sys/core/ClassLoader.php';

$classloader = new sys\core\ClassLoader ();
$classloader->register ();

use sys\core\Request;

var_dump ( $_REQUEST );
var_dump ( $_SERVER );
var_dump ( $_ENV );
//phpinfo ();

$request = new Request ();

?>