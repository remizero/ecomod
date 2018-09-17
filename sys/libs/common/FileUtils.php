<?php
namespace sys\libs\common;

use sys\libs\exceptions\FileException;
use sys\libs\exceptions\FileNotFoundException;
use sys\libs\exceptions\PathException;

/**
 * <strong>FileUtils</strong>
 *
 * Archivo creado el 13 de septiembre de 2018 a las 22:02:00 p.m.
 * <p>Clase que realizar operaciones sobre archivos.</p>
 *
 *
 * @name FileUtils
 * @namespace sys\libs\common
 * @package ECOMOD.
 * @subpackage LIBS-COMMON.
 * @filesource FileUtils.php
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
 *       <li>Inclusión de traza informativa en el sistema de log de errores para
 *       indicar que clase no pudo se encontrada.</li>
 *       <li>.</li>
 *       <li>.</li>
 *       </ul>
 */
abstract class FileUtils {

  /**
   * Salto de linea para sistemas tipo UNIX.
   * 
   * @var string
   */
  const LINE_BREAK_UNIX = '\n';
  
  /**
   * Salto de linea para sistemas tipo WINDOWS.
   *
   * @var string
   */
  const LINE_BREAK_WINDOWS = '\r\n';
  
  /**
   * Método que permite obtener la extension de un archivo.
   * 
   * @param string $fileName Nombre del archivo a obtener su extensión.
   * 
   * @throws FileException
   * @throws FileNotFoundException
   * @throws PathException
   * 
   * @return string
   */
  public static function getFileExtension ( string $fileName ) {
    
    if ( !empty ( $fileName ) ) {
      
      if ( \file_exists ( $fileName ) ) {
        
        if ( \is_file ( $fileName ) ) {
          
          return ( false === $pos = \strrpos ( $fileName, '.' ) ) ? '' : \substr ( $fileName, $pos + 1 );
          
        } else {
          
          throw new FileException ( $fileName );
        }
      } else {
        
        throw new FileNotFoundException ( $fileName );
      }
    } else {
      
      throw new PathException ();
    }
  }
  
  /**
   * Método que permite validar la existencia de un archivo.
   * 
   * @param string $path
   * @throws FileException
   * @throws FileNotFoundException
   * @throws PathException
   * 
   * @return string
   */
  public static function validate ( string $path ) {
    
    if ( !empty ( $path ) ) {
      
      if ( \file_exists ( $path ) ) {
        
        if ( \is_file ( $path ) ) {
              
          return $path;
              
        } else {
          
          throw new FileException ( $path );
        }
      } else {
        
        throw new FileNotFoundException ( $path );
      }
    } else {
      
      throw new PathException ();
    }
  }
}

