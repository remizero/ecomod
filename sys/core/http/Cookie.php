<?php
namespace sys\core\http;

/**
 * <strong>Cookie</strong>
 *
 * Archivo creado el 25 de octubre de 2018 a las 19:50:00 p.m.
 * <p>Clase que facilita realizar operaciones sobre una COOKIES.</p>
 *
 * @name Cookie
 * @namespace sys\api\config
 * @package ECOMOD.
 * @subpackage CORE.
 * @filesource Cookie.php
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
class Cookie {

  /**
   * The name of the cookie which is also the key for future accesses via
   * $_COOKIE[...].
   * 
   * @readwrite
   *
   * @var string
   */
  private $name = "";

  /**
   * The value of the cookie that will be stored on the client's machine.
   * 
   * @readwrite
   *
   * @var mixed
   */
  private $value = NULL;

  /**
   * The Unix timestamp indicating the time that the cookie will expire at, i.e.
   * usually `time() + $seconds`.
   * 
   * @readwrite
   *
   * @var int
   */
  private $expire = 0;

  /**
   * The path on the server that the cookie will be valid for (including all
   * sub-directories), e.g. an empty string for the current directory or `/` 
   * for the root directory.
   * 
   * @readwrite
   *
   * @var string
   */
  private $path = "/";

  /**
   * The domain that the cookie will be valid for (including subdomains) or
   * `null` for the current host (excluding subdomains).
   * 
   * @readwrite
   *
   * @var string|null
   */
  private $domain = NULL;

  /**
   * Indicates that the cookie should be accessible through the HTTP protocol
   * only and not through scripting languages.
   * 
   * @readwrite
   *
   * @var bool
   */
  private $httpOnly = TRUE;

  /**
   * Indicates that the cookie should be sent back by the client over secure
   * HTTPS connections only.
   * 
   * @readwrite
   *
   * @var bool
   */
  private $secure = FALSE;

  /**
   * Indicates that the cookie should not be sent along with cross-site requests
   * (either `null`, `Lax` or `Strict`).
   * 
   * @readwrite
   *
   * @var string|null
   */
  private $sameSiteRestriction;

  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @return void
   */
  public function __construct () {

    $numArgs = \func_num_args ();
    if ( $numArgs == 2 ) {
      
      $this->name = \func_get_arg ( 0 );
      $this->value = \func_get_arg ( 1 );
      
    } elseif ( $numArgs == 3 ) {
      
      $this->name = \func_get_arg ( 0 );
      $this->value = \func_get_arg ( 1 );
      $this->expire = \func_get_arg ( 2 );
      
    } elseif ( $numArgs == 4 ) {
      
      $this->name = \func_get_arg ( 0 );
      $this->value = \func_get_arg ( 1 );
      $this->expire = \func_get_arg ( 2 );
      $this->path = \func_get_arg ( 3 );
      
    } elseif ( $numArgs == 5 ) {
      
      $this->name = \func_get_arg ( 0 );
      $this->value = \func_get_arg ( 1 );
      $this->expire = \func_get_arg ( 2 );
      $this->path = \func_get_arg ( 3 );
      $this->domain = \func_get_arg ( 4 );
      
    } elseif ( $numArgs == 6 ) {
      
      $this->name = \func_get_arg ( 0 );
      $this->value = \func_get_arg ( 1 );
      $this->expire = \func_get_arg ( 2 );
      $this->path = \func_get_arg ( 3 );
      $this->domain = \func_get_arg ( 4 );
      $this->secure = \func_get_arg ( 5 );
      
    } elseif ( $numArgs == 7 ) {
      
      $this->name = \func_get_arg ( 0 );
      $this->value = \func_get_arg ( 1 );
      $this->expire = \func_get_arg ( 2 );
      $this->path = \func_get_arg ( 3 );
      $this->domain = \func_get_arg ( 4 );
      $this->secure = \func_get_arg ( 5 );
      $this->httpOnly = \func_get_arg ( 6 );
      
    } else {
      
      // Lanzar excepción
    }
  }

  /**
   *
   * @return string
   */
  public function getName () {

    return $this->name;
  }

  /**
   *
   * @return mixed
   */
  public function getValue () {

    return $this->value;
  }

  /**
   *
   * @return number
   */
  public function getExpire () {

    return $this->expire;
  }

  /**
   *
   * @return string
   */
  public function getPath () {

    return $this->path;
  }

  /**
   *
   * @return string
   */
  public function getDomain () {

    return $this->domain;
  }

  /**
   *
   * @return boolean
   */
  public function isHttpOnly () {

    return $this->httpOnly;
  }

  /**
   *
   * @return boolean
   */
  public function isSecure () {

    return $this->secure;
  }

  /**
   *
   * @return string
   */
  public function getSameSiteRestriction () {

    return $this->sameSiteRestriction;
  }

  /**
   *
   * @param string $name
   *
   * @return \sys\core\http\Cookie
   */
  public function setName ( string $name ) {

    $this->name = $name;
    return $this;
  }

  /**
   *
   * @param mixed $value
   *
   * @return \sys\core\http\Cookie
   */
  public function setValue ( $value ) {

    $this->value = $value;
    return $this;
  }

  /**
   *
   * @param integer $expire
   *
   * @return \sys\core\http\Cookie
   */
  public function setExpire ( int $expire ) {

    $this->expire = $expire;
    return $this;
  }

  /**
   *
   * @param string $path
   *
   * @return \sys\core\http\Cookie
   */
  public function setPath ( string $path ) {

    $this->path = $path;
    return $this;
  }

  /**
   *
   * @param string $domain
   *
   * @return \sys\core\http\Cookie
   */
  public function setDomain ( string $domain ) {

    $this->domain = $domain;
    return $this;
  }

  /**
   *
   * @param boolean $httpOnly
   *
   * @return \sys\core\http\Cookie
   */
  public function setHttpOnly ( bool $httpOnly ) {

    $this->httpOnly = $httpOnly;
    return $this;
  }

  /**
   *
   * @param boolean $secure
   *
   * @return \sys\core\http\Cookie
   */
  public function setSecure ( bool $secure ) {

    $this->secure = $secure;
    return $this;
  }

  /**
   *
   * @param string $sameSiteRestriction
   *
   * @return \sys\core\http\Cookie
   */
  public function setSameSiteRestriction ( $sameSiteRestriction ) {

    $this->sameSiteRestriction = $sameSiteRestriction;
    return $this;
  }
}
