<?php

namespace sys\libs\exceptions;

/**
 * <strong>ArgumentException</strong>
 * Archivo creado el 31 de agosto de 2018 a las 18:29:00 p.m.
 * <p>Clase que permite definir el tipo de excepcion de error en tipo o tipo
 * invalido.</p>
 *
 * @name ArgumentException
 * @namespace sys\libs\exceptions
 * @package ECOMOD.
 * @subpackage EXCEPTIONS.
 * @filesource ArgumentException.php
 * @version 1.0
 * @since 1.0
 * @author Filiberto Zaá Avila ( remizero ) filizaa@gmail.com.
 * @copyright Todos los derechos reservados 2018.
 * @link http://www.ecosoftware.com.ve
 * @license http://www.ecosoftware.com.ve/licencia
 * @uses .php
 * @see .php
 */
class ArgumentException extends Exception {

  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @return void
   */
  public function __construct () {

    parent::__construct ( "Invalid type.", 0, null );
  }

  /**
   */
  function __destruct () {

  }
}

