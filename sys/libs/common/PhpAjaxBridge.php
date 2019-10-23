<?php

// PARA ENVIAR VIA AJAX EL ERROR SUCEDIDO
// https://developer.hyvor.com/php/ajax-request-handler-with-php

// PARA CACHEAR PETICIONES AJAX
// https://www.genbeta.com/desarrollo/cacheando-peticiones-ajax
// echo $_POST [ 'request_type' ];
// use sys\core\Request;

/**
 * Siempre que utilice peticiones vía Ajax debe definir desde el código
 * javascript el objeto X-Requested-With haciendo uso del método
 * setRequestHeader( etiqueta, valor ), de la forma
 * setRequestHeader ( 'X-Requested-With', 'XMLHttpRequest');
 */
echo $_SERVER [ 'REQUEST_METHOD' ];

if ( !empty ( $_SERVER [ 'HTTP_X_REQUESTED_WITH' ] ) && \strtolower ( $_SERVER [ 'HTTP_X_REQUESTED_WITH' ] ) == 'xmlhttprequest' ) {

  define ( "AJAXREQUEST", TRUE );
  define ( "SITEROOT", \substr ( \dirname ( __FILE__ ), 0, -15 ) );

  require_once SITEROOT . 'sys/core/ClassLoader.php';

  $classloader = new sys\core\ClassLoader ();
  $classloader->register ();

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
   */

  // use sys\libs\common\RequestUtils;

  /*
   * require_once 'sys/core/Request.php';
   * require_once 'sys/libs/common/RequestUtils.php';
   */

  // Request::isXmlHttpRequest ();
  // header ( 'Content-type: text/plain; charset=UTF-8' );
  // header('Content-type: application/json');
  header ( "Cache-Control: no-cache, must-revalidate" );
  header ( 'Content-type: text/plain' );
  // header ( 'Content-type: text/html' );

  $method = '$_' . $_SERVER [ 'REQUEST_METHOD' ];

  // echo $method [ 'oculto' ];
  // echo ${$method};

  echo "Hi. What did you expect? ;P";
  // echo file_get_contents ( "PhpAjxBridge2.php" );
  // exit ();
} else {

  echo "La peticion no es de tipo ajax";
}

?>