<?php
namespace sys\api\cache;

use sys\api\cache\core\CacheAbs;
use sys\api\cache\controller\Memcached;
use sys\api\cache\controller\Memcachedb;
use sys\api\cache\controller\Xcache;
use sys\libs\exceptions\ArgumentException;
use sys\patterns\creational\FactoryMethod;

/**
 * <strong>CacheFac</strong>
 *
 * Archivo creado el 23 de septiembre de 2018 a las 20:43:00 p.m.
 * <p>Clase abstracta que permite crear objetos controladores para manipular
 * distintos tipos de archivos y estructuras de datos para la configuración del
 * sistema ECOMOD.</p>
 *
 * @name CacheFac
 * @namespace sys\api\config
 * @package ECOMOD.
 * @subpackage CACHE.
 * @filesource CacheFac.php
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
abstract class CacheFac implements FactoryMethod {
  
  /**
   * Constante que define el tipo de controlador Ini.
   *
   * @var string
   */
  const MEMCACHED = 'Memcached';
  
  /**
   * Constante que define el tipo de controlador Ini.
   *
   * @var string
   */
  const MEMCACHEDB = 'memcachedb';
  
  /**
   * Constante que define el tipo de controlador Ini.
   *
   * @var string
   */
  const XCACHE = 'xcache';
  
  /**
   * Función que permite crear clases de un tipo, determinado por la
   * implementación en la clase concreta.
   *
   * @param string $className Nombre de la clase a crear.
   *
   * @throws ArgumentException
   *
   * @return CacheAbs
   *
   * @see \sys\patterns\creational\FactoryMethod::create()
   */
  public static function create ( string $className ) {

    \var_dump ( "ENTRÓ A CREAR EL SERVICIO DE CACHÉ" );
    switch ( \strtolower ( $className ) ) {
      
      case self::MEMCACHED :
        
        return new Memcached ();
        break;
        
      case self::MEMCACHEDB :
        
        return new Memcachedb ();
        break;
        
      case self::XCACHE :
        
        return new Xcache ();
        break;
        
      default:
        
        throw new ArgumentException ();
        break;
  }
}

