<?php
error_reporting ( E_ALL );
define ( "SITEROOT", \dirname ( __FILE__ ) . "/" );
// require_once 'indexes/index_classloader.php';
// require_once 'indexes/index_baseclass.php';
//require_once 'indexes/index_config.php';
//require_once 'indexes/index_cache.php';
//require_once 'indexes/index_router.php';
//require_once 'indexes/index_prueba_vista.php';
//require_once 'indexes/index_cookies.php';
require_once SITEROOT . 'indexes/index_request.php';

?>