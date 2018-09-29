<?php
namespace sys\api\config\controller;

use sys\api\config\core\ConfigAbs;
use sys\api\config\exceptions\SyntaxException;
use sys\libs\common\ArrayUtils;
use sys\libs\exceptions\MethodNotImplementedException;

/**
 * <strong>Php</strong>
 *
 * Archivo creado el 12 de septiembre de 2018 a las 00:45:40 a.m.
 * <p>Clase controladores que permite manipular archivos de configuracion de
 * tipo Php para la configuración del sistema ECOMOD.</p>
 *
 * @name Php
 * @namespace sys\api\config\controller
 * @package ECOMOD.
 * @subpackage CONFIG.
 * @filesource Php.php
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
class Php extends ConfigAbs {

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
   * Método que permite analizar un archivo de configuración Xml.
   *
   * @throws SyntaxException
   *
   * @return boolean Verdadero si analiza el archivo, SyntaxException en caso 
   *         contrario.
   *        
   * @see \sys\api\config\core\ConfigAbs::parse()
   */
  public function parse () {

    $settings = array ();
    include ( $this->path );
    $this->parsed = $settings;
    if ( \sizeof ( $this->parsed ) == 0 ) {
      
      throw new SyntaxException ();
    }
    return true;
  }

  /**
   * Método que permite obtener la representacion de un archivo de configuracion
   * en una variable de tipo array.
   *
   * @return array
   *
   * @see \sys\api\config\core\ConfigAbs::toArray()
   */
  public function toArray () {

    return $this->parsed;
  }

  /**
   * Método que permite obtener la representacion de un archivo de configuracion
   * en una variable de tipo object.
   *
   * @return \stdClass
   *
   * @see \sys\api\config\core\ConfigAbs::toObject()
   */
  public function toObject () {

    return ArrayUtils::toObject ( $this->parsed );
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
  public static function write ( string $path, $data ) {
    
    throw new MethodNotImplementedException ( __METHOD__ );
  }
}

