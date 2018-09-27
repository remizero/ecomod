<?php
namespace sys\core;

use sys\core\abstracts\BaseClass;

/**
 * <strong>Router</strong>
 *
 * Archivo creado el 26 de septiembre de 2018 a las 22:56:00 p.m.
 * <p>Clase que permite inferir las rutas a los recursos del sistema ECOMOD.</p>
 *
 * @name Router
 * @namespace sys\api\config
 * @package ECOMOD.
 * @subpackage CACHE.
 * @filesource Router.php
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
 *       <li>https://diego.com.es/rendimiento-en-php.</li>
 *       <li>.</li>
 *       <li>.</li>
 *       </ul>
 */
class Router extends BaseClass {
  
  /**
   * @readwrite
   */
  protected $_url;
  
  /**
   * @readwrite
   */
  protected $_extension;
  
  /**
   * @read
   */
  protected $_controller;
  
  /**
   * @read
   */
  protected $_action;
  
  /**
   * 
   * @var array
   */
  protected $_routes = array ();
  
  /**
   *
   * @param array $options
   *
   * @return void
   */
  public function __construct ( array $options ) {

    parent::__construct ( $options );
  }
}

