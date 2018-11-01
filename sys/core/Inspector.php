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
use sys\libs\types\Image;
use sys\libs\types\Ip;

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
  protected $class;

  /**
   * Clase introspectada para hacer uso de la reflección para obtener
   * información de una clase.
   *
   * @var \ReflectionClass
   */
  protected $introspectedClass;

  /**
   *
   * @var array
   */
  protected $meta = array ( 
  "class" => array (), "properties" => array (), "methods" => array () );

  /**
   * Arreglo con los metodos de la clase.
   *
   * @var array
   */
  protected $methods = array ();

  /**
   * Arreglo con las propiedades de la clase.
   *
   * @var array
   */
  protected $properties = array ();

  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @param string|object $class Nombre de la clase u objeto de la clase a
   *        inspeccionar.
   *       
   * @return void
   */
  public function __construct ( $class ) {

    $this->class = $class;
    $this->introspectedClass = new \ReflectionClass ( $this->class );
  }

  /**
   */
  function __destruct () {

    // TODO - Insert your code here
  }

  /**
   * Método que permite obtener los comentarios de la clase.
   * 
   * @return string
   */
  protected function _getClassComment () {

    return $this->introspectedClass->getDocComment ();
  }

  /**
   * Método que permite obtener los métodos de la clase.
   * 
   * @return array
   */
  protected function _getClassMethods () {

    return $this->introspectedClass->getMethods ();
  }

  /**
   * Método que permite obtener las propiedades de la clase.
   * 
   * @return array
   */
  protected function _getClassProperties () {

    return $this->introspectedClass->getProperties ();
  }

  /**
   * Método que permite obtener los comentarios de un método.
   * 
   * @param string $method Método sobre le cual se obtendrán los comentarios.
   *
   * @return string
   */
  protected function _getMethodComment ( string $method ) {

    $introspectedMethod = $this->introspectedClass->getMethod ( $method );
    return $introspectedMethod->getDocComment ();
  }

  /**
   * Método que permite obtener los comentarios de una propiedad.
   * 
   * @param string $property Propiedad sobre la cual se obtendrán los 
   *        comentarios.
   *
   * @return string
   */
  protected function _getPropertyComment ( string $property ) {

    $introspectedProperty = $this->introspectedClass->getProperty ( $property );
    return $introspectedProperty->getDocComment ();
  }

  /**
   * Método que analiza estructura de la clase.
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
   * Método que permite obtener las metaetiquetas de la clase.
   * 
   * @return boolean|array
   */
  public function getClassMeta () {

    if ( !isset ( $meta [ "class" ] ) ) {
      
      $comment = $this->_getClassComment ();
      if ( !empty ( $comment ) ) {
        
        $meta [ "class" ] = $this->_parse ( $comment );
      } else {
        
        $meta [ "class" ] = null;
      }
    }
    return $meta [ "class" ];
  }

  /**
   * Método que permite obtener los métodos de la clase.
   *
   * @return array
   */
  public function getClassMethods () {

    if ( !isset ( $methods ) ) {
      
      $methods = $this->_getClassMethods ();
      foreach ( $methods as $method ) {
        
        $methods [] = $method->getName ();
      }
    }
    return $properties;
  }

  /**
   * Método que permite obtener las propiedades de la clase.
   * 
   * @return array
   */
  public function getClassProperties () {

    if ( !isset ( $properties ) ) {
      
      $properties = $this->_getClassProperties ();
      foreach ( $properties as $property ) {
        
        $properties [] = $property->getName ();
      }
    }
    return $properties;
  }

  /**
   * Método que permite obtener las metaetiquetas de un método.
   * 
   * @param string $method Método sobre el cual se obtendrán las metaetiquetas.
   *
   * @return void
   */
  public function getMethodMeta ( string $method ) {

    if ( !isset ( $meta [ "actions" ] [ $method ] ) ) {
      
      $comment = $this->_getMethodComment ( $method );
      if ( !empty ( $comment ) ) {
        
        $meta [ "methods" ] [ $method ] = $this->_parse ( $comment );
      } else {
        
        $meta [ "methods" ] [ $method ] = null;
      }
    }
    return $meta [ "methods" ] [ $method ];
  }

  /**
   * Método que permite obtener las metaetiquetas de una propiedad.
   *
   * @param string $property Propiedad sobre la cual se obtendrán las 
   *        metaetiquetas.
   *       
   * @return void
   */
  public function getPropertyMeta ( string $property ) {

    if ( !isset ( $meta [ "properties" ] [ $property ] ) ) {
      
      $comment = $this->_getPropertyComment ( $property );
      if ( !empty ( $comment ) ) {
        
        $meta [ "properties" ] [ $property ] = $this->_parse ( $comment );
      } else {
        
        $meta [ "properties" ] [ $property ] = null;
      }
    }
    return $meta [ "properties" ] [ $property ];
  }

  /**
   * Método que permite validar la propiedad solicitada y realizar las
   * operaciones previas sobre la misma antes de ser devuelta.
   *
   * @param array $meta Arreglo con las metaetiquetas de la propiedad.
   * @param mixed $property Propiedad a ser validada.
   *       
   * @throws ImageException
   * @throws IpException
   * @throws PropertyNullException
   *
   * @return array|string|boolean|number|\StdClass|mixed
   */
  public function getTypeValidation ( array $meta, $property ) {

    if ( \is_null ( $property ) ) {
      
      throw new PropertyNullException ();
    }
    $auxMeta = "";
    if ( isset ( $meta [ "@var" ] ) ) {
      
      \var_dump ( $meta [ "@var" ] [ 0 ] );
      $auxMeta = $meta [ "@var" ] [ 0 ];
    }
    if ( $auxMeta == "array" ) {
      
      $property = ( array ) $property;
      
    } elseif ( $auxMeta == "binary" ) {
      
      $property = ( string ) $property;
      
    } elseif ( ( $auxMeta == "bool" ) || ( $auxMeta == "boolean" ) ) {
      
      $property = ( bool ) $property;
      
    } elseif ( $auxMeta == "double" ) {
      
      $property = ( double ) $property;
      
    } elseif ( $auxMeta == "float" ) {
      
      $property = ( float ) $property;
      
    } elseif ( $auxMeta == "Image" ) {
      
      if ( !( $property instanceof Image ) ) {
        
        throw new ImageException ();
      }
      if ( !\is_a ( $property, "Image" ) ) {
        
        throw new ImageException ();
      }
    } elseif ( $auxMeta == "int" ) {
      
      $property = ( int ) $property;
      
    } elseif ( $auxMeta == "integer" ) {
      
      $property = ( integer ) $property;
      
    } elseif ( $auxMeta == "Ip" ) {
      
      if ( !( $property instanceof Ip ) ) {
        
        throw new IpException ();
      }
      if ( !\is_a ( $property, "Ip" ) ) {
        
        throw new IpException ();
      }
    } elseif ( $auxMeta == "long" ) {
      
      $property = ( integer ) $property;
      
    } elseif ( $auxMeta == "object" ) {
      
      $property = ( object ) $property;
      
    } elseif ( $auxMeta == "real" ) {
      
      $property = ( real ) $property;
      
    } elseif ( $auxMeta == "string" ) {
      
      $property = ( string ) $property;
      
    } else {
      
      if ( \is_object ( $property ) ) {
        
        if ( !( $property instanceof $auxMeta ) ) {
          
          throw new ObjectException ();
        }
      } else {
        
        throw new ObjectException ();
      }
    }
    return $property;
  }

  /**
   * Método que permite validar los tipos de datos y los valores a asignar a las
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
   * @throws IntegerException
   * @throws IpException
   * @throws LongException
   * @throws ObjectException
   * @throws RealException
   * @throws StringException
   *
   * @return array|string|boolean|number|\StdClass|mixed
   */
  public function setTypeValidation ( array $meta, $argument ) {

    /**
     * El punto aqui es, si $arguments cumple con el tipo indicado por la
     * metaetiqueta $meta [ "@var" ] [ 0 ] == "___" ] entonces $arguments es valido y se retorna,
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
    $auxMeta = "";
    if ( isset ( $meta [ "@var" ] ) ) {
      
      if ( \is_array ( $meta [ "@var" ] ) ) {
        
        if ( isset ( $meta [ "@var" ] [ 0 ] ) ) {
          
          $auxMeta = $meta [ '@var' ] [ 0 ];
          
        } else {
          
          \var_dump ( "Por lo visto no está definido el índice 0" );
        }
      }
    } else {
      
      \var_dump ( "Por lo visto no está definido el índice @var" );
    }
    $validatedType = FALSE;
    if ( $auxMeta == "array" ) {
      
      if ( \is_​array ( $argument ) ) {
        
        $validatedType = $argument;
        
      } else {
        
        throw new ArrayException ();
      }
    } elseif ( $auxMeta == "binary" ) {
      
      $property = ( string ) $property;
      
    } elseif ( ( $auxMeta == "bool" ) || ( $auxMeta == "boolean" ) ) {
      
      if ( !\is_​bool ( $argument ) && ( ( $validatedType = \filter_var ( $argument, FILTER_VALIDATE_BOOLEAN ) ) === FALSE ) ) {
        
        throw new BooleanException ();
      }
    } elseif ( $auxMeta == "double" ) {
      
      if ( \is_​double ( $argument ) && ( \filter_var ( $argument, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND | FILTER_FLAG_ALLOW_SCIENTIFIC ) !== FALSE ) && ( \filter_var ( $argument, FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_THOUSAND ) !== FALSE ) ) {
        
        $validatedType = $argument;
        
      } else {
        
        throw new DoubleException ();
      }
    } elseif ( $auxMeta == "float" ) {
      
      if ( \is_​float ( $argument ) && ( \filter_var ( $argument, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND | FILTER_FLAG_ALLOW_SCIENTIFIC ) !== FALSE ) && ( \filter_var ( $argument, FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_THOUSAND ) !== FALSE ) ) {
        
        $validatedType = $argument;
        
      } else {
        
        throw new FloatException ();
      }
    } elseif ( $auxMeta == "Image" ) {
      
      if ( \is_object ( $argument ) ) {
        
        if ( !( $argument instanceof Image ) ) {
          
          $validatedType = $argument;
          
        } else {
          
          throw new ImageException ();
        }
      } else {
        
        throw new ObjectException ();
      }
    } elseif ( $auxMeta == "int" ) {
      
      if ( \is_​int ( $argument ) && ( \filter_var ( $argument, FILTER_SANITIZE_NUMBER_INT ) !== FALSE ) && ( \filter_var ( $argument, FILTER_VALIDATE_INT ) !== FALSE ) ) {
        
        $validatedType = $argument;
        
      } else {
        
        throw new IntegerException ();
      }
    } elseif ( $auxMeta == "integer" ) {
      
      if ( \is_​integer ( $argument ) && ( \filter_var ( $argument, FILTER_SANITIZE_NUMBER_INT ) !== FALSE ) && ( \filter_var ( $argument, FILTER_VALIDATE_INT ) !== FALSE ) ) {
        
        $validatedType = $argument;
        
      } else {
        
        throw new IntegerException ();
      }
    } elseif ( $auxMeta == "Ip" ) {
      
      if ( \is_object ( $argument ) ) {
        
        if ( !( $argument instanceof Ip ) ) {
          
          $validatedType = $argument;
          
        } else {
          
          throw new IpException ();
        }
      } else {
        
        throw new ObjectException ();
      }
    } elseif ( $auxMeta == "long" ) {
      
      if ( \is_​long ( $argument ) && ( \filter_var ( $argument, FILTER_SANITIZE_NUMBER_INT ) !== FALSE ) && ( \filter_var ( $argument, FILTER_VALIDATE_INT ) !== FALSE ) ) {
        
        $validatedType = $argument;
        
      } else {
        
        throw new LongException ();
      }
    } elseif ( $auxMeta == "object" ) {
      
      if ( \is_object ( $argument ) ) {
        
        $validatedType = $argument;
        
      } else {
        
        throw new ObjectException ();
      }
    } elseif ( $auxMeta == "real" ) {
      
      if ( \is_​real ( $argument ) && ( \filter_var ( $argument, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND | FILTER_FLAG_ALLOW_SCIENTIFIC ) !== FALSE ) && ( \filter_var ( $argument, FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_THOUSAND ) !== FALSE ) ) {
        
        $validatedType = $argument;
        
      } else {
        
        throw new RealException ();
      }
    } elseif ( $auxMeta == "string" ) {
      
      if ( \is_string ( $argument ) && ( ( $validatedType = \filter_var ( $argument, FILTER_SANITIZE_STRING ) ) !== FALSE ) ) {
        
        throw new StringException ();
      }
    } else {
      
      if ( \is_object ( $argument ) ) {
        
        if ( $argument instanceof $auxMeta ) {
          
          $validatedType = $argument;

        } else {
          
          throw new ObjectException ();
        }
      } else {
        
        throw new ObjectException ();
      }
    }
    return $validatedType;
  }
}
