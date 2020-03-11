<?php

namespace sys\core;

use sys\api\config\controller\Ini;
use sys\api\config\controller\Json;
use sys\api\config\controller\Php;
use sys\api\config\controller\Toml;
use sys\api\config\controller\Xml;
use sys\api\config\controller\Yaml;
use sys\api\config\core\ConfigAbs;
use sys\core\abstracts\BaseClass;
use sys\libs\exceptions\ArgumentException;

/**
 * <strong>Configuration</strong>
 *
 * Archivo creado el 11 de septiembre de 2018 a las 00:12:40 a.m.
 * <p>Clase tipo Factory que permite crear una serie de objetos controladores
 * para manipular distintos tipos de archivos y estructuras de datos para la
 * configuracion del sistema ECOMOD.</p>
 *
 * @name Configuration
 * @namespace sys\core
 * @package ECOMOD.
 * @subpackage CORE.
 * @filesource Configuration.php
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
class Configuration extends BaseClass {

  /**
   * @readwrite
   */
  protected $_type;

  /**
   * @readwrite
   */
  protected $_options;

  /**
   * @param array $options
   *
   * @return void
   */
  public function __construct ( array $options = array ()) {

    parent::__construct ( $options );
  }

  /**
   */
  function __destruct () {

  }

  public function initialize () {

    Events::fire ( "framework.configuration.initialize.before", array ( $this->type, $this->options ) );

    if ( !$this->type ) {

      throw new ArgumentException ();
    }

    Events::fire ( "framework.configuration.initialize.after", array ( $this->type, $this->options ) );

    switch ( $this->type ) {

      case ConfigAbs::INI :

        return new Ini ( $this->options );
        break;

      case ConfigAbs::JSON :

        return new Json ( $this->options );
        break;

      case ConfigAbs::PHP :

        return new Php ( $this->options );
        break;

      case ConfigAbs::TOML :

        return new Toml ( $this->options );
        break;

      case ConfigAbs::XML :

        return new Xml ( $this->options );
        break;

      case ConfigAbs::YAML :

        return new Yaml ( $this->options );
        break;

      default :

        throw new ArgumentException ();
        break;
    }
  }
}

