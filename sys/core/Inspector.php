<?php
namespace sys\core;

use sys\libs\common\ArrayUtils;
use sys\libs\common\StringUtils;
use sys\libs\exceptions\ArrayException;
use sys\libs\exceptions\BooleanException;
use sys\libs\exceptions\DoubleException;
use sys\libs\exceptions\FloatException;
use sys\libs\exceptions\ImageException;
use sys\libs\exceptions\IntegerException;
use sys\libs\exceptions\IpException;
use sys\libs\exceptions\LongException;
use sys\libs\exceptions\ObjectException;
use sys\libs\exceptions\PropertyNullException;
use sys\libs\exceptions\RealException;
use sys\libs\exceptions\StringException;

/**
 * <strong>Inspector</strong>
 *
 * Archivo creado el 16 de agosto de 2018 a las 23:48:07 p.m.
 * <p>Clase que permite definir e inspeccionar diferentes tipos de banderas y
 * pares clave/valor, para determinar si un método/propiedad puede ser accesible
 * o se deben llamar a otros métodos antes o después de ser inspeccionado. 
 * Evaluar bloques de comentarios especiales para información, usando código, 
 * determinar todo tipo de metadatos sobre cada método/propiedad.</p>
 *
 * @name Inspector
 * @namespace sys\core
 * @package ECOMOD.
 * @subpackage CORE.
 * @filesource Inspector.php
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
 *       <li>Validacion completa a todos los tipos simples de php y definidos
 *       para el sistema.</li>
 *       <li>.</li>
 *       <li>.</li>
 *       </ul>
 */
class Inspector {

  /**
   *
   * @var string|object
   */
  protected $_class;

  /**
   *
   * @var array
   */
  protected $_meta = array ( 
    
      "class" => array (),
      "properties" => array (),
      "methods" => array () 
  );

  /**
   * Arreglo con las propiedades de la clase.
   *
   * @var array
   */
  protected $_properties = array ();

  /**
   * Arreglo con los metodos de la clase.
   *
   * @var array
   */
  protected $_methods = array ();

  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @param string|object $class Nombre de la clase u objeto de la clase a
   *        inspeccionar.
   *       
   * @return void
   */
  public function __construct ( $class ) {

    $this->_class = $class;
  }

  /**
   */
  function __destruct () {

    // TODO - Insert your code here
  }

  /**
   *
   * @return string
   */
  protected function _getClassComment () {

    $reflection = new \ReflectionClass ( $this->_class );
    return $reflection->getDocComment ();
  }

  /**
   *
   * @return array
   */
  protected function _getClassMethods () {

    $reflection = new \ReflectionClass ( $this->_class );
    return $reflection->getMethods ();
  }

  /**
   *
   * @return array
   */
  protected function _getClassProperties () {

    $reflection = new \ReflectionClass ( $this->_class );
    return $reflection->getProperties ();
  }

  /**
   *
   * @param string $method
   *
   * @return string
   */
  protected function _getMethodComment ( string $method ) {

    $reflection = new \ReflectionMethod ( $this->_class, $method );
    return $reflection->getDocComment ();
  }

  /**
   *
   * @param string $property
   *
   * @return string
   */
  protected function _getPropertyComment ( string $property ) {

    $reflection = new \ReflectionProperty ( $this->_class, $property );
    return $reflection->getDocComment ();
  }

  /**
   *
   * @param string $comment
   *
   * @return boolean[]|array[]
   */
  protected function _parse ( string $comment ) {

    $meta = array ();
    $pattern = "(@[a-zA-Z]+\s*[a-zA-Z0-9, ()_]*)";
    $matches = StringUtils::match ( $comment, $pattern );
    if ( $matches != null ) {
      
      foreach ( $matches as $match ) {
        
        $parts = ArrayUtils::clean ( ArrayUtils::trim ( StringUtils::split ( $match, "[\s]", 2 ) ) );
        $meta [ $parts [ 0 ] ] = true;
        if ( \sizeof ( $parts ) > 1 ) {
          
          $meta [ $parts [ 0 ] ] = ArrayUtils::clean ( ArrayUtils::trim ( StringUtils::split ( $parts [ 1 ], "," ) ) );
        }
      }
    }
    return $meta;
  }

