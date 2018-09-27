<?php
namespace sys\api\router\exceptions;

use sys\libs\exceptions\Exception;

/**
 * <strong>RouteException</strong>
 * Archivo creado el 27 de septiembre de 2018 a las 01:03:00 a.m.
 * <p>Clase que permite definir el tipo de excepcion de tipo ruta invalida.</p>
 *
 * @name RouteException
 * @namespace sys\libs\exceptions
 * @package ECOMOD.
 * @subpackage ROUTER.
 * @filesource RouteException.php
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
class RouteException extends Exception {
  
  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @return void
   */
  public function __construct () {
    
    parent::__construct ( "Invalid route.", 0, null );
  }
}

