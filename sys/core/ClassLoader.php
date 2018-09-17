<?php
namespace sys\core;

use sys\libs\common\LoadingTime;

/**
 * <strong>ClassLoader</strong>
 * 
 * Archivo creado el 14 de agosto de 2018 a las 2:45:37 p.m.
 * <p>Clase que permite cargar los archivos php de forma automatica, validar la 
 * existencia de los mismos y mostrar mensajes de error si no son encontrados.</p>
 *
 * @name ClassLoader
 * @namespace sys\core
 * @package ECOMOD.
 * @subpackage CORE.
 * @filesource ClassLoader.php
 * @version 1.0
 * @since 1.0
 * @author Filiberto Zaá Avila ( remizero ) filizaa@gmail.com.
 * @copyright Todos los derechos reservados 2018.
 * @link http://www.ecosoftware.com.ve
 * @license http://www.ecosoftware.com.ve/licencia
 * @uses <ul>
 *         <li>.php</li>
 *       </ul>
 * @see .php
 * @todo <p>En futuras versiones estarán disponibles los métodos para dar
 *       soporte a:</p> 
 *       <ul>
 *         <li>https://diego.com.es/rendimiento-en-php.</li>
 *         <li>.</li>
 *         <li>.</li>
 *       </ul>
 */
class ClassLoader {

  /**
   *
   * @var boolean
   */
  private $debug = false;

  /**
   * Arreglo con todas las dependencias cargadas.
   *
   * @var array
   */
  private $dependencies = array ();

  /**
   *
   * @var array
   */
  private $fallbackDirs = array ();

  /**
   *
   * @var LoadingTime
   */
  private $loadingTime = NULL;

  /**
   *
   * @var array
   */
  private $prefixes = array ();

  /**
   *
   * @deprecated
   * @var boolean
   */
  private $useIncludePath = false;

  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @param bool $debug Verdadero, indica si se desea generar comentarios
   *          adicionales sobre el tiempo de carga, cantidad y nombre de una
   *          dependencia solicitada, falso, si no se quiere los comentarios
   *          adicionales.
   *          
   * @return void
   */
  public function __construct ( bool $debug = false ) {

    $this->debug = $debug;
    if ( $this->debug ) {
      
      $this->loadingTime = new LoadingTime ();
    }
  }

  /**
   */
  function __destruct () {

    // TODO - Insert your code here
  }

  /**
   * Registers a set of classes.
   *
   * @param string $prefix The classes prefix.
   * @param array|string $paths The location(s) of the classes.
   * 
   * @return void
   */
  public function addPrefix ( string $prefix, $paths ) {

    if ( !$prefix ) {
      
      foreach ( ( array ) $paths as $path ) {
        
        $this->fallbackDirs [] = $path;
      }
      return;
    }
    if ( isset ( $this->prefixes [ $prefix ] ) ) {
      
      if ( \is_array ( $paths ) ) {
        
        $this->prefixes [ $prefix ] = \array_unique ( \array_merge ( $this->prefixes [ $prefix ], $paths ) );
      } elseif ( !\in_array ( $paths, $this->prefixes [ $prefix ] ) ) {
        
        $this->prefixes [ $prefix ] [] = $paths;
      }
    } else {
      
      $this->prefixes [ $prefix ] = \array_unique ( ( array ) $paths );
    }
  }

  /**
   * Adds prefixes.
   *
   * @param array $prefixes Prefixes to add.
   * 
   * @return void
   */
  public function addPrefixes ( array $prefixes ) {

    foreach ( $prefixes as $prefix => $path ) {
      
      $this->addPrefix ( $prefix, $path );
    }
  }

  /**
   * Finds the path to the file where the class is defined.
   *
   * @param string $class The name of the class.
   * 
   * @return string|null The path, if found
   */
  public function findFile ( string $class ) {

    if ( false !== $pos = strrpos ( $class, '\\' ) ) { // namespaced class name
      
      $classPath = \str_replace ( '\\', DIRECTORY_SEPARATOR, \substr ( $class, 0, $pos ) ) . DIRECTORY_SEPARATOR;
      $className = \substr ( $class, $pos + 1 );
    } else { // PEAR-like class name
      
      $classPath = null;
      $className = $class;
    }
    $classPath .= \str_replace ( '_', DIRECTORY_SEPARATOR, $className ) . '.php';
    foreach ( $this->prefixes as $prefix => $dirs ) {
      
      if ( $class === \strstr ( $class, $prefix ) ) {
        
        foreach ( $dirs as $dir ) {
          
          if ( \file_exists ( $dir . DIRECTORY_SEPARATOR . $classPath ) ) {
            
            return $dir . DIRECTORY_SEPARATOR . $classPath;
          }
        }
      }
    }
    foreach ( $this->fallbackDirs as $dir ) {
      
      if ( \file_exists ( $dir . DIRECTORY_SEPARATOR . $classPath ) ) {
        
        return $dir . DIRECTORY_SEPARATOR . $classPath;
      }
    }
    // if ( $this->useIncludePath && $file = \stream_resolve_include_path (
    // $classPath ) ) {
    if ( $file = \stream_resolve_include_path ( $classPath ) ) {
      
      return $file;
    }
  }

  /**
   * Retorna la cantidad de dependencias cargadas.
   *
   * @return number
   */
  public function getDependenciesCount () {

    return \sizeof ( $this->dependencies );
  }

  /**
   * Returns fallback directories.
   *
   * @return array
   */
  public function getFallbackDirs () {

    return $this->fallbackDirs;
  }

  /**
   * Returns prefixes.
   *
   * @return array
   */
  public function getPrefixes () {

    return $this->prefixes;
  }

  /**
   * Can be used to check if the autoloader uses the include path to check for
   * classes.
   *
   * @deprecated
   * @return bool
   */
  public function getUseIncludePath () {

    return $this->useIncludePath;
  }

  /**
   * Loads the given class or interface.
   *
   * @param string $class The name of the class.
   * 
   * @return bool|null True, if loaded
   */
  public function loadClass ( string $class ) {

    if ( $this->debug && \is_null ( $this->loadingTime ) ) {
      
      $this->loadingTime->start ();
    }
    if ( $file = $this->findFile ( $class ) ) {
      
      require_once $file;
      if ( $this->debug ) {
        
        $this->dependencies [] = $file;
        if ( \is_null ( $this->loadingTime ) ) {
          
          $this->loadingTime->end ();
        }
      /**
       *
       * @todo faltaria agregar algun codigo que permita guardar el valor
       *       devuelto por el metodo $this->loadingTime->getLoadingTime (); en
       *       un log de errores y/o log de depuracion.
       */
      }
      return true;
    }
  }

  /**
   * Turns on searching the include for class files.
   *
   * @param bool $useIncludePath.
   *
   * @deprecated
   * @return void
   */
  public function setUseIncludePath ( bool $useIncludePath ) {

    $this->useIncludePath = ( bool ) $useIncludePath;
  }

  /**
   * Registers this instance as an autoloader.
   *
   * @param bool $prepend Whether to prepend the autoloader or not.
   * 
   * @return void
   */
  public function register ( bool $prepend = false ) {

    \spl_autoload_register ( array ( 
      $this,'loadClass' 
    ), true, $prepend );
  }

  /**
   * Unregisters this instance as an autoloader.
   *
   * @return void
   */
  public function unregister () {

    \spl_autoload_unregister ( array ( 
      $this,'loadClass' 
    ) );
  }
}
