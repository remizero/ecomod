<?php
namespace sys\core\abstracts;

use sys\core\Inspector;
use sys\libs\common\ClassUtils;
use sys\libs\common\StringUtils;
use sys\libs\exceptions\Exception;
use sys\libs\exceptions\MethodNotImplementedException;
use sys\libs\exceptions\PropertyException;
use sys\libs\exceptions\PropertyValueException;
use sys\libs\exceptions\ReadOnlyException;
use sys\libs\exceptions\WriteOnlyException;

/**
 * <strong>BaseClass</strong>
 *
 * Archivo creado el 31 de agosto de 2018 a las 17:29:00 p.m.
 * <p>Clase base de la que heredarán la mayoria sino todas las demás clases del
 * sistema, que permitirá algunas funciones comunes para todas las clases.</p>
 *
 * @name BaseClass
 * @namespace sys\core\abstracts
 * @package ECOMOD.
 * @subpackage CORE-ABSTRACTS.
 * @filesource BaseClass.php
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
 *       <li>La validación de los datos de entrada en el método mágico
 *       __set.</li>
 *       <li>.</li>
 *       <li>.</li>
 *       </ul>
 */
abstract class BaseClass {
  
  /**
   * Instancia de la clase Inspector.
   *
   * @var Inspector
   */
  private $inspector = NULL;
  
  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @param array $options
   *
   * @return void
   */
  public function __construct ( array $options = array () ) {
    
    $this->inspector = new Inspector ( $this );
    if ( \is_array ( $options ) || \is_object ( $options ) ) {
      
      foreach ( $options as $key => $value ) {
        
        $key = \ucfirst ( $key );
        $method = "set{$key}";
        $this->$method ( $value );
      }
    }
  }
  
  /**
   */
  public function __destruct () {
    
    // TODO - Insert your code here
  }
  
  /**
   * Método que sobreescribe el método mágico __call, este método se invoca cada
   * vez que se invoca un método inexistente en el objeto.
   *
   * @param string $name Nombre del metodo.
   * @param array $arguments Valor a asignar.
   *
   * @throws Exception
   * @throws MethodNotImplementedException
   *
   * @return \sys\core\abstracts\BaseClass|array|string|boolean|number|mixed|NULL
   */
  public function __call ( string $name, array $arguments ) {
    
    if ( empty ( $this->inspector ) ) {
      
      throw new Exception ( "Call parent::__construct!" );
    }
    if ( ( $called = $this->callGetterSetter ( $name ) ) !== FALSE ) {

      return $called;
      
    } elseif ( ( $called = $this->callGetterSetter ( $name, TRUE, $arguments ) ) !== FALSE ) {

      return $called;
      
    } else {
      
      throw new MethodNotImplementedException ( $name );
    }
  }
  
  /**
   * Este método mágico se llama cada vez que se hace referencia a una variable 
   * desde el objeto.
   * 
   * @param string $name Nombre de la propiedad.
   * 
   * @return mixed
   */
  public function __get ( string $name ) {
    
    $function = "get" . \ucfirst ( $name );
    return $this->$function ();
  }
  
  /**
   * Este método mágico se llama cada vez que se establece una variable en el 
   * objeto.
   * 
   * @param string $name Nombre de la propiedad.
   * @param mixed $value Valor a asignar a la propiedad.
   *
   * @return void
   */
  public function __set ( string $name, $value ) {

    $function = "set" . \ucfirst ( $name );
    return $this->$function ( $value );
  }
  
  /**
   *
   * @return \sys\libs\exceptions\PropertyException
   */
  protected function _getExceptionForProperty () {
    
    return new PropertyException ( "Invalid property" );
  }
  
  /**
   *
   * @param string $name Nombre de la propiedad.
   * @param bool $set Verdadero si se busca/valida el metodo de asignacion (set)
   *        de la propiedad, falso si se busca/valida el metodo de obtencion
   *        (get) de la propiedad.
   * @param array $arguments Arreglo de argumentos a ser asignados a la propiedad.
   * 
   * @throws PropertyException
   * @throws PropertyValueException
   * @throws ReadOnlyException
   * @throws WriteOnlyException
   *
   * @return \sys\core\abstracts\BaseClass|array|string|boolean|number|\StdClass|mixed|NULL
   */
  protected function callGetterSetter ( string $name, bool $set = false, array $arguments = array () ) {
    
    $pattern = $set ? "^set([a-zA-Z0-9]+)$" : "^get([a-zA-Z0-9]+)$";
    $matches = StringUtils::match ( $name, $pattern );
    if ( \sizeof ( $matches ) > 0 ) {
      
      $normalized = ClassUtils::normalizeProperty ( $matches [ 0 ] );
      $property = "{$normalized}";
      if ( \property_exists ( $this, $property ) ) {
        
        $meta = $this->inspector->getPropertyMeta ( $property );
        if ( $set ) {

          if ( empty ( $meta [ "@readwrite" ] ) && empty ( $meta [ "@write" ] ) ) {
            
            throw new ReadOnlyException ( $normalized );
          }
          if ( ( $argument = $this->inspector->setTypeValidation ( $meta, $arguments [ 0 ] ) ) !== FALSE ) {

            $this->$property = $argument;
            return $this;
            
          } else {

            throw new PropertyValueException ( $property );
          }
        } else {

          if ( empty ( $meta [ "@readwrite" ] ) && empty ( $meta [ "@read" ] ) ) {
            
            throw new WriteOnlyException ( $normalized );
          }
          if ( isset ( $this->$property ) ) {
  
            return $this->inspector->getTypeValidation ( $meta, $this->$property );
          }
          return null;
        }
      } else {
        
        throw new PropertyException ( $property );
      }
    }
    return false;
  }
}
