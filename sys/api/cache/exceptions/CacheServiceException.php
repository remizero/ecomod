<?php
namespace sys\api\cache\exceptions;

use sys\libs\exceptions\Exception;

/**
 * <strong>CacheServiceException</strong>
 * Archivo creado el 24 de septiembre de 2018 a las 22:58:05 p.m.
 * <p>Clase que permite definir el tipo de excepcion de para los diferentes 
 * servicios de cache.</p>
 *
 * @name CacheServiceException
 * @namespace sys\api\cache\exceptions
 * @package ECOMOD.
 * @subpackage CACHE.
 * @filesource CacheServiceException.php
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
class CacheServiceException extends Exception {
  
  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @return void
   */
  public function __construct () {
    
    parent::__construct ( "Unable to connect to a valid cache service.", 0, null );
  }

  /**
   */
  function __destruct () {

    // TODO - Insert your code here
  }
}

