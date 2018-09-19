<?php
namespace sys\libs\common;

use sys\libs\exceptions\CompileErrorException;
use sys\libs\exceptions\CompileWarningException;
use sys\libs\exceptions\CoreErrorException;
use sys\libs\exceptions\CoreWarningException;
use sys\libs\exceptions\DeprecatedException;
use sys\libs\exceptions\Exception;
use sys\libs\exceptions\ErrorException;
use sys\libs\exceptions\NoticeException;
use sys\libs\exceptions\ParseException;
use sys\libs\exceptions\RecoverableErrorException;
use sys\libs\exceptions\StrictException;
use sys\libs\exceptions\UserDeprecatedException;
use sys\libs\exceptions\UserErrorException;
use sys\libs\exceptions\UserNoticeException;
use sys\libs\exceptions\UserWarningException;
use sys\libs\exceptions\WarningException;

/**
 * <strong>ErrorLog</strong>
 *
 * Archivo creado el 14 de septiembre de 2018 a las 19:40:40 p.m.
 * <p>Clase que permite hacer un manejo centralizado de las excepciones y los
 * errores que se presenten durante la ejecucion de un script php.</p>
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
  
  /**
   */
  public function __construct () {
    
    @\set_error_handler ( array (
      
        $this,
        'catchError'
    ) );

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
   * Metodo que permite manejar los errores como excepciones guardar la traza de error en un archivo log, para su
   * posterior depuracion.
   *
   * @param string $code Codigo del error.
   * @param string $error Mensaje descriptivo del error.
   * @param string $file Archivo donde se genera el error.
   * @param string $line Linea donde se genera el error.
   * @param array $context Contexto donde se genera el error.
   * 
   * @throws CompileErrorException
   * @throws CompileWarningException
   * @throws CoreWarningException
   * @throws CoreErrorException
   * @throws DeprecatedException
   * @throws ErrorException
   * @throws NoticeException
   * @throws ParseException
   * @throws RecoverableErrorException
   * @throws StrictException
   * @throws UserDeprecatedException
   * @throws UserErrorException
   * @throws UserNoticeException
   * @throws UserWarningException
   * @throws WarningException
   * 
   * @return boolean
   */
  public function catchError ( string $code, string $error, string $file = NULL, string $line = NULL, array $context ) {
    
    /*function ($err_severity, $err_msg, $err_file, $err_line, array $err_context);
    function myErrorHandler($code, $error, $file = NULL, $line = NULL) {
      throw new Exception($error . ' encontrado en '. $file.', línea '.$line);
    }
    self::validate ();
    $filePointer = \fopen ( 'public/errors/error.log', 'a' );
    \fwrite ( $filePointer, "[" . \date ( DATE_RFC2822 ) . "] ERROR $message" . PHP_EOL );
    \fclose ( $filePointer );*/
    
    
    // error was suppressed with the @-operator
    /*if ( 0 === \error_reporting () ) {
      
      return false;
    }*/

    switch( $code ) {
      
      case E_COMPILE_ERROR:
        
        throw new CompileErrorException ( $code, $error, $file, $line, $context );
        
      case E_COMPILE_WARNING:
        
        throw new CompileWarningException ( $code, $error, $file, $line, $context );
      
      case E_CORE_ERROR:
        
        throw new CoreErrorException ( $code, $error, $file, $line, $context );
        
      case E_CORE_WARNING:
        
        throw new CoreWarningException ( $code, $error, $file, $line, $context );
        
      case E_DEPRECATED:
        
        throw new DeprecatedException ( $code, $error, $file, $line, $context );
      
      case E_ERROR:
        
        
        throw new ErrorException ( $code, $error, $file, $line, $context );
        
      case E_NOTICE:
        
        throw new NoticeException ( $code, $error, $file, $line, $context );
        
      case E_PARSE:
        
        throw new ParseException ( $code, $error, $file, $line, $context );
        
      case E_RECOVERABLE_ERROR:
        
        throw new RecoverableErrorException ( $code, $error, $file, $line, $context );
        
      case E_STRICT:
        
        throw new StrictException ( $code, $error, $file, $line, $context );
        
      case E_USER_DEPRECATED:
        
        throw new UserDeprecatedException ( $code, $error, $file, $line, $context );
        
      case E_USER_ERROR:
        
        throw new UserErrorException ( $code, $error, $file, $line, $context );
        
      case E_USER_NOTICE:
        
        throw new UserNoticeException ( $code, $error, $file, $line, $context );
        
      case E_USER_WARNING:
        
        throw new UserWarningException ( $code, $error, $file, $line, $context );
        
      case E_WARNING:

        throw new WarningException ( $code, $error, $file, $line, $context );
    }
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

