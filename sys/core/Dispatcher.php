<?php

namespace sys\core;

use sys\core\abstracts\BaseClass;

/**
 * <strong>Dispatcher</strong>
 *
 * Archivo creado el 10 de marzo de 2020 a las 16:03:00 p.m.
 * <p>El propósito de la clase Yaf_Dispatcher es inicializar el entorno de
 * peticiones, enrutar las peticiones entrantes, y despachar cuanlquier acción
 * encontrada; agrega cualesquiera respuestas y las devuelve cuando el proceso
 * está completado.
 * Yaf_Dispatcher también implementa el patrón Singleton, lo que significa que
 * solamente puede estar disponible una instancia de la misma a la vez. Esto le
 * permite también actuar como un registro en el que se puede establecer el
 * orden de los objetos del proceso de despachamiento.</p>
 *
 * @name Dispatcher
 * @namespace sys\core
 * @package ECOMOD.
 * @subpackage CORE.
 * @filesource Dispatcher.php
 * @version 1.0
 * @since 1.0
 * @author Filiberto Zaá Avila ( remizero ) filizaa@gmail.com.
 * @copyright Todos los derechos reservados 2020.
 * @link http://www.ecosoftware.com.ve
 * @license http://www.ecosoftware.com.ve/licencia
 * @uses
 * @see .php
 * @todo <p>.</p>
 */
class Dispatcher extends BaseClass {

  /**
   * @param array $options
   *
   * @return void
   */
  public function __construct ( array $options ) {

    parent::__construct ( $options );
  }

  /**
   */
  function __destruct () {

  }

  public function render () {

  }

  public function setAction () {

  }

  public function setController ( Controller $controller ) {

  }

  public function setModule () {

  }

  public function setRequest ( Request $request ) {

  }

  public function setResponse ( Response $response ) {

  }

  public function setTemplate ( Template $template ) {

  }

  public function setView ( View $view ) {

  }
}

