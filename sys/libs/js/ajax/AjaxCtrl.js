/**
 * 
 */
import Ajax from './Ajax.js';

function init () {
  
  var btn = document.getElementById ( "ajaxBtn" );
  btn.addEventListener ( "click", () => { console.log ( "in ok_click" ); sendRequest ( document ) } );
}

function callback ( document, response ) {
  
  /**
   * ESTA FUNCIÓN SERÁ QUIEN PERMITA GENERAR LA SALIDA CORRESPONDIENTE A LA
   * VISTA DONDE Y CUANDO SE NECESITE.
   * 
   * ESTA FUNCIÓN NO DEBE ESTAR EN EL MISMO ARCHIVO DE LA CLASE AJAX.
   * 
   * COMO HACER CUANDO HAY QUE HACER VARIOS LLAMADOS AJAX Y EL COMPORTAMIENTO ES
   * DIFERENTE EN CADA CASO?
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
   * 
   * COMO HACER CUANDO HAY QUE HACER VARIOS LLAMADOS AJAX Y EL COMPORTAMIENTO ES
   * DIFERENTE EN CADA CASO?
   */
  let ajax = new Ajax ( document, Ajax.HEADERS.JSON, Ajax.RESPONSETYPEENUM.JSON, callback );
  ajax.send ( "POST", "http://localhost/ecomod/sys/libs/common/PhpAjaxBridge.php" );
}

function showHideContainer ( id ) {
  
  if ( document.getElementById ) { //se obtiene el id
  
    var el = document.getElementById ( id ); //se define la variable "el" igual a nuestro div
  
    el.style.display = ( el.style.display == 'none' ) ? 'block' : 'none'; //damos un atributo display:none que oculta el div
  }
}

window.onload = function () {/*hace que se cargue la función lo que predetermina que div estará oculto hasta llamar a la función nuevamente*/

  init ();
  showHideContainer ( 'contenido' );/* "contenido_a_mostrar" es el nombre que le dimos al DIV */
}

export { callback, sendRequest, showHideContainer };