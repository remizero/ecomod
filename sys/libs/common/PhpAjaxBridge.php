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
use sys\core\RequestHandler;
use sys\libs\common\ErrorLog;

define ( "AJAXREQUEST", TRUE );
define ( "SITEROOT", \substr ( \dirname ( __FILE__ ), 0, -15 ) );

require_once SITEROOT . 'sys/core/ClassLoader.php';

$classloader = new sys\core\ClassLoader ();
$classloader->register ();

new ErrorLog ();
$request = new Request ();

if ( $request->isXmlHttpRequest () ) {
  /**
   * Aquí se debe definir la estrategia para procesar la petición realizada vía
   * Ajax como por ejemplo, saber que tipo de cabeceras han de ser usadas.
   *
   * header ( "Cache-Control: no-cache, must-revalidate" );
   *
   * Atom
   * header('Content-Type: application/atom+xml');
   *
   * CSS
   * header('Content-Type: text/css');
   *
   * HTML
   * header('Content-Type: text/html');
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
   * 4-. Enviar el resultado obtenido de acuerdo con el content-Response solicitado.
   * 4.1-. procesar la solicitud.
   * 4.2-. Obtener el content-type.
   * 4.3-. Ajustar la respuesta de la solicitud al content-Response.
   */
  /**
   * Esto es para saber como vienen los datos desde el cliente y como han de ser
   * procesados.
   */
  // $request->getContentType ();

  /**
   * Esta forma permite obtener como el cliente espera que sean enviados los
   * datos solicitados.
   */
  // $request->getContentResponse ();



  /**
   * Lo mas probable es que solo utilice este método para realizar las
   * operaciones solicitadas y de ser así, no se necesitará hacer uso de
   * $request->getContentType (); o de $request->getContentResponse ();
   *
   * ARRAYBUFFER : "arraybuffer",
   * BLOB : "blob",
   * DOCUMENT : "document",
   * EMPTY : "",
   * JSON : "json",
   * MSSTREAM : "ms-stream",
   * TEXT : "text"
   */
  RequestHandler::processRequestMethod ( $request );

  // $file = fopen ( "archivo.txt", "a" );
  // foreach ( $_SERVER as $key => $value ) {

  // fwrite ( $file, $key . ': ' . $value . PHP_EOL );
  // }
  // fclose ( $file );

  // header ( 'content-type: image/png' );
  // $fn = "avatar.png";
  // header ( 'Content-Length: ' . filesize ( $fn ) );
  // print file_get_contents ( $fn );
} else {

  /**
   * AQUÍ ESTO NO ES UN ERROR SOLO QUE A PARTIR DE AQUÍ SE EJECUTAN LAS
   * INSTRUCCIONES QUE NO VIENEN VÍA AJAX.
   */
  echo "La peticion no es de tipo ajax";
}


?>