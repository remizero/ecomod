<?php

namespace sys\api\cache\exceptions;

use sys\libs\exceptions\Exception;

/**
 * <strong>CacheException</strong>
 * Archivo creado el 24 de septiembre de 2018 a las 22:32:30 p.m.
 * <p>Clase que permite definir el tipo de excepcion de para cache.</p>
 *
 * @name CacheException
 * @namespace sys\api\cache\exceptions
 * @package ECOMOD.
 * @subpackage CACHE.
 * @filesource CacheException.php
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
 */
class CacheException extends Exception {

  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @return void
   */
  public function __construct () {

    parent::__construct ( "Invalid syntax. Could not parse configuration file.", 0, null );
  }

  /**
   */
  function __destruct () {

  }
}

