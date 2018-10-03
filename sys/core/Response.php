<?php
namespace sys\core;

use sys\core\abstracts\BaseClass;

/**
 * <strong>Response</strong>
 *
 * Archivo creado el 03 de octubre de 2018 a las 01:09:40 a.m.
 * <p>Clase que ejecutar acciones secundarias antes o después de las acciones
 * principales definidas para el sistema ECOMOD.</p>
 *
 * @name Response
 * @namespace sys\api\config
 * @package ECOMOD.
 * @subpackage CORE.
 * @filesource Response.php
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
class Response extends BaseClass {

  /**
   *
   * @var string
   */
  protected $_response;

  /**
   *
   * @read
   *
   * @var string
   */
  protected $_body = null;

  /**
   *
   * @read
   *
   * @var array
   */
  protected $_headers = array ();

  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @param array $options
   *
   * @return void
   */
  public function __construct ( array $options = array () ) {

    if ( ! empty ( $options [ "response" ] ) ) {
      
      $response = $this->_response = $options [ "response" ];
      unset ( $options [ "response" ] );
    }
    parent::__construct ( $options );
    $pattern = '#HTTP/\d\.\d.*?$.*?\r\n\r\n#ims';
    \preg_match_all ( $pattern, $response, $matches );
    $headers = \array_pop ( $matches [ 0 ] );
    $headers = \explode ( "\r\n", \str_replace ( "\r\n\r\n", "", $headers ) );
    $this->_body = \str_replace ( $headers, "", $response );
    $version = \array_shift ( $headers );
    \preg_match ( '#HTTP/(\d\.\d)\s(\d\d\d)\s(.*)#', $version, $matches );
    $this->_headers [ "Http-Version" ] = $matches [ 1 ];
    $this->_headers [ "Status-Code" ] = $matches [ 2 ];
    $this->_headers [ "Status" ] = $matches [ 2 ] . " " . $matches [ 3 ];
    foreach ( $headers as $header ) {
      
      \preg_match ( '#(.*?)\:\s(.*)#', $header, $matches );
      $this->_headers [ $matches [ 1 ] ] = $matches [ 2 ];
    }
  }

  function __toString () {

    return $this->body;
  }
}
