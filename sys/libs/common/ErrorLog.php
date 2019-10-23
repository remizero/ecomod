<?php
namespace sys\libs\common;

use sys\libs\exceptions\CompileErrorException;
use sys\libs\exceptions\CompileWarningException;
use sys\libs\exceptions\CoreErrorException;
use sys\libs\exceptions\CoreWarningException;
use sys\libs\exceptions\DeprecatedException;
// use sys\libs\exceptions\Exception;
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
 * errores que se presenten durante la ejecución de un script php.</p>
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
 *       <li>Envío de mensajes de errores por pantalla.</li>
 *       <li>Envío de mensajes de errores vía correo.</li>
 *       <li>.</li>
 *       </ul>
 */
class ErrorLog {
  
  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @return void
   */
  public function __construct () {

    @\set_error_handler ( array ( $this, 'catchError' ) );
    @\set_exception_handler ( array ( $this, 'catchException' ) );
  }

  /**
   */
  function __destruct () {

    // TODO - Insert your code here
  }

  /**
   * Método que permite manejar los errores como excepciones guardar la traza de
   * error en un archivo log, para su posterior depuración.
   *
   * @param int $code Código del error.
   * @param string $error Mensaje descriptivo del error.
   * @param string $file Archivo donde se genera el error.
   * @param string $line Línea donde se genera el error.
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
   * @return void
   */
  public function catchError ( int $code, string $error, string $file = NULL, string $line = NULL, array $context ) {

    switch ( $code ) {
      
      case E_COMPILE_ERROR :

        \var_dump ( "CompileErrorException" );
        throw new CompileErrorException ( $code, $error, $file, $line );
      
      case E_COMPILE_WARNING :
        
        \var_dump ( "CompileWarningException" );
        throw new CompileWarningException ( $code, $error, $file, $line );
      
      case E_CORE_ERROR :
        
        \var_dump ( "CoreErrorException" );
        throw new CoreErrorException ( $code, $error, $file, $line );
      
      case E_CORE_WARNING :
        
        \var_dump ( "CoreWarningException" );
        throw new CoreWarningException ( $code, $error, $file, $line );
      
      case E_DEPRECATED :
        
        \var_dump ( "DeprecatedException" );
        throw new DeprecatedException ( $code, $error, $file, $line );
      
      case E_ERROR :
        
        \var_dump ( "ErrorException" );
        throw new ErrorException ( $code, $error, $file, $line );
      
      case E_NOTICE :
        
        \var_dump ( "NoticeException" );
        throw new NoticeException ( $code, $error, $file, $line );
      
      case E_PARSE :
        
        \var_dump ( "ParseException" );
        throw new ParseException ( $code, $error, $file, $line );
      
      case E_RECOVERABLE_ERROR :
        
        \var_dump ( "RecoverableErrorException" );
        throw new RecoverableErrorException ( $code, $error, $file, $line );
      
      case E_STRICT :
        
        \var_dump ( "StrictException" );
        throw new StrictException ( $code, $error, $file, $line );
      
      case E_USER_DEPRECATED :
        
        \var_dump ( "UserDeprecatedException" );
        throw new UserDeprecatedException ( $code, $error, $file, $line );
      
      case E_USER_ERROR :
        
        \var_dump ( "UserErrorException" );
        throw new UserErrorException ( $code, $error, $file, $line );
      
      case E_USER_NOTICE :
        
        \var_dump ( "UserNoticeException" );
        throw new UserNoticeException ( $code, $error, $file, $line );
      
      case E_USER_WARNING :
        
        \var_dump ( "UserWarningException" );
        throw new UserWarningException ( $code, $error, $file, $line );
      
      case E_WARNING :
        
        \var_dump ( "WarningException" );
        throw new WarningException ( $code, $error, $file, $line );
    }
  }

  /**
   * Método que permite manejar las excepciones, guardar la traza de error en un 
   * archivo log, para su posterior depuración.
   * 
   * @param \Exception $exception
   *
   * @return void
   */
  public function catchException ( \Exception $exception ) {

    self::validate ();
    $filePointer = \fopen ( 'public/errors/error.log', 'a' );
    \fwrite ( $filePointer, "[" . \date ( DATE_RFC2822 ) . "] EXCEPTION " . $exception->__toString () . PHP_EOL );
    \fclose ( $filePointer );
  }

  private static function validate () {

    if ( \filesize ( "public/errors/error.log" ) > 1000000 ) {
      
      // http://ecapy.com/anadir-tu-usuario-de-linux-al-grupo-www-data/index.html
      // http://flexiblewebs.net/como-configurar-los-permisos-para-el-directorio-raiz-de-un-sitio-web/
      // https://www.boscolopez.com/anadir-usuario-al-grupo-www-data/
      //
      \rename ( "public/errors/error.log", "public/errors/error_" . \date ( "Y-m-d_H:i:s" ) . ".log" );
    }
  }

  /**
   * Metodo que permite guardar la traza de error de una excepcion en un archivo
   * log, para su posterior depuracion.
   *
   * @param \Exception $exception
   *
   * @return void
   */
  public static function exception ( \Exception $exception ) {

    self::validate ();
    $filePointer = \fopen ( 'public/errors/error.log', 'a' );
    \fwrite ( $filePointer, "[" . \date ( DATE_RFC2822 ) . "] EXCEPTION " . $exception->__toString () . PHP_EOL );
    \fclose ( $filePointer );
    // $this->sendMail ();
  }

  public function sendMail () {

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
  }
}

