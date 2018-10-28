<?php

setcookie ( "miCookie", "ElValorDeMiCookie", time () + 10000, "/", "localhost", FALSE, FALSE );

$cookie = json_decode ( $_COOKIE [ "miCookie" ] );

$expiry = time() + 12345;
$data = (object) array( "value1" => "just for fun", "value2" => "i'll save whatever I want here" );
$cookieData = (object) array( "data" => $data, "expiry" => $expiry );
setcookie( "cookiename", json_encode( $cookieData ), $expiry );

$cookie = json_decode ( $_COOKIE [ "cookiename" ] );

var_dump ( $_COOKIE );
var_dump ( $cookie );

?>