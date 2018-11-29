/**
 * ATRIBUTOS DEL OBEJTO XMLHttpRequest 
 * Atributo       Descripción
 * readyState     Devuelve el estado del objeto como sigue: 
 *                0 = sin inicializar, 1 = abierto, 2 = cabeceras recibidas, 3 = cargando y 4 = completado.
 * responseBody   (Level 2) Devuelve la respuesta como un array de bytes
 * responseText   Devuelve la respuesta como una cadena
 * responseXML    Devuelve la respuesta como XML. Esta propiedad devuelve un objeto documento XML, que puede ser examinado usando las propiedades y métodos del árbol del Document Object Model.
 * status         Devuelve el estado como un número (p. ej. 404 para "Not Found" y 200 para "OK").
 * statusText     Devuelve el estado como una cadena (p. ej. "Not Found" o "OK").
 * 
 * 
 * MÉTODOS DEL OBJETO XMLHttpRequest
 * Método                   Descripción
 * abort ()                 Cancela la petición en curso getAllResponseHeaders () 
 *                          Devuelve el conjunto de cabeceras HTTP como una cadena.
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
 */
class Ajax extends XMLHttpRequest {

  constructor () {
    
    super ();
    /*
    this.xhr = false;
    try {

      this.xhr = new ActiveXObject ( "Msxml2.xhr" );

    } catch ( e ) {

      try {

        this.xhr = new ActiveXObject ( "Microsoft.xhr" );

      } catch ( E ) {

        this.xhr = false;
      }
    }
    if ( !this.xhr && typeof XMLHttpRequest != 'undefined' ) {

      this.xhr = new XMLHttpRequest ();
    }*/
    
    //this.xhr = null;
    /*let xhr = null;
    if ( XMLHttpRequest ) {
      
      //El explorador implementa la interfaz de forma nativa
      this.xhr = new XMLHttpRequest ();
      console.log ( "Se creo el objeto XMLHttpRequest" );
      
    } else if ( ActiveXObject ) {
      
      //El explorador permite crear objetos ActiveX
      try {
        
        this.xhr = new ActiveXObject ( "MSXML2.XMLHTTP" );
        console.log ( "Se creo el objeto MSXML2.XMLHTTP" );
        
      } catch ( e ) {
        
        try {
          
          this.xhr = new ActiveXObject ( "Microsoft.XMLHTTP" );
          console.log ( "Se creo el objeto Microsoft.XMLHTTP" );
          
        } catch ( e ) {}
      }
    }
    if ( !this.xhr ) {
      
      console.log ( "El navegador no tiene soporte para realizar este tipo de solicitudes al servidor." );
    }*/
    this.addEventListener ( "onloadstart", this.onLoadStartEvent.bind ( this ), true );
    this.addEventListener ( "onprogress", this.onProgressEvent.bind ( this ), true );
    this.addEventListener ( "onabort", this.onAbortEvent.bind ( this ), true );
    this.addEventListener ( "onerror", this.onErrorEvent.bind ( this ), true );
    this.addEventListener ( "onload", this.onLoadEvent.bind ( this ), true );
    this.addEventListener ( "ontimeout", this.onTimeOutEvent.bind ( this ), true );
    this.addEventListener ( "onloadend", this.onLoadEndEvent.bind ( this ), true );
    
    //this.xhr.addEventListener ( "onreadystatechange", this.readyStateChange.bind ( this.readyStateChangeCallback ), true );
  }

  destroy () {
    
    this.removeEventListener ( "onloadstart", this.onLoadStartEvent.bind ( this ) );
    this.removeEventListener ( "onprogress", this.onProgressEvent.bind ( this ) );
    this.removeEventListener ( "onabort", this.onAbortEvent.bind ( this ) );
    this.removeEventListener ( "onerror", this.onErrorEvent.bind ( this ) );
    this.removeEventListener ( "onload", this.onLoadEvent.bind ( this ) );
    this.removeEventListener ( "ontimeout", this.onTimeOutEvent.bind ( this ) );
    this.removeEventListener ( "onloadend", this.onLoadEndEvent.bind ( this ) );
    
    //this.xhr.removeEventListener ( "onreadystatechange", this.readyStateChange.bind ( this.readyStateChangeCallback ) );
  }
  
