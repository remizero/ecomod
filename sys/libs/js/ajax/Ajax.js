
"use strict";
import AjaxUtils from './AjaxUtils.js';

/**
 * ATRIBUTOS DEL OBEJTO XMLHttpRequest 
 * Atributo       Descripción
 * readyState     Devuelve el estado del objeto como sigue: 
 *                0 = sin inicializar, 1 = abierto, 2 = cabeceras recibidas, 3 = cargando y 4 = completado.
 * response		  Después de una solicitud exitosa, la propiedad de respuesta de xhr contendrá los datos solicitados como DOMString, ArrayBuffer, Blob o Document (dependiendo de lo que se configuró para responseType).
 * responseBody   (Level 2) Devuelve la respuesta como un array de bytes
 * responseText   Devuelve la respuesta como una cadena
 * responseType	  Antes de enviar una solicitud, configure xhr.responseType en "text", "arraybuffer", "blob" o "document", según sus necesidades de datos. Tenga en cuenta que establecer xhr.responseType = '' (u omitir) predeterminará la respuesta a "texto".
 * 				  '' (default)	Same as 'text', 'text'	String, 'arraybuffer'	ArrayBuffer, 'blob'	Blob, 'document'	Document, 'json'	Object
 * responseXML    Devuelve la respuesta como XML. Esta propiedad devuelve un objeto documento XML, que puede ser examinado usando las propiedades y métodos del árbol del Document Object Model.
 * status         Devuelve el estado como un número (p. ej. 404 para "Not Found" y 200 para "OK").
 * statusText     Devuelve el estado como una cadena (p. ej. "Not Found" o "OK").
 * 
 * 
 * MÉTODOS DEL OBJETO XMLHttpRequest
 * Método                   Descripción
 * abort ()                 Cancela la petición en curso
 * getAllResponseHeaders () Devuelve el conjunto de cabeceras HTTP como una cadena.
 * getResponseHeader        Devuelve el valor de la cabecera HTTP especificada. 
 * ( nombreCabecera ) 
 * open                     Especifica el método, URL y otros atributos opcionales de una petición.
 * ( método, URL [,         El parámetro de método puede tomar los valores "GET", "POST", o "PUT" ("GET" y "POST" son dos formas para solicitar datos, con "GET" los parámetros de la petición se codifican en la URL y con "POST" en las cabeceras de HTTP). 
 * asíncrono [,             El parámetro URL puede ser una URL relativa o completa. 
 * nombreUsuario [,         El parámetro asíncrono especifica si la petición será gestionada asíncronamente o no. Un valor true indica que el proceso del script continúa después del método send(), sin esperar a la respuesta, y false indica que el script se detiene hasta que se complete la operación, tras lo cual se reanuda la ejecución.
 * clave ] ] ] )            En el caso asíncrono se especifican manejadores de eventos, que se ejecutan ante cada cambio de estado y permiten tratar los resultados de la consulta una vez que se reciben, o bien gestionar eventuales errores.
 * send([datos])            Envía la petición
 * setRequestHeader         Añade un par etiqueta/valor a la cabecera HTTP a enviar.
 * ( etiqueta, valor ) 
 * overrideMimeType(mime : String)
 * 
 * 
 * EVENTOS DEL OBJETO XMLHttpRequest
 * Evento               Descripción
 * onreadystatechange   Evento que se dispara con cada cambio de estado.
 * onabort              (Level 2) Evento que se dispara al abortar la operación.
 * onload               (Level 2) Evento que se dispara al completar la carga.
 * onloadstart          (Level 2) Evento que se dispara al iniciar la carga.
 * onprogress           (Level 2) Evento que se dispara periódicamente con información de estado.
 * 
 * 
 * PROPIEDADES DEL OBJETO XMLHttpRequest
 * DONE : Number  readonly  value = 4
 * HEADERS_RECEIVED : Number  readonly  value = 2
 * LOADING : Number  readonly  value = 3
 * OPENED : Number  readonly  value = 1
 * UNSENT : Number  readonly  value = 0
 * 
 * https://material-ui.com/components/progress/
 */

