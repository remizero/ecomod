<?php

namespace sys\libs\common;

/**
 * <strong>LoadingTime</strong>
 *
 * Archivo creado el 17 de agosto de 2018 a las 23:05:37 p.m.
 * <p>Clase que permite calcular el tiempo de ejecución de un script.</p>
 *
 * @name LoadingTime
 * @namespace sys\libs\common
 * @package ECOMOD.
 * @subpackage LIBS-COMMON.
 * @filesource LoadingTime.php
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
 *       <li>https://desarrolloweb.com/articulos/stoper-php.html.</li>
 *       <li>.</li>
 *       <li>.</li>
 *       </ul>
 */
class LoadingTime {

  /**
   * Tiempo de finalización de la ejecución de un script.
   *
   * @var float
   */
  private $endTime;

  /**
   * Tiempo de ejecución de un script.
   *
   * @var float
   */
  private $loadingTime;

  /**
   * Tiempo de inicio de la ejecución de un script.
   *
   * @var float
   */
  private $startTime;

  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   */
  public function __construct () {

  }

  /**
   */
  function __destruct () {

  }

  /**
   * Calcula el tiempo de duración en segundos de la ejecución de un script.
   *
   * @return void
   */
  private function calculateExecutionTime () {

    $this->loadingTime = $this->endTime - $this->startTime;
  }

  /**
   * Permite obtener el tiempo en segundos al final de la ejecución de un script.
   *
   * @return void
   */
  public function end () {

    $this->endTime = $this->getTime ();
    $this->calculateExecutionTime ();
  }

  /**
   * Retorna el tiempo en segundos de la ejecución de un script.
   *
   * @return float
   */
  public function getLoadingTime () {

    return $this->loadingTime;
  }

  /**
   * Permite obtener el tiempo en segundos en un momento determinado.
   *
   * @return float
   */
  public function getTime () {

    list ( $useg, $seg ) = \explode ( " ", \microtime () );
    return ( ( float ) $useg + ( float ) $seg );
  }

  /**
   * Permite obtener el tiempo en segundos al inicio de la ejecución de un script.
   *
   * @return void
   */
  public function start () {

    $this->startTime = $this->getTime ();
  }
}

