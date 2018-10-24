<?php
namespace sys\api\template\controller;

use sys\core\Registry;
use sys\libs\common\StringUtils;
use sys\core\Template;
use sys\libs\common\RequestUtils;
use sys\core\Request;

/**
 * <strong>Extended</strong>
 *
 * Archivo creado el 03 de octubre de 2018 a las 00:16:10 a.m.
 * <p>Clase que ejecutar acciones secundarias antes o después de las acciones
 * principales definidas para el sistema ECOMOD.</p>
 *
 * @name Extended
 * @namespace sys\api\template\controller
 * @package ECOMOD.
 * @subpackage TEMPLATE.
 * @filesource Extended.php
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
class Extended extends Standard {

  /**
   *
   * @readwrite
   * 
   * @var string
   */
  protected $defaultPath = "application/views";

  /**
   *
   * @readwrite
   * 
   * @var string
   */
  protected $defaultKey = "data";

  /**
   *
   * @readwrite
   * 
   * @var int
   */
  protected $index = 0;

  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @param array $options
   *
   * @return void
   */
  public function __construct ( array $options = array () ) {

    parent::__construct ( $options );
    $this->map = array ( 
      "partial" => array ( 
        "opener" => "{partial","closer" => "}","handler" => "_partial"
      ),"include" => array ( 
        "opener" => "{include","closer" => "}","handler" => "_include"
      ),"yield" => array ( 
        "opener" => "{yield","closer" => "}","handler" => "yield"
      )
    ) + $this->map;
    $this->map [ "statement" ] [ "tags" ] = array ( 
      "set" => array ( 
        "isolated" => false,"arguments" => "{key}","handler" => "set"
      ),"append" => array ( 
        "isolated" => false,"arguments" => "{key}","handler" => "append"
      ),"prepend" => array ( 
        "isolated" => false,"arguments" => "{key}","handler" => "prepend"
      )
    ) + $this->map [ "statement" ] [ "tags" ];
  }

  protected function _include ( $tree, $content ) {

    $template = new Template ( array ( 
      "implementation" => new self ()
    ) );
    $file = \trim ( $tree [ "raw" ] );
    $path = $this->defaultPath;
    $content = \file_get_contents ( APP_PATH . "/{$path}/{$file}" );
    $template->parse ( $content );
    $index = $this->index++;
    return "\$_anon = function(\$_data){
                " . $template->code . "
            };\$_text[] = \$_anon(\$_data);";
  }

  protected function _partial ( $tree, $content ) {

    $address = \trim ( $tree [ "raw" ], " /" );
    if ( StringUtils::indexOf ( $address, "http" ) != 0 ) {
      $host = RequestUtils::server ( "HTTP_HOST" );
      $address = "http://{$host}/{$address}";
    }
    $request = new Request ();
    $response = \addslashes ( \trim ( $request->get ( $address ) ) );
    return "\$_text[] = \"{$response}\";";
  }

  protected function _getKey ( $tree ) {

    if ( empty ( $tree [ "arguments" ] [ "key" ] ) ) {
      
      return null;
    }
    return \trim ( $tree [ "arguments" ] [ "key" ] );
  }

  protected function _setValue ( $key, $value ) {

    \var_dump("si está entrando al método setValue línea 134");
    \var_dump("El valor de \$key es $key 135");
    if ( ! empty ( $key ) ) {
      
      \var_dump($this->defaultKey);
      $data = Registry::get ( $this->defaultKey, array () );
      $data [ $key ] = $value;
      Registry::set ( $this->defaultKey, $data );
    }
  }

  protected function _getValue ( $key ) {

    $data = Registry::get ( $this->defaultKey );
    if ( isset ( $data [ $key ] ) ) {
      
      return $data [ $key ];
    }
    return "";
  }

  public function set ( string $key, string $value ) {

    \var_dump("si está entrando al método set línea 157");
    \var_dump ( "El valor de \$key es $key 158" );
    \var_dump ( "El valor de \$vakue es $value 159" );
    StringUtils::indexOf ( ( string ) $value, "\$_text" );
    if ( StringUtils::indexOf ( $value, "\$_text" ) > - 1 ) {
      
      \var_dump("si es mayor a -1 línea 160");
      $first = StringUtils::indexOf ( $value, "\"" );
      $last = StringUtils::lastIndexOf ( $value, "\"" );
      $value = \stripslashes ( \substr ( $value, $first + 1, ( $last - $first ) - 1 ) );
    }
    \var_dump("línea 167--------------------------------------------------------");
    if ( \is_array ( $key ) ) {
      
      \var_dump("si es un array el \$key línea 167");
      $key = $this->_getKey ( $key );
    }
    \var_dump("antes de entrar al método setValue línea 170");
    $this->_setValue ( $key, $value );
  }

  public function append ( $key, $value ) {

    if ( \is_array ( $key ) ) {
      
      $key = $this->_getKey ( $key );
    }
    $previous = $this->_getValue ( $key );
    $this->set ( $key, $previous . $value );
  }

  public function prepend ( $key, $value ) {

    if ( \is_array ( $key ) ) {
      
      $key = $this->_getKey ( $key );
    }
    $previous = $this->_getValue ( $key );
    $this->set ( $key, $value . $previous );
  }

  public function yield ( $tree, $content ) {

    $key = \trim ( $tree [ "raw" ] );
    $value = \addslashes ( $this->_getValue ( $key ) );
    return "\$_text[] = \"{$value}\";";
  }
}
