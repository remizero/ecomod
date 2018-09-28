<?php
namespace sys\core\cache\controller;

use sys\core\abstracts\CacheAbs;
use sys\core\cache\exceptions\CacheServiceException;

/**
 * <strong>Memcached</strong>
 *
 * Archivo creado el 25 de septiembre de 2018 a las 22:56:00 p.m.
 * <p>Clase controladora del sistema distribuido para caché basado en memoria
 * Memcached.</p>
 *
 * @name Memcached
 * @namespace sys\api\config
 * @package ECOMOD.
 * @subpackage CACHE.
 * @filesource Memcached.php
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
class Memcached extends CacheAbs {
  
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
   * Desconecta el servicio de caché.
   * 
   * @return Memcached
   *
   * @see \sys\core\abstracts\CacheAbs::connect()
   */
  public function connect () {
    
    try {
      
      $this->service = new \Memcache ();
      $this->_service->connect (
        $this->host,
        $this->port
        );
      $this->isConnected = true;
      
    } catch ( \Exception $e ) {
      
      throw new CacheServiceException ();
    }
    return $this;
  }

  /**
   * Desconecta el servicio de caché.
   * 
   * @return Memcached
   *
   * @see \sys\core\abstracts\CacheAbs::disconnect()
   */
  public function disconnect () {

    if ( $this->isValidService () ) {
      
      $this->service->close ();
      $this->connected = false;
    }
    return $this;
  }

  /**
   * Elimina un valor del servidor de caché.
   * 
   * @param string $key La clave asociada al valor a eliminar.
   * 
   * @return Memcached
   *
   * @see \sys\core\abstracts\CacheAbs::erase()
   */
  public function erase ( string $key ) {

    if ( !$this->isValidService () ) {
      
      throw new CacheServiceException ();
    }
    $this->_service->delete ( $key );
    return $this;
  }
  
  /**
   * Obtener el valor de la clave dada del servidor de caché.
   * 
   * @param string $key La clave asociada al valor a obtener.
   * @param mixed $default Valor a retornar por omisión si no se consigue un 
   *        valor válido en la clave dada.
   * 
   * @return mixed
   *
   * @see \sys\core\abstracts\CacheAbs::get()
   */
  public function get ( string $key, $default = null ) {
    
    if ( !$this->_isValidService () ) {
      
      throw new CacheServiceException ();
    }
    $value = $this->service->get ( $key, MEMCACHE_COMPRESSED );
    if ( $value ) {
      
      return $value;
    }
    return $default;
  }
  
  /**
   * Indica si es un servicio válido de caché.
   * 
   * @return boolean
   *
   * @see \sys\core\abstracts\CacheAbs::isValidService()
   */
  public function isValidService () {

    return ( $this->connected && ( $this->service instanceof \Memcache ) && !empty ( $this->service ) );
  }

  /**
   * Asigna un valor a la caché en la clave dada.
   * 
   * @param string $key Clave del valor a guardar en la caché.
   * @param mixed $value Valor a guardar en la caché.
   * @param int $duration Tiempo de expiración del valor. Si es iqual a cero, 
   *        el valor nunca expirará.
   * 
   * @throws CacheServiceException
   * 
   * @return Memcached
   *
   * @see \sys\core\abstracts\CacheAbs::set()
   */
  public function set ( string $key, $value, $duration = 120 ) {

    if ( !$this->isValidService () ) {
      
      throw new CacheServiceException ();
    }
    $this->service->set ( $key, $value, MEMCACHE_COMPRESSED, $duration );
    return $this;
  }
}