/**
 * <strong>Ajax</strong>
 *
 * Archivo creado el 26 de noviembre de 2019 a las 00:52:55 a.m.
 * <p>Clase que permite realizar solicitudes (Request) vía ajax para el sistema 
 * ECOMOD.</p>
 *
 * @name Ajax
 * @namespace 
 * @package ECOMOD/LIBS/JS/AJAX.
 * @subpackage 
 * @filesource Ajax.js
 * @version 1.0
 * @since 1.0
 * @author Filiberto Zaá Avila ( remizero ) filizaa@gmail.com.
 * @copyright Todos los derechos reservados 2019.
 * @link http://www.ecosoftware.com.ve
 * @license http://www.ecosoftware.com.ve/licencia
 * @uses <ul>
 *       <li>.php</li>
 *       </ul>
 * @see .php
 * @todo <p>PARA CARGAR Y DESCARGAR ARCHIVOS VÍA AJAX</p>
 * @todo <p>https://msdn.microsoft.com/es-es/silverlight/hh673569(v=vs.100)</p>
 * @todo <p>https://www.rephp.com/subir-barra-de-progreso-en-php.html</p>
 * @todo <p>https://evilnapsis.com/2019/05/17/mostrar-el-progreso-al-subir-imagenes-con-ajax-y-php/</p>
 * @todo <p>https://www.rephp.com/permita-el-acceso-al-archivo-php-solo-a-traves-de-ajax-en-el-servidor-local.html</p>
 * @todo <p>https://www.rephp.com/como-verificar-si-la-solicitud-es-una-solicitud-de-ajax-con-php.html</p>
 * @todo <p>https://developer.mozilla.org/es/docs/Web/Guide/AJAX</p>
 * @todo <p>http://www.uco.es/~lr1maalm/manualdeajax.pdf (MANUAL DE AJAX)</p>
 * @todo <p>https://cybmeta.com/ajax-con-json-y-php-con-javascript-puro</p>
 * @todo <p>https://www.html5rocks.com/en/tutorials/file/xhr2/</p>
 */
export default class Ajax extends XMLHttpRequest {

  contentType = null;
  internalCallbackFunction = null;
  internalDocument = null;
  outputProcessed = null;
  responseType = null;

  /**
   * Constructor de la clase Ajax.
   * 
   * @param document Instancia del documento activo que realiza la petición.
   * @param contentType Indica el tipo de dato que se está enviando.
   * @param responseType Indica el tipo de dato a recibir.
   * @param callbackFunction Función a ser llamada para procesar la respuesta 
   * recibida desde el servidor. Valor por omisión null, no hace nada con la 
   * respuesta.
   * 
   * @return void
   */
	constructor ( document, contentType = Ajax.HEADERS.TEXTPLAIN, responseType = Ajax.RESPONSETYPEENUM.TEXT, callbackFunction = null ) {

		super ();
    this.contentType = contentType;
		this.internalDocument = document;
		this.internalCallbackFunction = callbackFunction;
    this.responseType = responseType;
		this.addEventListener ( "loadstart", this.onLoadStartEvent );
    this.addEventListener ( "progress", this.onProgressEvent );
    this.addEventListener ( "abort", this.onAbortEvent );
    this.addEventListener ( "error", this.onErrorEvent );
    this.addEventListener ( "load", this.onLoadEvent );
    this.addEventListener ( "timeout", this.onTimeOutEvent );
    this.addEventListener ( "loadend", this.onLoadEndEvent );
    this.addEventListener ( "readystatechange", this.readyStateChangeEvent );
	}
	
