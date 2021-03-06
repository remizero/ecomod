<?php
namespace sys\libs\exceptions;

/**
 * <strong>ResponseException</strong>
 *
 * Archivo creado el 03 de octubre de 2018 a las 19:52:20 p.m.
 * <p>Clase que ejecutar acciones secundarias antes o después de las acciones
 * principales definidas para el sistema ECOMOD.</p>
 *
 * @name ResponseException
 * @namespace sys\api\config
 * @package ECOMOD.
 * @subpackage EXCEPTIONS.
 * @filesource ResponseException.php
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
class ResponseException extends Exception {
  
  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @param string $className Nombre de la clase.
   *
   * @return void
   */
  public function __construct ( string $className ) {
    
    parent::__construct ( "{$className} ResponseException.", 0, null );
  }
}

