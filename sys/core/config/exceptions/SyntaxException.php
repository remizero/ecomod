<?php
namespace sys\core\config\exceptions;

use sys\libs\exceptions\Exception;

/**
 * <strong>SyntaxException</strong>
 * Archivo creado el 12 de septiembre de 2018 a las 01:29:30 a.m.
 * <p>Clase que permite definir el tipo de excepcion de error en tipo o tipo
 * invalido.</p>
 *
 * @name SyntaxException
 * @namespace sys\api\config\exceptions
 * @package ECOMOD.
 * @subpackage CONFIG.
 * @filesource SyntaxException.php
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
class SyntaxException extends Exception {
  
  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @return void
   */
  public function __construct () {
    
    parent::__construct ( "Invalid syntax. Could not parse configuration file.", 0, null );
  }

  /**
   */
  function __destruct () {

    // TODO - Insert your code here
  }
}

