<?php
declare(strict_types = 1);
error_reporting ( E_ALL );
define ( "SITEROOT", \dirname ( __FILE__ ) . "/" );

/*
 * Se incluye la clase ClassLoader y se crea la instancia que permitirá cargar
 * todas las clases del sistema.
 */
require_once SITEROOT . 'sys/core/ClassLoader.php';
$classloader = new sys\core\ClassLoader ();
$classloader->register ();

/*
 * Esta será la sección para colocar todas las inclusiones de clases requeridas
 * para el procesamiento, ubicación y visualización de la solicitud recibida.
 */
use sys\core\Registry;
use sys\libs\common\ErrorLog;

/*
 * Se crea la instancia de la clase Registry para almacenar los objetos que
 * serán utilizados por el sistema.
 */
$registry = Registry::getInstance ();

/*
 * Se crea la instancia de la clase ErrorLog para el manejo de errores mediante
 * archivo de errores para su posterior visualización y permitir la corrección
 * de errores de forma mas efectiva y rápida.
 */
new ErrorLog ();






// require_once 'indexes/index_classloader.php';
// require_once 'indexes/index_baseclass.php';
// require_once 'indexes/index_config.php';
// require_once 'indexes/index_cache.php';
// require_once 'indexes/index_router.php';
// require_once 'indexes/index_prueba_vista.php';
// require_once 'indexes/index_cookies.php';
// require_once SITEROOT . 'indexes/index_ip.php';
require_once SITEROOT . 'indexes/index_request.php';

?>
