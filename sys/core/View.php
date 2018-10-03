<?php
namespace sys\core;

use sys\core\abstracts\BaseClass;

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
   */
  protected $file;

  /**
   *
   * @readwrite
   */
  protected $data;

  /**
   *
   * @read
   */
  protected $template;

  public function __construct ( $options = array() ) {

    parent::__construct ( $options );
    Events::fire ( "framework.view.construct.before", array ( 
      $this->file
    ) );
    $this->_template = new Template ( array ( 
      "implementation" => new Template\Implementation\Extended ()
    ) );
    Events::fire ( "framework.view.construct.after", array ( 
      $this->file,$this->template
    ) );
  }

  public function render () {

    Events::fire ( "framework.view.render.before", array ( 
      $this->file
    ) );
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
      
      throw new Exception\Data ( "Key must be a string or a number" );
    }
    $data = $this->data;
    if ( ! $data ) {
      
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