  /**
   *
   * @return boolean|array
   */
  public function getClassMeta () {

    if ( !isset ( $_meta [ "class" ] ) ) {
      
      $comment = $this->_getClassComment ();
      if ( !empty ( $comment ) ) {
        
        $_meta [ "class" ] = $this->_parse ( $comment );
        
      } else {
        
        $_meta [ "class" ] = null;
      }
    }
    return $_meta [ "class" ];
  }

  /**
   *
   * @return array
   */
  public function getClassMethods () {

    if ( !isset ( $_methods ) ) {
      
      $methods = $this->_getClassMethods ();
      foreach ( $methods as $method ) {
        
        $_methods [] = $method->getName ();
      }
    }
    return $_properties;
  }

  /**
   *
   * @return array
   */
  public function getClassProperties () {

    if ( !isset ( $_properties ) ) {
      
      $properties = $this->_getClassProperties ();
      foreach ( $properties as $property ) {
        
        $_properties [] = $property->getName ();
      }
    }
    return $_properties;
  }

  /**
   *
   * @param string $method
   *
   * @return void
   */
  public function getMethodMeta ( string $method ) {

    if ( !isset ( $_meta [ "actions" ] [ $method ] ) ) {
      
      $comment = $this->_getMethodComment ( $method );
      if ( !empty ( $comment ) ) {
        
        $_meta [ "methods" ] [ $method ] = $this->_parse ( $comment );
        
      } else {
        
        $_meta [ "methods" ] [ $method ] = null;
      }
    }
    return $_meta [ "methods" ] [ $method ];
  }

  /**
   *
   * @param string $property
   *
   * @return void
   */
  public function getPropertyMeta ( string $property ) {

    if ( !isset ( $_meta [ "properties" ] [ $property ] ) ) {
      
      $comment = $this->_getPropertyComment ( $property );
      if ( !empty ( $comment ) ) {
        
        $_meta [ "properties" ] [ $property ] = $this->_parse ( $comment );
        
      } else {
        
        $_meta [ "properties" ] [ $property ] = null;
      }
    }
    return $_meta [ "properties" ] [ $property ];
  }

  /**
   * Metodo que permite validar la propiedad solicitada y realizar las
   * operaciones previas sobre la misma antes de ser devuelta.
   *
   * @param array $meta Arreglo con las metaetiquetas de la propiedad.
   * @param mixed $property Propiedad a ser validada.
   *       
   * @throws ImageException
   * @throws PropertyNullException
   *
   * @return array|string|boolean|number|\StdClass|mixed
   */
  public function getTypeValidation ( array $meta, $property ) {

    /**
     * El punto aqui es, validar que el valor de la propiedad no este en null,
     * de ser asi hacer una advertencia, por otro lado realizar las conversiones
     * necesarias sobre todo en el caso la propiedad de tipo Ip y/o cualquier
     * otro tipo de dato definido por el desarrollador del sistema ECOMOD que
     * requiera alguna conversion particular.
     * 
     */
    if ( \is_null ( $property ) ) {
      
      throw new PropertyNullException ();
    }
    if ( $meta [ "@array" ] ) {
      
      $property = ( array ) $property;
      
    } elseif ( $meta [ "@binary" ] ) {
      
      $property = ( binary ) $property;
      
    } elseif ( $meta [ "@bool" ] || $meta [ "@boolean" ] ) {
      
      $property = ( bool ) $property;
      
    } elseif ( $meta [ "@double" ] ) {
      
      $property = ( double ) $property;
      
    } elseif ( $meta [ "@float" ] ) {
      
      $property = ( float ) $property;
      
    } elseif ( $meta [ "@Image" ] ) {
      
      if ( !\is_a ( $property, "Image" ) ) {

        throw new ImageException ();
      }
    } elseif ( $meta [ "@int" ] ) {
      
      $property = ( int ) $property;
      
    } elseif ( $meta [ "@integer" ] ) {
      
      $property = ( integer ) $property;
      
    } elseif ( $meta [ "@Ip" ] ) {
      
      if ( !\is_a ( $property, "Ip" ) ) {
        
        throw new ImageException ();
      }
    } elseif ( $meta [ "@long" ] ) {
      
      $property = ( integer ) $property;
      
    } elseif ( $meta [ "@object" ] ) {
      
      $property = ( object ) $property;
      
    } elseif ( $meta [ "@real" ] ) {
      
      $property = ( real ) $property;
      
    } elseif ( $meta [ "@string" ] ) {
      
      $property = ( string ) $property;
    }
    return $property;
  }

