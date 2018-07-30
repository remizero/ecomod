<?php

namespace sys\api\ecomca;

use sys\api\ecomca\core\ResultActions;
use sys\api\ecomca\core\ResultScan;
use sys\api\ecomca\exceptions\ScanDirException;
use sys\core\abstractions\ApiAbs;
use sys\libs\common\Json;
use sys\libs\common\Normalize;
use sys\api\ecomca\core\MaliciousCodeDefinition;

/**
 * <strong>EcoMca</strong>
 *
 * Archivo creado el 30 de abr. de 2016 a las 2:45:37 p. m.
 * <p>Descripción de la clase.</p>
 *
 * @name EcoMca
 * @namespace sys\api\ecomca
 * @package ECOMOD.
 * @subpackage ECOMCA.
 * @filesource EcoMca.php
 * @version 1.0
 * @since 1.0
 * @author Filiberto Zaá Avila ( remizero ) filizaa@gmail.com.
 * @copyright Todos los derechos reservados 2016.
 * @link http://www.ecosoftware.com.ve
 * @license http://www.ecosoftware.com.ve/licencia
 * @uses <ul>
 *       <li>.php</li>
 *       </ul>
 * @see .php
 * @todo <p>En futuras versiones estarán disponibles los métodos para dar
 *       soporte a:</p>
 *       <ul>
 *       <li>Corregir el problema del envío del mensaje de alerta cuando la
 *       opción "send" del archivo config.xml de la api ecomca estar configurada
 *       a 1.</li>
 *       <li>Corregir o agregar las posibles opciones de código potencialmente
 *       peligroso a escanear en el método isClean ().</li>
 *       <li>.</li>
 *       </ul>
 */
class EcoMca extends ApiAbs {

  /**
   * Separador de directorio o rutas, correspondiente al S.O.
   * sobre el cual se
   * esté ejecutando el sistema.
   *
   * @access private
   * @var string
   */
  private $delimiter = '';

  /**
   * Contiene la fecha y hora de finalización del proceso de acciones a los
   * archivos infectados.
   *
   * @access private
   * @var string
   */
  private $endTimeAction;

  /**
   * Contiene la fecha y hora de finalización del proceso de escaneo de
   * archivos.
   *
   * @access private
   * @var string
   */
  private $endTimeScan;

  /**
   * Arreglo con todos los archivos contenidos en el directorio indicado, o
   * conjunto de archivos dado.
   *
   * @access private
   * @var array [ file ]
   */
  private $filesToScan = array ();

  /**
   * Arreglo con todos los archivos infectados o con código potencialmente
   * peligroso en el directorio indicado, o conjunto de archivos dado.
   *
   * @access private
   * @var array [ file ]
   */
  private $infectedFiles = array ();

  /**
   * Arreglo con todos los archivos no escaneados en el directorio indicado, o
   * conjunto de archivos dado.
   *
   * @access private
   * @var array [ file ]
   */
  private $notScannedFiles = array ();

  /**
   * Arreglo con todos los archivos escaneados en el directorio indicado, o
   * conjunto de archivos dado.
   *
   * @access private
   * @var array [ file ]
   */
  private $scannedFiles = array ();

  /**
   * Contiene la fecha y hora de inicio del proceso de acciones a los archivos
   * infectados.
   *
   * @access private
   * @var string
   */
  private $startTimeAction;

  /**
   * Contiene la fecha y hora de inicio del proceso de escaneo de archivos.
   *
   * @access private
   * @var string
   */
  private $startTimeScan;

  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @return void
   *
   * @see sys\core\abstractions\ApiAbs::__construct ()
   */
  public function __construct () {

    parent::__construct ( 'ecomca' );
    $this->delimiter = Normalize::getDelimiter ();
  }

  /**
   * Permite generar un mensaje que alerte al administrador del sistema sobre
   * las acciones a tomar luego de haber realizado un escaneo con el sistema
   * ECOMCA.
   *
   * @return string Mensaje a enviar en el correo de alerta.
   */
  private function generateAlertMessage () {

    $message = '';
    $message = $this->dataConfig->getValue ( 'contentEmail' );
    if ( \count ( $this->infectedFiles ) != 0 ) {
      
      $message = $this->dataConfig->getValue ( 'contentEmail' );
      
      foreach ( $this->infectedFiles as $inf ) {
        
        $message .= "  -  $inf \n";
      }
    }
    return $message;
  }

  /**
   * Contiene la fecha y hora de finalización del proceso de acciones a los
   * archivos infectados.
   * 
   * @return string
   */
  public function getEndTimeAction () {

    return $this->endTimeAction;
  }