  send ( method, event, url ) {

    //preparar el envio: método open
    this.open ( method, url, true );
    this.setRequestHeader ( 'X-Requested-With', 'XMLHttpRequest');
    //this.xhr.setRequestHeader ( "Content-Type", "application/x-www-form-urlencoded" );
    //this.xhr.setRequestHeader ( "Content-Type", "multipart/form-data" );
    this.setRequestHeader ( "Content-Type", "text/plain" );
    //this.xhr.onreadystatechange = this.readyStateChangeCallback ( this.xhr.readyState );

    
    super.send ( event ); //enviar
    //this.xhr.setRequestHeader ( "Content-Type", "text/html" );
    //this.xhr.setRequestHeader ( "Content-Type", "application/json" );
    //Devolver el archivo cuando éste se haya cargado
    //this.xhr.onreadystatechange = this.readyStateChange ( this.readyStateChangeCallback () );
    //this.xhr.onreadystatechange = this.readyStateChangeCallback ();
    //this.xhr.onloadstart = this.onLoadStartEvent ();
    //this.xhr.onprogress = this.onProgressEvent ();
    //this.xhr.onabort = this.onAbortEvent ();
    //this.xhr.onerror = this.onErrorEvent ();
    //this.xhr.onload = this.onLoadEvent ();
    //this.xhr.ontimeout = this.onTimeOutEvent ();
    //this.xhr.onloadend = this.onLoadEndEvent ();
  }
  
  readyStateChange ( callback ) {

    callback ( this.xhr.readyState );
  }
  
  readyStateChangeCallback ( status ) {
  //readyStateChangeCallback () {

    //console.log ( "El valor de this.xhr.readyState es: " + this.xhr.readyState );
    //console.log ( "Las cabeceras de la respuesta: " + this.xhr.getResponseHeader ( 'Content-Type' ) );
    console.log ( "El valor de status es: " + status );
    
    //if ( this.xhr.readyState == 0 ) { // request not initialized
    if ( status == 0 ) { // request not initialized 

      console.log ( "Objeto no inicializado" );
      
    //} else if ( this.xhr.readyState == 1 ) { // server connection established
    } else if ( status == 1 ) { // server connection established

      console.log ( "Estableciendo conexion" );
      
    //} else if ( this.xhr.readyState == 2 ) { // request received
    } else if ( status == 2 ) { // request received 

      console.log ( "Request recibido" );
    
    //} else if ( this.xhr.readyState == 3 ) { // processing request
    } else if ( status == 3 ) { // processing request 

      console.log ( "Procesando Request" );
      
    //} else if ( this.xhr.readyState == 4 ) { // request finished and response is ready
    } else if ( status == 4 ) { // request finished and response is ready

      console.log ( "Recibiendo y Procesando respuesta" );
      if ( this.xhr.status == 200 ) {

        console.log ( this.xhr.responseText );
        textoAjax = this.xhr.responseText;
        document.getElementById ( "responsephp" ).innerHTML = textoAjax;
        console.log ( textoAjax );

      } else {
        
        console.log ( "Que hacer en este caso" );
      }
    }
  }
  
  //The request was canceled by the call xhr.abort().
  onAbortEvent () {
    
    console.log ( "The request was canceled by the call xhr.abort()." );
  }
  
  //Connection error has occured, e.g. wrong domain name. Doesn’t happen for HTTP-errors like 404.
  onErrorEvent () {
    
    console.log ( "Connection error has occured, e.g. wrong domain name. Doesn’t happen for HTTP-errors like 404." );
  }
  
  //The request has finished (succeffully or not).
  onLoadEndEvent () {
    
    console.log ( "The request has finished (succeffully or not)." );
  }

