<?php
require_once 'sys/core/ClassLoader.php';

$classloader = new sys\core\ClassLoader ();
$classloader->register ();

use pruebas\Hello;

$hello = new Hello ();

$hello->setWorld ( "foo!" );
echo $hello->getWorld ();

?>