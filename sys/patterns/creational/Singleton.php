<?php
namespace sys\patterns\creational;

/**
 * <strong>Singleton</strong>
 * 
 * Archivo creado el 14 de agosto de 2018 a las 2:45:37 p.m.
 * <p>Trait que permite heredar la cualidad de objeto Singleton a cualquier clase
 * que lo extienda.</p>
 * 
 * 
 * @name Singleton
 * @namespace sys\patterns\creational
 * @package ECOMOD.
 * @subpackage PATTERNS.
 * @filesource Singleton.php
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
 *       <li>.</li>
 *       <li>.</li>
 *       <li>.</li>
 *       </ul>
 */
trait Singleton {

  /**
   * Instancia estática de la clase.
   * 
   * @var mixed $instance
   */
  private static $instance = NULL;

  /**
   * Evita la clonación de la instancia, garantizando que solo exista una 
   * instancia de la clase heredada.
   * 
   * @return void
   */
  public function __clone () {

    \trigger_error ( 'Clonacion no permitida.', E_USER_ERROR );
  }

  /**
   * Método que permite la creación de una instancia estática de la clase 
   * heredada.
   * 
   * @return mixed
   */
  public static function getInstance () {

    if ( !isset ( self::$instance ) ) {

      $c = __CLASS__; // Esta forma permite que el código funcione en cualquier clase.
      self::$instance = new $c ();
    }
    return self::$instance;
  }
}

