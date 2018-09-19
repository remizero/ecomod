<?php
ini_set ( "display_errors", "on" );
require_once 'sys/core/ClassLoader.php';

$classloader = new sys\core\ClassLoader ();
$classloader->register ();

use pruebas\Hello;
use sys\api\config\Config;
use sys\api\config\controller\Ini;
use sys\libs\common\ErrorLog;

$hello = new Hello ();

$hello->setWorld ( "foo!" );
var_dump ( $hello->getWorld () );

echo date ( DATE_RFC2822 );

new ErrorLog ();

$config = Config::create ( Config::INI );
//$config = Config::create ( "perro" );
//var_dump ( $config->read ( "sys/config/config.xml" ) );
//var_dump ( $config->read ( "sys/config/config.ini" ) );

if ( $config->read ( "sys/config/config.ini" ) ) {
  
  //var_dump ( $config->parse ( "sys/config/config.ini" ) );
  if ( $config->parse ( "sys/config/config.ini" ) ) {
    
    var_dump ( $config->toArray () );
    var_dump ( $config->toObject () );
    
    //var_dump ( Ini::write ( "sys/config/config.txt", $config->toArray () ) );
    var_dump ( Ini::write ( "sys/config/config.txt", $config->toObject () ) );
  }
}

//include('/ruta/hacia/un/archivo/inexistente.php');
fopen ( "config_cpy.ini", "r" );
//otraFuncion ();

?>