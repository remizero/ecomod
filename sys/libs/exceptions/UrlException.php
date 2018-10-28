<?php
namespace sys\libs\exceptions;

/**
 * <strong>UrlException</strong>
 *
 * Archivo creado el 27 de octubre de 2018 a las 19:51:20 p.m.
 * <p>Clase que permite procesar las excepciones de tipo URL.</p>
 *
 * @name UrlException
 * @namespace sys\libs\exceptions
 * @package ECOMOD.
 * @subpackage EXCEPTIONS.
 * @filesource UrlException.php
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
class UrlException extends Exception {
  
  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @return void
   */
  public function __construct () {

    parent::__construct ( "Invalid URL value.", 0, null );
  }
}

