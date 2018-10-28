<?php
namespace sys\core;

use sys\core\abstracts\BaseClass;
use sys\libs\common\StringUtils;
use sys\libs\common\RequestUtils;
use sys\libs\exceptions\ResponseException;
use sys\core\http\Http;
use sys\core\http\Url;

/**
 * <strong>Request</strong>
 *
 * Archivo creado el 03 de octubre de 2018 a las 00:52:55 a.m.
 * <p>Clase que ejecutar acciones secundarias antes o después de las acciones
 * principales definidas para el sistema ECOMOD.</p>
 *
 * @name Request
 * @namespace sys\api\config
 * @package ECOMOD.
 * @subpackage CORE.
 * @filesource Request.php
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
class Request extends BaseClass {

  /**
   *
   * @readwrite
   *
   * @var boolean
   */
  //public $ = "";
  
  /**
   *
   * @readwrite
   *
   * @var Url
   */
  public $url = "";

  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @param array $options
   *
   * @return void
   */
  public function __construct ( array $options = array () ) {

    parent::__construct ( $options );
    $this->agent = RequestUtils::server ( "HTTP_USER_AGENT", "Curl/PHP " . PHP_VERSION );
  }

  /**
   * Determina si la solicitud es una solicitud GET.
   * 
   * @return boolean
   */
  public function isGet () {
    
    return RequestUtils::requestMethod ( Http::GET );
  }
  
  /**
   * Determina si la solicitud es una solicitud HEAD.
   * 
   * @return boolean
   */
  public function isHead () {
    
    return RequestUtils::requestMethod ( Http::HEAD );
  }
  
  /**
   * Determina si la solicitud es una solicitud OPTION.
   *
   * @return boolean
   */
  public function isOption () {
    
    return RequestUtils::requestMethod ( Http::OPTIONS );
  }
  
  /**
   * Determina si la solicitud es una solicitud POST.
   * 
   * @return boolean
   */
  public function isPost () {
    
    return RequestUtils::requestMethod ( Http::POST );
  }
  
  /**
   * Determina si la solicitud es una solicitud POST.
   * 
   * @return boolean
   */
  public function isPut () {
    
    return RequestUtils::requestMethod ( Http::PUT );
  }

  /**
   * Método que indica si una petición o solicitud se ha realizado vía AJAX o no.
   * 
   * @return boolean
   */
  public function isXmlHttpRequest () {
    
    return !empty ( $_SERVER [ 'HTTP_X_REQUESTED_WITH' ] ) && \strtolower ( $_SERVER [ 'HTTP_X_REQUESTED_WITH' ] ) == 'xmlhttprequest';
  }
}
