<?php

// PARA ENVIAR VIA AJAX EL ERROR SUCEDIDO
// https://developer.hyvor.com/php/ajax-request-handler-with-php

// PARA CACHEAR PETICIONES AJAX
// https://www.genbeta.com/desarrollo/cacheando-peticiones-ajax

/**
 * Siempre que utilice peticiones vía Ajax debe definir desde el código
 * javascript el objeto X-Requested-With haciendo uso del método
 * setRequestHeader( etiqueta, valor ), de la forma
 * setRequestHeader ( 'X-Requested-With', 'XMLHttpRequest');
 */
use sys\core\Request;
use sys\core\http\Http;

define ( "AJAXREQUEST", TRUE );
define ( "SITEROOT", \substr ( \dirname ( __FILE__ ), 0, -15 ) );

require_once SITEROOT . 'sys/core/ClassLoader.php';

$classloader = new sys\core\ClassLoader ();
$classloader->register ();

$request = new Request ();

if ( $request->isXmlHttpRequest () ) {
  /**
   * Aquí se debe definir la estrategia para procesar la petición realizada vía
   * Ajax como por ejemplo, saber que tipo de cabeceras han de ser usadas.
   *
   * header('Content-type: application/json');
   * header ( 'Content-type: text/plain' );
   * header ( 'Content-type: text/html' );
   * header ( 'Content-type: text/xml' );
   * header ( "Cache-Control: no-cache, must-revalidate" );
   *
   * Atom
   * header('Content-Type: application/atom+xml');
   *
   * CSS
   * header('Content-Type: text/css');
   *
   * Javascript
   * header('Content-Type: text/javascript');
   *
   * JPEG Image
   * header('Content-Type: image/jpeg');
   *
   * JSON
   * header('Content-Type: application/json');
   *
   * PDF
   * header('Content-Type: application/pdf');
   *
   * RSS
   * header('Content-Type: application/rss+xml; charset=ISO-8859-1');
   *
   * Text (Plain)
   * header('Content-Type: text/plain');
   *
   * XML
   * header('Content-Type: text/xml');
   *
   *
   * 1-. Identificar los recursos, controladores, métodos solicitados.
   * 2-. Hacer entrega de la data recibida a los controladores respectivos.
   * 3-. Lanzar el controlador respuesta de acuerdo al tipo de content-type solicitado.
   * 4-. Enviar el resultado obtenido de acuerdo con el content-type solicitado.
   * 4.1-. procesar la solicitud.
   * 4.2-. Obtener el content-type.
   * 4.3-. Ajustar la respuesta de la solicitud al content-type.
   */

  // header ( 'Content-type: text/plain; charset=UTF-8' );
  // header('Content-type: application/json');
  // header ( "Cache-Control: no-cache, must-revalidate" );
  header ( 'Content-type: text/plain' );
  // header ( 'Content-type: text/html' );

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
       */
      echo "Hi. What did you expect? The request is GET ;P";
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
       */
      echo "Hi. What did you expect? The request is POST ;P";
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
       */
      break;
  }

  $headers = apache_request_headers ();
  switch ( $headers [ 'Content-Type' ] ) {

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

    case "application/json" :
      echo "El header es un json.";
      break;

    case "application/pdf" :
      ;
      break;

    case "application/rss+xml; charset=ISO-8859-1" :
      ;
      break;

    case "text/plain" :
      echo "El header es texto plano.";
      break;

    case "text/xml" :
      ;
      break;

    case "" :
      ;
      break;

    default :
      ;
      break;
  }
} else {

  /*
   * AQUÍ ESTO NO ES UN ERROR SOLO QUE A PARTIR DE AQUÍ SE EJECUTAN LAS
   * INSTRUCCIONES QUE NO VIENEN VÍA AJAX.
   */
  echo "La peticion no es de tipo ajax";
}


?>