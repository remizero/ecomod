<?php
namespace sys\patterns\creational;

/**
 * <strong>FactoryMethod</strong>
 *
 * Archivo creado el 12 de septiembre de 2018 a las 23:36:30 p.m.
 * <p>Interface que permite definir y heredear la estructura del patrón de
 * diseño FACTORY METHOD, para la construcción de objetos de un subtipo de un 
 * tipo determinado.</p>
 *
 *
 * @name FactoryMethod
 * @namespace sys\patterns\creational
 * @package ECOMOD.
 * @subpackage PATTERNS.
 * @filesource FactoryMethod.php
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
 *       <li>.</li>
 *       <li>.</li>
 *       <li>.</li>
 *       </ul>
 */
interface FactoryMethod {
  
  /**
   * Función que permite crear clases de un tipo, determinado por la 
   * implementación en la clase concreta.
   * 
   * @param string $className Nombre de la clase a crear.
   * 
   * @return mixed
   */
  public static function create ( string $className );
}

