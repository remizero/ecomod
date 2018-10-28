<?php
namespace sys\libs\common;

/**
 * <strong>RequestUtils</strong>
 *
 * Archivo creado el 03 de octubre de 2018 a las 00:03:45 a.m.
 * <p>Clase que ejecutar acciones secundarias antes o después de las acciones
 * principales definidas para el sistema ECOMOD.</p>
 *
 * @name RequestUtils
 * @namespace sys\api\config
 * @package ECOMOD.
 * @subpackage LIBS-COMMON.
 * @filesource RequestUtils.php
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
abstract class RequestUtils {
  
  /**
   *
   * @param string $key
   * @param string $default
   *
   * @return string
   */
  public static function get ( string $key, string $default = "" ) {

    if ( ! empty ( $_GET [ $key ] ) ) {
      
      return $_GET [ $key ];
    }
    return $default;
  }
  
  /**
   *
   * @param string $key
   * @param string $default
   *
   * @return string
   */
  public static function post ( string $key, string $default = "" ) {

    if ( ! empty ( $_POST [ $key ] ) ) {
      
      return $_POST [ $key ];
    }
    return $default;
  }

  /**
   * 
   * @param string $key
   * @param string $default
   * 
   * @return string
   */
  public static function server ( string $key, string $default = "" ) {

    if ( ! empty ( $_SERVER [ $key ] ) ) {
      
      return $_SERVER [ $key ];
    }
    return $default;
  }

  /**
   * 
   * @param string $key
   * @param string $default
   * 
   * @return string
   */
  public static function cookie ( string $key, string $default = "" ) {

    if ( ! empty ( $_COOKIE [ $key ] ) ) {
      
      return $_COOKIE [ $key ];
    }
    return $default;
  }
  
  public static function requestMethod ( string $method ) {
    
    return ( $_SERVER [ "REQUEST_METHOD" ] == $method );
  }
}
