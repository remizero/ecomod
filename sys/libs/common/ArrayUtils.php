<?php
namespace sys\libs\common;

/**
 * <strong>ArrayUtils</strong>
 * Archivo creado el 14 de agosto de 2018 a las 0:36:50 a.m.
 * <p>Clase que permite realizar operaciones sobre arreglos (Matrices/array).</p>
 *
 * @name ArrayUtils
 * @namespace sys\libs\common
 * @package ECOMOD.
 * @subpackage LIBS-COMMON.
 * @filesource ArrayUtils.php
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
abstract class ArrayUtils {

  /**
   * 
   * @param array $array
   * 
   * @return array
   */
  public static function clean ( $array ) {

    return \array_filter ( $array, function ( $item ) {
      
      return !empty ( $item );
    } );
  }

  /**
   * 
   * @param array $array
   * 
   * @return NULL|string
   */
  public static function first ( $array ) {
    
    if ( \sizeof ( $array ) == 0 ) {
      
      return null;
    }
    $keys = \array_keys ( $array );
    return $array [ $keys [ 0 ] ];
  }
  
  /**
   * 
   * @param array $array
   * @param array $return
   * 
   * @return array
   */
  public function flatten ( $array, $return = array() ) {
    
    foreach ( $array as $key => $value ) {
      
      if ( \is_array ( $value ) || is_object ( $value ) ) {
        
        $return = self::flatten ( $value, $return );
        
      } else {
        
        $return [] = $value;
      }
    }
    return $return;
  }
  
  /**
   * 
   * @param array $array
   * 
   * @return NULL|string
   */
  public static function last ( $array ) {
    
    if ( \sizeof ( $array ) == 0 ) {
      
      return null;
    }
    $keys = \array_keys ( $array );
    return $array [ $keys [ \sizeof ( $keys ) - 1 ] ];
  }
  
  /**
   * Metodo que permite convertir un array a string para ser guardado en un
   * archivo de configuracion.
   *
   * @param array $array Arreglo a convertir.
   *
   * @return string
   */
  public static function toConfigFile ( array $array ) {
    
    foreach ( $array as $section => $arrayValue ) {
      
      $output .= '[' . $section . ']' . PHP_EOL;
      
      foreach ( $arrayValue as $key => $value ) {
        
        $output .= $key . ' = "' . $value . '"' . PHP_EOL;
      }
      $output .= PHP_EOL;
    }
    return $output;
  }

  /**
   * Convierte un arreglo en un objeto de tipo stdClass.
   *  
   * @param array $array Arreglo a convertir.
   * 
   * @return \stdClass
   */
  public static function toObject ( array $array ) {

    $result = new \stdClass ();
    foreach ( $array as $key => $value ) {
      
      if ( \is_array ( $value ) ) {
        
        $result->{$key} = self::toObject ( $value );
        
      } else {
        
        $result->{$key} = $value;
      }
    }
    
    return $result;
  }

  public function toQueryString ( $array ) {

    return \http_build_query ( self::clean ( $array ) );
  }
  
  public static function trim ( $array ) {
    
    return \array_map ( function ( $item ) {
      
      return \trim ( $item );
    }, $array );
  }
}

