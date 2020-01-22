<?php

namespace sys\libs\exceptions;

/**
 * <strong>ArrayException</strong>
 *
 * Archivo creado el 05 de septiembre de 2018 a las 22:12:35 p.m.
 * <p>Clase que permite procesar las excepciones de tipo array.</p>
 *
 * @name ArrayException
 * @namespace sys\libs\exceptions
 * @package ECOMOD.
 * @subpackage EXCEPTIONS.
 * @filesource ArrayException.php
 * @version 1.0
 * @since 1.0
 * @author Filiberto Zaá Avila ( remizero ) filizaa@gmail.com.
 * @copyright Todos los derechos reservados 2018.
 * @link http://www.ecosoftware.com.ve
 * @license http://www.ecosoftware.com.ve/licencia
 * @uses .php
 * @see .php
 */
class ArrayException extends Exception {

  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @return void
   */
  public function __construct () {

    parent::__construct ( "Invalid Array value.", 0, null );
  }

  /**
   */
  function __destruct () {

  }
}

