<?php
namespace sys\libs\exceptions;

/**
 * <strong>IndexException</strong>
 *
 * Archivo creado el 27 de octubre de 2018 a las 22:00:10 p.m.
 * <p>Clase que permite definir el tipo de excepcion de tipo index.</p>
 *
 * @name IndexException
 * @namespace sys\api\config
 * @package ECOMOD.
 * @subpackage EXCEPTIONS.
 * @filesource IndexException.php
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
class IndexException extends Exception {
  
  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @return void
   */
  public function __construct () {
    
    parent::__construct ( "Key must be a string or a number.", 0, null );
  }
}

