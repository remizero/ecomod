<?php

namespace sys\libs\types;

use sys\libs\common\IpUtils;
use sys\libs\exceptions\IpException;

/**
 * <strong>Ip</strong>
 *
 * Archivo creado el 14 de agosto de 2018 a las 20:54:35 p.m.
 * <p>Clase que permite manipular direcciones IP de manera más natural para el
 * sistema. Permite manipular direcciones IP de tipo IPv4 e IPv6 de manera
 * transparente para el usuario.</p>
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
 *       <li>.</li>
 *       <li>.</li>
 *       <li>.</li>
 *       </ul>
 */
class Ip {

  /**
   * Valor de la ip.
   *
   * @readwrite
   *
   * @var string $ip
   */
  private $ip;

  /**
   * Indica si la IP es de tipo IPv6.
   *
   * @readwrite
   *
   * @var boolean $isIpv6
   */
  private $isIpv6 = FALSE;

  /**
   * Indica si la IP es de tipo IPv4 o IPv6 pública.
   *
   * @readwrite
   *
   * @var boolean $isPublic
   */
  private $isPublic = FALSE;

  /**
   * Indica si la IP es de tipo IPv4 o IPv6 reservada.
   *
   * @readwrite
   *
   * @var boolean $isReserved
   */
  private $isReserved = FALSE;

  /**
   * Indica si la IP es de tipo IPv4 o IPv6 válida.
   *
   * @readwrite
   *
   * @var boolean $isValid
   */
  private $isValid = FALSE;

  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @param string $ip
   *
   * @return void
   */
  public function __construct ( string $ip ) {

    $this->setIp ( $ip );
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
   * Método que permite determinar si la ip es de tipo IPv4.
   *
   * @return boolean
   */
  public function isIPv4 () {

    return !$this->isIpv6;
  }

  /**
   * Método que permite determinar si la ip es de tipo IPv6.
   *
   * @return boolean
   */
  public function isIPv6 () {

    return $this->isIpv6;
  }

  /**
   * Método que permite determinar si una ip es una ip válida.
   *
   * @return boolean
   */
  public function isValid () {

    return $this->isValid;
  }

  /**
   * Método que permite determinar si la ip es de rango privado.
   *
   * @return boolean
   */
  public function isPrivate () {

    return !$this->isPublic;
  }

  /**
   * Método que permite determinar si la ip es de rango público.
   *
   * @return boolean
   */
  public function isPublic () {

    return $this->isPublic;
  }

  /**
   * Método que permite determinar si una ip es de rango reservado.
   *
   * @param string $ip Ip a validar.
   *
   * @return boolean
   */
  public function isReserved () {

    return $this->isReserved;
  }

  /**
   * Asigna el valor de la IP Address y lo convierte en un entero largo (long)
   * para mejor manipulacion del mismo.
   *
   * @param string $ip
   *
   * @throws IpException
   *
   * @return \sys\libs\types\Ip
   */
  public function setIp ( string $ip ) {

    if ( !$this->isValid = IpUtils::isValid ( $ip ) ) {

      throw new IpException ();
    }
    $this->isPublic = IpUtils::isPublic ( $ip );
    $this->isReserved = IpUtils::isReserved ( $ip );
    if ( IpUtils::isIPv4 ( $ip ) ) {

      $this->ip = \ip2long ( $ip );
    } elseif ( $this->isIpv6 = IpUtils::isIPv6 ( $ip ) ) {

      $this->ip = ( string ) IpUtils::ipv6ToLong ( $ip );
    }
    return $this;
  }

  /**
   * Convierte la IP Address en formato de octetos de tipo IPv4 o IPv6 según sea
   * el caso.
   *
   * @return string
   */
  public function toString () {

    if ( !$this->isIpv6 ) {

      return \long2ip ( $this->ip );
    } elseif ( $this->isIpv6 ) {

      return IpUtils::long2Ipv6 ( $this->ip );
    }
  }
}
