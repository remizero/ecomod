<?php
namespace sys\core;

use sys\patterns\creational\Singleton;

/**
 * <strong>Registry</strong>
 *
 * Archivo creado el 25 de septiembre de 2018 a las 22:07:00 p.m.
 * <p>Clase que permite almacenar instancias de otras clases de la forma
 * clave/instanciapara para el sistema ECOMOD.</p>
 *
 * @name Registry
 * @namespace sys\api\config
 * @package ECOMOD.
 * @subpackage CORE.
 * @filesource Registry.php
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
class Registry {
  
  use Singleton;
  
  /**
   * Arreglo que almacena las instancias de las clases.
   *  
   * @var array
   */
  private static $instances = array ();

  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @return void
   */
  private function __construct () {

    // TODO - Insert your code here
  }

  /**
   * Método que permite obtener la instancia de una clase dado el índice $key.
   * 
   * @param string $key Índice asociado a la instancia a buscar.
   * @param mixed $default Valor a devolver por omisión en caso de no existir 
   *        el índice $key.
   * 
   * @return mixed
   */
  public function get ( string $key, $default = null ) {

    if ( isset ( self::$instances [ $key ] ) ) {
      
      return self::$instances [ $key ];
    }
    return $default;
  }

  /**
   * Retorna un arreglo con todas las instancias almacenadas.
   * 
   * @return array
   */
  public function getInstances () {
    
    return Registry::$instances;
  }

  /**
   * Método que permite asignar la instancia de una clase al índice indicado $key.
   * 
   * @param string $key Índice asociado a la instancia a almacenar.
   * @param mixed $instance Instancia del objeto a almacenar.
   * 
   * @return void
   */
  public function set ( string $key, $instance = null ) {

    self::$instances [ $key ] = $instance;
  }

  /**
   * Método que permite eliminar la instancia de una clase dado su índice $key.
   * 
   * @param string $key Índice asociado a la instancia a eliminar.
   * 
   * @return void
   */
  public function erase ( string $key ) {

    unset ( self::$instances [ $key ] );
    return !\array_key_exists ( $key , self::$instances );
  }
}
