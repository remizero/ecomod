<?php
namespace sys\libs\exceptions;

/**
 * <strong>ControllerException</strong>
 *
 * Archivo creado el 02 de octubre de 2018 a las 23:34:35 p.m.
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
class LayoutException extends Exception {
  
  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @return void
   */
  public function __construct () {
    
    parent::__construct ( "Invalid layout/template syntax", 0, null );
  }
}

