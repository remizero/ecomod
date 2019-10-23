<?php

namespace sys\core;

use sys\core\abstracts\BaseClass;

/**
 * <strong>RequestHandler</strong>
 *
 * Archivo creado el 16 de octubre de 2019 a las 21:27:55 p.m.
 * <p>Clase que permite realizar acciones referentes a una solicitud ( Request )
 * capturando los recursos, métodos, clases y parámetros de una solicitud
 * definidas para ser usadas por el sistema ECOMOD.</p>
 *
 * @name RequestHandler
 * @namespace sys\core
 * @package ECOMOD.
 * @subpackage CORE.
 * @filesource RequestHandler.php
 * @version 1.0
 * @since 1.0
 * @author Filiberto Zaá Avila ( remizero ) filizaa@gmail.com.
 * @copyright Todos los derechos reservados 2019.
 * @link http://www.ecosoftware.com.ve
 * @license http://www.ecosoftware.com.ve/licencia
 * @uses <ul>
 *       <li>.php</li>
 *       </ul>
 * @see .php
 * @todo <p>En futuras versiones estarán disponibles los métodos para dar
 *       soporte a:</p>
 *       <ul>
 *       <li>https://diego.com.es/rendimiento-en-php.</li>
 *       <li>http://mialtoweb.es/como-saber-que-navegador-utiliza-un-usario-en-php/.</li>
 *       <li>https://gist.github.com/digitalhydra/7949601.</li>
 *       <li>https://artisansweb.net/detect-browser-php-javascript/.</li>
 *       <li>.</li>
 *       <li>.</li>
 *       <li>.</li>
 *       <li>.</li>
 *       </ul>
 */
class RequestHandler extends BaseClass {

  /**
   * Acción a ejecutar según la solicitud al servidor.
   *
   * @readwrite
   *
   * @var string
   */
  private $action = "";

  /**
   * Controlador a ejecutar según la solicitud al servidor.
   *
   * @readwrite
   *
   * @var string
   */
  private $controller = "";

  /**
   * Método a ejecutar según la solicitud al servidor.
   *
   * @readwrite
   *
   * @var string
   */
  private $method = "";

  /**
   * Módulo
   *
   * @readwrite
   *
   * @var string
   */
  private $module = "";

  /**
   * Parámetros a asignar al método solicitado según la solicitud al servidor.
   *
   * @readwrite
   *
   * @var string
   */
  private $params = "";

  /**
   * @param array $options
   *
   * @return void
   */
  public function __construct ( array $options ) {

    parent::__construct ( $options );
    // TODO - Insert your code here
  }

  /**
   */
  function __destruct () {

    // TODO - Insert your code here
  }
}

