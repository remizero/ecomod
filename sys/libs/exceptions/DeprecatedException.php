<?php

namespace sys\libs\exceptions;

/**
 * <strong>DeprecatedException</strong>
 *
 * Archivo creado el 19 de septiembre de 2018 a las 02:06:19 a.m.
 * <p>Clase que permite procesar las excepciones de tipo error de compilacion.</p>
 *
 * @name DeprecatedException
 * @namespace sys\libs\exceptions
 * @package ECOMOD.
 * @subpackage EXCEPTIONS.
 * @filesource DeprecatedException.php
 * @version 1.0
 * @since 1.0
 * @author Filiberto Zaá Avila ( remizero ) filizaa@gmail.com.
 * @copyright Todos los derechos reservados 2018.
 * @link http://www.ecosoftware.com.ve
 * @license http://www.ecosoftware.com.ve/licencia
 * @uses .php
 * @see .php
 */
class DeprecatedException extends ErrorHandlerException {

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
  public function __construct ( string $code, string $error, string $file = NULL, string $line = NULL) {

    $this->isError = true;
    parent::__construct ( $code, $error, $file, $line );
  }

  /**
   */
  function __destruct () {

  }
}

