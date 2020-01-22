<?php

namespace sys\libs\common;

/**
 * <strong>Ajax</strong>
 *
 * Archivo creado el 02 de enero de 2020 a las 18:29:00 p.m.
 * <p>Clase que facilita la interacción con objetos ajax para el sistema ECOMOD.</p>
 *
 * @name Ajax
 * @namespace sys\libs\common
 * @package ECOMOD.
 * @subpackage LIBS-COMMON..
 * @filesource Ajax.php
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
 * @todo
 */
abstract class Ajax {

  /**
   * Define el tipo de valor solicitado vía AJAX.
   *
   * @var string
   */
  const ARRAYBUFFER = "arraybuffer";

  /**
   * Define el tipo de valor solicitado vía AJAX.
   *
   * @var string
   */
  const BLOB = "blob";

  /**
   * Define el tipo de valor solicitado vía AJAX.
   *
   * @var string
   */
  const DOCUMENT = "document";

  /**
   * Define el tipo de valor solicitado vía AJAX.
   *
   * @var string
   */
  const EMPTY = "";

  /**
   * Define el tipo de valor solicitado vía AJAX.
   *
   * @var string
   */
  const JSON = "json";

  /**
   * Define el tipo de valor solicitado vía AJAX.
   *
   * @var string
   */
  const MSSTREAM = "ms-stream";

  /**
   * Define el tipo de valor solicitado vía AJAX.
   *
   * @var string
   */
  const TEXT = "text";

  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   */
  public function __construct () {

  }

  /**
   */
  function __destruct () {

  }
}


?>