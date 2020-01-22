<?php

namespace sys\libs\exceptions;

/**
 * <strong>BinaryException</strong>
 *
 * Archivo creado el 06 de septiembre de 2018 a las 01:03:35 a.m.
 * <p>Clase que permite procesar las excepciones de tipo Binary.</p>
 *
 * @name BinaryException
 * @namespace sys\libs\exceptions
 * @package ECOMOD.
 * @subpackage EXCEPTIONS.
 * @filesource BinaryException.php
 * @version 1.0
 * @since 1.0
 * @author Filiberto Zaá Avila ( remizero ) filizaa@gmail.com.
 * @copyright Todos los derechos reservados 2018.
 * @link http://www.ecosoftware.com.ve
 * @license http://www.ecosoftware.com.ve/licencia
 * @uses .php
 * @see .php
 */
class BinaryException extends Exception {

  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @return void
   */
  public function __construct () {

    parent::__construct ( "Invalid Binary value.", 0, null );
  }

  /**
   */
  function __destruct () {

  }
}

