<?php
namespace sys\api\config\controller;

use sys\api\config\core\ConfigAbs;
use sys\api\config\exceptions\SyntaxException;
use sys\libs\common\ArrayUtils;
use sys\libs\exceptions\PathException;

/**
 * <strong>Ini</strong>
 *
 * Archivo creado el 12 de septiembre de 2018 a las 00:23:00 a.m.
 * <p>Clase controladores que permite manipular archivos de configuración de
 * tipo INI para la configuración del sistema ECOMOD.</p>
 *
 * @name Ini
 * @namespace sys\api\config\controller
 * @package ECOMOD.
 * @subpackage CONFIG.
 * @filesource Ini.php
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
class Ini_original extends ConfigAbs {

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
   * Método que permite analizar un archivo de configuración INI.
   *
   * @param string $path Ruta del archivo a analizar.
   *       
   * @return array
   *
   * @see \sys\api\config\core\ConfigAbs::parse()
   */
  public function parse ( string $path ) {

    if ( empty ( $path ) ) {
      
      throw new PathException ();
    }
    if ( !isset ( $this->_parsed [ $path ] ) ) {
      
      $config = array ();
      \ob_start ();
      include ( "{$path}.ini" );
      $string = \ob_get_contents ();
      \ob_end_clean ();
      $pairs = \parse_ini_string ( $string );
      if ( $pairs == false ) {
        
        throw new SyntaxException ();
      }
      foreach ( $pairs as $key => $value ) {
        
        $config = $this->_pair ( $config, $key, $value );
      }
      $this->_parsed [ $path ] = ArrayUtils::toObject ( $config );
    }
    return $this->_parsed [ $path ];
  }

  /**
   * Método que permite leer un archivo de configuración.
   *
   * @param string $path Ruta del archivo a leer.
   *       
   * @return
   *
   * @see \sys\api\config\core\ConfigAbs::read()
   */
  public function read ( string $path ) {

  }

  /**
   * Método que permite escribir un archivo de configuración.
   *
   * @param string $path Ruta del archivo a escribir.
   *       
   * @return
   *
   * @see \sys\api\config\core\ConfigAbs::write()
   */
  public function write ( string $path ) {

  }
public function toArray () {

  }

public function toObject () {

  }

}

