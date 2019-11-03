<?php

namespace sys\libs\common;

/**
 * <strong>RequestUtils</strong>
 *
 * Archivo creado el 03 de octubre de 2018 a las 00:03:45 a.m.
 * <p>Clase abstracta que facilita la obtención de los valores de las variables,
 * campos y/o atributos de un formulario, URL o recurso contenidas en las
 * globales $_COOKIE, $_FILES, $_GET, $_POST, $_REQUEST, $_SESSION y $_SERVER.</p>
 *
 * @name RequestUtils
 * @namespace sys\libs\common
 * @package ECOMOD.
 * @subpackage LIBS-COMMON.
 * @filesource RequestUtils.php
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
abstract class RequestUtils {

  /**
   * Permite obtener el valor de una variable.
   *
   * @param string $key Indice de la cookie a solicitar.
   * @param string $default Valor por omisión en caso de no existir.
   *
   * @return string
   */
  public static function cookie ( string $key, string $default = "") {

    if ( isset ( $_COOKIE [ $key ] ) ) {

      if ( !empty ( $_COOKIE [ $key ] ) ) {

        return $_COOKIE [ $key ];
      }
    }
    return $default;
  }

  /**
   * Permite obtener el valor de una variable.
   *
   * @param string $key Indice de la variable files a solicitar.
   * @param string $default Valor por omisión en caso de no existir.
   *
   * @return string
   */
  public static function files ( string $key, string $default = "") {

    if ( isset ( $_FILES [ $key ] ) ) {

      if ( !empty ( $_FILES [ $key ] ) ) {

        return $_FILES [ $key ];
      }
    }
    return $default;
  }

  /**
   * Permite obtener el valor de una variable.
   *
   * @param string $key Indice de la variable get a solicitar.
   * @param string $default Valor por omisión en caso de no existir.
   *
   * @return string
   */
  public static function get ( string $key, string $default = "") {

    if ( isset ( $_GET [ $key ] ) ) {

      if ( !empty ( $_GET [ $key ] ) ) {

        return $_GET [ $key ];
      }
    }
    return $default;
  }

  /**
   * Permite obtener el valor de una variable.
   *
   * @param string $key Indice de la variable post a solicitar.
   * @param string $default Valor por omisión en caso de no existir.
   *
   * @return string
   */
  public static function post ( string $key, string $default = "") {

    if ( isset ( $_POST [ $key ] ) ) {

      if ( !empty ( $_POST [ $key ] ) ) {

        return $_POST [ $key ];
      }
    }
    return $default;
  }

  /**
   * Permite obtener el valor de una variable.
   *
   * @param string $key Indice de la variable request a solicitar.
   * @param string $default Valor por omisión en caso de no existir.
   *
   * @deprecated
   *
   * @return string
   */
  public static function request ( string $key, string $default = "") {

    if ( isset ( $_REQUEST [ $key ] ) ) {

      if ( !empty ( $_REQUEST [ $key ] ) ) {

        return $_REQUEST [ $key ];
      }
    }
    return $default;
  }

  /**
   * Permite obtener cual es el método de la petición Request.
   *
   * @return string
   */
  public static function requestMethod () {

    return ( $_SERVER [ "REQUEST_METHOD" ] );
  }

  /**
   * Permite comparar cual es el método solicitado a traves de la petición Request.
   *
   * @param string $method Nombre del método a comparar.
   *
   * @return boolean
   */
  public static function isRequestMethod ( string $method ) {

    return ( $_SERVER [ "REQUEST_METHOD" ] == $method );
  }

  /**
   * Permite obtener el valor de una variable.
   *
   * @param string $key Indice de la variable server a solicitar.
   * @param string $default Valor por omisión en caso de no existir.
   *
   * @return string
   */
  public static function server ( string $key, string $default = "") {

    if ( isset ( $_SERVER [ $key ] ) ) {

      if ( !empty ( $_SERVER [ $key ] ) ) {

        return $_SERVER [ $key ];
      }
    }
    return $default;
  }

  /**
   * Permite obtener el valor de una variable.
   *
   * @param string $key Indice de la sesión a solicitar.
   * @param string $default Valor por omisión en caso de no existir.
   *
   * @return string
   */
  public static function session ( string $key, string $default = "") {

    if ( isset ( $_SESSION [ $key ] ) ) {

      if ( !empty ( $_SESSION [ $key ] ) ) {

        return $_SESSION [ $key ];
      }
    }
    return $default;
  }
}