  /**
   * Retorna la fecha y hora de finalización del proceso de escaneo de archivos.
   *
   * @return string
   */
  public function getEndTimeScan () {

    return $this->endTimeScan;
  }

  /**
   * Permite obtener el o los archivos para ser analizados.
   *
   * @param array|string $dir
   *        Nombre o lista de nombres de los archivos o directorios a analizar
   *        para obtener el o los archivos contenidos.
   *        
   * @return
   *
   */
  private function getFiles ( $dir ) {

    if ( \is_string ( $dir ) ) {
      
      $this->_getFiles ( $dir );
    } elseif ( \is_array ( $dir ) ) {
      
      foreach ( $dir as $file ) {
        
        $this->_getFiles ( $file );
      }
    } else {
    
    /**
     * @TODO Lanzar una excepción.
     */
    }
  }

  /**
   * Permite obtener el o los archivos para ser analizados.
   *
   * @param string $file
   *        Nombre del archivo o directorio.
   *        
   * @return void
   */
  private function _getFiles ( $file ) {

    if ( \is_dir ( $file ) ) {
      
      $this->scanDir ( $file );
    } elseif ( \is_file ( $file ) && \file_exists ( $file ) && !\in_array ( $file, $this->filesToScan ) ) {
      
      $this->filesToScan [] = $file;
    } else {
    
    /**
     * @TODO Lanzar excepción.
     */
    }
  }

  /**
   * Arreglo con todos los archivos contenidos en el directorio indicado, o
   * conjunto de archivos dado.
   *
   * @return array [ file ]
   */
  public function getFilesToScan () {

    return $this->filesToScan;
  }

  /**
   * Contiene la fecha y hora de inicio del proceso de acciones a los archivos
   * infectados.
   * 
   * @return string
   */
  public function getStartTimeAction () {

    return $this->startTimeAction;
  }

  /**
   * Retorna la fecha y hora de inicio del proceso de escaneo de archivos.
   *
   * @return string
   */
  public function getStartTimeScan () {

    return $this->startTimeScan;
  }

  /**
   * Permite inicializar los parametros necesarios para realizar un nuevo
   * escaneo de archivos con el sistema ECOMCA.
   *
   * @return void
   */
  private function init () {

    $this->filesToScan = array ();
    $this->infectedFiles = array ();
    $this->scannedFiles = array ();
  }

  /**
   *
   * @return void
   */
  private function initScanProcess () {

  }

  /**
   * Permite verificar si el servicio de escaneo de archivos por código
   * potencialmente peligroso está activo.
   *
   * @return boolean Verdadero si está activo, falso en caso contrario.
   *        
   * @see \sys\core\abstractions\ApiAbs::isActive ()
   */
  public function isActive () {

    return $this->active;
  }

  /**
   * Permite analizar un texto y verificar si contiene código potencialmente
   * peligroso, que pueda dañar o realizar acciones no permitidas.
   *
   * @param string $content
   *        Texto a analizar.
   *        
   * @return boolean Verdadero si no contiene código potencialmente peligroso,
   *         falso en caso contrario.
   */
  private function isClean ( $content ) {

    /**
     * @TODO Como indicar todos los posibles códigos potencialmente peligrosos
     */
    $result = TRUE;
    foreach ( MaliciousCodeDefinition::getPatterns () as $pattern ) {
var_dump($pattern);
      if ( \preg_match ( '/' . $pattern . '/', $content ) == 1 ) {
        
        $result = FALSE;
        break;
      }
    }
    return $result;
  }

  /**
   * Contiene la fecha y hora de finalización del proceso de acciones a los
   * archivos infectados.
   * 
   * @return sys\api\ecomca\EcoMca
   */
  public function setEndTimeAction () {

    $this->endTimeAction = \getdate ();
    return $this;
  }

  /**
   * Asigna la fecha y hora de finalización del proceso de escaneo de archivos.
   *
   * @return sys\api\ecomca\EcoMca
   */
  private function setEndTimeScan () {

    $this->endTimeScan = \getdate ();
    return $this;
  }

  /**
   * Contiene la fecha y hora de inicio del proceso de acciones a los archivos
   * infectados.
   *       
   * @return sys\api\ecomca\EcoMca
   */
  private function setStartTimeAction () {

    $this->startTimeAction = \getdate ();
    return $this;
  }

  /**
   * Asigna la fecha y hora de inicio del proceso de escaneo de archivos.
   *
   * @return sys\api\ecomca\EcoMca
   */
  private function setStartTimeScan () {

    $this->startTimeScan = \getdate ();
    return $this;
  }

