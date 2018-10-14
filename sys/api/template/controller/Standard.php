<?php
namespace sys\api\template\controller;

use sys\api\template\core\TemplateAbs;

/**
 * <strong>Standard</strong>
 *
 * Archivo creado el 03 de octubre de 2018 a las 00:16:10 a.m.
 * <p>Clase que ejecutar acciones secundarias antes o después de las acciones
 * principales definidas para el sistema ECOMOD.</p>
 *
 * @name Standard
 * @namespace sys\api\template\controller
 * @package ECOMOD.
 * @subpackage TEMPLATE.
 * @filesource Standard.php
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
class Standard extends TemplateAbs {

  protected $map = array ( 
    "echo" => array ( 
      "opener" => "{echo","closer" => "}","handler" => "_echo"
    ),"script" => array ( 
      "opener" => "{script","closer" => "}","handler" => "_script"
    ),"statement" => array ( 
      "opener" => "{","closer" => "}","tags" => array ( 
        "foreach" => array ( 
          "isolated" => false,"arguments" => "{element} in {object}","handler" => "_each"
        ),"for" => array ( 
          "isolated" => false,"arguments" => "{element} in {object}","handler" => "_for"
        ),"if" => array ( 
          "isolated" => false,"arguments" => null,"handler" => "_if"
        ),"elseif" => array ( 
          "isolated" => true,"arguments" => null,"handler" => "_elif"
        ),"else" => array ( 
          "isolated" => true,"arguments" => null,"handler" => "_else"
        ),"macro" => array ( 
          "isolated" => false,"arguments" => "{name}({args})","handler" => "_macro"
        ),"literal" => array ( 
          "isolated" => false,"arguments" => null,"handler" => "_literal"
        )
      )
    )
  );

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

  protected function _echo ( $tree, $content ) {

    $raw = $this->_script ( $tree, $content );
    return "\$_text[] = {$raw}";
  }

  protected function _script ( $tree, $content ) {

    $raw = ! empty ( $tree [ "raw" ] ) ? $tree [ "raw" ] : "";
    return "{$raw};";
  }

  protected function _each ( $tree, $content ) {

    $object = $tree [ "arguments" ] [ "object" ];
    $element = $tree [ "arguments" ] [ "element" ];
    return $this->_loop ( $tree, "foreach ({$object} as {$element}_i => {$element}) {
                    {$content}
                }" );
  }

  protected function _for ( $tree, $content ) {

    $object = $tree [ "arguments" ] [ "object" ];
    $element = $tree [ "arguments" ] [ "element" ];
    return $this->_loop ( $tree, "for ({$element}_i = 0; {$element}_i < sizeof({$object}); {$element}_i++) {
                    {$element} = {$object}[{$element}_i];
                    {$content}
                }" );
  }

  protected function _if ( $tree, $content ) {

    $raw = $tree [ "raw" ];
    return "if ({$raw}) {{$content}}";
  }

  protected function _elif ( $tree, $content ) {

    $raw = $tree [ "raw" ];
    return "elseif ({$raw}) {{$content}}";
  }

  protected function _else ( $tree, $content ) {

    return "else {{$content}}";
  }

  protected function _macro ( $tree, $content ) {

    $arguments = $tree [ "arguments" ];
    $name = $arguments [ "name" ];
    $args = $arguments [ "args" ];
    return "function {$name}({$args}) {
                \$_text = array();
                {$content}
                return implode(\$_text);
            }";
  }

  protected function _literal ( $tree, $content ) {

    $source = \addslashes ( $tree [ "source" ] );
    return "\$_text[] = \"{$source}\";";
  }

  protected function _loop ( $tree, $inner ) {

    $number = $tree [ "number" ];
    $object = $tree [ "arguments" ] [ "object" ];
    $children = $tree [ "parent" ] [ "children" ];
    if ( ! empty ( $children [ $number + 1 ] [ "tag" ] ) && $children [ $number + 1 ] [ "tag" ] == "else" ) {
      
      return "if (is_array({$object}) && sizeof({$object}) > 0) {{$inner}}";
    }
    return $inner;
  }
}
