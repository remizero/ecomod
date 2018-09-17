<?php
namespace sys\libs\exceptions;

/**
 * <strong>ImplementationException</strong>
 * Archivo creado el 31 de agosto de 2018 a las 18:41:44 p.m.
 * <p>Clase que permite definir el tipo de excepcion de solo lectura.</p>
 *
 * @name ImplementationException
 * @namespace sys\libs\exceptions
 * @package ECOMOD.
 * @subpackage EXCEPTIONS.
 * @filesource ImplementationException.php
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
class ImplementationException extends Exception {
  
  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @return void
   */
  public function __construct () {

    parent::__construct ();
    // TODO - Insert your code here
  }

  /**
   */
  function __destruct () {

    // TODO - Insert your code here
  }
}

