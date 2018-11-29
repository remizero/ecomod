<?php

// PARA ENVIAR VIA AJAX EL ERROR SUCEDIDO
// https://developer.hyvor.com/php/ajax-request-handler-with-php

//use sys\core\Request;

/*if ( !empty ( $_SERVER [ 'HTTP_X_REQUESTED_WITH' ] ) && \strtolower ( $_SERVER [ 'HTTP_X_REQUESTED_WITH' ] ) == 'xmlhttprequest' ) {

  define ( "AJAXREQUEST", TRUE );
  define ( "SITEROOT", \substr ( \dirname ( __FILE__ ), 0, -15 ) );

  require_once SITEROOT . 'sys/core/ClassLoader.php';

  $classloader = new sys\core\ClassLoader ();
  $classloader->register ();

  //use sys\libs\common\RequestUtils;

  /*require_once 'sys/core/Request.php';
   require_once 'sys/libs/common/RequestUtils.php';*/
  
  //Request::isXmlHttpRequest ();
  //header ( 'Content-type: text/plain; charset=UTF-8' );
  //header('Content-type: application/json');
  /*header ( "Cache-Control: no-cache, must-revalidate" );
  header ( 'Content-type: text/plain' );*/
  //header ( 'Content-type: text/html' );
  echo "Hi. What did you expect? ;P";
  //echo file_get_contents ( "PhpAjxBridge2.php" );
  /*exit ();
  
} else {
  
  echo "La peticion no es de tipo ajax";
}*/

?>