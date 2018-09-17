<?php
namespace sys\api\config;

use sys\api\config\controller\Ini;
use sys\api\config\controller\Json;
use sys\api\config\controller\Php;
use sys\api\config\controller\Toml;
use sys\api\config\controller\Xml;
use sys\api\config\controller\Yaml;
use sys\api\config\core\ConfigAbs;
use sys\patterns\creational\FactoryMethod;
use sys\libs\exceptions\ArgumentException;

/**
 * <strong>Config</strong>
 *
 * Archivo creado el 12 de septiembre de 2018 a las 00:04:30 a.m.
 * <p>Clase abstracta que permite crear objetos controladores para manipular 
 * distintos tipos de archivos y estructuras de datos para la configuración del 
 * sistema ECOMOD.</p>
 *
 * @name Config
 * @namespace sys\api\config
 * @package ECOMOD.
 * @subpackage CONFIG.
 * @filesource Config.php
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
abstract class Config implements FactoryMethod {
  
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
      
      case Config::INI:

        return new Ini ();
        break;
        
      case Config::JSON:
        
        return new Json ();
        break;
        
      case Config::PHP:
        
        return new Php ();
        break;
        
      case Config::TOML:
        
        return new Toml ();
        break;
        
      case Config::XML:
        
        return new Xml ();
        break;
        
      case Config::YAML:
        
        return new Yaml ();
        break;
        
      default:
        
        throw new ArgumentException ();
        break;
    }
  }
}

