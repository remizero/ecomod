<?php

namespace sys\api\cache\controller;

use sys\api\cache\core\CacheAbs;
use sys\api\cache\exceptions\CacheServiceException;

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
 * @todo Para el rendimiento de PHP https://diego.com.es/rendimiento-en-php.
 */
class Memcached extends CacheAbs {

  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @param array $options
   *
   * @return void
   */
  public function __construct ( array $options = array ()) {

    parent::__construct ( $options );
  }

  /**
   */
  function __destruct () {

  }

  /**
   * Desconecta el servicio de caché.
   *
   * @return Memcached
   *
   * @see \sys\api\cache\core\CacheAbs::connect()
   */
  public function connect () {

    try {

      $this->service = new \Memcache ();
      $this->_service->connect ( $this->host, $this->port );
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
   * Elimina un valor del servidor de caché.
   *
   * @param string $key La clave asociada al valor a eliminar.
   *
   * @return Memcached
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
   * Obtener el valor de la clave dada del servidor de caché.
   *
   * @param string $key La clave asociada al valor a obtener.
   * @param mixed $default Valor a retornar por omisión si no se consigue un
   *        valor válido en la clave dada.
   *
   * @return mixed
   *
   * @see \sys\api\cache\core\CacheAbs::get()
   */
  public function get ( string $key, $default = null) {

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
   * @return Memcached
   *
   * @see \sys\api\cache\core\CacheAbs::set()
   */
  public function set ( string $key, $value, $duration = 120) {

    if ( !$this->isValidService () ) {

      throw new CacheServiceException ();
    }
    $this->service->set ( $key, $value, MEMCACHE_COMPRESSED, $duration );
    return $this;
  }
}