	/**
	 * Método sobrecargado de la clase XMLHttpRequest que realiza configuraciones 
	 * adicionales, que facilita la utilización del mismo.
	 * 
	 * @param method Tipo de solicitud a realizar al servidor. Puede tomar los 
	 * valores GET, HEAD, POST, PUT, DELETE, CONNECT, OPTIONS, TRACE, PATCH.
   * @param url Representa la URL a la que se envia la solicitud.
   * @param body
   * 
   * @returns void
	 */
	send ( method, url, body = null ) {

    //preparar el envio: método open
    this.open ( method, url, true );
    this.setRequestHeader ( 'X-Requested-With', 'XMLHttpRequest');
    this.setRequestHeader ( "Content-Type", this.contentType );
    if ( this.responseType == Ajax.RESPONSETYPEENUM.JSON ) {
      
      this.setRequestHeader ( "ACCEPT", "application/json" );
    }
    //this.setRequestHeader ( "Content-Type", "application/json" );
    //this.setRequestHeader ( "Content-Type", "application/x-www-form-urlencoded" );
    //this.setRequestHeader ( "Content-Type", "text/plain" );
    //this.onreadystatechange = this.readyStateChangeEvent ( this.output );
    this.onreadystatechange = this.readyStateChangeEvent ();
    super.send ( body ); //enviar
	}

	/**
	 * 
	 */
  destroy () {
    
    this.removeEventListener ( "loadstart", this.onLoadStartEvent );
    this.removeEventListener ( "progress", this.onProgressEvent );
    this.removeEventListener ( "abort", this.onAbortEvent );
    this.removeEventListener ( "error", this.onErrorEvent );
    this.removeEventListener ( "load", this.onLoadEvent );
    this.removeEventListener ( "timeout", this.onTimeOutEvent );
    this.removeEventListener ( "loadend", this.onLoadEndEvent );
    this.removeEventListener ( "readystatechange", this.readyStateChangeEvent );
  }

  /**
   * 
   */
  readyStateChangeEvent () {

    console.log ( "El valor de readyState es: " + this.readyState );
    switch ( this.readyState ) {

      case XMLHttpRequest.UNSENT :// request not initialized 

        console.log ( "Objeto no inicializado" );
        this.showHideContainer ( 'contenido' );
        this.showProgressMessage ( 'contenido', "Inicializando objeto." );
        break;

      case XMLHttpRequest.OPENED :// server connection established

        console.log ( "Estableciendo conexion" );
        this.showHideContainer ( 'contenido' );
        this.showProgressMessage ( 'contenido', "Estableciendo conexión." );
        break;

      case XMLHttpRequest.HEADERS_RECEIVED :// request received

        console.log ( "Request recibido" );
        this.showProgressMessage ( 'contenido', "Solicitud recibida." );
        break;

      case XMLHttpRequest.LOADING :// processing request

        console.log ( "Procesando Request" );
        this.showProgressMessage ( 'contenido', "Procesando solicitud." );
        break;

      case XMLHttpRequest.DONE :// request finished and response is ready

        /**
         * el experimento rendicion
         */
        console.log ( "Recibiendo y Procesando respuesta" );
        this.showProgressMessage ( 'contenido', "Recibiendo y Procesando respuesta." );
        if ( this.status == 200 ) {

          let textoAjax;
          if ( this.responseType == Ajax.RESPONSETYPEENUM.ARRAYBUFFER ) {
            
            console.log ( "Es un ARRAYBUFFER." );
            console.log ( "Procesando Request" );
            
         // Get the raw header string
            /*var headers = this.getAllResponseHeaders ();

            // Convert the header string into an array
            // of individual headers
            var arr = headers.trim ().split ( /[\r\n]+/ );

            // Create a map of header names to values
            var headerMap = {};
            arr.forEach ( function ( line ) {
              var parts = line.split ( ': ' );
              var header = parts.shift ();
              var value = parts.join ( ': ' );
              headerMap [ header ] = value;
            } );
            var contentType = headerMap [ "content-type" ];
            console.log ( contentType );
            var contentLength = headerMap [ "Content-Length" ];
            console.log ( contentLength );*/
            
            var contentType = this.getResponseHeader ( "Content-Type" );
            console.log ( contentType );
            var contentLength = this.getResponseHeader ( "Content-Length" );
            console.log ( contentLength );
            /*this.outputProcessed = JSON.parse ( this.response );
            if ( this.internalCallbackFunction != null ) {
              
              this.internalCallbackFunction ( this.internalDocument, this.outputProcessed );
            }*/
            
          } else if ( this.responseType == Ajax.RESPONSETYPEENUM.BLOB ) {
            
            //this.outputProcessed = JSON.parse ( this.response );
            
          } else if ( this.responseType == Ajax.RESPONSETYPEENUM.DOCUMENT ) {
            
            //this.outputProcessed = JSON.parse ( this.response );
            
          } else if ( this.responseType == Ajax.RESPONSETYPEENUM.EMPTY ) {
            
            this.outputProcessed = this.responseText;
            
          } else if ( this.responseType == Ajax.RESPONSETYPEENUM.JSON ) {
            
            this.outputProcessed = JSON.parse ( this.response );
            if ( this.internalCallbackFunction != null ) {
              
              this.internalCallbackFunction ( this.internalDocument, this.outputProcessed );
            }
            
          } else if ( this.responseType == Ajax.RESPONSETYPEENUM.MSSTREAM ) {
            
            //this.outputProcessed = JSON.parse ( this.response );
            
          } else if ( this.responseType == Ajax.RESPONSETYPEENUM.TEXT ) {
            
            this.outputProcessed = this.responseText;
            
          } else {
            
            this.outputProcessed = this.responseText;
          }
        } else {
          
          console.log ( "Que hacer en este caso" );
        }
        break;
    }
  }
  
