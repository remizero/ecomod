<?php
namespace sys\libs\common;

/**
 * <strong>ObjectUtils</strong>
 * Archivo creado el 14 de septiembre de 2018 a las 11:39:20 a.m.
 * <p>Clase que permite realizar operaciones sobre objetos.</p>
 *
 * @name ObjectUtils
 * @namespace sys\libs\common
 * @package ECOMOD.
 * @subpackage LIBS-COMMON.
 * @filesource ObjectUtils.php
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
class ObjectUtils {
  
  /**
   * Metodo que permite convertir un array a string para ser guardado en un
   * archivo de configuracion.
   *
   * @param \stdClass $object Arreglo a convertir.
   *
   * @return string
   */
  public static function toConfigFile ( $object ) {
    
    $output = "";
    if ( \is_object ( $object ) ) {
      
      foreach ( $object as $section => $objectValue ) {
        
        $output .= '[' . $section . ']' . PHP_EOL;
        
        if ( \is_object ( $objectValue ) ) {
          
          foreach ( $objectValue as $key => $value ) {
            
            $output .= $key . ' = "' . $value . '"' . PHP_EOL;
          }
          $output .= PHP_EOL;
        }
      }
    } else {
      
      
    }
    return $output;
  }
}

