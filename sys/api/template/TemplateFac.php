<?php
namespace sys\api\template;

use sys\api\template\controller\Extended;
use sys\api\template\controller\Smarty;
use sys\api\template\controller\Standard;
use sys\api\template\controller\Twig;
use sys\api\template\core\TemplateAbs;
use sys\libs\exceptions\ArgumentException;
use sys\patterns\creational\FactoryMethod;

/**
 * <strong>TemplateFac</strong>
 *
 * Archivo creado el 03 de octubre de 2018 a las 00:45:10 a.m.
 * <p>Clase que ejecutar acciones secundarias antes o después de las acciones
 * principales definidas para el sistema ECOMOD.</p>
 *
 * @name TemplateFac
 * @namespace sys\api\config
 * @package ECOMOD.
 * @subpackage TEMPLATE.
 * @filesource TemplateFac.php
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
class TemplateFac implements FactoryMethod {
  
  /**
   * Constante que define el tipo de controlador Ini.
   *
   * @var string
   */
  const STANDARD = 'standard';
  
  /**
   * Constante que define el tipo de controlador Json.
   *
   * @var string
   */
  const EXTENDED = 'extended';
  
  /**
   * Constante que define el tipo de controlador Php.
   *
   * @var string
   */
  const SMARTY = 'smarty';
  
  /**
   * Constante que define el tipo de controlador Toml.
   *
   * @var string
   */
  const TWIG = 'twig';
  
  /**
   * Función que permite crear clases de un tipo, determinado por la
   * implementación en la clase concreta.
   *
   * @param string $className Nombre de la clase a crear.
   *
   * @throws ArgumentException
   *
   * @return TemplateAbs
   *
   * @see \sys\patterns\creational\FactoryMethod::create()
   */
  public static function create ( string $className ) {
    
    switch ( \strtolower ( $className ) ) {
      
      case self::EXTENDED :
        
        return new Extended ();
        break;
        
      case self::SMARTY :
        
        return new Smarty ();
        break;
        
      case self::STANDARD :
        
        return new Standard ();
        break;
        
      case self::TWIG :
        
        return new Twig ();
        break;
        
      default:
        
        throw new ArgumentException ();
        break;
    }
  }
}

