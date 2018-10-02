<?php
namespace sys\core;

use sys\core\abstracts\BaseClass;
use sys\api\router\exceptions\ControllerException;
use sys\api\router\exceptions\ActionException;

/**
 * <strong>Router</strong>
 *
 * Archivo creado el 26 de septiembre de 2018 a las 22:56:00 p.m.
 * <p>Clase que permite inferir las rutas a los recursos del sistema ECOMOD.</p>
 *
 * @name Router
 * @namespace sys\api\config
 * @package ECOMOD.
 * @subpackage ROUTER.
 * @filesource Router.php
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
 *       <li>https://diego.com.es/rendimiento-en-php.</li>
 *       <li>.</li>
 *       <li>.</li>
 *       </ul>
 */
class Router extends BaseClass {

  /**
   *
   * @readwrite
   * 
   * @var string
   */
  protected $url;

  /**
   *
   * @readwrite
   */
  protected $extension;

  /**
   *
   * @read
   */
  protected $controller;

  /**
   *
   * @read
   */
  protected $action;

  /**
   * Lista de rutas.
   * 
   * @var array
   */
  protected $routes = array ();
  
  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @param array $options
   *
   * @return void
   */
  public function __construct ( array $options = array () ) {
    
    parent::__construct ( $options );
  }

  /**
   * 
   * @param string $route
   * 
   * @return \sys\core\Router
   */
  public function add ( string $route ) {

    $this->routes [] = $route;
    return $this;
  }

  public function remove ( string $route ) {

    foreach ( $this->routes as $i => $stored ) {
      
      if ( $stored == $route ) {
        
        unset ( $this->routes [ $i ] );
      }
    }
    return $this;
  }

  public function getRoutes () {

    $list = array ();
    foreach ( $this->routes as $route ) {
      
      $list [ $route->pattern ] = \get_class ( $route );
    }
    return $list;
  }

  protected function pass ( $controller, $action, $parameters = array() ) {

    $name = \ucfirst ( $controller );
    
    $this->controller = $controller;
    $this->action = $action;
    
    Events::fire ( "framework.router.controller.before", array ( 
      $controller,$parameters
    ) );
    
    try {
      
      $instance = new $name ( array ( 
        "parameters" => $parameters
      ) );
      Registry::getInstance ()::set ( "controller", $instance );
      
    } catch ( \Exception $e ) {
      
      throw new ControllerException ( $name );
    }
    
    Events::fire ( "framework.router.controller.after", array ( 
      $controller,$parameters
    ) );
    
    if ( !\method_exists ( $instance, $action ) ) {
      
      $instance->willRenderLayoutView = false;
      $instance->willRenderActionView = false;
      
      throw new ActionException ( $action );
    }
    
    $inspector = new Inspector ( $instance );
    $methodMeta = $inspector->getMethodMeta ( $action );
    
    if ( ! empty ( $methodMeta [ "@protected" ] ) || ! empty ( $methodMeta [ "@private" ] ) ) {
      
      throw new ActionException ( $action );
    }
    
    $hooks = function ( $meta, $type ) use ( $inspector, $instance ) {
      if ( isset ( $meta [ $type ] ) ) {
        
        $run = array ();
        foreach ( $meta [ $type ] as $method ) {
          
          $hookMeta = $inspector->getMethodMeta ( $method );
          
          if ( \in_array ( $method, $run ) && ! empty ( $hookMeta [ "@once" ] ) ) {
            
            continue;
          }
          $instance->$method ();
          $run [] = $method;
        }
      }
    };
    
    Events::fire ( "framework.router.beforehooks.before", array ( 
      $action,$parameters
    ) );
    
    $hooks ( $methodMeta, "@before" );
    Events::fire ( "framework.router.beforehooks.after", array ( 
      $action,$parameters
    ) );
    Events::fire ( "framework.router.action.before", array ( 
      $action,$parameters
    ) );
    
    \call_user_func_array ( array ( 
      $instance,$action
    ), \is_array ( $parameters ) ? $parameters : array () );
    
    Events::fire ( "framework.router.action.after", array ( 
      $action,$parameters
    ) );
    Events::fire ( "framework.router.afterhooks.before", array ( 
      $action,$parameters
    ) );
    
    $hooks ( $methodMeta, "@after" );
    Events::fire ( "framework.router.afterhooks.after", array ( 
      $action,$parameters
    ) );
    
    // unset controller
    
    Registry::getInstance ()::erase ( "controller" );
  }

  public function dispatch () {

    $url = $this->url;
    $parameters = array ();
    $controller = "index";
    $action = "index";
    
    Events::fire ( "framework.router.dispatch.before", array ( 
      $url
    ) );
    
    foreach ( $this->routes as $route ) {
      
      $matches = $route->matches ( $url );
      if ( $matches ) {
        
        $controller = $route->controller;
        $action = $route->action;
        $parameters = $route->parameters;
        
        Events::fire ( "framework.router.dispatch.after", array ( 
          $url,$controller,$action,$parameters
        ) );
        $this->pass ( $controller, $action, $parameters );
        return;
      }
    }
    
    $parts = \explode ( "/", trim ( $url, "/" ) );
    
    if ( \sizeof ( $parts ) > 0 ) {
      $controller = $parts [ 0 ];
      
      if ( \sizeof ( $parts ) >= 2 ) {
        $action = $parts [ 1 ];
        $parameters = array_slice ( $parts, 2 );
      }
    }
    
    Events::fire ( "framework.router.dispatch.after", array ( 
      $url,$controller,$action,$parameters
    ) );
    $this->pass ( $controller, $action, $parameters );
  }
}
