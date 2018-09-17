<?php
namespace sys\libs\exceptions;

/**
 * <strong>Exception</strong>
 * Archivo creado el 31 de agosto de 2018 a las 18:19:00 p.m.
 * <p>Clase base que permite procesar las excepciones de manera
 * centralizada.</p>
 *
 * @name Exception
 * @namespace sys\libs\exceptions
 * @package ECOMOD.
 * @subpackage EXCEPTIONS.
 * @filesource Exception.php
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
 *       <li>.</li>
 *       <li>.</li>
 *       <li>.</li>
 *       </ul>
 */
class Exception extends \Exception {

  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @param string $message
   * @param int $code
   * @param \Exception $previous
   *
   * @return void
   */
  public function __construct ( string $message = null, int $code = 0, \Exception $previous = null ) {

    parent::__construct ( $message, $code, $previous );
  }

  /**
   */
  public function __destruct () {

    // TODO - Insert your code here
  }

  /**
   * Metodo recursivo que permite reconstruir la traza de excepcion hasta el
   * ultimo nivel de profundidad del error o excepcion.
   *
   * @param array $trace Traza de la excepcion a reconstruir.
   * @param array $args Argumentos de los metodos involucrados en la traza de
   *        excepcion. Para ser usados internamente por el metodo.
   * @param number $traceLevel Define los niveles de profundidad de la
   *        excepcion.
   *       
   * @return string
   */
  private function parseTrace ( array $trace, array $args = array (), $traceLevel = 0 ) {

    $parsedTrace = "";
    foreach ( $trace as $key => $value ) {
      
      if ( \is_array ( $value ) ) {
        
        if ( ( string ) $key == 'args' ) {
          
          if ( \array_key_exists ( "function", $args ) && \array_key_exists ( "class", $args ) && \array_key_exists ( "type", $args ) ) {
            
            $parsedTrace .= $args [ "class" ] . $args [ "type" ] . $args [ "function" ];
            $parsedTrace .= " ( \"";
          } else {
            
            $parsedTrace .= "*** ( \"";
          }
          $parsedTrace .= $this->parseTrace ( $value );
          $parsedTrace = \substr ( $parsedTrace, 0, -2 );
          $parsedTrace .= "\" )";
        } else {
          
          $parsedTrace .= "#$traceLevel ";
          $parsedTrace .= $this->parseTrace ( $value, $args, $traceLevel++ );
        }
      } else {
        
        switch ( ( string ) $key ) {
          
          case "file" :
            
            $parsedTrace .= $value . "(";
            break;
          
          case "line" :
            
            $parsedTrace .= $value . "): ";
            break;
          
          case "function" :
            
            $arrayKey = \array_keys ( $trace );
            if ( ( \count ( $trace ) - 1 ) == \array_search ( 'function', $arrayKey ) ) {
              
              $exploded = \explode ( "***", $parsedTrace );
              $parsedTrace = $exploded [ 0 ] . $value . $exploded [ 1 ];
            } else {
              
              $args [ "function" ] = $value;
            }
            break;
          
          case "class" :
            
            $args [ "class" ] = $value;
            break;
          
          case "type" :
            
            $args [ "type" ] = $value;
            break;
          
          default :
            
            $parsedTrace .= $value . ", ";
            break;
        }
      }
    }
    return $parsedTrace;
  }

  /**
   * Metodo que permite mostrar una cadena de texto de la excepcion generada
   * entendible para humanos.
   *
   * @return string
   *
   * @see Exception::__toString()
   */
  public function __toString () {

    return "CODE: " . $this->getCode () . " FILE: " . $this->getFile () . " LINE: " . $this->getLine () . " MESSAGE: " . $this->getMessage () . " BACKTRACE: " . $this->parseTrace ( $this->getTrace () );
  }
}
