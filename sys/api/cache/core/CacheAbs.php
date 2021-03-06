<?php

namespace sys\api\cache\core;

use sys\core\abstracts\BaseClass;

/**
 * <strong>CacheAbs</strong>
 *
 * Archivo creado el 23 de septiembre de 2018 a las 20:43:00 p.m.
 * <p>Clase abstracta que permite crear objetos controladores para manipular
 * distintos tipos de sistema distribuido para caché basado en memoria, del
 * sistema ECOMOD.</p>
 *
 * @name CacheAbs
 * @namespace sys\api\config
 * @package ECOMOD.
 * @subpackage CACHE.
 * @filesource CacheAbs.php
 * @version 1.0
 * @since 1.0
 * @author Filiberto Zaá Avila ( remizero ) filizaa@gmail.com.
 * @copyright Todos los derechos reservados 2018.
 * @link http://www.ecosoftware.com.ve
 * @license http://www.ecosoftware.com.ve/licencia
 * @uses .php
 * @see .php
 * @todo Para el rendimiento de PHP https://diego.com.es/rendimiento-en-php.
 */
abstract class CacheAbs extends BaseClass {

  /**
   * Indica si está conectado el servicio de cache.
   *
   * @readwrite
   *
   * @var boolean
   */
  protected $connected = false;

  /**
   * Puerto del servidor de caché.
   *
   * @readwrite
   *
   * @var Ip
   */
  protected $host = "127.0.0.1";

  /**
   * @readwrite
   *
   * @var int
   */
  protected $port = "11211";

  /**
   * Almacena el prefijo de una instancia para separarla de otra cuando se
   * trabaja diferentes aplicaciones desde un mismo servidor.
   *
   * @readwrite
   *
   * @var string
   */
  protected $prefix = "";

  /**
   * Instancia del objeto puente con el servidor de caché.
   *
   * @readwrite
   *
   * @var CacheAbs
   */
  protected $service;

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
  public function __destruct () {

  }

  /**
   * Conecta el servicio de caché.
   *
   * @return CacheAbs
   */
  public abstract function connect ();

  /**
   * Desconecta el servicio de caché.
   *
   * @return CacheAbs
   */
  public abstract function disconnect ();

  /**
   * Elimina un valor del servidor de caché.
   *
   * @param string $key La clave asociada al valor a eliminar.
   *
   * @return CacheAbs
   */
  public abstract function erase ( string $key );

  /**
   * Obtener el valor de la clave dada del servidor de caché.
   *
   * @param string $key La clave asociada al valor a obtener.
   * @param mixed $default Valor a retornar por omisión si no se consigue un
   *        valor válido en la clave dada.
   *
   * @return mixed
   */
  public abstract function get ( string $key, $default = null);

  /**
   * Indica si es un servicio válido de caché.
   *
   * @return boolean
   */
  public abstract function isValidService ();

  /**
   * Asigna un valor a la caché en la clave dada.
   *
   * @param string $key Clave del valor a guardar en la caché.
   * @param mixed $value Valor a guardar en la caché.
   * @param int $duration Tiempo de expiración del valor. Si es iqual a cero,
   *        el valor nunca expirará.
   *
   * @return CacheAbs
   */
  public abstract function set ( string $key, $value, $duration = 120);
}

