<?php
//phpinfo();
ini_set ( "display_errors", "on" );
require_once 'sys/core/ClassLoader.php';

$classloader = new sys\core\ClassLoader ();
$classloader->register ();

use pruebas\Hello;
use sys\api\config\ConfigFac;
use sys\api\config\controller\Ini;
use sys\api\config\controller\Xml;
use sys\libs\common\ErrorLog;
use sys\libs\common\XmlUtils;

$hello = new Hello ();

$hello->setWorld ( "foo!" );
var_dump ( $hello->getWorld () );

echo date ( DATE_RFC2822 );

new ErrorLog ();

//$config = ConfigFac::create ( ConfigFac::INI );
$config = ConfigFac::create ( ConfigFac::XML );
//$config = Config::create ( "perro" );
//var_dump ( $config->read ( "sys/config/config.xml" ) );
//var_dump ( $config->read ( "sys/config/config.ini" ) );

//if ( $config->read ( "sys/config/config.ini" ) ) {
if ( $config->read ( "sys/config/config.xml" ) ) {
  
  //var_dump ( $config->parse ( "sys/config/config.ini" ) );
  if ( $config->parse () ) {
    
    var_dump ( $config->toArray () );
    var_dump ( $config->toObject () );
    
    //var_dump ( Ini::write ( "sys/config/config.txt", $config->toArray () ) );
    //var_dump ( Ini::write ( "sys/config/config.txt", $config->toObject () ) );
  }
}

var_dump ( XmlUtils::arrayToSimpleXmlElement ( $config->toArray () ) );
var_dump ( XmlUtils::stdClassToSimpleXmlElement ( $config->toObject () ) );

$from = "test@ecosoftware.com";
$to = "filizaa@gmail.com";
$subject = "Checking PHP mail";
$message = "PHP mail works just fine";
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";
$headers = "From:" . $from;
$respuesta = \mail ( $to, $subject, $message, $headers );
if ( $respuesta ) {
  
  echo "Si lo envio";
  
} else {
  
  echo "No lo envio";
}

//include('/ruta/hacia/un/archivo/inexistente.php');
fopen ( "config_cpy.ini", "r" );
//otraFuncion ();

?>