  /**
   * Permite escanear un archivo o lista de archivos para descartar posible
   * código potencialmente peligroso.
   *
   * @param array|string $files
   *        Archivo o lista de archivos para escanear. Puede contener archivos,
   *        directorios y/o una combinación de los mismos.
   *        
   * @return void
   */
  public function scan ( $files ) {

    /**
     * @TODO (LISTO)Validar el o los parámetros indicados.
     * @TODO (LISTO)Obtener los archivos a escanear.
     * @TODO Generar valores y/o parámetros para mostrar barra de progreso.
     * 1.- (LISTO)Obtener fecha y hora de inicio.
     * 2.- (LISTO)Obtener fecha y hora de culminación.
     * 3.- Obtener tiempo estimado de culminación.
     * 4.- Obtener tiempo del progreso.
     * Esto se debe realizar con javascript, para no congestionar el
     * servidor de peticiones vía ajax. Se manda la hora de inicio al
     * cliente y el cliente muestra la ejecución del contador del
     * tiempo en ejecución del proceso.
     * 5.- Mostrar archivos que se estan escaneando.
     * Esto se debe realizar vía Ajax.
     * @TODO (LISTO)Iniciar proceso de escaneo.
     * @TODO (LISTO)Guardar en arreglo los archivos escaneados.
     * @TODO (LISTO)Guardar en arreglo los archivos no escaneados.
     * @TODO (LISTO)Guardar en arreglo los archivos infectados.
     * @TODO (LISTO)Mostrar resultados del escaneo.
     * @TODO Mostrar acciones a realizar (No hacer nada, reparar, eliminar,
     * cuarentena, etc.).
     * @TODO Definir las acciones permitidas a realizar por el sistema ECOMCA.
     * @TODO Permitir al sistema verificar si el o los archivos "infectados",
     * forman parte del sistema, apis, aplicación desarrollada con ECOMOD, de
     * terceros o si son archivos externos(no forman parte de nada).
     * @TODO Obtener los archivos a los que se les realizará alguna acción.
     * @TODO Generar valores y/o parámetros para mostrar barra de progreso.
     * 1.- (LISTO)Obtener fecha y hora de inicio.
     * 2.- (LISTO)Obtener fecha y hora de culminación.
     * 3.- Obtener tiempo estimado de culminación.
     * 4.- Obtener tiempo del progreso.
     * 5.- Mostrar archivos a los que se les está aplicando la(s) acción(es).
     * 6.- Mostrar acción que se está realizando.
     * @TODO Iniciar proceso de las acciones.
     * @TODO Mostrar resultado de las acciones realizadas.
     * @TODO Generar archivo log, de todas las acciones realizadas.
     * 1.- Inicio del proceso.
     * 2.- Culminación del proceso.
     * 3.- Lista de archivos escaneados o en su defecto la carpeta (ver cual es
     * mejor).
     * 4.- Lista de archivos infectados.
     * 5.- Acciones realizadas para cada archivo infectado.
     * 6.- Fecha en que se realizó el escaneo.
     * @TODO Definir que métodos son públicos, privados o protegidos
     * @TODO (LISTO)Generar el código y los métodos para enviar mensaje de
     * alerta de
     * código potencialmente peligroso.
     */
    $this->setStartTimeScan ();
    $this->init ();
    // \var_dump ( $this->getStartTime () );
    $this->getFiles ( $files );
    
    $this->_scan ();
    $this->sendResultScan ();
    
    // \var_dump ( $this->getFilesToScan () );
    $this->setEndTimeScan ();
    // \var_dump ( $this->getEndTime () );
    $this->sendAlert ();
  }

  /**
   * Ejecuta el proceso de escaneo de código malicioso de los archivos
   * seleccionados.
   *
   * @return void
   */
  private function _scan () {

    /**
     * @TODO Enviar vía Ajax la fecha y hora de inicio.
     * @TODO Con javascript actualizar el contador del tiempo de progreso.
     */
    foreach ( $this->filesToScan as $file ) {

      if ( ( $fileContent = \file_get_contents ( $file ) ) !== FALSE ) {

        $this->scannedFiles [] = $file;
        if ( ( $result = !$this->isClean ( $fileContent ) ) !== FALSE ) {

          if ( $result == 1 ) {

            $this->infectedFiles [] = $file;
          }
        } else {

          $this->notScannedFiles [] = $file;
        }
      } else {

        $this->notScannedFiles [] = $file;
      }
    }
  }

