<?php
namespace sys\core\http;

use sys\libs\common\ArrayUtils;

/**
 * <strong>Files</strong>
 *
 * Archivo creado el 01 de noviembre de 2018 a las 10:39:40 a.m.
 * <p>Clase que facilita realizar operaciones sobre la global $_FILES.</p>
 *
 * @name Files
 * @namespace sys\api\config
 * @package ECOMOD.
 * @subpackage CORE.
 * @filesource Files.php
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
class Files {

  /**
   * Arreglo con todos los archivos a cargar.
   *
   * @var array [ File ]
   */
  private $files = array ();

  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *       
   * @return void
   */
  public function __construct () {

    $filesArray = Array ( 
      
        "download" => Array ( 
          
            "name" => Array ( 
              
                "file1" => "MyFile.txt",
                "file2" => "MyFile.jpg" 
            ),
            "type" => Array ( 
              
                "file1" => "text/plain",
                "file2" => "image/jpeg" 
            ),
            "tmp_name" => Array ( 
              
                "file1" => "/tmp/php/php1h4j1o",
                "file2" => "/tmp/php/php6hst32" 
            ),
            "error" => Array ( 
              
                "file1" => "UPLOAD_ERR_OK",
                "file2" => "UPLOAD_ERR_OK" 
            ),
            "size" => Array ( 
              
                "file1" => "123",
                "file2" => "98174" 
            ) 
        ) 
    );
    $keyFilesArray = NULL;
    if ( !\function_exists ( 'array_key_first' ) ) {
      
      //$keyFilesArray = ArrayUtils::firstKey ( $_FILES );
      $keyFilesArray = ArrayUtils::firstKey ( $filesArray );
      
    } else {
      
      //$keyFilesArray = \array_key_first ( $_FILES );
      $keyFilesArray = \array_key_first ( $filesArray );
    }
    $uploadedFiles = ArrayUtils::uploadArray ( $filesArray [ $keyFilesArray ] );
    foreach ( $uploadedFiles as $key => $value ) {
      
      $this->files [ $key ] = new File ( $value );
    }
  }

  /**
   * Retorna un arreglo con todos los archivos a cargar.
   * 
   * @return array [ File ]
   */
  public function getFiles () {

    return $this->files;
  }

  /**
   * Retorna el archivo indicado.
   *
   * @return File|NULL
   */
  public function getFile ( string $file ) {

    return ( isset ( $this->files [ $file ] ) ) ? $this->files [ $file ] : null;
  }
}

