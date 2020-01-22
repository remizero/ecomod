<?php

namespace sys\api\router\exceptions;

use sys\libs\exceptions\Exception;

/**
 * <strong>ActionException</strong>
 *
 * Archivo creado el 01 de octubre de 2018 a las 21:05:55 p.m.
 * <p>Clase que permite definir el tipo de excepción de acción no encontrada o
 * inválida.</p>
 *
 * @name ActionException
 * @namespace sys\api\config
 * @package ECOMOD.
 * @subpackage ROUTER.
 * @filesource ActionException.php
 * @version 1.0
 * @since 1.0
 * @author Filiberto Zaá Avila ( remizero ) filizaa@gmail.com.
 * @copyright Todos los derechos reservados 2018.
 * @link http://www.ecosoftware.com.ve
 * @license http://www.ecosoftware.com.ve/licencia
 * @uses .php
 * @see .php
 * @todo REVISAR ESTO https://diego.com.es/rendimiento-en-php.
 */
class ActionException extends Exception {

  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @param string $actionName Nombre de la acción.
   *
   * @return void
   */
  public function __construct ( string $actionName ) {

    parent::__construct ( "Action {$actionName} not found.", 0, null );
  }
}

