<?php
namespace sys\libs\exceptions;

/**
 * <strong>ParseTemplateException</strong>
 * Archivo creado el 04 de octubre de 2018 a las 10:54:05 a.m.
 * <p>Clase que permite definir el tipo de excepcion de solo lectura.</p>
 *
 * @name ParseTemplateException
 * @namespace sys\libs\exceptions
 * @package ECOMOD.
 * @subpackage EXCEPTIONS.
 * @filesource ParseTemplateException.php
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
class ParseTemplateException extends Exception {
  
  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @return void
   */
  public function __construct () {
    
    parent::__construct ( "Error al analizar la plantilla.", 0, null );
  }
}

