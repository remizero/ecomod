<?php
namespace sys\api\config\core;

use sys\core\abstracts\BaseClass;
use sys\libs\common\ClassUtils;
use sys\libs\common\FileUtils;
use sys\libs\exceptions\ArgumentException;

/**
 * <strong>ConfigAbs</strong>
 *
 * Archivo creado el 12 de septiembre de 2018 a las 00:11:40 a.m.
 * <p>Clase abstracta que define la estructura basica de las clases 
 * controladores para manipular distintos tipos de archivos y estructuras de 
 * datos para la configuración del sistema ECOMOD.</p>
 *
 * @name ConfigAbs
 * @namespace sys\api\config\core
 * @package ECOMOD.
 * @subpackage CONFIG.
 * @filesource ConfigAbs.php
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
abstract class ConfigAbs extends BaseClass {
  
  /**
   * 
   * @var array
   */
  protected $parsed = array ();
  
  /**
   * Ruta del archivo a analizar.
   * 
   * @var string
   */
  protected $path;
  
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
   */
  function __destruct () {

    // TODO - Insert your code here
  }
  
  /**
   * Método que retorna un arreglo clave/valor representativo del archivo de
   * configuración.
   * 
   * @param array $config
   * @param string $key
   * @param mixed $value
   * 
   * @return array
   */
  protected function _pair ( array $config, string $key, $value ) {
    
    if ( \strstr ( $key, "." ) ) {
      
      $parts = \explode ( ".", $key, 2 );
      if ( empty ( $config [ $parts [ 0 ] ] ) ) {
        
        $config [ $parts [ 0 ] ] = array ();
      }
      $config [ $parts [ 0 ] ] = $this->_pair ( $config [ $parts [ 0 ] ], $parts [ 1 ], $value );
      
    } else {
      
      $config [ $key ] = $value;
    }
    return $config;
  }
  
  /**
   * Método que permite analizar un archivo de configuración.
   * 
   * @return boolean Verdadero si analiza el archivo, falso en caso contrario.
   */
  public abstract function parse ();
  
  /**
   * Método que permite leer un archivo de configuración.
   *
   * @param string $path Ruta del archivo a leer.
   *
   * @throws ArgumentException
   *
   * @return boolean
   */
  public function read ( string $path ) {

    switch ( \strtolower ( FileUtils::getFileExtension ( FileUtils::validate ( $path ) ) ) == \strtolower ( ClassUtils::getClassNameNoNamespace ( \get_class ( $this ) ) ) ) {
      
      case true:
        
        $this->path = $path;
        return true;
        break;
        
      default:
        
        throw new ArgumentException ();
        break;
    }
  }
  
  /**
   * Método que permite obtener la representacion de un archivo de configuracion
   * en una variable de tipo array.
   * 
   * @return array
   */
  public abstract function toArray ();
  
  /**
   * Método que permite obtener la representacion de un archivo de configuracion
   * en una variable de tipo object.
   *
   * @return \stdClass
   */
  public abstract function toObject ();
  
  /**
   * Método que permite escribir un archivo de configuración.
   *
   * @param string $path Ruta del archivo a escribir.
   * 
   * @return
   */
  public abstract static function write ( string $path, $data );
}

