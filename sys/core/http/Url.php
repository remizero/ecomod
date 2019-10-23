<?php
namespace sys\core\http;

use sys\libs\exceptions\UrlException;

/**
 * <strong>Url</strong>
 *
 * Archivo creado el 24 de octubre de 2018 a las 10:43:50 a.m.
 * <p>Clase que facilita realizar operaciones sobre una URL.</p>
 *
 * @name Url
 * @namespace sys\api\config
 * @package ECOMOD.
 * @subpackage CORE.
 * @filesource Url.php
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
 *       <li>Al uso de de la bandera FILTER_FLAG_PATH_REQUIRED.</li>
 *       <li>Al uso de de la bandera FILTER_FLAG_QUERY_REQUIRED.</li>
 *       <li>.</li>
 *       </ul>
 */
class Url {

  /**
   * Componente fragmento opcional de una url precedido por un hash (#). El 
   * fragmento contiene un identificador de fragmento que proporciona dirección 
   * a un recurso secundario, como el encabezado de una sección en un artículo
   * identificado por el resto del URI.
   *
   * @readwrite
   *
   * @var string
   */
  private $fragment = "";

  /**
   * Dominio de la Url.
   * 
   * @readwrite
   *
   * @var string
   */
  private $host = "";

  /**
   * Contraseña de acceso de la URL indicada.
   * 
   * @readwrite
   *
   * @var string
   */
  private $pass = "";

  /**
   * Consiste en una secuencia de segmentos de ruta separados por una barra (/).
   *
   * @readwrite
   *
   * @var string
   */
  private $path = "";

  /**
   * Puerto de acceso de la URL indicada.
   * 
   * @readwrite
   *
   * @var integer
   */
  private $port = "";

  /**
   * Componente de consulta opcional precedido por un signo de interrogación (?).
   * Que contiene una cadena de consulta de datos no jerárquicos.
   *
   * @readwrite
   *
   * @var string
   */
  private $query = "";

  /**
   * Esquema(protocolo) de acceso de la URL indicada.
   * 
   * @readwrite
   *
   * @var string
   */
  private $scheme = "";

  /**
   * Usuario de acceso de la URL indicada.
   * 
   * @readwrite
   *
   * @var string
   */
  private $user = "";

  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @param string $url Url a analizar.
   *       
   * @return void
   */
  public function __construct ( string $url ) {

    $url = Url::validate ( $url );
    $parsedUrl = \parse_url ( $url );
    foreach ( $parsedUrl as $key => $value ) {

      $this->$key = $value;
    }
  }

  /**
   * Retorna el fragmento o sección interna del documento HTML de la URL dada.
   *
   * @return string
   */
  public function getFragment () {

    return $this->fragment;
  }

  /**
   * Retorna el dominio de la URL dada.
   *
   * @return string
   */
  public function getHost () {

    return $this->host;
  }

  /**
   * Retorna el password o contraseña de la URL dada.
   *
   * @return string
   */
  public function getPass () {

    return $this->pass;
  }

  /**
   * Retorn al ruta del recurso solicitado en la URL dada.
   *
   * @return string
   */
  public function getPath () {

    return $this->path;
  }

  /**
   * Retorna el puerto de la URL dada.
   *
   * @return integer
   */
  public function getPort () {

    return $this->port;
  }

  /**
   * Retorna los argumentos de consulta de la URL dada.
   *
   * @return string
   */
  public function getQuery () {

    return $this->query;
  }

  /**
   * Retorna el protocolo utilizado en la solicitud de la URL dada.
   *
   * @return string
   */
  public function getScheme () {

    return $this->scheme;
  }

  /**
   * Retorna el usuario de la URL dada.
   *
   * @return string
   */
  public function getUser () {

    return $this->user;
  }
  
  /**
   * Retorna un arreglo clave/valor a partir de la cadena query_string obtenida 
   * de la Url actual.
   *   
   * @return array
   */
  public function queryStringToQueryArray () {
    
    $queryArray = array ();
    \parse_str ( $this->query, $queryArray );
    return $queryArray;
  }
  
  /**
   * Método que permite limpiar una URL de caracteres inválidos.
   * 
   * @param string $url URL a limpiar.
   * 
   * @throws UrlException
   * 
   * @return string
   */
  public static function sanitize ( string $url ) {
    
    if ( ( $result = \filter_var ( $url, FILTER_SANITIZE_URL ) ) === FALSE ) {
      
      throw new UrlException ();
    }
    return $result;
  }

  /**
   * Retorna la Url original analizada.
   *
   * @return string
   */
  public function toString () {

    $scheme = !empty ( $this->scheme ) ? $this->scheme . '://' : '';
    $host = !empty ( $this->host ) ? $this->host : '';
    $port = !empty ( $this->port ) ? ':' . $this->port : '';
    $user = !empty ( $this->user ) ? $this->user : '';
    $pass = !empty ( $this->pass ) ? ':' . $this->pass : '';
    $pass = ( $user || $pass ) ? "$pass@" : '';
    $path = !empty ( $this->path ) ? $this->path : '';
    $query = !empty ( $this->query ) ? '?' . $this->query : '';
    $fragment = !empty ( $this->fragment ) ? '#' . $this->fragment : '';
    return $scheme . $user . $pass . $host . $port . $path . $query . $fragment;
  }
  
  /**
   * Método que permite validar una URL.
   * 
   * @param string $url URL a validar.
   * 
   * @throws UrlException
   * 
   * @return string
   */
  public static function validate ( string $url ) {
    
    $url = Url::sanitize ( $url );
    if ( ( $result = \filter_var ( $url, FILTER_VALIDATE_URL ) ) === FALSE ) {
      
      throw new UrlException ();
    }
    //$response = \filter_var ( $url, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED );
    //$response = \filter_var ( $url, FILTER_VALIDATE_URL, FILTER_FLAG_QUERY_REQUIRED );
    return $result;
  }
}
