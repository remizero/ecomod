<?php
namespace sys\libs\exceptions;

/**
 * <strong>ErrorException</strong>
 *
 * Archivo creado el 18 de septiembre de 2018 a las 21:51:50 p.m.
 * <p>Clase que permite procesar las excepciones de tipo error.</p>
 *
 * @name ErrorException
 * @namespace sys\libs\exceptions
 * @package ECOMOD.
 * @subpackage EXCEPTIONS.
 * @filesource ErrorException.php
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
class ErrorException extends ErrorHandlerException {
  
  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @return void
   */
  public function __construct ( string $code, string $error, string $file = NULL, string $line = NULL, array $context ) {

    \var_dump("esta entrando por ErrorException");
    //parent::__construct ( "Error Fatal en tiempo de ejecución", 0, null );
    parent::__construct ( $code, $error, $file, $line, $context );
  }

  /**
   */
  function __destruct () {

    // TODO - Insert your code here
  }
}

