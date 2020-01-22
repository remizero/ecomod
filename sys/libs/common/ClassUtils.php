<?php

namespace sys\libs\common;

/**
 * <strong>ClassUtils</strong>
 *
 * Archivo creado el 13 de septiembre de 2018 a las 22:14:00 p.m.
 * <p>Clase que permite realizar operaciones sobre las clases.</p>
 *
 *
 * @name ClassUtils
 * @namespace sys\libs\common
 * @package ECOMOD.
 * @subpackage LIBS-COMMON.
 * @filesource ClassUtils.php
 * @version 1.0
 * @since 1.0
 * @author Filiberto Zaá Avila ( remizero ) filizaa@gmail.com.
 * @copyright Todos los derechos reservados 2018.
 * @link http://www.ecosoftware.com.ve
 * @license http://www.ecosoftware.com.ve/licencia
 * @uses .php
 * @see .php
 * @todo Inclusión de traza informativa en el sistema de log de errores para
 *       indicar que clase no pudo se encontrada.
 */
abstract class ClassUtils {

  /**
   * Retorna el nombre de una clase sin su namespace.
   *
   * @param string $className Nombre de la clase.
   *
   * @return string
   */
  public static function getClassNameNoNamespace ( string $className ) {

    $splitClassName = \explode ( "\\", $className );
    return $splitClassName [ count ( $splitClassName ) - 1 ];
  }

  /**
   * Metodo que permite normalizar una propiedad.
   *
   * @param string $property Propiedad a normalizar.
   *
   * @return string
   */
  public static function normalizeProperty ( string $property ) {

    return \lcfirst ( $property );
  }
}
