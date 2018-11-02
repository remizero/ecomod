<?php
namespace sys\core\http;

use sys\libs\exceptions\IndexException;

/**
 * <strong>Cookies</strong>
 *
 * Archivo creado el 25 de octubre de 2018 a las 21:12:50 p.m.
 * <p>Clase que facilita realizar operaciones sobre las COOKIES.</p>
 *
 * @name Cookies
 * @namespace sys\api\config
 * @package ECOMOD.
 * @subpackage CORE.
 * @filesource Cookies.php
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
class Cookies {
  
  /**
   * Arreglo con todas las cookies.
   * 
   * @readwrite
   * 
   * @var array [ Cookie ]
   */
  private $cookies = array ();
  
  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @return void
   */
  public function __construct () {

    $cookie;
    foreach ( $_COOKIE as $key => $value ) {
      
      $cookie = new Cookie ( $key, $value );
      $this->add ( $cookie );
    }
  }
  
  /**
   * Método que permite agregar una nueva cookie.
   * 
   * @param string|Cookie $cookieName Nombre de la cookie.
   * @param mixed $cookieValue Valor de la cookie.
   * @param int $cookieExpire Tiempo de duración de la cookie.
   * 
   * @return \sys\core\http\Cookies
   */
  public function add ( $cookieName, $cookieValue = NULL, int $cookieExpire = -1 ) {
    
    if ( \is_string ( $cookieName ) ) {
      
      if ( !$this->exists ( $cookieName ) ) {
        
        $cookie = new Cookie ( $cookieName, $cookieValue, $cookieExpire );
        $this->cookies [ $cookieName ] = $cookie;
      }
    } elseif ( $cookieName instanceof Cookie ) {
      
      if ( !$this->exists ( $cookieName->getName () ) ) {
        
        $this->cookies [ $cookieName->getName () ] = $cookieName;
      }
    }
    return $this;
  }
  
  /**
   * Checks whether a cookie with the specified name exists
   *
   * @param string|Cookie $cookieName the name of the cookie to check
   * 
   * @return bool whether there is a cookie with the specified name
   */
  public function exists ( $cookieName ) {

    if ( \is_string ( $cookieName ) ) {
      
      return isset ( $this->cookies [ $cookieName ] );
      
    } elseif ( $cookieName instanceof Cookie ) {
      
      return isset ( $this->cookies [ $cookieName->getName () ] );
    }
  }

  /**
   * Método que permite obtener una cookie del listado de cookies activas.
   * 
   * @param string $cookieName Nombre de la cookie a obtener
   * 
   * @throws IndexException
   * 
   * @return Cookie
   */
  public function get ( string $cookieName ) {
    
    if ( $this->exists ( $cookieName ) ) {
      
      return $this->cookies [ $cookieName ];
      
    } else {
      
      throw new IndexException ();
    }
  }

  /**
   * Método que permite eliminar todas las coockies activas.
   * 
   * @return void
   */
  public function release () {

    foreach ( $this->cookies as $cookie ) {
      
      $this->remove ( $Cookie );
    }
  }
  
  /**
   * Método que permite eliminar una cookie.
   * 
   * @param string|Cookie $cookieName
   * 
   * @return boolean
   */
  public function remove ( $cookieName ) {
    
    if ( \is_string ( $cookieName ) ) {
      
      if ( $this->exists ( $cookieName ) ) {
        
        unset ( $this->cookies [ $cookieName ] );
        return \setcookie ( $cookieName, NULL, -1 );
      }
    } elseif ( $cookieName instanceof Cookie ) {
      
      if ( $this->exists ( $cookieName->getName () ) ) {
        
        unset ( $this->cookies [ $cookieName->getName () ] );
        return \setcookie ( $cookieName->getName (), NULL, -1 );
      }
    }
    return FALSE;
  }
}
