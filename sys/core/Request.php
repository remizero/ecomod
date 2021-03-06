<?php

namespace sys\core;

use sys\core\abstracts\BaseClass;
use sys\core\http\Cookies;
use sys\core\http\Files;
use sys\core\http\Http;
use sys\core\http\Url;
use sys\libs\common\RequestUtils;

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
 * @todo Que usar de esta clase https://github.com/geerlingguy/Request/blob/1.x/JJG/Request.php
 * @todo https://diego.com.es/rendimiento-en-php
 * @todo http://mialtoweb.es/como-saber-que-navegador-utiliza-un-usario-en-php/
 * @todo https://gist.github.com/digitalhydra/7949601
 * @todo https://artisansweb.net/detect-browser-php-javascript/
 */
class Request extends BaseClass {

  /**
   * @readwrite
   *
   * @var boolean
   */
  // public $ = "";

  /**
   * Instancia de la clase Cookies con las cookies a enviar al cliente.
   *
   * @readwrite
   *
   * @var Cookies
   */
  private $cookies = NULL;

  /**
   * Instancia de la clase Files con los archivos a cargar al servidor.
   *
   * @readwrite
   *
   * @var Files
   */
  private $files = NULL;

  /**
   * Url solicitante.
   *
   * @readwrite
   *
   * @var Url
   */
  private $url = "";

  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @param array $options
   *
   * @return void
   */
  public function __construct ( array $options = array ()) {

    parent::__construct ( $options );
    $url = ( ( isset ( $_SERVER [ 'HTTPS' ] ) && ( $_SERVER [ 'HTTPS' ] === 'on' ) ) ? "https" : "http" ) . "://" . $_SERVER [ "HTTP_HOST" ] . $_SERVER [ "REQUEST_URI" ];
    $this->url = new Url ( $url );
    // $this->agent = RequestUtils::server ( "HTTP_USER_AGENT", "Curl/PHP " . PHP_VERSION );
    if ( !empty ( $_FILES ) ) {

      $this->files = new Files ();
    }
    if ( !empty ( $_COOKIE ) ) {

      $this->cookies = new Cookies ();
    }
  }

  /**
   * Permite obtener el valor del Content-Response, una variable personalizada
   * del sistema ECOMOD para determinar cual será el tipo de valor que espera
   * recibir el cliente.
   *
   * @return string
   */
  public function getContentResponse () {

    $headers = apache_request_headers ();
    $exploded = \explode ( "Content-Response:", $headers [ 'Content-Type' ] );
    return $exploded [ 1 ];
  }

  /**
   * Permite obtener el valor de la cabecera Content-Type, la cual indica el
   * tipo de dato que se está recibiendo en la petición(Request) HTTP en el
   * servidor.
   *
   * @return string
   */
  public function getContentType () {

    $headers = apache_request_headers ();
    $exploded = \explode ( ", ", $headers [ 'Content-Type' ] );
    return $exploded [ 0 ];
  }

  /**
   * Permite obtener el valor de una variable.
   *
   * @param string $key Indice de la variable get a solicitar.
   *
   * @return string
   */
  public function getGet ( string $key ) {

    return RequestUtils::get ( $key );
  }

  /**
   * Retorna una instancia con las cookies creadas o almacenadas.
   *
   * @return \sys\core\http\Cookies
   */
  public function getCookie () {

    return $this->cookies;
  }

  /**
   * Retorna una instancia con los archivos a cargar en el servidor.
   *
   * @return \sys\core\http\Cookies
   */
  public function getFiles () {

    return $this->files;
  }

  /**
   * Permite obtener el valor de una variable.
   *
   * @param string $key Indice de la variable post a solicitar.
   *
   * @return string
   */
  public function getPost ( string $key ) {

    return RequestUtils::post ( $key );
  }

  public function getQuery () {

    \var_dump ( $this->url->getQuery () );
  }

  /**
   * Permite obtener el valor de una variable.
   *
   * @param string $key Indice de la variable request a solicitar.
   *
   * @deprecated
   *
   * @return string
   */
  public function getRequest ( string $key ) {

    return RequestUtils::request ( $key );
  }

  /**
   * Permite obtener el valor de la variable HTTP_ACCEPT, utilizada por el
   * sistema ECOMOD para indicar como debe ser devuelta la data solicitada.
   *
   * @return string
   */
  public function getRequestData () {

    return RequestUtils::server ( 'HTTP_ACCEPT' );
  }

  /**
   * Permite obtener el valor de la variable REQUEST_METHOD.
   *
   * @return string
   */
  public function getRequestMethod () {

    return RequestUtils::server ( 'REQUEST_METHOD' );
  }

  /**
   * Retorna la URL de la petición actual.
   *
   * @return \sys\core\http\Url
   */
  public function getUrl () {

    return $this->url;
  }

  /**
   * Determina si la solicitud es una solicitud de tipo DELETE.
   *
   * @return boolean
   */
  public function isDelete () {

    return RequestUtils::isRequestMethod ( Http::DELETE );
  }

  /**
   * Determina si la solicitud es una solicitud de tipo GET.
   *
   * @return boolean
   */
  public function isGet () {

    return RequestUtils::isRequestMethod ( Http::GET );
  }

  /**
   * Determina si la solicitud es una solicitud de tipo HEAD.
   *
   * @return boolean
   */
  public function isHead () {

    return RequestUtils::isRequestMethod ( Http::HEAD );
  }

  /**
   * Determina si la solicitud es una solicitud de tipo OPTION.
   *
   * @return boolean
   */
  public function isOption () {

    return RequestUtils::isRequestMethod ( Http::OPTIONS );
  }

  /**
   * Determina si la solicitud es una solicitud de tipo POST.
   *
   * @return boolean
   */
  public function isPost () {

    return RequestUtils::isRequestMethod ( Http::POST );
  }

  /**
   * Determina si la solicitud es una solicitud de tipo PUT.
   *
   * @return boolean
   */
  public function isPut () {

    return RequestUtils::isRequestMethod ( Http::PUT );
  }

  /**
   * Determina si la solicitud es una solicitud de tipo PUT.
   *
   * @return boolean
   */
  public function isTrace () {

    return RequestUtils::isRequestMethod ( Http::TRACE );
  }

  /**
   * Determina si la solicitud es una solicitud de tipo AJAX.
   *
   * @return boolean
   */
  public function isXmlHttpRequest () {

    return !empty ( $_SERVER [ 'HTTP_X_REQUESTED_WITH' ] ) && \strtolower ( $_SERVER [ 'HTTP_X_REQUESTED_WITH' ] ) == 'xmlhttprequest';
  }

  /**
   * Permite obtener cual es el método de la petición Request.
   *
   * @return string
   */
  public function requestMethod () {

    return RequestUtils::requestMethod ();
  }
}
