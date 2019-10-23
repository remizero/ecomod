<?php

namespace sys\libs\common;

use sys\libs\exceptions\IpException;

/**
 * <strong>IpUtils</strong>
 *
 * Archivo creado el 14 de agosto de 2018 a las 11:02:35 p.m.
 * <p>Clase que permite manipular direcciones IP.</p>
 *
 * @name IpUtils
 * @namespace sys\libs\common
 * @package ECOMOD.
 * @subpackage LIBS-COMMON.
 * @filesource IpUtils.php
 * @version 1.0
 * @since 1.0
 * @author Filiberto Zaá Avila ( remizero ) filizaa@gmail.com.
 * @copyright Todos los derechos reservados 2019.
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
abstract class IpUtils {

  /**
   * Convierte ina dirección de tipo IPv6 en un entero.
   * La respuesta fue tomada de aquí https://stackoverflow.com/questions/18276757/php-convert-ipv6-to-number
   *
   * @param string $ip Ip a validar.
   *
   * @throws IpException
   *
   * @return number
   */
  public static function ipv6ToLong ( string $ip ) {

    if ( !self::isIPv6 ( $ip ) ) {

      throw new IpException ();
    }
    return ( string ) \gmp_import ( ( string ) \inet_pton ( ( string ) $ip ) );
  }

  /**
   * Convierte un entero a una dirección de tipo IPv6.
   * La respuesta fue tomada de aquí https://stackoverflow.com/questions/18276757/php-convert-ipv6-to-number
   *
   * @param int $ip Ip a validar.
   *
   * @return string
   */
  public static function long2Ipv6 ( $ipLong ) {

    return ( string ) \inet_ntop ( ( string ) \str_pad ( ( string ) \gmp_export ( ( string ) $ipLong ), 16, "\0", STR_PAD_LEFT ) );
  }

  /**
   * Método que permite determinar si una ip es de tipo IPv4.
   *
   * @param string $ip Ip a validar.
   *
   * @throws IpException
   *
   * @return boolean
   */
  public static function isIPv4 ( string $ip ) {

    if ( !self::isValid ( $ip ) ) {

      throw new IpException ();
    }
    return ( \filter_var ( $ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) !== FALSE );
  }

  /**
   * Método que permite determinar si una ip es de tipo IPv6.
   *
   * @param string $ip Ip a validar.
   *
   * @throws IpException
   *
   * @return boolean
   */
  public static function isIPv6 ( string $ip ) {

    if ( !self::isValid ( $ip ) ) {

      throw new IpException ();
    }
    return ( \filter_var ( $ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6 ) !== FALSE );
  }

  /**
   * Método que permite determinar si una ip es una ip válida.
   *
   * @param string $ip Ip a validar.
   *
   * @throws IpException
   *
   * @return boolean
   */
  public static function isValid ( string $ip ) {

    return ( \filter_var ( $ip, FILTER_VALIDATE_IP ) !== FALSE );
  }

  /**
   * Método que permite determinar si una ip es de rango privado.
   *
   * @param string $ip Ip a validar.
   *
   * @return boolean
   */
  public static function isPrivate ( string $ip ) {

    return !self::isPublic ( $ip );
  }

  /**
   * Método que permite determinar si una ip es de rango público.
   *
   * @param string $ip Ip a validar.
   *
   * @return boolean
   */
  public static function isPublic ( string $ip ) {

    return ( \filter_var ( $ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE ) !== FALSE );
  }

  /**
   * Método que permite determinar si una ip es de rango reservado.
   *
   * @param string $ip Ip a validar.
   *
   * @return boolean
   */
  public static function isReserved ( string $ip ) {

    return ( \filter_var ( $ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_RES_RANGE ) === FALSE );
  }
}