  //The request has finished successfully.
  onLoadEvent () {
    
    console.log ( "The request has finished successfully." );
  }

  //The request has started.
  onLoadStartEvent () {
    
    console.log ( "The request has started." );
  }
  
  //A data packet of the response has arrived, the whole response body at the moment is in responseText.
  onProgressEvent () {
    
    console.log ( "A data packet of the response has arrived, the whole response body at the moment is in responseText." );
  }
  
  //The request was canceled due to timeout (only happens if it was set).
  onTimeOutEvent () {
    
    console.log ( "The request was canceled due to timeout (only happens if it was set)." );
  }
}

function sendRequest () {
  
  let ajax = new Ajax ();
  ajax.send ( "POST", null, "http://localhost/ecomod/sys/libs/common/PhpAjaxBridge.php" );
}

/*class Ajax {
tar -xjvf example.tar.bz2
  constructor () {
    
    this.xhr = null;
    if ( XMLHttpRequest ) {

      this.xhr = new XMLHttpRequest ();
      
    } else if ( ActiveXObject ) {

      try {
        
        this.xhr = new ActiveXObject ( "MSXML2.XMLHTTP" );
        
      } catch ( e ) {
        
        try {
          
          this.xhr = new ActiveXObject ( "Microsoft.XMLHTTP" );
          
        } catch ( e ) {

          // throws error log
        }
      }
    }
    if ( !this.xhr ) {
      
      console.log ( "The browser does not have support to make this type of requests to the server." );
    }
    this.xhr.onreadystatechange = this.readyStateChange ();
  }
  
  send ( method, event, url ) {

    this.xhr.open ( method, url, true );
    this.xhr.setRequestHeader ( 'X-Requested-With', 'XMLHttpRequest');
    this.xhr.setRequestHeader ( "Content-Type", "text/plain" );
    //this.xhr.onreadystatechange = this.readyStateChange ();
    this.xhr.send ( event );
  }
  
  readyStateChange () {

    if ( ( this.xhr.readyState == 4 ) && ( this.xhr.status == 200 ) ) {

      document.getElementById ( "responsePhp" ).innerHTML = this.xhr.responseText;
    }
  }
}

function sendRequest () {
  
  let ajax = new Ajax ();
  ajax.send ( "POST", null, "http://localhost/ecomod/sys/libs/common/PhpAjaxBridge.php" );
}*/


