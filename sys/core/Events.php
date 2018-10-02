<?php
namespace sys\core;

/**
 * <strong>Events</strong>
 *
 * Archivo creado el 01 de octubre de 2018 a las 20:34:50 p.m.
 * <p>Clase que ejecutar acciones secundarias antes o después de las acciones
 * principales definidas para el sistema ECOMOD.</p>
 *
 * @name Events
 * @namespace sys\api\config
 * @package ECOMOD.
 * @subpackage CORE.
 * @filesource Events.php
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
abstract class Events {

  /**
   *
   * @var array
   */
  private static $callbacks = array ();

  /**
   * 
   * @param string $type
   * @param callable $callback
   * 
   * @return void
   */
  public static function add ( string $type, callable $callback ) {

    if ( empty ( self::$callbacks [ $type ] ) ) {
      
      self::$callbacks [ $type ] = array ();
    }
    self::$callbacks [ $type ] [] = $callback;
  }

  /**
   * 
   * @param string $type
   * @param array $parameters
   * 
   * @return mixed|boolean Retorna falso en caso de error.
   */
  public static function fire ( string $type, array $parameters = null ) {

    if ( ! empty ( self::$callbacks [ $type ] ) ) {
      
      foreach ( self::$callbacks [ $type ] as $callback ) {
        
        \call_user_func_array ( $callback, $parameters );
      }
    }
  }

  /**
   * Método que permite eliminar una retrollamada almacenada.
   * 
   * @param string $type
   * @param callable $callback
   * 
   * @return boolean True si remueve la función, falso en caso contrario.
   */
  public static function remove ( string $type, callable $callback ) {

    $return = FALSE;
    if ( ! empty ( self::$callbacks [ $type ] ) ) {
      
      foreach ( self::$callbacks [ $type ] as $i => $found ) {
        
        if ( $callback == $found ) {
          
          unset ( self::$callbacks [ $type ] [ $i ] );
          $return = TRUE;
          break;
        }
      }
    }
    return $return;
  }
}
