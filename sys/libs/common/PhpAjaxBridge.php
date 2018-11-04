<?php

require_once 'sys/core/ClassLoader.php';

$classloader = new sys\core\ClassLoader ();
$classloader->register ();

use sys\core\Request;

if ( Request::isXmlHttpRequest () ) {
  
  
  
} else {
  
  
}

?>