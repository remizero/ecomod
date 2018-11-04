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
 * PROPIEDADES DEL OBJETO XMLHttpRequest
 * Propiedad            Descripción
 * onreadystatechange   Evento que se dispara con cada cambio de estado.
 * onabort              (Level 2) Evento que se dispara al abortar la operación.
 * onload               (Level 2) Evento que se dispara al completar la carga.
 * onloadstart          (Level 2) Evento que se dispara al iniciar la carga.
 * onprogress           (Level 2) Evento que se dispara periódicamente con información de estado.
 * 
 * 
 */
class Ajax {

  constructor () {
    
    this.xmlhttp = false;
    try {

      this.xmlhttp = new ActiveXObject ( "Msxml2.XMLHTTP" );

    } catch ( e ) {

      try {

        this.xmlhttp = new ActiveXObject ( "Microsoft.XMLHTTP" );

      } catch ( E ) {

        this.xmlhttp = false;
      }
    }
    if ( !this.xmlhttp && typeof XMLHttpRequest != 'undefined' ) {

      this.xmlhttp = new XMLHttpRequest ();
    }
  }
  
  // PARA UTILIZAR
  // https://es.stackoverflow.com/questions/138528/cómo-llamar-a-una-función-concreta-de-php-desde-ajax
  // https://magmax.org/blog/ajax-principios-basicos/
  // https://www.clubdelphi.com/foros/showthread.php?t=38993
  // http://clubdelpra.cluster003.ovh.net/foros/showthread.php?p=176522&langid=1
  // https://xhr.spec.whatwg.org/
  // https://xhr.spec.whatwg.org/#security-considerations
  // https://es.wikipedia.org/wiki/AJAX
  // https://es.wikipedia.org/wiki/XMLHttpRequest
  // 
  // https://librosweb.es/libro/ajax/capitulo_7/la_primera_aplicacion.html
  // http://www.forosdelweb.com/f68/poo-con-ajax-gran-duda-726880/
  // https://www.phpclasses.org/browse/file/11788.html
  // 
}

function isValidJson ( json ) {
  
  // https://es.stackoverflow.com/questions/133325/validar-un-json-e-imprimirlo-formateado
  try {
    
    objJson = JSON.parse ( json );
    //console.log ( 'Sintaxis Correcta' );
    
  } catch ( error ) {
    
    return false;
    /*if ( error instanceof SyntaxError ) {
      
      let mensaje = error.message;
      console.log ( 'ERROR EN LA SINTAXIS:', mensaje );
        
    } else {
      
      throw error; // si es otro error, que lo siga lanzando
    }*/
  }
  return true;
}




function objetoAjax () {

  var xmlhttp = false;
  try {

    xmlhttp = new ActiveXObject ( "Msxml2.XMLHTTP" );

  } catch ( e ) {

    try {

      xmlhttp = new ActiveXObject ( "Microsoft.XMLHTTP" );

    } catch ( E ) {

      xmlhttp = false;
    }
  }
  if ( !xmlhttp && typeof XMLHttpRequest != 'undefined' ) {

    xmlhttp = new XMLHttpRequest ();
  }
  return xmlhttp;
}
