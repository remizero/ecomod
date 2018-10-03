<?php
namespace sys\libs\common;

/**
 * <strong>StringUtils</strong>
 * Archivo creado el 14 de agosto de 2018 a las 0:50:25 a.m.
 * <p>Clase que permite realizar operaciones sobre cadenas de caracteres
 * (string).</p>
 *
 * @name StringUtils
 * @namespace sys\libs\common
 * @package ECOMOD.
 * @subpackage LIBS-COMMON.
 * @filesource StringUtils.php
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
class StringUtils {

  /**
   * 
   * @var string
   */
  private static $_delimiter = "#";

  /**
   * 
   * @var array
   */
  private static $_singular = array ( 
    "(matr)ices$" => "\\1ix","(vert|ind)ices$" => "\\1ex","^(ox)en" => "\\1","(alias)es$" => "\\1","([octop|vir])i$" => "\\1us","(cris|ax|test)es$" => "\\1is","(shoe)s$" => "\\1","(o)es$" => "\\1","(bus|campus)es$" => "\\1","([m|l])ice$" => "\\1ouse","(x|ch|ss|sh)es$" => "\\1","(m)ovies$" => "\\1\\2ovie","(s)eries$" => "\\1\\2eries","([^aeiouy]|qu)ies$" => "\\1y","([lr])ves$" => "\\1f","(tive)s$" => "\\1","(hive)s$" => "\\1","([^f])ves$" => "\\1fe","(^analy)ses$" => "\\1sis","((a)naly|(b)a|(d)iagno|(p)arenthe|(p)rogno|(s)ynop|(t)he)ses$" => "\\1\\2sis","([ti])a$" => "\\1um","(p)eople$" => "\\1\\2erson","(m)en$" => "\\1an","(s)tatuses$" => "\\1\\2tatus","(c)hildren$" => "\\1\\2hild","(n)ews$" => "\\1\\2ews","([^u])s$" => "\\1" 
  );

  /**
   * 
   * @var array
   */
  private static $_plural = array ( 
    "^(ox)$" => "\\1\\2en","([m|l])ouse$" => "\\1ice","(matr|vert|ind)ix|ex$" => "\\1ices","(x|ch|ss|sh)$" => "\\1es","([^aeiouy]|qu)y$" => "\\1ies","(hive)$" => "\\1s","(?:([^f])fe|([lr])f)$" => "\\1\\2ves","sis$" => "ses","([ti])um$" => "\\1a","(p)erson$" => "\\1eople","(m)an$" => "\\1en","(c)hild$" => "\\1hildren","(buffal|tomat)o$" => "\\1\\2oes","(bu|campu)s$" => "\\1\\2ses","(alias|status|virus)" => "\\1es","(octop)us$" => "\\1i","(ax|cris|test)is$" => "\\1es","s$" => "s","$" => "s" 
  );

  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   * 
   * @return void
   */
  private function __construct () {

    // do nothing
  }

  /**
   * 
   */
  private function __clone () {

    // do nothing
  }

  /**
   * 
   * @param string $pattern
   * 
   * @return string
   */
  private static function _normalize ( $pattern ) {

    return self::$_delimiter . \trim ( $pattern, self::$_delimiter ) . self::$_delimiter;
  }

  /**
   * 
   * @return string
   */
  public static function getDelimiter () {

    return self::$_delimiter;
  }
  
  /**
   * 
   * @param string $string
   * @param string $substring
   * @param int $offset
   * 
   * @return number
   */
  public function indexOf ( string $string, string $substring, int $offset = null ) {
    
    $position = \strpos ( $string, $substring, $offset );
    if ( !is_int ( $position ) ) {
      
      return -1;
    }
    return $position;
  }
  
  /**
   * 
   * @param string $string
   * @param string $substring
   * @param int $offset
   * 
   * @return number
   */
  public function lastIndexOf ( string $string, string $substring, int $offset = null ) {
    
    $position = \strrpos ( $string, $substring, $offset );
    if ( !is_int ( $position ) ) {
      return -1;
    }
    return $position;
  }
  
  /**
   * 
   * @param string $string
   * @param string $pattern
   * 
   * @return array|NULL
   */
  public static function match ( string $string, string $pattern ) {
    
    \preg_match_all ( self::_normalize ( $pattern ), $string, $matches, PREG_PATTERN_ORDER );
    if ( !empty ( $matches [ 1 ] ) ) {
      
      return $matches [ 1 ];
    }
    if ( !empty ( $matches [ 0 ] ) ) {
      
      return $matches [ 0 ];
    }
    return null;
  }
  
  /**
   * 
   * @param string $string
   * 
   * @return array|string
   */
  function plural ( string $string ) {
    
    $result = $string;
    foreach ( self::$_plural as $rule => $replacement ) {
      
      $rule = self::_normalize ( $rule );
      if ( \preg_match ( $rule, $string ) ) {
        
        $result = \preg_replace ( $rule, $replacement, $string );
        break;
      }
    }
    return $result;
  }
  
  /**
   * 
   * @param string $string
   * @param array|string $mask
   * 
   * @return string
   */
  public static function sanitize ( string $string, $mask ) {
    
    if ( \is_array ( $mask ) ) {
      
      $parts = $mask;
      
    } else if ( \is_string ( $mask ) ) {
      
      $parts = \str_split ( $mask );
      
    } else {
      
      return $string;
    }
    foreach ( $parts as $part ) {
      
      $normalized = self::_normalize ( "\\{$part}" );
      $string = \preg_replace ( "{$normalized}m", "\\{$part}", $string );
    }
    return $string;
  }

  /**
   * 
   * @param string $delimiter
   * 
   * @return void
   */
  public static function setDelimiter ( string $delimiter ) {

    self::$_delimiter = $delimiter;
  }
  
  /**
   * 
   * @param string $string
   * 
   * @return string
   */
  public static function singular ( string $string ) {
    
    $result = $string;
    
    foreach ( self::$_singular as $rule => $replacement ) {
      
      $rule = self::_normalize ( $rule );
      if ( \preg_match ( $rule, $string ) ) {
        
        $result = \preg_replace ( $rule, $replacement, $string );
        break;
      }
    }
    return $result;
  }

  /**
   * 
   * @param string $string
   * @param string $pattern
   * @param int $limit
   * 
   * @return array
   */
  public static function split ( string $string, string $pattern, $limit = null ) {

    $flags = PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE;
    return \preg_split ( self::_normalize ( $pattern ), $string, $limit, $flags );
  }

  /**
   * 
   * @param string $string
   * 
   * @return string
   */
  public static function unique ( $string ) {

    $unique = "";
    $parts = \str_split ( $string );
    foreach ( $parts as $part ) {
      
      if ( !\strstr ( $unique, $part ) ) {
        
        $unique .= $part;
      }
    }
    return $unique;
  }
}

