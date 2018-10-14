<?php
namespace sys\core;

use sys\api\template\controller\Extended;
use sys\core\abstracts\BaseClass;
use sys\libs\exceptions\KeyException;

/**
 * <strong>View</strong>
 *
 * Archivo creado el 02 de octubre de 2018 a las 23:45:40 p.m.
 * <p>Clase que ejecutar acciones secundarias antes o después de las acciones
 * principales definidas para el sistema ECOMOD.</p>
 *
 * @name View
 * @namespace sys\api\config
 * @package ECOMOD.
 * @subpackage CORE.
 * @filesource View.php
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
class View extends BaseClass {

  /**
   *
   * @readwrite
   * 
   * @var string
   */
  protected $file;

  /**
   *
   * @readwrite
   * 
   * @var array
   */
  protected $data;

  /**
   *
   * @read
   * 
   * @var Template
   */
  protected $template;
  
  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @param array $options
   *
   * @return void
   */
  public function __construct ( array $options = array () ) {
    
    \var_dump("paso por la linea 69 la clase view");
    parent::__construct ( $options );
    \var_dump("paso por la linea 71 la clase view");
    Events::fire ( "framework.view.construct.before", array ( $this->file ) );
    \var_dump("paso por la linea 73 la clase view");
    $this->template = new Template ( array ( "implementation" => new Extended () ) );
    //$this->template = new Template ();
    //$this->template->setImplementation ( new Extended () );
    \var_dump("paso por la linea 75 la clase view");
    Events::fire ( "framework.view.construct.after", array ( $this->file, $this->template ) );
  }

  public function render () {

    Events::fire ( "framework.view.render.before", array ( $this->file ) );
    if ( !\file_exists ( $this->file ) ) {
      
      return "";
    }
    return $this->template->parse ( \file_get_contents ( $this->file ) )->process ( $this->data );
  }

  public function get ( $key, $default = "" ) {

    if ( isset ( $this->data [ $key ] ) ) {
      
      return $this->data [ $key ];
    }
    return $default;
  }

  protected function _set ( $key, $value ) {

    if ( !\is_string ( $key ) && !\is_numeric ( $key ) ) {
      
      throw new KeyException ();
    }
    $data = $this->data;
    if ( !$data ) {
      
      $data = array ();
    }
    $data [ $key ] = $value;
    $this->data = $data;
  }

  public function set ( $key, $value = null ) {

    if ( \is_array ( $key ) ) {
      
      foreach ( $key as $_key => $value ) {
        
        $this->_set ( $_key, $value );
      }
      return $this;
    }
    $this->_set ( $key, $value );
    return $this;
  }

  public function erase ( $key ) {

    unset ( $this->data [ $key ] );
    return $this;
  }
}
