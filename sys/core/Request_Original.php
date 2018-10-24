<?php
namespace sys\core;

use sys\core\abstracts\BaseClass;
use sys\libs\common\StringUtils;
use sys\libs\common\RequestUtils;
use sys\libs\exceptions\ResponseException;

/**
 * <strong>Request</strong>
 *
 * Archivo creado el 03 de octubre de 2018 a las 00:52:55 a.m.
 * <p>Clase que ejecutar acciones secundarias antes o después de las acciones
 * principales definidas para el sistema ECOMOD.</p>
 *
 * @name Request
 * @namespace sys\api\config
 * @package ECOMOD.
 * @subpackage CORE.
 * @filesource Request.php
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
class Request_Original extends BaseClass {

  protected $_request;

  /**
   *
   * @readwrite
   *
   * @var boolean
   */
  public $_willFollow = true;

  /**
   *
   * @readwrite
   *
   * @var boolean
   */
  protected $_willShareSession = true;

  /**
   *
   * @readwrite
   *
   * @var array
   */
  protected $_headers = array ();

  /**
   *
   * @readwrite
   *
   * @var array
   */
  protected $_options = array ();

  /**
   *
   * @readwrite
   *
   * @var
   */
  protected $_referer;

  /**
   *
   * @readwrite
   *
   * @var
   */
  protected $_agent;

  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @param array $options
   *
   * @return void
   */
  public function __construct ( array $options = array () ) {

    parent::__construct ( $options );
    $this->agent = RequestUtils::server ( "HTTP_USER_AGENT", "Curl/PHP " . PHP_VERSION );
  }

  public function delete ( $url, $parameters = array() ) {

    return $this->request ( "DELETE", $url, $parameters );
  }

  function get ( $url, $parameters = array() ) {

    if ( !empty ( $parameters ) ) {
      
      $url .= StringUtils::indexOf ( $url, "?" ) ? "&" : "?";
      $url .= \is_string ( $parameters ) ? $parameters : \http_build_query ( $parameters, "", "&" );
    }
    return $this->request ( "GET", $url );
  }

  function head ( $url, $parameters = array() ) {

    return $this->request ( "HEAD", $url, $parameters );
  }

  function post ( $url, $parameters = array() ) {

    return $this->request ( "POST", $url, $parameters );
  }

  function put ( $url, $parameters = array() ) {

    return $this->request ( "PUT", $url, $parameters );
  }

  function request ( $method, $url, $parameters = array() ) {

    \session_write_close ();
    Events::fire ( "framework.request.request.before", array ( $method, $url, $parameters ) );
    $request = $this->_request = \curl_init ();
    if ( \is_array ( $parameters ) ) {
      
      $parameters = \http_build_query ( $parameters, "", "&" );
    }
    $this->_setRequestMethod ( $method )
      ->_setRequestOptions ( $url, $parameters )
      ->_setRequestHeaders ();
    $response = \curl_exec ( $request );
    if ( !\headers_sent () ) {
      
      \session_start ();
    }
    if ( $response ) {
      
      $response = new Response ( array ( "response" => $response ) );

    } else {
      
      throw new ResponseException ( \ucfirst ( \curl_error ( $request ) ) );
    }
    Events::fire ( "framework.request.request.after", array ( $method, $url, $parameters, $response ) );
    \curl_close ( $request );
    return $response;
  }

  protected function _setOption ( $key, $value ) {

    \curl_setopt ( $this->_request, $key, $value );
    return $this;
  }

  protected function _normalize ( $key ) {

    return "CURLOPT_" . \str_replace ( "CURLOPT_", "", \strtoupper ( $key ) );
  }

  protected function _setRequestMethod ( $method ) {

    switch ( \strtoupper ( $method ) ) {
      
      case "HEAD" :
        
        $this->_setOption ( CURLOPT_NOBODY, true );
        break;
      
      case "GET" :
        
        $this->_setOption ( CURLOPT_HTTPGET, true );
        break;
      
      case "POST" :
        
        $this->_setOption ( CURLOPT_POST, true );
        break;
      
      default :
        
        $this->_setOption ( CURLOPT_CUSTOMREQUEST, $method );
        break;
    }
    return $this;
  }

  protected function _setRequestOptions ( $url, $parameters ) {

    $this->_setOption ( CURLOPT_URL, $url )
      ->_setOption ( CURLOPT_HEADER, true )
      ->_setOption ( CURLOPT_RETURNTRANSFER, true )
      ->_setOption ( CURLOPT_USERAGENT, $this->agent );
    if ( !empty ( $parameters ) ) {
      
      $this->_setOption ( CURLOPT_POSTFIELDS, $parameters );
    }
    if ( $this->willFollow ) {
      
      $this->_setOption ( CURLOPT_FOLLOWLOCATION, true );
    }
    if ( $this->willShareSession ) {
      
      $this->_setOption ( CURLOPT_COOKIE, \session_name () . "=" . \session_id () );
    }
    if ( $this->referer ) {
      
      $this->_setOption ( CURLOPT_REFERER, $this->referer );
    }
    foreach ( $this->_options as $key => $value ) {
      
      $this->_setOption ( \constant ( $this->_normalize ( $key ) ), $value );
    }
    return $this;
  }

  protected function _setRequestHeaders () {

    $headers = array ();
    foreach ( $this->headers as $key => $value ) {
      
      $headers [] = $key . ': ' . $value;
    }
    $this->_setOption ( CURLOPT_HTTPHEADER, $headers );
    return $this;
  }
}
