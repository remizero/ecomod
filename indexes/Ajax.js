
"use strict";

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
 * 
 * 
 * HACER USO DE ESTAS IDEAS
 * https://www.html5rocks.com/en/tutorials/file/xhr2/
 * 
 * 
 * 
 * https://material-ui.com/components/progress/
 *
 */

/**
 * 
 */
class Ajax extends XMLHttpRequest {
  
  outputProcessed = null;
  internalCallbackFunction = null;

  /**
   * Constructor de la clase Ajax.
   * 
   * @param document
   * @param contentType
   * @param responseType Indica el tipo de dato a recibir.
   * 
   * @return void
   */
	constructor ( document, contentType, responseType, callbackFunction = null ) {

		super ();
		this.documento = document;
		this.contentType = contentType;
		this.responseType = responseType;
		this.internalCallbackFunction = callbackFunction;
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
	 * @param method
   * @param event
   * @param url
   * 
   * @returns void
	 */
	send ( method, event, url ) {

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
    this.onreadystatechange = this.readyStateChangeEvent ( this.output );
    super.send ( event ); //enviar
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
  readyStateChangeEvent ( /*callback*/ ) {

    console.log ( "El valor de readyState es: " + this.readyState );
    switch ( this.readyState ) {
      
      case 0 :// request not initialized 

        console.log ( "Objeto no inicializado" );
        this.showHideContainer ( 'contenido' );
        this.showProgressMessage ( 'contenido', "Inicializando objeto." );
        break;

      case 1 :// server connection established

        console.log ( "Estableciendo conexion" );
        this.showHideContainer ( 'contenido' );
        this.showProgressMessage ( 'contenido', "Estableciendo conexión." );
        break;

      case 2 :// request received

        console.log ( "Request recibido" );
        this.showProgressMessage ( 'contenido', "Solicitud recibida." );
        break;

      case 3 :// processing request

        console.log ( "Procesando Request" );
        this.showProgressMessage ( 'contenido', "Procesando solicitud." );
        break;

      case 4 :// request finished and response is ready

        /**
         * el experimento rendicion
         */
        console.log ( "Recibiendo y Procesando respuesta" );
        this.showProgressMessage ( 'contenido', "Recibiendo y Procesando respuesta." );
        if ( this.status == 200 ) {

          let textoAjax;
          if ( this.responseType == Ajax.RESPONSETYPEENUM.ARRAYBUFFER ) {
            
            //this.outputProcessed = JSON.parse ( this.response );
            
          } else if ( this.responseType == Ajax.RESPONSETYPEENUM.BLOB ) {
            
            //this.outputProcessed = JSON.parse ( this.response );
            
          } else if ( this.responseType == Ajax.RESPONSETYPEENUM.DOCUMENT ) {
            
            //this.outputProcessed = JSON.parse ( this.response );
            
          } else if ( this.responseType == Ajax.RESPONSETYPEENUM.EMPTY ) {
            
            this.outputProcessed = this.responseText;
            
          } else if ( this.responseType == Ajax.RESPONSETYPEENUM.JSON ) {
            
            this.outputProcessed = JSON.parse ( this.response );
            if ( this.internalCallbackFunction != null ) {
              
              this.internalCallbackFunction ( this.documento, this.outputProcessed );
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

    if ( this.documento.getElementById ) { //se obtiene el id
    
      var el = this.documento.getElementById ( id ); //se define la variable "el" igual a nuestro div

      el.style.display = ( el.style.display == 'none' ) ? 'inline' : 'none'; //damos un atributo display:none que oculta el div
    }
  }

  /**
   * 
   */
  showProgressMessage ( id, message ) {
    
    if ( this.documento.getElementById ) { //se obtiene el id
      
      var el = this.documento.getElementById ( id ); //se define la variable "el" igual a nuestro div
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

function callback ( document, response ) {
  
  /**
   * ESTA FUNCIÓN SERÁ QUIEN PERMITA GENERAR LA SALIDA CORRESPONDIENTE A LA
   * VISTA DONDE Y CUANDO SE NECESITE.
   * 
   * ESTA FUNCIÓN NO DEBE ESTAR EN EL MISMO ARCHIVO DE LA CLASE AJAX.
   */
  console.log ( "Por lo visto si entró." );
  setTimeout ( showHideContainer ( "contenido" ), 10000 );
  var el = document.getElementById ( "responsephp" ); //se define la variable "el" igual a nuestro div
  el.innerHTML += response.nombre + '<br>';
  el.innerHTML += response.apellido + '<br>';
  console.log ( response.nombre );
}

function sendRequest ( document ) {

  /**
   * ESTA FUNCIÓN ES LA ENCARGADA DE LANZAR LA PETICIÓN VÍA AJAX, HAY QUE 
   * DOCUMENTAR MUY BIEN LA CLASE AJAX PARA ESPECIFICAR MUY BIEN COMO HACER USO 
   * DE LA MISMA Y COMO Y POR QUÉ SE DEBE HACER USO DE LOS HEADERS Y EL 
   * RESPONSETYPEENUM.
   * 
   * ESTA FUNCIÓN NO DEBE ESTAR EN EL MISMO ARCHIVO DE LA CLASE AJAX.
   */
  let ajax = new Ajax ( document, Ajax.HEADERS.JSON, Ajax.RESPONSETYPEENUM.JSON, callback );
  ajax.send ( "POST", null, "http://localhost/ecomod/sys/libs/common/PhpAjaxBridge.php" );
}

function showHideContainer ( id ) {
  
  if ( document.getElementById ) { //se obtiene el id
  
    var el = document.getElementById ( id ); //se define la variable "el" igual a nuestro div
  
    el.style.display = ( el.style.display == 'none' ) ? 'block' : 'none'; //damos un atributo display:none que oculta el div
  }
}

window.onload = function () {/*hace que se cargue la función lo que predetermina que div estará oculto hasta llamar a la función nuevamente*/

  showHideContainer ( 'contenido' );/* "contenido_a_mostrar" es el nombre que le dimos al DIV */
}




