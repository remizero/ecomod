<?php

namespace sys\core;

use sys\core\abstracts\BaseClass;
use sys\core\http\Http;
use sys\libs\common\Ajax;
use sys\libs\common\ErrorLog;
use sys\libs\common\Json;
use sys\libs\exceptions\ErrorHandlerException;

/**
 * <strong>RequestHandler</strong>
 *
 * Archivo creado el 16 de octubre de 2019 a las 21:27:55 p.m.
 * <p>Clase que permite realizar acciones referentes a una solicitud ( Request )
 * capturando los recursos, métodos, clases y parámetros de una solicitud
 * definidas para ser usadas por el sistema ECOMOD.</p>
 *
 * @name RequestHandler
 * @namespace sys\core
 * @package ECOMOD.
 * @subpackage CORE.
 * @filesource RequestHandler.php
 * @version 1.0
 * @since 1.0
 * @author Filiberto Zaá Avila ( remizero ) filizaa@gmail.com.
 * @copyright Todos los derechos reservados 2019.
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
 *       <li>http://mialtoweb.es/como-saber-que-navegador-utiliza-un-usario-en-php/.</li>
 *       <li>https://gist.github.com/digitalhydra/7949601.</li>
 *       <li>https://artisansweb.net/detect-browser-php-javascript/.</li>
 *       <li>.</li>
 *       <li>.</li>
 *       <li>.</li>
 *       <li>.</li>
 *       </ul>
 */
class RequestHandler extends BaseClass {

  /**
   * Acción a ejecutar según la solicitud al servidor.
   *
   * @readwrite
   *
   * @var string
   */
  private $action = "";

  /**
   * Controlador a ejecutar según la solicitud al servidor.
   *
   * @readwrite
   *
   * @var string
   */
  private $controller = "";

  /**
   * Método a ejecutar según la solicitud al servidor.
   *
   * @readwrite
   *
   * @var string
   */
  private $method = "";

  /**
   * Módulo
   *
   * @readwrite
   *
   * @var string
   */
  private $module = "";

  /**
   * Parámetros a asignar al método solicitado según la solicitud al servidor.
   *
   * @readwrite
   *
   * @var string
   */
  private $params = "";

  /**
   * @param array $options
   *
   * @return void
   */
  public function __construct ( array $options ) {

    parent::__construct ( $options );
  }

  /**
   */
  function __destruct () {

  }

  public static function processRequestMethod ( Request $request ) {

    switch ( $request->requestMethod () ) {

      case Http::DELETE :

        /**
         * Que hacer en este caso?
         */
        echo "Hi. What did you expect? The request is DELETE ;P";
        break;

      case Http::GET :

        /**
         * Que hacer en este caso?
         * 1-.
         * Capturar
         */
        echo "Hi. What did you expect? The request is GET ;P";
        self::processData ( $request );
        break;

      case Http::HEAD :

        /**
         * Que hacer en este caso?
         */
        echo "Hi. What did you expect? The request is HEAD ;P";
        break;

      case Http::OPTIONS :

        /**
         * Que hacer en este caso?
         */
        echo "Hi. What did you expect? The request is OPTION ;P";
        break;

      case Http::POST :

        /**
         * Que hacer en este caso?
         * AQUÍ SE DEBE OBTENER EL CONTROLADOR, LOS PARÁMETROS, LA CLASE Y/O
         * EL RECURSO SOLICITADO
         */
        // echo "Hi. What did you expect? The request is POST ;P";
        self::processData ( $request );
        break;

      case Http::PUT :

        /**
         * Que hacer en este caso?
         */
        echo "Hi. What did you expect? The request is PUT ;P";
        break;

      case Http::TRACE :

        /**
         * Que hacer en este caso?
         */
        echo "Hi. What did you expect? The request is TRACE ;P";
        break;

      default :

        /**
         * Que hacer en este caso?
         * Enviar un error indicando que la solicitud es una solicitud no permitida.
         */
        break;
    }
  }

  public static function processData ( Request $request ) {

    $file = fopen ( "archivo.txt", "a" );
    fwrite ( $file, "EL REQUEST DATA ES: " . $request->getRequestData () . PHP_EOL );
    fclose ( $file );
    switch ( $request->getContentResponse () ) {
      // switch ( $request->getRequestData () ) {

      case "application/atom+xml" :
        ;
        break;

      case "text/css" :
        ;
        break;

      case "text/javascript" :
        ;
        break;

      case "image/jpeg" :
        ;
        break;

      // case "application/json" :
      case Ajax::JSON :
        // echo "El header es un json.";
        try {

          $array = array ( "nombre" => "Scarlet", "apellido" => "johansson" );
          echo Json::convertTo ( $array );
        } catch ( ErrorHandlerException $ehe ) {

          ErrorLog::exception ( $ehe );
        }
        break;

      case "application/pdf" :
        ;
        break;

      case "application/rss+xml; charset=ISO-8859-1" :
        ;
        break;

      case "text/plain" :
        // echo "El header es texto plano.";
        break;

      case "text/xml" :
        ;
        break;

      case "" :
        ;
        break;

      default :

        $file = fopen ( "archivo.txt", "a" );
        fwrite ( $file, "ENTRÓ POR EL DEFAULT: " . PHP_EOL );
        fclose ( $file );
        break;
    }
  }
}
?>