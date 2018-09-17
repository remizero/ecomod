<?php
namespace sys\libs\exceptions;

/**
 * <strong>FileNotFoundException</strong>
 *
 * Archivo creado el 13 de septiembre de 2018 a las 21:20:10 p.m.
 * <p>Clase que indica que no se pudo encontrar el archivo indicado.</p>
 *
 *
 * @name FileNotFoundException
 * @namespace sys\libs\exceptions
 * @package ECOMOD.
 * @subpackage EXCEPTIONS.
 * @filesource FileNotFoundException.php
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
class FileNotFoundException extends Exception {
  
  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @param string $fileName Nombre del archivo.
   *
   * @return void
   */
  public function __construct ( string $fileName ) {
    
    parent::__construct ( "The {$fileName} file can not be found.", 0, null );
  }

  /**
   */
  function __destruct () {

    // TODO - Insert your code here
  }
}

