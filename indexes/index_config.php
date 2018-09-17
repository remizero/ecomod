<?php
require_once 'sys/core/ClassLoader.php';

$classloader = new sys\core\ClassLoader ();
$classloader->register ();

use pruebas\Hello;
use sys\api\config\Config;
use sys\libs\exceptions\ArgumentException;
use sys\libs\exceptions\FileException;
use sys\libs\exceptions\FileNotFoundException;
use sys\libs\exceptions\PathException;
use sys\api\config\exceptions\SyntaxException;
use sys\api\config\controller\Ini;
use sys\libs\common\ErrorLog;

$hello = new Hello ();

$hello->setWorld ( "foo!" );
var_dump ( $hello->getWorld () );

echo date ( DATE_RFC2822 );

new ErrorLog ();

/*try {*/

  $config = Config::create ( Config::INI );
  //$config = Config::create ( "perro" );
  //var_dump ( $config->read ( "sys/config/config.xml" ) );
  //var_dump ( $config->read ( "sys/config/config.ini" ) );
  
  if ( $config->read ( "sys/config/conig.ini" ) ) {
    
    //var_dump ( $config->parse ( "sys/config/config.ini" ) );
    if ( $config->parse ( "sys/config/config.ini" ) ) {
      
      var_dump ( $config->toArray () );
      var_dump ( $config->toObject () );
      
      //var_dump ( Ini::write ( "sys/config/config.txt", $config->toArray () ) );
      var_dump ( Ini::write ( "sys/config/config.txt", $config->toObject () ) );
    }
  }
/*} catch ( ArgumentException $ae ) {
  
  ErrorLog::exception ( $ae );
  $ae->__toString ();
  
} catch ( FileException $fe ) {
  
  ErrorLog::exception ( $fe );
  $fe->__toString ();
  
} catch ( FileNotFoundException $fnfe ) {
  
  ErrorLog::exception ( $fnfe );
  $fnfe->__toString ();
  
} catch ( PathException $pe ) {
  
  ErrorLog::exception ( $pe );
  $pe->__toString ();
  
} catch ( SyntaxException $se ) {
  
  ErrorLog::exception ( $se );
  $se->__toString ();
}*/

//ErrorLog::toErrorLog ( "mensaje de error" );

?>