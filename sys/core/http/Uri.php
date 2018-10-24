<?php
namespace sys\core\http;

/**
 * <strong>Uri</strong>
 *
 * Archivo creado el 24 de octubre de 2018 a las 11:06:15 a.m.
 * <p>.</p>
 *
 * @name Uri
 * @namespace sys\api\config
 * @package ECOMOD.
 * @subpackage CORE.
 * @filesource Uri.php
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
class Uri {
  
  /**
   * 
   * @readwrite
   * 
   * @var string
   */
  private $url = "";
  
  /**
   *
   * @readwrite
   *
   * @var string
   */
  private $urn = "";

  // TODO - Insert your code here
  
  /**
   */
  public function __construct () {

    // TODO - Insert your code here
  }
  
  public function get () {
    
    return $this->url . $this->urn;
  }
}