  /**
   * Permite leer un directorio para obtener los archivos contenidos en él.
   * Función recursiva.
   *
   * @param string $dir
   *        Nombre del directorio a leer.
   *        
   * @throws ScanDirException
   *
   * @return void
   */
  private function scanDir ( $dir ) {

    $filesList = \scandir ( $dir );
    if ( !\is_array ( $filesList ) ) {
      
      throw new ScanDirException ( $dir );
    }
    
    foreach ( $filesList as $file ) {
      
      if ( ( $file != '.' ) && ( $file != '..' ) ) {
        
        if ( \is_dir ( $dir . $this->delimiter . $file ) ) {
          
          $this->scanDir ( $dir . $this->delimiter . $file );
        } elseif ( \is_file ( $dir . $this->delimiter . $file ) && !\in_array ( $dir . $this->delimiter . $file, $this->filesToScan ) ) {
          
          $this->filesToScan [] = $dir . $this->delimiter . $file;
        }
      }
    }
  }

  /**
   * Permite enviar una alerta al administrador del sistema en caso de encontrar
   * código potencialmente peligroso en el escaneo de archivos.
   * Adicionalmente,
   * la opción "send" del archivo config.xml de la api ecomca debe estar
   * configurada a 1 para ser enviado el correo de alerta.
   *
   * @return boolean Verdadero si envía la alerta, falso en caso contrario.
   */
  private function sendAlert () {

    if ( $this->dataConfig->getValue ( 'send' ) ) {
      
      return \mail ( $this->dataConfig->getValue ( 'email' ), 'ALERTA, encontrado código potencialmente peligroso.', $this->generateAlertMessage (), 'FROM:' );
    }
  }

  /**
   * Permite enviar vía Ajax, un objeto JSON al cliente, contentivo de los datos
   * resultantes del escaneo con el sistema ECOMCA.
   *
   * @return void
   */
  private function sendResultActions () {

    /**
     * @TODO Estos datos deben enviarse como un objeto por Ajax al cliente para
     * ser interpretados, procesados y mostrados
     */
    $objResultActions = new ResultActions ();
    $objJson = new Json ();
    // return $objJson->objectToJson ( $objResultActions );
    \var_dump ( $objJson->objectToJson ( $objResultActions ) );
    /*
     * \var_dump ( 'Archivos escaneados: ' . \count ( $this->scannedFiles ) );
     * \var_dump ( 'Archivos no escaneados: ' . \count ( $this->notScannedFiles
     * ) );
     * \var_dump ( 'Archivos limpios: ' . ( \count ( $this->scannedFiles ) -
     * \count ( $this->infectedFiles ) ) );
     * \var_dump ( 'Archivos infectados: ' . \count ( $this->infectedFiles ) );
     * \var_dump (
     * '============================================================' );
     * \var_dump ( 'Archivo Acciones' );
     * \var_dump (
     * '============================================================' );
     * foreach ( $this->infectedFiles as $infectedFile ) {
     * \var_dump ( $infectedFile . ' ' . 'Reparar' );
     * }
     * \var_dump ( ' ' );
     * \var_dump (
     * '============================================================' );
     * \var_dump ( 'Aplicar acciones: ' . '"Aplicar"' );
     * // \var_dump ( '' );
     * // \var_dump ( '' );
     */
  }

  /**
   * Permite enviar vía Ajax, un objeto JSON al cliente, contentivo de los datos
   * resultantes del escaneo con el sistema ECOMCA.
   *
   * @return void
   */
  private function sendResultScan () {

    /**
     * @TODO Estos datos deben enviarse como un objeto por Ajax al cliente para
     * ser interpretados, procesados y mostrados
     */
    /*
     * $objResultScan = new ResultScan ();
     * $objResultScan->setInfectedFiles ( $this->infectedFiles );
     * $objResultScan->setNotScannedFiles ( $this->notScannedFiles );
     * $objResultScan->setScannedFiles ( $this->scannedFiles );
     * $objJson = new Json ();
     */
    // return $objJson->objectToJson ( $objResultScan );
    // \var_dump ( $objJson->objectToJson ( $objResultScan ) );
    \var_dump ( 'Archivos escaneados: ' . \count ( $this->scannedFiles ) );
    \var_dump ( 'Archivos no escaneados: ' . \count ( $this->notScannedFiles ) );
    \var_dump ( 'Archivos limpios: ' . ( \count ( $this->scannedFiles ) - \count ( $this->infectedFiles ) ) );
    \var_dump ( 'Archivos infectados: ' . \count ( $this->infectedFiles ) );
    \var_dump ( '============================================================' );
    \var_dump ( 'Archivo                                             Acciones' );
    \var_dump ( '============================================================' );
    foreach ( $this->infectedFiles as $infectedFile ) {
      
      \var_dump ( $infectedFile . ' ' . 'Reparar' );
    }
    \var_dump ( '                                                            ' );
    \var_dump ( '============================================================' );
    \var_dump ( 'Aplicar acciones: ' . '"Aplicar"' );
    // \var_dump ( '' );
    // \var_dump ( '' );
  }
}
?>
