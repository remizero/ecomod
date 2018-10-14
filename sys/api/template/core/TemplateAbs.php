<?php
namespace sys\api\template\core;

use sys\core\abstracts\BaseClass;
use sys\libs\common\StringUtils;
use sys\libs\exceptions\MethodNotImplementedException;

/**
 * <strong>TemplateAbs</strong>
 *
 * Archivo creado el 03 de octubre de 2018 a las 00:04:40 a.m.
 * <p>Clase que ejecutar acciones secundarias antes o después de las acciones
 * principales definidas para el sistema ECOMOD.</p>
 *
 * @name TemplateAbs
 * @namespace sys\api\config
 * @package ECOMOD.
 * @subpackage TEMPLATE.
 * @filesource TemplateAbs.php
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
abstract class TemplateAbs extends BaseClass {

  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @param array $options
   *
   * @return void
   */
  public function __construct ( array $options = array () ) {

    parent::__construct ( $options );
  }

  /**
   *
   * @param array $node
   *
   * @return array|NULL
   */
  protected function _handler ( array $node ) {

    if ( empty ( $node [ "delimiter" ] ) ) {
      
      return null;
    }
    if ( !empty ( $node [ "tag" ] ) ) {
      
      return $this->map [ $node [ "delimiter" ] ] [ "tags" ] [ $node [ "tag" ] ] [ "handler" ];
    }
    return $this->map [ $node [ "delimiter" ] ] [ "handler" ];
  }

  /**
   * 
   * @param array $node
   * @param mixed $content
   * 
   * @throws MethodNotImplementedException
   * 
   * @return mixed
   */
  public function handle ( array $node, $content ) {

    try {
      
      $handler = $this->_handler ( $node );
      return \call_user_func_array ( array ( 
        
          $this,
          $handler 
      ), array ( 
        
          $node,
          $content 
      ) );
    } catch ( \Exception $e ) {
      
      throw new MethodNotImplementedException ( $handler );
    }
  }

  /**
   *
   * @param string $source
   *
   * @return array|NULL
   */
  public function match ( string $source ) {

    $type = null;
    $delimiter = null;
    foreach ( $this->_map as $_delimiter => $_type ) {
      
      if ( !$delimiter || StringUtils::indexOf ( $source, $type [ "opener" ] ) == -1 ) {
        
        $delimiter = $_delimiter;
        $type = $_type;
      }
      $indexOf = StringUtils::indexOf ( $source, $_type [ "opener" ] );
      if ( $indexOf > -1 ) {
        
        if ( StringUtils::indexOf ( $source, $type [ "opener" ] ) > $indexOf ) {
          
          $delimiter = $_delimiter;
          $type = $_type;
        }
      }
    }
    if ( $type == null ) {
      
      return null;
    }
    return array ( 
      
        "type" => $type,
        "delimiter" => $delimiter 
    );
  }
}
