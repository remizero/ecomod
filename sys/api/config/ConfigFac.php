<?php
namespace sys\api\config;

use sys\api\config\controller\Ini;
use sys\api\config\controller\Json;
use sys\api\config\controller\Php;
use sys\api\config\controller\Toml;
use sys\api\config\controller\Xml;
use sys\api\config\controller\Yaml;
use sys\api\config\core\ConfigAbs;
use sys\libs\exceptions\ArgumentException;
use sys\patterns\creational\FactoryMethod;

/**
 * <strong>ConfigFac</strong>
 *
 * Archivo creado el 20 de septiembre de 2018 a las 20:43:00 a.m.
 * <p>Clase abstracta que permite crear objetos controladores para manipular
 * distintos tipos de archivos y estructuras de datos para la configuración del
 * sistema ECOMOD.</p>
 *
 * @name ConfigFac
 * @namespace sys\api\config
 * @package ECOMOD.
 * @subpackage CONFIG.
 * @filesource ConfigFac.php
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
abstract class ConfigFac implements FactoryMethod {
  
  /**
   * Constante que define el tipo de controlador Ini.
   *
   * @var string
   */
  const INI = 'ini';
  
  /**
   * Constante que define el tipo de controlador Json.
   *
   * @var string
   */
  const JSON = 'json';
  
  /**
   * Constante que define el tipo de controlador Php.
   *
   * @var string
   */
  const PHP = 'php';
  
  /**
   * Constante que define el tipo de controlador Toml.
   *
   * @var string
   */
  const TOML = 'toml';
  
  /**
   * Constante que define el tipo de controlador Xml.
   *
   * @var string
   */
  const XML = 'xml';
  
  /**
   * Constante que define el tipo de controlador Yaml.
   *
   * @var string
   */
  const YAML = 'yaml';
  
  /**
   * Función que permite crear clases de un tipo, determinado por la
   * implementación en la clase concreta.
   *
   * @param string $className Nombre de la clase a crear.
   *
   * @throws ArgumentException
   *
   * @return ConfigAbs
   *
   * @see \sys\patterns\creational\FactoryMethod::create()
   */
  public static function create ( string $className ) {
    
    switch ( \strtolower ( $className ) ) {
      
      case self::INI:
        
        return new Ini ();
        break;
        
      case self::JSON:
        
        return new Json ();
        break;
        
      case self::PHP:
        
        return new Php ();
        break;
        
      case self::TOML:
        
        return new Toml ();
        break;
        
      case self::XML:
        
        return new Xml ();
        break;
        
      case self::YAML:
        
        return new Yaml ();
        break;
        
      default:
        
        throw new ArgumentException ();
        break;
    }
  }
}
