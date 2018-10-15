<?php
//phpinfo();
ini_set ( "display_errors", "on" );
error_reporting ( E_ALL ^ E_WARNING );

require_once 'sys/core/ClassLoader.php';

$classloader = new sys\core\ClassLoader ();
$classloader->register ();


$movies =array(
  "comedy" => array("Pink Panther", "John English", "See no evil hear no evil"),
  "action" => array("Die Hard", "Expendables"),
  "epic" => array("The Lord of the rings"),
  "Romance" => array("Romeo and Juliet")
);
print_r($movies);
var_dump($movies);



use pruebas\Hello;
use sys\api\config\ConfigFac;
use sys\api\config\controller\Ini;
use sys\api\config\controller\Xml;
use sys\libs\common\ErrorLog;
use sys\libs\common\XmlUtils;
use sys\api\cache\CacheFac;
use sys\core\Registry;
use sys\core\Router;
use pruebas\Index;

$hello = new Hello ();

$hello->setWorld ( "foo!" );
var_dump ( $hello->getWorld () );

echo date ( DATE_RFC2822 );

$registry = Registry::getInstance ();

new ErrorLog ();

//$config = ConfigFac::create ( ConfigFac::INI );
$config = ConfigFac::create ( ConfigFac::XML );
//$config = ConfigFac::create ( ConfigFac::PHP );
//$config = Config::create ( "perro" );
//var_dump ( $config->read ( "sys/config/config.xml" ) );
//var_dump ( $config->read ( "sys/config/config.ini" ) );

//if ( $config->read ( "sys/config/config.ini" ) ) {
if ( $config->read ( "sys/config/config.xml" ) ) {
//if ( $config->read ( "sys/config/config.php" ) ) {
  
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
//fopen ( "config_cpy.ini", "r" );
//otraFuncion ();

$cache = CacheFac::create ( CacheFac::MEMCACHED );
var_dump ( "CREÓ LA CACHE" );

$router = new Router ();
var_dump ( "CREÓ LA CLASE ROUTER" );
Registry::getInstance ()->set ( "router", $router );

define ( "APP_PATH", dirname ( __DIR__ ) );
var_dump ( "CREÓ LA CONSTANTE APP_PATH" . APP_PATH );
$index = new Index ();
var_dump ( "CREÓ LA CLASE INDEX" );

?>