<?php
namespace sys\libs\exceptions;

/**
 * <strong>ClassNotFoundException</strong>
 *
 * Archivo creado el 16 de agosto de 2018 a las 23:07:20 p.m.
 * <p>Clase que indica que no se pudo encontrar la clase indicada.</p>
 *
 *
 * @name ClassNotFoundException
 * @namespace sys\libs\exceptions
 * @package ECOMOD.
 * @subpackage EXCEPTIONS.
 * @filesource ClassNotFoundException.php
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
class ClassNotFoundException extends Exception {
  
  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @param string $className Nombre de la clase.
   *
   * @return void
   */
  public function __construct ( string $className ) {
    
    parent::__construct ( "The {$className} class can not be found.", 0, null );
  }

  /**
   */
  function __destruct () {

    // TODO - Insert your code here
  }
}

