<?php
// phpinfo ();
require_once SITEROOT . 'sys/core/ClassLoader.php';

$classloader = new sys\core\ClassLoader ();
$classloader->register ();

use sys\core\Registry;
use sys\core\Request;
use sys\libs\common\ErrorLog;
use sys\libs\types\Ip;

$registry = Registry::getInstance ();
new ErrorLog ();

// 2001:0db8:85a3:08d3:1319:8a2e:0370:7334

$request = new Request ();
$request->getUrl ();

$ipv6 = new Ip ( "2001:0db8:85a3:08d3:1319:8a2e:0370:7334" );
var_dump ( "Es una IPv6: " . $ipv6->isIPv6 () );
var_dump ( "Es una IPv4: " . $ipv6->isIPv4 () );
var_dump ( "Es una IP válida: " . $ipv6->isValid () );
var_dump ( "Es una IP privada: " . $ipv6->isPrivate () );
var_dump ( "Es una IP pública: " . $ipv6->isPublic () );
var_dump ( "Es una IP reservada: " . $ipv6->isReserved () );
var_dump ( "Representación entera de la IP: " . $ipv6->getIp () );
var_dump ( "Representación original de la IP: " . $ipv6->toString () );

$ipv4 = new Ip ( "196.5.4.44" );
var_dump ( "Es una IPv6: " . $ipv4->isIPv6 () );
var_dump ( "Es una IPv4: " . $ipv4->isIPv4 () );
var_dump ( "Es una IP válida: " . $ipv4->isValid () );
var_dump ( "Es una IP privada: " . $ipv4->isPrivate () );
var_dump ( "Es una IP pública: " . $ipv4->isPublic () );
var_dump ( "Es una IP reservada: " . $ipv4->isReserved () );
var_dump ( "Representación entera de la IP: " . $ipv4->getIp () );
var_dump ( "Representación original de la IP: " . $ipv4->toString () );

?>