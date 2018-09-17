<?php
namespace sys\libs\types;

/**
 * <strong>Ip</strong>
 *
 * Archivo creado el 14 de agosto de 2018 a las 20:54:35 p.m.
 * <p>Clase que permite manipular direcciones IP de manera m´as natural para el 
 * sistema. Solo permite manipular direcciones IP de tipo IPv4.</p>
 *
 * @name Ip
 * @namespace sys\libs\types
 * @package ECOMOD.
 * @subpackage LIBS-TYPES.
 * @filesource Ip.php
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
 *       <li>Direcciones IPv6.</li>
 *       <li>.</li>
 *       <li>.</li>
 *       </ul>
 */
class Ip {

  /**
   *
   * @var int $ip
   */
  private $ip;

  // TODO - Insert your code here
  
  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @return void
   */
  public function __construct () {

    // TODO - Insert your code here
  }

  /**
   */
  function __destruct () {

    // TODO - Insert your code here
  }

  /**
   * Retorna la IP Address como un entero largo (long).
   * 
   * @return int
   */
  public function getIp () {

    return $this->ip;
  }

  /**
   * Asigna el valor de la IP Address y lo convierte en un entero largo (long) 
   * para mejor manipulacion del mismo.
   * 
   * @param string $ip
   * 
   * @return void
   */
  public function setIp ( $ip ) {

    $this->ip = \ip2long ( $ip );
  }

  /**
   * Convierte la IP Address en formato de octetos de tipo IPv4.
   * 
   * @return string
   */
  public function toString () {

    return \long2ip ( $this->ip );
  }
}

