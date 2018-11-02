<?php
namespace sys\core\http;

/**
 * <strong>File</strong>
 *
 * Archivo creado el 01 de noviembre de 2018 a las 10:37:45 a.m.
 * <p>Clase que facilita realizar operaciones sobre un archivo de la global
 * $_FILES.</p>
 *
 * @name File
 * @namespace sys\api\config
 * @package ECOMOD.
 * @subpackage CORE.
 * @filesource File.php
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
class File {

  /**
   * Nombre del archivo a cargar.
   *
   * @readwrite
   *
   * @var string
   */
  private $name;

  /**
   * Tipo del archivo a cargar.
   *
   * @readwrite
   *
   * @var string
   */
  private $type;

  /**
   * Nombre temporal del archivo a cargar.
   *
   * @readwrite
   *
   * @var string
   */
  private $tmp_name;

  /**
   * Error del archivo a cargar.
   *
   * @readwrite
   *
   * @var string
   */
  private $error;

  /**
   * Tamaño del archivo a cargar.
   *
   * @readwrite
   *
   * @var int
   */
  private $size;
  
  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @param array $file Data del archivo a cargar.
   *
   * @return void
   */
  public function __construct ( array $file ) {

    foreach ( $file as $key => $value ) {
      
      $this->$key = $value;
    }
  }

  /**
   * Retorna el nombre del archivo a cargar.
   * 
   * @return string
   */
  public function getName () {

    return $this->name;
  }

  /**
   * Retorna el tipo del archivo a cargar.
   * 
   * @return string
   */
  public function getType () {

    return $this->type;
  }

  /**
   * Retorna el nombre temporal del archivo a cargar.
   * 
   * @return string
   */
  public function getTmp_name () {

    return $this->tmp_name;
  }

  /**
   * Retorna el error del archivo a cargar.
   * 
   * @return string
   */
  public function getError () {

    return $this->error;
  }

  /**
   * Retorna el tamaño del archivo a cargar.
   * 
   * @return int
   */
  public function getSize () {

    return $this->size;
  }
}
