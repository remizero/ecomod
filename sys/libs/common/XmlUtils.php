<?php
namespace sys\libs\common;

use sys\libs\exceptions\ObjectException;
use sys\libs\exceptions\ArrayException;
use sys\libs\exceptions\ArgumentException;

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

    return \json_decode ( \json_encode ( $simpleXmlElement ), 1 );
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

    $data = new \StdClass ();
    if ( ( \is_object ( $simpleXmlElement ) && ( $simpleXmlElement instanceof \SimpleXMLElement ) ) ) {
      
      if ( \count ( $simpleXmlElement->children () ) ) {
        
        foreach ( $simpleXmlElement as $key => $value ) {
          
          if ( \count ( $simpleXmlElement->$key ) > 1 ) {
            
            if ( !isset ( $data->$key ) || !\is_array ( $data->$key ) ) {
              
              $data->$key = array ();
            }
            \array_push ( $data->$key, self::toObject ( $value ) );
          } else {
            
            $data->$key = self::toObject ( $value );
          }
        }
      }
      if ( \count ( $simpleXmlElement->attributes () ) ) {
        
        foreach ( $simpleXmlElement->attributes () as $key => $value ) {
          
          $data->$key = ( string ) $value;
        }
      }
      if ( \count ( \get_object_vars ( $data ) ) == 0 ) {
        
        $data = ( string ) $simpleXmlElement;
      }
    } elseif ( \is_array ( $simpleXmlElement ) ) {
      
      foreach ( $simpleXmlElement as $key => $value ) {
        
        $data->$key = self::toObject ( $value );
      }
    } else {
      
      $data = ( string ) $simpleXmlElement;
    }
    return $data;
  }

  /**
   * Convierte un objeto de tipo stdClass o un arreglo(array) en un objeto de
   * tipo SimpleXMLElement.
   *
   * @param \stdClass|array $data Objeto de tipo \stdClass o array a convertir.
   * @param string $rootName Nombre del elemento raiz del archivo XML.
   * 
   * @throws ArgumentException
   *       
   * @return \SimpleXMLElement
   */
  public static function toSimpleXmlElement ( $data, string $rootName = 'ecomod' ) {

    if ( \is_object ( $data ) ) {
      
      return self::stdClassToSimpleXmlElement ( $data, $rootName );
      
    } elseif ( \is_array ( $data ) ) {
      
      return self::arrayToSimpleXmlElement ( $data, $rootName );
      
    } else {
      
      throw new ArgumentException ();
    }
  }

  /**
   * Metodo recursivo que permite convertir un arreglo en un objeto de tipo
   * SimpleXMLElement.
   *
   * @param array $data Array a convertir.
   * @param string $rootName Nombre del elemento raiz del archivo XML.
   * 
   * @throws ArrayException
   *       
   * @return \SimpleXMLElement
   */
  public static function arrayToSimpleXmlElement ( array $array, string $rootName = 'ecomod' ) {

    if ( \is_array ( $array ) ) {
      
      $xml = new \DOMDocument;
      try {
        
        $root = $xml->createElement ( $rootName );
        
      } catch ( \DOMException $de ) {
        
        ErrorLog::exception ( $de );
      }
      $xml->appendChild ( $root );
      foreach ( $array as $key => $value ) {
        
        if ( \is_array ( $value ) ) {
          
          $subXml = self::arrayToSimpleXmlElement ( $value, $key );
          $subXml = \str_replace ( '<?xml version="1.0"?>', '', $subXml->asXML () );
          $element = $xml->createElement ( $key, $subXml );
          $xml->replaceChild ( $element, $root );
          
        } else {
          
          $element = $xml->createElement ( $key, $value );
          $root->appendChild ( $element );
        }
      }
      $simpleXml = \simplexml_load_string ( \html_entity_decode ( $xml->saveXml () ) );
      return $simpleXml;
      
    } else {
      
      throw new ArrayException ();
    }
  }

  /**
   * Metodo recursivo que permite convertir un objeto de tipo stdClass en un
   * objeto de tipo SimpleXMLElement.
   *
   * @param \stdClass $object Objeto de tipo \stdClass o array a convertir.
   * @param string $rootName Nombre del elemento raiz del archivo XML.
   * 
   * @throws ObjectException
   *       
   * @return \SimpleXMLElement
   */
  public static function stdClassToSimpleXmlElement ( \stdClass $object, string $rootName = 'ecomod' ) {

    if ( \is_object ( $object ) ) {
      
      $xml = new \DOMDocument;
      try {
        
        $root = $xml->createElement ( $rootName );
        
      } catch ( \DOMException $de ) {
        
        ErrorLog::exception ( $de );
      }
      $xml->appendChild ( $root );
      foreach ( $object as $key => $value ) {
        
        if ( \is_object ( $value ) ) {
          
          $subXml = self::stdClassToSimpleXmlElement ( $value, $key );
          $subXml = \str_replace ( '<?xml version="1.0"?>', '', $subXml->asXML () );
          $element = $xml->createElement ( $key, $subXml );
          $xml->replaceChild ( $element, $root );
          
        } else {

          $element = $xml->createElement ( $key, $value );
          $root->appendChild ( $element );
        }
      }
      $simpleXml = \simplexml_load_string ( \html_entity_decode ( $xml->saveXml () ) );
      return $simpleXml;

    } else {
      
      throw new ObjectException ();
    }
  }
}

