<?php
namespace sys\core\config\controller;

use sys\core\abstracts\ConfigAbs;

/**
 * <strong>Toml</strong>
 *
 * Archivo creado el 12 de septiembre de 2018 a las 00:42:15 a.m.
 * <p>Clase controladores que permite manipular archivos de configuracion de
 * tipo Toml para la configuración del sistema ECOMOD.</p>
 *
 * @name Toml
 * @namespace sys\api\config\controller
 * @package ECOMOD.
 * @subpackage CONFIG.
 * @filesource Toml.php
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
class Toml extends ConfigAbs {
  
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
   * Método que permite analizar un archivo de configuración Toml.
   *
   * @param string $path Ruta del archivo a analizar.
   *
   * @return
   *
   * @see \sys\core\abstracts\ConfigAbs::parse()
   */
  public function parse ( string $path ) {
    
    // TODO - Insert your code here
  }
  
  /**
   * Método que permite leer un archivo de configuración Toml.
   *
   * @param string $path Ruta del archivo a leer.
   *
   * @return
   *
   * @see \sys\core\abstracts\ConfigAbs::read()
   */
  public function read ( string $path ) {
    
    
  }
  
  /**
   * Método que permite escribir un archivo de configuración Toml.
   *
   * @param string $path Ruta del archivo a escribir.
   *
   * @return
   *
   * @see \sys\core\abstracts\ConfigAbs::write()
   */
  public function write ( string $path, $data ) {
    
    
  }
public function toArray () {

  }

public function toObject () {

  }

}

