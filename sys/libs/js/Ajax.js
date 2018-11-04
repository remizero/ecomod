/**
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
    
	}	catch ( error ) {
	  
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