  /**
   * Metodo que permite validar los tipos de datos y los valores a asignar a las
   * propiedades de las clases.
   *
   * @param array $meta Arreglo con las metaetiquetas de la propiedad.
   * @param mixed $argument Valor a asignar a la propiedad.
   *       
   * @throws ArrayException
   * @throws BooleanException
   * @throws DoubleException
   * @throws FloatException
   * @throws ImageException
   * @throws ObjectException
   * @throws IntegerException
   * @throws IpException
   * @throws LongException
   * @throws RealException
   * @throws StringException
   *
   * @return array|string|boolean|number|\StdClass|mixed
   */
  public function setTypeValidation ( array $meta, $argument ) {

    /**
     * El punto aqui es, si $arguments cumple con el tipo indicado por la
     * metaetiqueta $meta [ "@___" ] entonces $arguments es valido y se retorna,
     * en caso contrario se retorna null.
     * Hacer uso de las siguientes funciones:
     *
     * \is_callable($var);
     * \is_​countable
     * \is_dir($filename);
     * \is_executable($filename);
     * \is_file($filename);
     * \is_finite($val);
     * \is_infinite($val);
     * \is_iterable($var);
     * \is_link($filename);
     * \is_nan($val);
     * \is_readable($filename);
     * \is_resource($var);
     * \is_scalar($var);
     * \is_soap_fault($object);
     * \is_subclass_of($object, $class_name);
     * \is_uploaded_file($filename);
     * \is_writable($filename);
     * \is_writeable($filename);
     */
    $validatedType = FALSE;
    if ( $meta [ "@array" ] ) {
      
      if ( \is_​array ( $argument ) ) {
        
        $validatedType = $argument;
        
      } else {
        
        throw new ArrayException ();
      }
    } elseif ( $meta [ "@binary" ] ) {
      
      
      $property = ( binary ) $property;
      
    } elseif ( $meta [ "@bool" ] || $meta [ "@boolean" ] ) {
      
      if ( \is_​bool ( $argument ) ) {
        
        $validatedType = $argument;
        
      } else {
        
        throw new BooleanException ();
      }
    } elseif ( $meta [ "@double" ] ) {
      
      if ( \is_​double ( $argument ) ) {
        
        $validatedType = $argument;
        
      } else {
        
        throw new DoubleException ();
      }
    } elseif ( $meta [ "@float" ] ) {
      
      if ( \is_​float ( $argument ) ) {
        
        $validatedType = $argument;
        
      } else {
        
        throw new FloatException ();
      }
    } elseif ( $meta [ "@Image" ] ) {
      
      if ( \is_object ( $argument ) ) {
        
        if ( \is_a ( $argument, "Image" ) ) {
          
          $validatedType = $argument;
          
        } else {
          
          throw new ImageException ();
        }
      } else {
        
        throw new ObjectException ();
      }
    } elseif ( $meta [ "@int" ] ) {
      
      if ( \is_​int ( $argument ) ) {
        
        $validatedType = $argument;
        
      } else {
        
        throw new IntegerException ();
      }
    } elseif ( $meta [ "@integer" ] ) {
      
      if ( \is_​integer ( $argument ) ) {
        
        $validatedType = $argument;
        
      } else {
        
        throw new IntegerException ();
      }
    } elseif ( $meta [ "@Ip" ] ) {
      
      if ( \is_object ( $argument ) ) {
        
        if ( \is_a ( $argument, "Ip" ) ) {
          
          $validatedType = $argument;
          
        } else {
          
          throw new IpException ();
        }
      } else {
        
        throw new ObjectException ();
      }
    } elseif ( $meta [ "@long" ] ) {
      
      if ( \is_​long ( $argument ) ) {
        
        $validatedType = $argument;
      } else {
        
        throw new LongException ();
      }
    } elseif ( $meta [ "@object" ] ) {
      
      if ( \is_​object ( $argument ) ) {
        
        $validatedType = $argument;
        
      } else {
        
        throw new ObjectException ();
      }
    } elseif ( $meta [ "@real" ] ) {
      
      if ( \is_​real ( $argument ) ) {
        
        $validatedType = $argument;
        
      } else {
        
        throw new RealException ();
      }
    } elseif ( $meta [ "@string" ] ) {
      
      if ( \is_string ( $argument ) ) {
        
        $validatedType = $argument;
        
      } else {
        
        throw new StringException ();
      }
    }
    return $validatedType;
  }
}
