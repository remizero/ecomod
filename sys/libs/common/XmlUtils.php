<?php
namespace sys\libs\common;

/**
 * <strong>XmlUtils</strong>
 *
 * Archivo creado el 20 de septiembre de 2018 a las 00:43:40 a.m.
 * <p>Clase que permite realizar operaciones sobre archivos y objetos XML.</p>
 *
 * @name XmlUtils
 * @namespace sys\api\config\core
 * @package ECOMOD.
 * @subpackage LIBS-COMMON.
 * @filesource XmlUtils.php
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
abstract class XmlUtils {

  /**
   * Convierte un objeto de tipo SimpleXMLElement en un array.
   *
   * @param \SimpleXMLElement $simpleXmlElement Objeto de tipo SimpleXMLElement
   *        a convertir.
   *       
   * @return array
   */
  public static function toArray ( \SimpleXMLElement $simpleXmlElement ) {

    return \json_decode ( \json_encode ( $simpleXmlElement ) , 1 );
  }

  /**
   * Convierte un objeto de tipo SimpleXMLElement en un objeto de tipo stdClass.
   *
   * @param \SimpleXMLElement $simpleXmlElement Objeto de tipo SimpleXMLElement
   *        a convertir.
   *       
   * @return \stdClass
   */
  public static function toObject ( \SimpleXMLElement $simpleXmlElement ) {

  }

  /**
   * Convierte un objeto de tipo stdClass o un arreglo(array) en un objeto de
   * tipo SimpleXMLElement.
   *
   * @param \stdClass|array $data Objeto de tipo \stdClass o array a convertir.
   *       
   * @return \SimpleXMLElement
   */
  public static function toSimpleXmlElement ( $data ) {

    if ( \is_object ( $data ) ) {
      
      
      
    } elseif ( \is_array ( $data ) ) {
      
      
    } else {
      
      //@todo lanzar excepcion
    }
    return new \SimpleXMLElement ( $data );
  }
}