/*class Ajax {

  constructor () {

    /*
    this.xhr = false;
    try {

      this.xhr = new ActiveXObject ( "Msxml2.xhr" );

    } catch ( e ) {

      try {

        this.xhr = new ActiveXObject ( "Microsoft.xhr" );

      } catch ( E ) {

        this.xhr = false;
      }
    }
    if ( !this.xhr && typeof XMLHttpRequest != 'undefined' ) {

      this.xhr = new XMLHttpRequest ();
    }*/
    
    //this.xhr = null;
    /*let xhr = null;
    if ( XMLHttpRequest ) {
      
      //El explorador implementa la interfaz de forma nativa
      this.xhr = new XMLHttpRequest ();
      console.log ( "Se creo el objeto XMLHttpRequest" );
      
    } else if ( ActiveXObject ) {
      
      //El explorador permite crear objetos ActiveX
      try {
        
        this.xhr = new ActiveXObject ( "MSXML2.XMLHTTP" );
        console.log ( "Se creo el objeto MSXML2.XMLHTTP" );
        
      } catch ( e ) {
        
        try {
          
          this.xhr = new ActiveXObject ( "Microsoft.XMLHTTP" );
          console.log ( "Se creo el objeto Microsoft.XMLHTTP" );
          
        } catch ( e ) {}
      }
    }
    if ( !this.xhr ) {
      
      console.log ( "El navegador no tiene soporte para realizar este tipo de solicitudes al servidor." );
    }
    this.xhr.addEventListener ( "onloadstart", this.onLoadStartEvent.bind ( this ), true );
    this.xhr.addEventListener ( "onprogress", this.onProgressEvent.bind ( this ), true );
    this.xhr.addEventListener ( "onabort", this.onAbortEvent.bind ( this ), true );
    this.xhr.addEventListener ( "onerror", this.onErrorEvent.bind ( this ), true );
    this.xhr.addEventListener ( "onload", this.onLoadEvent.bind ( this ), true );
    this.xhr.addEventListener ( "ontimeout", this.onTimeOutEvent.bind ( this ), true );
    this.xhr.addEventListener ( "onloadend", this.onLoadEndEvent.bind ( this ), true );
    
    //this.xhr.addEventListener ( "onreadystatechange", this.readyStateChange.bind ( this.readyStateChangeCallback ), true );
  }

  destroy () {
    
    this.xhr.removeEventListener ( "onloadstart", this.onLoadStartEvent.bind ( this ) );
    this.xhr.removeEventListener ( "onprogress", this.onProgressEvent.bind ( this ) );
    this.xhr.removeEventListener ( "onabort", this.onAbortEvent.bind ( this ) );
    this.xhr.removeEventListener ( "onerror", this.onErrorEvent.bind ( this ) );
    this.xhr.removeEventListener ( "onload", this.onLoadEvent.bind ( this ) );
    this.xhr.removeEventListener ( "ontimeout", this.onTimeOutEvent.bind ( this ) );
    this.xhr.removeEventListener ( "onloadend", this.onLoadEndEvent.bind ( this ) );
    
    //this.xhr.removeEventListener ( "onreadystatechange", this.readyStateChange.bind ( this.readyStateChangeCallback ) );
  }
  
  send ( method, event, url ) {

    //preparar el envio: método open
    this.xhr.open ( method, url, true );
    this.xhr.setRequestHeader ( 'X-Requested-With', 'XMLHttpRequest');
    //this.xhr.setRequestHeader ( "Content-Type", "application/x-www-form-urlencoded" );
    //this.xhr.setRequestHeader ( "Content-Type", "multipart/form-data" );
    this.xhr.setRequestHeader ( "Content-Type", "text/plain" );
    //this.xhr.onreadystatechange = this.readyStateChangeCallback ( this.xhr.readyState );

    
    this.xhr.send ( event ); //enviar
    //this.xhr.setRequestHeader ( "Content-Type", "text/html" );
    //this.xhr.setRequestHeader ( "Content-Type", "application/json" );
    //Devolver el archivo cuando éste se haya cargado
    //this.xhr.onreadystatechange = this.readyStateChange ( this.readyStateChangeCallback () );
    //this.xhr.onreadystatechange = this.readyStateChangeCallback ();
    //this.xhr.onloadstart = this.onLoadStartEvent ();
    //this.xhr.onprogress = this.onProgressEvent ();
    //this.xhr.onabort = this.onAbortEvent ();
    //this.xhr.onerror = this.onErrorEvent ();
    //this.xhr.onload = this.onLoadEvent ();
    //this.xhr.ontimeout = this.onTimeOutEvent ();
    //this.xhr.onloadend = this.onLoadEndEvent ();
  }
  
  readyStateChange ( callback ) {

    callback ( this.xhr.readyState );
  }
  
  readyStateChangeCallback ( status ) {
  //readyStateChangeCallback () {

    //console.log ( "El valor de this.xhr.readyState es: " + this.xhr.readyState );
    //console.log ( "Las cabeceras de la respuesta: " + this.xhr.getResponseHeader ( 'Content-Type' ) );
    console.log ( "El valor de status es: " + status );
    
    //if ( this.xhr.readyState == 0 ) { // request not initialized
    if ( status == 0 ) { // request not initialized 

      console.log ( "Objeto no inicializado" );
      
    //} else if ( this.xhr.readyState == 1 ) { // server connection established
    } else if ( status == 1 ) { // server connection established

      console.log ( "Estableciendo conexion" );
      
    //} else if ( this.xhr.readyState == 2 ) { // request received
    } else if ( status == 2 ) { // request received 

      console.log ( "Request recibido" );
    
    //} else if ( this.xhr.readyState == 3 ) { // processing request
    } else if ( status == 3 ) { // processing request 

      console.log ( "Procesando Request" );
      
    //} else if ( this.xhr.readyState == 4 ) { // request finished and response is ready
    } else if ( status == 4 ) { // request finished and response is ready

      console.log ( "Recibiendo y Procesando respuesta" );
      if ( this.xhr.status == 200 ) {

        console.log ( this.xhr.responseText );
        textoAjax = this.xhr.responseText;
        document.getElementById ( "responsephp" ).innerHTML = textoAjax;
        console.log ( textoAjax );

      } else {
        
        console.log ( "Que hacer en este caso" );
      }
    }
  }
  
  //The request was canceled by the call xhr.abort().
  onAbortEvent () {
    
    console.log ( "The request was canceled by the call xhr.abort()." );
  }
  
  //Connection error has occured, e.g. wrong domain name. Doesn’t happen for HTTP-errors like 404.
  onErrorEvent () {
    
    console.log ( "Connection error has occured, e.g. wrong domain name. Doesn’t happen for HTTP-errors like 404." );
  }
  
  //The request has finished (succeffully or not).
  onLoadEndEvent () {
    
    console.log ( "The request has finished (succeffully or not)." );
  }

  //The request has finished successfully.
  onLoadEvent () {
    
    console.log ( "The request has finished successfully." );
  }

  //The request has started.
  onLoadStartEvent () {
    
    console.log ( "The request has started." );
  }
  
  //A data packet of the response has arrived, the whole response body at the moment is in responseText.
  onProgressEvent () {
    
    console.log ( "A data packet of the response has arrived, the whole response body at the moment is in responseText." );
  }
  
  //The request was canceled due to timeout (only happens if it was set).
  onTimeOutEvent () {
    
    console.log ( "The request was canceled due to timeout (only happens if it was set)." );
  }
}

function sendRequest () {
  
  let ajax = new Ajax ();
  ajax.send ( "POST", null, "http://localhost/ecomod/sys/libs/common/PhpAjaxBridge.php" );
}


/*function ajax () {
  var xmlhttp = false;
  try { // Para navegadores No MSIE
    xmlhttp = new ActiveXObject ( "Msxml2.XMLHTTP" );
  } catch ( e ) {
    try { // Para navegadores MSIE
      xmlhttp = new ActiveXObject ( "Microsoft.XMLHTTP" );
    } catch ( E ) {
      xmlhttp = false;
    }
  }
  if  ( !xmlhttp && typeof XMLHttpRequest != "undefined" ) {
    xmlhttp = new XMLHttpRequest ();
  }
  return xmlhttp;
};



function sendRequest () {

  var mi_ajax = ajax ();
  mi_ajax.open ( "POST", "http://localhost/ecomod/sys/libs/common/PhpAjaxBridge.php", true );
  mi_ajax.setRequestHeader ( 'X-Requested-With', 'XMLHttpRequest');
  mi_ajax.setRequestHeader ( "Content-Type", "text/plain" );
  mi_ajax.send ();
  mi_ajax.onreadystatechange = function () {

    if ( mi_ajax.readyState == 0 ) {
      
      console.log ( "ESTADO EN 0" );
    }
if ( mi_ajax.readyState == 1 ) {
      
  console.log ( "ESTADO EN 1" );
    }
if ( mi_ajax.readyState == 2 ) {
  
  console.log ( "ESTADO EN 2" );
}
if ( mi_ajax.readyState == 3 ) {
  
  console.log ( "ESTADO EN 3" );
}
    if ( mi_ajax.readyState == 4 ) {
      
      console.log ( mi_ajax.responseText );
      var textoAjax = mi_ajax.responseText;
      document.getElementById ( "responsephp" ).innerHTML = textoAjax;
    }
  };
}*/