  /**
   * The request was canceled by the call abort() method.
   */
  onAbortEvent () {
    
    console.log ( "The request was canceled by the call abort() method." );
  }
  
  /**
   * Connection error has occured, e.g. wrong domain name. Doesn’t happen for HTTP-errors like 404.
   */
  onErrorEvent () {
    
    console.log ( "Connection error has occured, e.g. wrong domain name. Doesn’t happen for HTTP-errors like 404." );
  }
  
  /**
   * The request has finished (succeffully or not).
   */
  onLoadEndEvent () {
    
    console.log ( "The request has finished (succeffully or not)." );
    this.showHideContainer ( 'contenido' );
  }

  /**
   * The request has finished successfully.
   */
  onLoadEvent () {

    this.showProgressMessage ( 'contenido', "The request has finished successfully." );
    console.log ( "The request has finished successfully." );
  }

  /**
   * The request has started.
   */
  onLoadStartEvent () {
    
    console.log ( "The request has started." );
    this.showProgressMessage ( 'contenido', "The request has started." );
  }
  
  /**
   * A data packet of the response has arrived, the whole response body at the moment is in responseText.
   */
  onProgressEvent () {
    
    console.log ( "A data packet of the response has arrived, the whole response body at the moment is in responseText." );
    this.showProgressMessage ( 'contenido', "A data packet of the response has arrived, the whole response body at the moment is in responseText." );
  }
  
  /**
   * The request was canceled due to timeout (only happens if it was set).
   */
  onTimeOutEvent () {
    
    console.log ( "The request was canceled due to timeout (only happens if it was set)." );
  }

  /**
   * 
   */
  showHideContainer ( id ) {

    if ( this.internalDocument.getElementById ) { //se obtiene el id
    
      var el = this.internalDocument.getElementById ( id ); //se define la variable "el" igual a nuestro div

      el.style.display = ( el.style.display == 'none' ) ? 'inline' : 'none'; //damos un atributo display:none que oculta el div
    }
  }

  /**
   * @TODO como hacer que los mensajes mostrados se vean todos hasta que reciba
   * la respuesta completa.
   */
  showProgressMessage ( id, message ) {
    
    if ( this.internalDocument.getElementById ) { //se obtiene el id
      
      var el = this.internalDocument.getElementById ( id ); //se define la variable "el" igual a nuestro div
      el.innerHTML += message + '<br>';
    }
  }

  static get HEADERS () {
    
    return { JSON : "application/json", TEXTPLAIN : "text/plain", XML : "text/xml" };
  }

  /**
   * 
   * @param document
   * @returns
   */
  static get RESPONSETYPEENUM () {

    return { ARRAYBUFFER : "arraybuffer", BLOB : "blob", DOCUMENT : "document", EMPTY : "", JSON : "json", MSSTREAM : "ms-stream", TEXT : "text" };
  }
}