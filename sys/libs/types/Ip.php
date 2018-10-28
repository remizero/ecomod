<?php
namespace sys\libs\types;

use sys\libs\exceptions\IpException;

/**
 * <strong>Ip</strong>
 *
 * Archivo creado el 14 de agosto de 2018 a las 20:54:35 p.m.
 * <p>Clase que permite manipular direcciones IP de manera más natural para el 
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
   * Valor de la ip.
   * 
   * @readwrite
   * 
   * @var int $ip
   */
  private $ip;
  
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
   * Método que permite determinar si una ip es de tipo IPv4.
   * 
   * @param string $ip Ip a validar.
   * 
   * @throws IpException
   * 
   * @return boolean
   */
  public static function isIPv4 ( string $ip ) {
    
    if ( !Ip::isValid ( $ip ) ) {
      
      throw  new IpException ();
    }
    return ( \filter_var ( $argument, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) !== FALSE );
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
    
    if ( !Ip::isValid ( $ip ) ) {
      
      throw  new IpException ();
    }
    return ( \filter_var ( $argument, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6 ) !== FALSE );
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
    
    return ( \filter_var ( $argument, FILTER_VALIDATE_IP ) !== FALSE );
  }
  
  /**
   * Método que permite determinar si una ip es de rango privado.
   *
   * @param string $ip Ip a validar.
   *
   * @return boolean
   */
  public static function isPrivate ( string $ip ) {
    
    return !Ip::isPublic ( $ip );
  }
  
  /**
   * Método que permite determinar si una ip es de rango público.
   *
   * @param string $ip Ip a validar.
   *
   * @return boolean
   */
  public static function isPublic ( string $ip ) {
    
    return ( \filter_var ( $argument, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE ) !== FALSE );
  }
  
  /**
   * Método que permite determinar si una ip es de rango reservado.
   *
   * @param string $ip Ip a validar.
   *
   * @return boolean
   */
  public static function isReserved ( string $ip ) {
    
    return ( \filter_var ( $argument, FILTER_VALIDATE_IP, FILTER_FLAG_NO_RES_RANGE ) === FALSE );
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

    if ( !Ip::isValid ( $ip ) ) {
      
      throw  new IpException ();
    }
    $this->ip = \ip2long ( $ip );
    return $this;
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
