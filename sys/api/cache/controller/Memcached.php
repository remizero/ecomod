<?php
namespace sys\api\cache\controller;

use sys\api\cache\core\CacheAbs;
use sys\api\cache\exceptions\CacheServiceException;

/**
 *
 * @author remizero
 *        
 */
class Memcached extends CacheAbs {
  
  /**
   *
   * @param array $options
   *
   * @return void
   */
  public function __construct ( array $options ) {

    parent::__construct ( $options );
    // TODO - Insert your code here
  }
  
  /**
   */
  function __destruct () {
    
    // TODO - Insert your code here
  }
  
  /**
   * (non-PHPdoc)
   *
   * @see \sys\api\cache\core\CacheAbs::connect()
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
   * (non-PHPdoc)
   *
   * @see \sys\api\cache\core\CacheAbs::disconnect()
   */
  public function disconnect () {

    if ( $this->isValidService () ) {
      
      $this->service->close ();
      $this->connected = false;
    }
    return $this;
  }

  /**
   * (non-PHPdoc)
   *
   * @see \sys\api\cache\core\CacheAbs::erase()
   */
  public function erase ( string $key ) {

    if ( !$this->isValidService () ) {
      
      throw new CacheServiceException ();
    }
    $this->_service->delete ( $key );
    return $this;
  }
  
  /**
   * (non-PHPdoc)
   *
   * @see \sys\api\cache\core\CacheAbs::get()
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
   * @see \sys\api\cache\core\CacheAbs::isValidService()
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
   * @return CacheAbs
   *
   * @see \sys\api\cache\core\CacheAbs::set()
   */
  public function set ( string $key, $value, $duration = 120 ) {

    if ( !$this->isValidService () ) {
      
      throw new CacheServiceException ();
    }
    $this->service->set ( $key, $value, MEMCACHE_COMPRESSED, $duration );
    return $this;
  }
}

