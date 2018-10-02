<?php
namespace sys\api\router\exceptions;

use sys\libs\exceptions\Exception;

/**
 * <strong>ControllerException</strong>
 *
 * Archivo creado el 01 de octubre de 2018 a las 20:56:35 p.m.
 * <p>Clase que permite definir el tipo de excepción de controlador no 
 * encontrado o inválido.</p>
 *
 * @name ControllerException
 * @namespace sys\api\config
 * @package ECOMOD.
 * @subpackage ROUTER.
 * @filesource ControllerException.php
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
 *       <li>https://diego.com.es/rendimiento-en-php.</li>
 *       <li>.</li>
 *       <li>.</li>
 *       </ul>
 */
class ControllerException extends Exception {
  
  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @param string $controllerName Nombre del controlador.
   *
   * @return void
   */
  public function __construct ( string $controllerName ) {
    
    parent::__construct ( "Controller {$controllerName} not found.", 0, null );
  }
}

