<?php

namespace sys\core;

use sys\core\abstracts\BaseClass;
use sys\libs\exceptions\LayoutException;

/**
 * <strong>Controller</strong>
 *
 * Archivo creado el 02 de octubre de 2018 a las 23:19:15 p.m.
 * <p>Clase que ejecutar acciones secundarias antes o después de las acciones
 * principales definidas para el sistema ECOMOD.</p>
 *
 * @name Controller
 * @namespace sys\api\config
 * @package ECOMOD.
 * @subpackage CORE.
 * @filesource Controller.php
 * @version 1.0
 * @since 1.0
 * @author Filiberto Zaá Avila ( remizero ) filizaa@gmail.com.
 * @copyright Todos los derechos reservados 2018.
 * @link http://www.ecosoftware.com.ve
 * @license http://www.ecosoftware.com.ve/licencia
 * @uses .php
 * @see .php
 * @todo REVISAR https://diego.com.es/rendimiento-en-php.
 */
abstract class Controller extends BaseClass {

  /**
   * @read
   *
   * @var string
   */
  protected $name;

  /**
   * @readwrite
   *
   * @var array
   */
  protected $parameters;

  /**
   * @readwrite
   *
   * @var View
   */
  protected $layoutView;

  /**
   * @readwrite
   *
   * @var View
   */
  protected $actionView;

  /**
   * @readwrite
   *
   * @var boolean
   */
  protected $willRenderLayoutView = true;

  /**
   * @readwrite
   *
   * @var boolean
   */
  protected $willRenderActionView = true;

  /**
   * @readwrite
   *
   * @var string
   */
  protected $defaultPath = "application/views";

  /**
   * @readwrite
   *
   * @var string
   */
  protected $defaultLayout = "layouts/standard";

  /**
   * @readwrite
   *
   * @var string
   */
  protected $defaultExtension = "html";

  /**
   * @readwrite
   *
   * @var string
   */
  protected $defaultContentType = "text/html";

  public function __construct ( $options = array()) {

    parent::__construct ( $options );
    Events::fire ( "framework.controller.construct.before", array ( $this->name ) );
    if ( $this->willRenderLayoutView ) {

      $defaultPath = $this->defaultPath;
      $defaultLayout = $this->defaultLayout;
      $defaultExtension = $this->defaultExtension;
      $view = new View ( array ( "file" => APP_PATH . "/{$defaultPath}/{$defaultLayout}.{$defaultExtension}" ) );
      $this->layoutView = $view;
    }
    if ( $this->willRenderActionView ) {

      \var_dump ( "paso por la linea 134 la clase controller" );
      $router = Registry::getInstance ()->get ( "router" );
      \var_dump ( "paso por la linea 136 la clase controller" );
      $controller = $router->controller;
      \var_dump ( "paso por la linea 138 la clase controller" );
      $action = $router->action;
      \var_dump ( "paso por la linea 140 la clase controller" );
      $view = new View ( array ( "file" => APP_PATH . "/{$defaultPath}/{$controller}/{$action}.{$defaultExtension}" ) );
      $this->actionView = $view;
      \var_dump ( "paso por la linea 143 la clase controller" );
    }
    Events::fire ( "framework.controller.construct.after", array ( $this->name ) );
  }

  public function __destruct () {

    // Events::fire ( "framework.controller.destruct.before", array ( $this->name ) );
    // $this->render ();
    // Events::fire ( "framework.controller.destruct.after", array ( $this->name ) );
  }

  protected function getName () {

    if ( empty ( $this->name ) ) {

      $this->name = \get_class ( $this );
    }
    return $this->name;
  }

  public function render () {

    Events::fire ( "framework.controller.render.before", array ( $this->name ) );
    $defaultContentType = $this->defaultContentType;
    $results = null;
    $doAction = $this->willRenderActionView && $this->actionView;
    $doLayout = $this->willRenderLayoutView && $this->layoutView;
    try {

      if ( $doAction ) {

        $view = $this->actionView;
        $results = $view->render ();
        \var_dump ( $results );
        $this->actionView->template->implementation->set ( "action", $results );
        \var_dump ( "Pasó el actionView de ka ckase controller en la línea 178 -" );
      }
      if ( $doLayout ) {

        $view = $this->layoutView;
        $results = $view->render ();
        \var_dump ( $results );
        \header ( "Content-type: {$defaultContentType}" );
        echo $results;
      } else
        if ( $doAction ) {

          \header ( "Content-type: {$defaultContentType}" );
          echo $results;
        }
      $this->willRenderLayoutView = false;
      $this->willRenderActionView = false;
    } catch ( \Exception $e ) {

      throw new LayoutException ();
    }
    Events::fire ( "framework.controller.render.after", array ( $this->name ) );
  }
}
