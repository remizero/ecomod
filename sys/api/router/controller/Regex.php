<?php
namespace sys\api\router\controller;

use sys\api\router\core\RouteAbs;

/**
 * <strong>Regex</strong>
 *
 * Archivo creado el 26 de septiembre de 2018 a las 00:20:00 a.m.
 * <p>Clase que permite inferir las rutas a los recursos del sistema ECOMOD.</p>
 *
 * @name Regex
 * @namespace sys\api\config
 * @package ECOMOD.
 * @subpackage ROUTER.
 * @filesource Regex.php
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
class Regex extends RouteAbs {

  /**
   *
   * @readwrite
   */
  protected $keys;

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
   * @param string $url
   * 
   * @return boolean
   */
  public function matches ( string $url ) {

    $pattern = $this->pattern;
    // check values
    \preg_match_all ( "#^{$pattern}$#", $url, $values );
    
    if ( \sizeof ( $values ) && \sizeof ( $values [ 0 ] ) && \sizeof ( $values [ 1 ] ) ) {
      
      // values found, modify parameters and return
      $derived = \array_combine ( $this->keys, $values [ 1 ] );
      $this->parameters = \array_merge ( $this->parameters, $derived );
      return true;
    }
    return false;
  }
}

