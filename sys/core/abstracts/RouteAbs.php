<?php
namespace sys\core\abstracts;

/**
 * <strong>RouteAbs</strong>
 *
 * Archivo creado el 26 de septiembre de 2018 a las 00:20:00 a.m.
 * <p>Clase que permite inferir las rutas a los recursos del sistema ECOMOD.</p>
 *
 * @name RouteAbs
 * @namespace sys\api\config
 * @package ECOMOD.
 * @subpackage ROUTER.
 * @filesource RouteAbs.php
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
abstract class RouteAbs extends BaseClass {
  
  /**
   * @readwrite
   */
  protected $pattern;
  
  /**
   * @readwrite
   */
  protected $controller;
  
  /**
   * @readwrite
   */
  protected $action;
  
  /**
   * @readwrite
   */
  protected $parameters = array ();
  
  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @param array $options
   *
   * @return void
   */
  public function __construct ( array $options = array () ) {
    
    parent::__construct ( $options );
  }
  
  /**
   * Método que permite crear la cadena de búsqueda correcta y devolver 
   * cualquier coincidencia con la URL proporcionada.
   *  
   * @param string $url Dirección url del recurso solicitado.
   *
   * @return int|boolean
   */
  public abstract function matches ( string $url );
}

