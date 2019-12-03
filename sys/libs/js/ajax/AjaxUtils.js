
"use strict";

/**
 * 
 */
export default class AjaxUtils {
  
  constructor () {}
  
  static arrayBuffer ( arrayBuffer ) {
    
    /**
     * Para poder recibir un arrayBuffer desde PHP este debe ser enviado como un
     * JSON. La razón de esta peculiaridad es por que se debe saber el tamaño del
     * arrayBuffer para poder crear el objeto ArrayBuffer, es decir, para poder 
     * crear una instancia de la siguiente forma
     *          var ab = new ArrayBuffer ( 100 );
     * Donde 100 debe ser un atributo contenido en el JSON recibido llamado lenght
     * 
     * 
     * https://stackoverflow.com/questions/11301254/accessing-arraybuffer-from-php-post-after-xmlhttprequest-send
     * https://codeday.me/es/qa/20190315/316301.html
     * https://stackoverflow.com/questions/26764192/sending-an-arraybuffer-in-php-through-javascript-xhr2-object
     * 
     * 
     * Para el manejo de imágenes PNG hacer uso de la siguiente librería
     * https://github.com/devongovett/png.js/
     * 
     */
    return null;
  }
}