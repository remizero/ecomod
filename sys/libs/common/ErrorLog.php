<?php
namespace sys\libs\common;

use sys\libs\exceptions\Exception;

/**
 * <strong>ErrorLog</strong>
 *
 * Archivo creado el 14 de septiembre de 2018 a las 19:40:40 p.m.
 * <p>Clase que permite hacer un manejo centralizado de las excepciones y los
 * errores que se presenten durante la ejecucion de un script php.</p>
 *
 *
 * @name ErrorLog
 * @namespace sys\libs\common
 * @package ECOMOD.
 * @subpackage LIBS-COMMON.
 * @filesource ErrorLog.php
 * @version 1.0
 * @since 1.0
 * @author Filiberto Zaá Avila ( remizero ) filizaa@gmail.com.
 * @copyright Todos los derechos reservados 2018.
 * @link http://www.ecosoftware.com.ve
 * @license http://www.ecosoftware.com.ve/licencia
 * @uses <ul>
 *       <li>.php</li>
 *       </ul>
 * @see .php
 * @todo <p>En futuras versiones estarán disponibles los métodos para dar
 *       soporte a:</p>
 *       <ul>
 *       <li>Inclusión de traza informativa en el sistema de log de errores para
 *       indicar que clase no pudo se encontrada.</li>
 *       <li>.</li>
 *       <li>.</li>
 *       </ul>
 */
class ErrorLog {

  // TODO - Insert your code here
  
  /**
   */
  public function __construct () {

    @\set_exception_handler ( array ( 
      
        $this,
        'catchException' 
    ) );
    
  }

  /**
   */
  function __destruct () {

    // TODO - Insert your code here
  }
  
  /**
   * Metodo que permite guardar la traza de error en un archivo log, para su
   * posterior depuracion.
   *
   * @param string $message
   *
   * @return void
   */
  public static function catchError ( string $message ) {
    
    self::validate ();
    $filePointer = \fopen ( 'public/errors/error.log', 'a' );
    \fwrite ( $filePointer, "[" . \date ( DATE_RFC2822 ) . "] ERROR $message" . PHP_EOL );
    \fclose ( $filePointer );
  }
  
  public function catchException ( Exception $exception ) {

    self::validate ();
    $filePointer = \fopen ( 'public/errors/error.log', 'a' );
    \fwrite ( $filePointer, "[" . \date ( DATE_RFC2822 ) . "] EXCEPTION " . $exception->__toString () . PHP_EOL );
    \fclose ( $filePointer );
  }
  
  private function validate () {

    if ( \filesize ( "public/errors/error.log" ) > 1000000 ) {

      //http://ecapy.com/anadir-tu-usuario-de-linux-al-grupo-www-data/index.html
      //http://flexiblewebs.net/como-configurar-los-permisos-para-el-directorio-raiz-de-un-sitio-web/
      //https://www.boscolopez.com/anadir-usuario-al-grupo-www-data/
      //
      \rename ( "public/errors/error.log", "public/errors/error_" . \date("Y-m-d_H:i:s") . ".log" );
    }
  }

  /**
   * Metodo que permite guardar la traza de error en un archivo log, para su 
   * posterior depuracion.
   * 
   * @param string $message
   * 
   * @return void
   */
  public static function error ( string $message ) {
    
    self::validate ();
    $filePointer = \fopen ( 'public/errors/error.log', 'a' );
    \fwrite ( $filePointer, "[" . \date ( DATE_RFC2822 ) . "] ERROR $message" . PHP_EOL );
    \fclose ( $filePointer );
  }
  
  /**
   * Metodo que permite guardar la traza de error de una excepcion en un archivo
   * log, para su posterior depuracion.
   * 
   * @param Exception $exception
   * 
   * @return void
   */
  public static function exception ( Exception $exception ) {

    self::validate ();
    $filePointer = \fopen ( 'public/errors/error.log', 'a' );
    \fwrite ( $filePointer, "[" . \date ( DATE_RFC2822 ) . "] EXCEPTION " . $exception->__toString () . PHP_EOL );
    \fclose ( $filePointer );
  }
}

