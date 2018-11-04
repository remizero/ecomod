<?php
namespace sys\libs\common;

/**
 *
 * @author remizero
 */
class Json {

  // TODO - Insert your code here

  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   */
  public function __construct () {

    // TODO - Insert your code here
  }

  /**
   */
  function __destruct () {

    // TODO - Insert your code here
  }
  
  /**
   * Metodo que permite validar si una cadena dada es de tipo Json.
   * 
   * @param string $json Cadena Json a evaluar.
   * 
   * @return boolean
   */
  public static function isValid ( string $json ) {

    \json_decode ( $json );
    return ( \json_last_error () === JSON_ERROR_NONE ); 
  }
}

