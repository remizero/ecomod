<?php
namespace sys\libs\exceptions;

/**
 * <strong>WarningException</strong>
 *
 * Archivo creado el 19 de septiembre de 2018 a las 00:46:20 a.m.
 * <p>Clase que permite procesar las excepciones de tipo error.</p>
 *
 * @name WarningException
 * @namespace sys\libs\exceptions
 * @package ECOMOD.
 * @subpackage EXCEPTIONS.
 * @filesource WarningException.php
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
class WarningException extends ErrorHandlerException {
  
  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @param string $code Codigo del error.
   * @param string $error Mensaje descriptivo del error.
   * @param string $file Archivo donde se genera el error.
   * @param string $line Linea donde se genera el error.
   *
   * @return void
   */
  public function __construct ( string $code, string $error, string $file = NULL, string $line = NULL ) {

    $this->isError = true;
    parent::__construct ( $code, $error, $file, $line );
  }

  /**
   */
  function __destruct () {

    // TODO - Insert your code here
  }
}

