<?php
namespace sys\libs\exceptions;

/**
 * <strong>PropertyValueException</strong>
 *
 * Archivo creado el 08 de septiembre de 2018 a las 15:00:00 p.m.
 * <p>Clase que permite definir el tipo de excepcion de solo lectura.</p>
 *
 * @name PropertyValueException
 * @namespace sys\libs\exceptions
 * @package ECOMOD.
 * @subpackage EXCEPTIONS.
 * @filesource PropertyValueException.php
 * @version 1.0
 * @since 1.0
 * @author Filiberto Zaá Avila ( remizero ) filizaa@gmail.com.
 * @copyright Todos los derechos reservados 2018.
 * @link http://www.ecosoftware.com.ve
 * @license http://www.ecosoftware.com.ve/licencia
 * @uses <ul>
 *         <li>.php</li>
 *       </ul>
 * @see .php
 * @todo <p>En futuras versiones estarán disponibles los métodos para dar
 *       soporte a:</p>
 *       <ul>
 *         <li>.</li>
 *         <li>.</li>
 *         <li>.</li>
 *       </ul>
 */
class PropertyValueException extends Exception {
  
  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @param string $propertyName Nombre de la propiedad.
   *
   * @return void
   */
  public function __construct ( string $propertyName ) {

    parent::__construct ( "The value of the {$propertyName} property is invalid.", 0, null );
  }

  /**
   */
  function __destruct () {

    // TODO - Insert your code here
  }
}

