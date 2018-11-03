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