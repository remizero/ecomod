<?php
namespace sys\libs\exceptions;

/**
 * <strong>MethodNotImplementedException</strong>
 *
 * Archivo creado el 07 de septiembre de 2018 a las 00:50:35 a.m.
 * <p>Clase que permite procesar las excepciones de tipo array.</p>
 *
 * @name MethodNotImplementedException
 * @namespace sys\libs\exceptions
 * @package ECOMOD.
 * @subpackage EXCEPTIONS.
 * @filesource MethodNotImplementedException.php
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
class MethodNotImplementedException extends Exception {
  
  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   * 
   * @param string $methodName Nombre del método
   *
   * @return void
   */
  public function __construct ( string $methodName ) {
    
    parent::__construct ( "{$methodName} method not implemented.", 0, null );
  }

  /**
   */
  function __destruct () {

    // TODO - Insert your code here
  }
}

