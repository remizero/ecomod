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
 * @uses .php
 * @see .php
 * @todo Capturar errores fatales.
 */
class Exception extends \Exception {

  /**
   * Permite identificar si la excepción es de tipo error.
   *
   * @var boolean
   */
  protected $isError = false;

  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @param string $message
   * @param int $code
   * @param \Exception $previous
   *
   * @return void
   */
  public function __construct ( string $message = null, int $code = 0, \Exception $previous = null) {

    parent::__construct ( $message, $code, $previous );
  }

  /**
   */
  public function __destruct () {

  }

  /**
   * Método recursivo que permite reconstruir la traza de excepción hasta el
   * último nivel de profundidad del error o excepción.
   *
   * @param array $trace Traza del error o de la excepción a reconstruir.
   *
   * @return string
   */
  private function parseTrace ( array $trace ) {

    if ( $this->isError ) {

      return $this->parseTraceError ( $trace );
    } else {

      return $this->parseTraceException ( $trace );
    }
  }

  /**
   * Método recursivo que permite reconstruir la traza de excepción hasta el
   * último nivel de profundidad del error.
   *
   * @param array $trace Traza del error a reconstruir.
   * @param array $args Argumentos de los métodos involucrados en la traza del
   *        error. Para ser usados internamente por el método.
   * @param int $traceLevel Define los niveles de profundidad del error.
   * @param bool $intoTrace
   *
   * @return string
   */
  private function parseTraceError ( array $trace, array $args = array (), int $traceLevel = 0, bool $intoTrace = FALSE, bool $argsToken = FALSE) {

    $parsedTrace = "";
    foreach ( $trace as $key => $value ) {

      if ( \is_array ( $value ) ) {

        if ( ( string ) $key == 'args' ) {

          $argsToken = !$argsToken;
          if ( \array_key_exists ( "function", $args ) && \array_key_exists ( "class", $args ) && \array_key_exists ( "type", $args ) ) {

            $parsedTrace .= $args [ "class" ] . $args [ "type" ] . $args [ "function" ];
            $parsedTrace .= " ( ";
          } elseif ( \array_key_exists ( "function", $args ) ) {

            $parsedTrace .= $args [ "function" ];
            $parsedTrace .= " ( \"";
          } else {

            $parsedTrace .= "***";
            $parsedTrace .= " ( \"";
          }
          $parsedTrace .= $this->parseTraceError ( $value, $args, $traceLevel, $intoTrace, $argsToken );
          $parsedTrace = \substr ( $parsedTrace, 0, -1 );
          if ( \array_key_exists ( "function", $args ) && \array_key_exists ( "class", $args ) && \array_key_exists ( "type", $args ) ) {

            $parsedTrace .= " ) ";
          } elseif ( \array_key_exists ( "function", $args ) ) {

            $parsedTrace = \substr ( $parsedTrace, 0, -1 );
            $parsedTrace .= "\" ) ";
          } else {

            $parsedTrace = \substr ( $parsedTrace, 0, -1 );
            $parsedTrace .= "\" ) ";
          }
        } else {

          if ( ( string ) $key == 'trace' ) {

            $parsedTrace .= "TRACE ";
            $auxParsedTrace = $this->parseTraceError ( $value, $args, $traceLevel++, $intoTrace, $argsToken );
          } elseif ( \is_object ( $value ) ) {} else {

            switch ( ( string ) $key ) {

              case "_GET" :
              case "_POST" :
              case "_COOKIE" :
              case "_FILES" :
              case "_ENV" :
              case "_REQUEST" :
              case "_SERVER" :

                break;

              default :

                if ( $argsToken && \is_array ( $value ) ) {

                  $argsToken = !$argsToken;
                  $parsedTrace = \substr ( $parsedTrace, 0, -1 );
                } else {

                  $parsedTrace .= "#$traceLevel ";
                  $auxParsedTrace = $this->parseTraceError ( $value, $args, $traceLevel++, $intoTrace, $argsToken );
                }
            }
          }
          if ( !empty ( $auxParsedTrace ) ) {

            $parsedTrace .= $auxParsedTrace;
          }
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

          case "key" :

            $parsedTrace .= "KEY " . $value . " ";
            break;

          case "parsedTrace" :

            $parsedTrace .= "PARSEDTRACE " . $value . " ";
            break;

          case "trace" :

            break;

          case "traceLevel" :

            $exploded = \explode ( "***", $parsedTrace );
            $parsedTrace = \substr ( $exploded [ 0 ], 0, -1 ) . $exploded [ 1 ];
            $parsedTrace .= "TRACELEVEL " . $value . " ";
            break;

          case "type" :

            $args [ "type" ] = $value;
            break;

          case "0" :
          case "1" :
          case "2" :
          case "3" :
          case "4" :
          case "5" :
          case "6" :
          case "7" :
          case "8" :
          case "9" :

            if ( \is_object ( $value ) ) {

              $parsedTrace .= \get_class ( $value ) . ", ";
            } else {

              $parsedTrace .= $value . ", ";
            }
            break;

          case "value" :

            if ( \is_object ( $value ) ) {

              $parsedTrace .= " VALUE " . \get_class ( $value ) . ", ";
            } else {

              $parsedTrace .= $value . ", ";
            }
            break;

          default :
            break;
        }
      }
    }
    return $parsedTrace;
  }

  /**
   * Método recursivo que permite reconstruir la traza de excepción hasta el
   * último nivel de profundidad de la excepción.
   *
   * @param array $trace Traza de la excepción a reconstruir.
   * @param array $args Argumentos de los métodos involucrados en la traza de
   *        excepción. Para ser usados internamente por el método.
   * @param number $traceLevel Define los niveles de profundidad de la
   *        excepción.
   *
   * @return string
   */
  private function parseTraceException ( array $trace, array $args = array (), $traceLevel = 0) {

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

            if ( \is_object ( $value ) ) {

              $parsedTrace .= \get_class ( $value ) . ", ";
            } else {

              $parsedTrace .= $value . ", ";
            }
            break;
        }
      }
    }
    return $parsedTrace;
  }

  /**
   * Método que permite mostrar una cadena de texto de la excepción generada
   * entendible para humanos.
   *
   * @return string
   *
   * @see Exception::__toString ()
   */
  public function __toString () {

    return "CODE: " . $this->getCode () . " FILE: " . $this->getFile () . " LINE: " . $this->getLine () . " MESSAGE: " . $this->getMessage () . " BACKTRACE: " . $this->parseTrace ( $this->getTrace () );
  }
}
