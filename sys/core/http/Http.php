<?php

namespace sys\core\http;

/**
 * <strong>Http</strong>
 *
 * Archivo creado el 24 de octubre de 2018 a las 08:35:15 a.m.
 * <p>Clase que define los métodos de petición del protocolo HTTP.</p>
 *
 * @name Http
 * @namespace sys\core\http
 * @package ECOMOD.
 * @subpackage CORE.
 * @filesource Http.php
 * @version 1.0
 * @since 1.0
 * @author Filiberto Zaá Avila ( remizero ) filizaa@gmail.com.
 * @copyright Todos los derechos reservados 2018.
 * @link http://www.ecosoftware.com.ve
 * @license http://www.ecosoftware.com.ve/licencia
 * @uses <ul> <li>.php</li> </ul>
 * @see .php
 * @todo <p>En futuras versiones estarán disponibles los métodos para dar soporte a:</p>
 *       <ul>
 *       <li>https://diego.com.es/rendimiento-en-php.</li>
 *       <li>.</li>
 *       <li>.</li>
 *       </ul>
 */
class Http {

  /**
   * <strong>Continue</strong>
   * El navegador puede continuar realizando su petición (se utiliza para
   * indicar que la primera parte de la petición del navegador se ha recibido
   * correctamente).​
   *
   * @var integer
   */
  const _100 = 100;

  /**
   * <strong>Switching Protocols</strong>
   * El servidor acepta el cambio de protocolo propuesto por el navegador (puede
   * ser por ejemplo un cambio de HTTP 1.0 a HTTP 1.1).​
   *
   * @var integer
   */
  const _101 = 101;

  /**
   * <strong>Processing (WebDAV - RFC 2518)</strong>
   * El servidor está procesando la petición del navegador pero todavía no ha
   * terminado (esto evita que el navegador piense que la petición se ha perdido
   * cuando no recibe ninguna respuesta).​
   *
   * @var integer
   */
  const _102 = 102;

  /**
   * <strong>Checkpoint</strong>
   * Se va a reanudar una petición POST o PUT que fue abortada previamente
   *
   * @var integer
   */
  const _103 = 103;

  /**
   * <strong>OK</strong>
   * Respuesta estándar para peticiones correctas.
   *
   * @var integer
   */
  const _200 = 200;

  /**
   * <strong>Created</strong>
   * La petición ha sido completada y ha resultado en la creación de un nuevo
   * recurso.
   *
   * @var integer
   */
  const _201 = 201;

  /**
   * <strong>Accepted</strong>
   * La petición ha sido aceptada para procesamiento, pero este no ha sido
   * completado.
   * La petición eventualmente pudiere no ser satisfecha, ya que podría ser no
   * permitida o prohibida cuando el procesamiento tenga lugar.
   *
   * @var integer
   */
  const _202 = 202;

  /**
   * <strong>Non-Authoritative Information (desde HTTP/1.1)</strong>
   * La petición se ha completado con éxito, pero su contenido no se ha obtenido
   * de la fuente originalmente solicitada sino de otro servidor.​
   *
   * @var integer
   */
  const _203 = 203;

  /**
   * <strong>No Content</strong>
   * La petición se ha completado con éxito pero su respuesta no tiene ningún
   * contenido (la respuesta puede incluir información en sus cabeceras HTTP).​
   *
   * @var integer
   */
  const _204 = 204;

  /**
   * <strong>Reset Content</strong>
   * La petición se ha completado con éxito, pero su respuesta no tiene
   * contenidos y además, el navegador tiene que inicializar la página desde la
   * que se realizó la petición (este código es útil por ejemplo para páginas
   * con formularios cuyo contenido debe borrarse después de que el usuario lo
   * envíe).
   *
   * @var integer
   */
  const _205 = 205;

  /**
   * <strong>Partial Content</strong>
   * La petición servirá parcialmente el contenido solicitado.
   * Esta característica es utilizada por herramientas de descarga como wget
   * para continuar la transferencia de descargas anteriormente interrumpidas,
   * o para dividir una descarga y procesar las partes simultáneamente.
   *
   * @var integer
   */
  const _206 = 206;

  /**
   * <strong>Multi-Status (Multi-Status, WebDAV)</strong>
   * El cuerpo del mensaje que sigue es un mensaje XML y puede contener algún
   * número de códigos de respuesta separados, dependiendo de cuántas
   * sub-peticiones sean hechas.
   *
   * @var integer
   */
  const _207 = 207;

  /**
   * <strong>Already Reported (WebDAV)</strong>
   * El listado de elementos DAV ya se notificó previamente, por lo que no se
   * van a volver a listar.
   *
   * @var integer
   */
  const _208 = 208;

  /**
   * <strong>Multiple Choices</strong>
   * Indica opciones múltiples para el URI que el cliente podría seguir.
   * Esto podría ser utilizado, por ejemplo, para presentar distintas opciones
   * de formato para video, listar archivos con distintas extensiones o word
   * sense disambiguation.
   *
   * @var integer
   */
  const _300 = 300;

  /**
   * <strong>Moved Permanently</strong>
   * Esta y todas las peticiones futuras deberían ser dirigidas a la URL dada.
   *
   * @var integer
   */
  const _301 = 301;

  /**
   * <strong>Found</strong>
   * Este es el código de redirección más popular, pero también un ejemplo de
   * las prácticas de la industria contradiciendo el estándar.
   * La especificación HTTP/1.0 (RFC 1945) requería que el cliente realizara una
   * redirección temporal (la frase descriptiva original fue "Moved
   * Temporarily"), pero los navegadores populares lo implementaron como 303 See
   * Other. Por tanto, HTTP/1.1 añadió códigos de estado 303 y 307 para eliminar
   * la ambigüedad entre ambos comportamientos. Sin embargo, la mayoría de
   * aplicaciones web y bibliotecas de desarrollo aún utilizan el código de
   * respuesta 302 como si fuera el 303.
   *
   * @var integer
   */
  const _302 = 302;

  /**
   * <strong>See Other (desde HTTP/1.1)</strong>
   * La respuesta a la petición puede ser encontrada bajo otra URI utilizando el
   * método GET.
   *
   * @var integer
   */
  const _303 = 303;

  /**
   * <strong>Not Modified</strong>
   * Indica que la petición a la URL no ha sido modificada desde que fue
   * requerida por última vez.
   * Típicamente, el cliente HTTP provee un encabezado como If-Modified-Since
   * para indicar una fecha y hora contra la cual el servidor pueda comparar. El
   * uso de este encabezado ahorra ancho de banda y reprocesamiento tanto del
   * servidor como del cliente.
   *
   * @var integer
   */
  const _304 = 304;

  /**
   * <strong>Use Proxy (desde HTTP/1.1)</strong>
   * Muchos clientes HTTP (como Mozilla3​ e Internet Explorer) no se apegan al
   * estándar al procesar respuestas con este código, principalmente por motivos
   * de seguridad.
   *
   * @var integer
   */
  const _305 = 305;

  /**
   * <strong>Switch Proxy</strong>
   * Este código se utilizaba en las versiones antiguas de HTTP pero ya no se
   * usa (aunque está reservado para usos futuros).​
   *
   * @var integer
   */
  const _306 = 306;

  /**
   * <strong>Temporary Redirect (desde HTTP/1.1)</strong>
   * Se trata de una redirección que debería haber sido hecha con otra URI, sin
   * embargo aún puede ser procesada con la URI proporcionada.
   * En contraste con el código 303, el método de la petición no debería ser
   * cambiado cuando el cliente repita la solicitud. Por ejemplo, una solicitud
   * POST tiene que ser repetida utilizando otra petición POST.
   *
   * @var integer
   */
  const _307 = 307;

  /**
   * <strong>Permanent Redirect</strong>
   * El recurso solicitado por el navegador se encuentra en otro lugar y este
   * cambio es permanente.
   * A diferencia del código 301, no se permite cambiar el método HTTP para la
   * nueva petición (así por ejemplo, si envías un formulario a un recurso que
   * ha cambiado de lugar, todo seguirá funcionando bien).
   *
   * @var integer
   */
  const _308 = 308;

  /**
   * <strong>Bad Request</strong>
   * El servidor no procesará la solicitud, porque no puede, o no debe, debido a
   * algo que es percibido como un error del cliente (ej: solicitud malformada,
   * sintaxis errónea, etc).
   * La solicitud contiene sintaxis errónea y no debería repetirse.
   *
   * @var integer
   */
  const _400 = 400;

  /**
   * <strong>Unauthorized</strong>​
   * Similar al 403 Forbidden, pero específicamente para su uso cuando la
   * autenticación es posible pero ha fallado o aún no ha sido provista.
   * Vea autenticación HTTP básica y Digest access authentication.
   *
   * @var integer
   */
  const _401 = 401;

  /**
   * <strong>Payment Required</strong>
   * La intención original era que este código pudiese ser usado como parte de
   * alguna forma o esquema de Dinero electrónico o micropagos, pero eso no
   * sucedió, y este código nunca se utilizó.
   *
   * @var integer
   */
  const _402 = 402;

  /**
   * <strong>Forbidden</strong>
   * La solicitud fue legal, pero el servidor rehúsa responderla dado que el
   * cliente no tiene los privilegios para realizarla.
   * En contraste a una respuesta 401 No autorizado, autenticarse previamente no
   * va a cambiar la respuesta.
   *
   * @var integer
   */
  const _403 = 403;

  /**
   * <strong>Not Found</strong>
   * Recurso no encontrado.
   * Se utiliza cuando el servidor web no encuentra la página o recurso
   * solicitado.
   *
   * @var integer
   */
  const _404 = 404;

  /**
   * <strong>Method Not Allowed</strong>
   * Una petición fue hecha a una URI utilizando un método de solicitud no
   * soportado por dicha URI; por ejemplo, cuando se utiliza GET en un
   * formulario que requiere que los datos sean presentados vía POST, o
   * utilizando PUT en un recurso de solo lectura.
   *
   * @var integer
   */
  const _405 = 405;

  /**
   * <strong>Not Acceptable</strong>
   * El servidor no es capaz de devolver los datos en ninguno de los formatos
   * aceptados por el cliente, indicados por éste en la cabecera "Accept" de la
   * petición.
   *
   * @var integer
   */
  const _406 = 406;

  /**
   * <strong>Proxy Authentication Required</strong>
   *
   * @var integer
   */
  const _407 = 407;

  /**
   * <strong>Request Timeout</strong>
   * El cliente falló al continuar la petición - excepto durante la ejecución de
   * videos Adobe Flash cuando solo significa que el usuario cerró la ventana de
   * video o se movió a otro.
   * ref
   *
   * @var integer
   */
  const _408 = 408;

  /**
   * <strong>Conflict</strong>
   * Indica que la solicitud no pudo ser procesada debido a un conflicto con el
   * estado actual del recurso que esta identifica.
   *
   * @var integer
   */
  const _409 = 409;

  /**
   * <strong>Gone</strong>
   * Indica que el recurso solicitado ya no está disponible y no lo estará de
   * nuevo.
   * Debería ser utilizado cuando un recurso ha sido quitado de forma permanente.
   * Si un cliente recibe este código no debería volver a solicitar el recurso
   * en el futuro. Por ejemplo un buscador lo eliminará de sus índices y lo hará
   * más rápidamente que utilizando un código 404.
   *
   * @var integer
   */
  const _410 = 410;

  /**
   * <strong>Length Required</strong>
   * El servidor rechaza la petición del navegador porque no incluye la cabecera
   * Content-Length adecuada.​
   *
   * @var integer
   */
  const _411 = 411;

  /**
   * <strong>Precondition Failed</strong>
   * El servidor no es capaz de cumplir con algunas de las condiciones impuestas
   * por el navegador en su petición.​
   *
   * @var integer
   */
  const _412 = 412;

  /**
   * <strong>Request Entity Too Large</strong>
   * La petición del navegador es demasiado grande y por ese motivo el servidor
   * no la procesa.
   *
   * @var integer
   */
  const _413 = 413;

  /**
   * <strong>Request-URI Too Long</strong>
   * La URI de la petición del navegador es demasiado grande y por ese motivo el
   * servidor no la procesa (esta condición se produce en muy raras ocasiones y
   * casi siempre porque el navegador envía como GET una petición que debería
   * ser POST).
   *
   * @var integer
   */
  const _414 = 414;

  /**
   * <strong>Unsupported Media Type</strong>
   * La petición del navegador tiene un formato que no entiende el servidor y
   * por eso no se procesa.​
   *
   * @var integer
   */
  const _415 = 415;

  /**
   * <strong>Requested Range Not Satisfiable</strong>
   * El cliente ha preguntado por una parte de un archivo, pero el servidor no
   * puede proporcionar esa parte, por ejemplo, si el cliente preguntó por una
   * parte de un archivo que está más allá de los límites del fin del archivo.
   *
   * @var integer
   */
  const _416 = 416;

  /**
   * <strong>Expectation Failed</strong>
   * La petición del navegador no se procesa porque el servidor no es capaz de
   * cumplir con los requerimientos de la cabecera Expect de la petición.​
   *
   * @var integer
   */
  const _417 = 417;

  /**
   * <strong>I'm a teapot</strong>
   * "Soy una tetera".
   * Este código fue definido en 1998 como una inocentada, en el Protocolo de
   * Transmisión de Hipertexto de Cafeteras (RFC-2324). No se espera que los
   * servidores web implementen realmente este código de error, pero es posible
   * encontrar sitios que devuelvan este código HTTP.
   *
   * @var integer
   */
  const _418 = 418;

  /**
   * <strong>Unprocessable Entity (WebDAV - RFC 4918)</strong>
   * La solicitud está bien formada pero fue imposible seguirla debido a errores
   * semánticos.
   *
   * @var integer
   */
  const _422 = 422;

  /**
   * <strong>Locked (WebDAV - RFC 4918)</strong>
   * El recurso al que se está teniendo acceso está bloqueado.
   *
   * @var integer
   */
  const _423 = 423;

  /**
   * <strong>Failed Dependency (WebDAV) (RFC 4918)</strong>
   * La solicitud falló debido a una falla en la solicitud previa.
   *
   * @var integer
   */
  const _424 = 424;

  /**
   * <strong>Unassigned</strong>
   * Definido en los drafts de WebDav Advanced Collections, pero no está
   * presente en "Web Distributed Authoring and Versioning (WebDAV) Ordered
   * Collections Protocol" (RFC 3648).
   *
   * @var integer
   */
  const _425 = 425;

  /**
   * <strong>Upgrade Required (RFC 7231)</strong>
   * El cliente debería cambiarse a TLS/1.0.
   *
   * @var integer
   */
  const _426 = 426;

  /**
   * <strong>Precondition Required</strong>
   * El servidor requiere que la petición del navegador sea condicional (este
   * tipo de peticiones evitan los problemas producidos al modificar con PUT un
   * recurso que ha sido modificado por otra parte).​
   *
   * @var integer
   */
  const _428 = 428;

  /**
   * <strong>Too Many Requests</strong>
   * Hay muchas conexiones desde esta dirección de internet.
   *
   * @var integer
   */
  const _429 = 429;

  /**
   * <strong>Request Header Fields Too Large)</strong>
   * El servidor no puede procesar la petición porque una de las cabeceras de la
   * petición es demasiado grande.
   * Este error también se produce cuando la suma del tamaño de todas las
   * peticiones es demasiado grande.
   *
   * @var integer
   */
  const _431 = 431;

  /**
   * Una extensión de Microsoft: La petición debería ser reintentada después de
   * hacer la acción apropiada.
   *
   * @var integer
   */
  const _449 = 449;

  /**
   * <strong>Unavailable for Legal Reasons</strong>
   * El contenido ha sido eliminado como consecuencia de una orden judicial o
   * sentencia emitida por un tribunal.
   *
   * @var integer
   */
  const _451 = 451;

  /**
   * <strong>Internal Server Error</strong>
   * Es un código comúnmente emitido por aplicaciones empotradas en servidores
   * web, mismas que generan contenido dinámicamente, por ejemplo aplicaciones
   * montadas en IIS o Tomcat, cuando se encuentran con situaciones de error
   * ajenas a la naturaleza del servidor web.
   *
   * @var integer
   */
  const _500 = 500;

  /**
   * <strong>Not Implemented</strong>
   * El servidor no soporta alguna funcionalidad necesaria para responder a la
   * solicitud del navegador (como por ejemplo el método utilizado para la
   * petición).
   *
   * @var integer
   */
  const _501 = 501;

  /**
   * <strong>Bad Gateway</strong>
   * El servidor está actuando de proxy o gateway y ha recibido una respuesta
   * inválida del otro servidor, por lo que no puede responder adecuadamente a
   * la petición del navegador.
   *
   * @var integer
   */
  const _502 = 502;

  /**
   * <strong>Service Unavailable</strong>
   * El servidor no puede responder a la petición del navegador porque está
   * congestionado o está realizando tareas de mantenimiento.
   *
   * @var integer
   */
  const _503 = 503;

  /**
   * <strong>Gateway Timeout</strong>
   * El servidor está actuando de proxy o gateway y no ha recibido a tiempo una
   * respuesta del otro servidor, por lo que no puede responder adecuadamente a
   * la petición del navegador.
   *
   * @var integer
   */
  const _504 = 504;

  /**
   * <strong>HTTP Version Not Supported</strong>
   * El servidor no soporta o no quiere soportar la versión del protocolo HTTP
   * utilizada en la petición del navegador.​
   *
   * @var integer
   */
  const _505 = 505;

  /**
   * <strong>Variant Also Negotiates (RFC 2295)</strong>
   * El servidor ha detectado una referencia circular al procesar la parte de la
   * negociación del contenido de la petición.
   *
   * @var integer
   */
  const _506 = 506;

  /**
   * <strong>Insufficient Storage (WebDAV - RFC 4918)</strong>
   * El servidor no puede crear o modificar el recurso solicitado porque no hay
   * suficiente espacio de almacenamiento libre.
   *
   * @var integer
   */
  const _507 = 507;

  /**
   * <strong>Loop Detected (WebDAV)</strong>
   * La petición no se puede procesar porque el servidor ha encontrado un bucle
   * infinito al intentar procesarla.
   *
   * @var integer
   */
  const _508 = 508;

  /**
   * <strong>Bandwidth Limit Exceeded</strong>
   * Límite de ancho de banda excedido.
   * Este código de estatus, a pesar de ser utilizado por muchos servidores, no
   * es oficial.
   *
   * @var integer
   */
  const _509 = 509;

  /**
   * <strong>Not Extended (RFC 2774)</strong>
   * La petición del navegador debe añadir más extensiones para que el servidor
   * pueda procesarla.
   *
   * @var integer
   */
  const _510 = 510;

  /**
   * <strong>Network Authentication Required</strong>
   * El navegador debe autenticarse para poder realizar peticiones (se utiliza
   * por ejemplo con los portales cautivos que te obligan a autenticarte antes
   * de empezar a navegar).
   *
   * @var integer
   */
  const _511 = 511;

  /**
   * <strong>Not updated</strong>
   * Este error prácticamente es inexistente en la red, pero indica que el
   * servidor está en una operación de actualizado y no puede tener conexión.
   *
   * @var integer
   */
  const _512 = 512;

  /**
   * <strong>Version Mismatch</strong>
   * Este error sale cuando la version no es compatible con tu hardware
   *
   * @var integer
   */
  const _521 = 521;

  /**
   * Se utiliza para saber si se tiene acceso a un host, no necesariamente la
   * petición llega al servidor, este método se utiliza principalmente para
   * saber si un proxy nos da acceso a un host bajo condiciones especiales, como
   * por ejemplo "corrientes" de datos bidireccionales encriptadas (como lo
   * requiere SSL).
   *
   * @var string
   */
  const CONNECT = "CONNECT";

  /**
   * El método COPY crea un duplicado del recurso de origen, identificado por el
   * URI de solicitud, en el recurso de destino, identificado por el URI en el
   * encabezado de destino.
   * El encabezado de destino DEBE estar presente. El comportamiento exacto del
   * método COPY depende del tipo de recurso fuente. Todos los recursos
   * compatibles con WebDAV DEBEN soportar el método COPY. Sin embargo, la
   * compatibilidad con el método COPY no garantiza la capacidad de copiar un
   * recurso. Por ejemplo, programas separados pueden controlar recursos en el
   * mismo servidor. Como resultado, puede que no sea posible copiar un recurso
   * en una ubicación que parece estar en el mismo servidor.
   *
   * @var string
   */
  const COPY = "COPY";

  /**
   * Borra el recurso especificado.
   *
   * @var string
   */
  const DELETE = "DELETE";

  /**
   * Solicita una representación del recurso especificado.
   * Estas solicitudes solo deben recuperar datos y no deben tener ningún otro
   * efecto.
   *
   * @var string
   */
  const GET = "GET";

  /**
   * Pide una respuesta idéntica a la que correspondería a una petición GET,
   * pero en la respuesta no se devuelve el cuerpo.
   * Útil para poder recuperar los metadatos de los encabezados de respuesta,
   * sin tener que transportar todo el contenido.
   *
   * @var string
   */
  const HEAD = "HEAD";

  /**
   * @var string
   */
  const LABEL = "LABEL";

  /**
   * El método LOCK, que se utiliza para eliminar un bloqueo de cualquier tipo
   * de acceso.
   * Cualquier recurso que admita el método LOCK DEBE, como mínimo, admitir los
   * formatos de solicitud y respuesta XML definidos en RFC 2518.
   *
   * @var string
   */
  const LOCK = "LOCK";

  /**
   * @var string
   */
  const MERGE = "MERGE";

  /**
   * Crea un nuevo recurso de recopilación en la ubicación especificada por el
   * URI de solicitud.
   * Cuando la operación MKCOL crea un nuevo recurso de colección, todos los
   * ancestros DEBEN existir, o el método DEBE fallar con un código de estado
   * 409 (Conflicto). Por ejemplo, si se realiza una solicitud para crear una
   * colección /a/b/c/d/ y no existe /a/b/ ni /a/b/c/, la solicitud debe fallar.
   *
   * @var string
   */
  const MKCOL = "MKCOL";

  /**
   * La operación MOVE en un recurso que no es de recopilación es el equivalente
   * lógico de una copia (COPY), seguido de un proceso de mantenimiento de
   * coherencia, seguido de una eliminación de la fuente, donde las tres
   * acciones se realizan atómicamente.
   * El paso de mantenimiento de coherencia permite que el servidor realice
   * actualizaciones causadas por el movimiento, como actualizar todos los URI
   * que no sean el URI de solicitud que identifican el recurso de origen, para
   * apuntar al nuevo recurso de destino.
   *
   * En consecuencia, el encabezado de destino DEBE estar presente en todos los
   * métodos MOVE y DEBE seguir todos los requisitos de COPIA para la parte COPY
   * del método MOVE. Todos los recursos compatibles con DAV DEBEN soportar el
   * método MOVE. Sin embargo, la compatibilidad con el método MOVE no garantiza
   * la capacidad de mover un recurso a un destino particular.
   *
   * Por ejemplo, los programas separados pueden controlar diferentes conjuntos
   * de recursos en el mismo servidor. Por lo tanto, es posible que no sea
   * posible mover un recurso dentro de un espacio de nombres que parece
   * pertenecer al mismo servidor.
   *
   * Si existe un recurso en el destino, el recurso de destino se ELIMINARÁ como
   * efecto secundario de la operación MOVER, sujeto a las restricciones del
   * encabezado Sobrescribir.
   *
   * @var string
   */
  const MOVE = "MOVE";

  /**
   * Devuelve los métodos HTTP que el servidor soporta para un URL específico.
   * Esto puede ser utilizado para comprobar la funcionalidad de un servidor web
   * mediante petición en lugar de un recurso específico.
   *
   * @var string
   */
  const OPTIONS = "OPTIONS";

  /**
   * Su función es la misma que PUT, el cual sobreescribe completamente un
   * recurso.
   * Se utiliza para actualizar, de manera parcial una o varias partes. Está
   * orientado también para el uso con proxy.
   *
   * @var string
   */
  const PATCH = "PATCH";

  /**
   * Envía los datos para que sean procesados por el recurso identificado.
   * Los datos se incluirán en el cuerpo de la petición. Esto puede resultar en
   * la creación de un nuevo recurso o de las actualizaciones de los recursos
   * existentes o ambas cosas.
   *
   * @var string
   */
  const POST = "POST";

  /**
   * El método PROPFIND recupera las propiedades definidas en el recurso
   * identificado por el URI de solicitud, si el recurso no tiene ningún miembro
   * interno, o en el recurso identificado por el URI de solicitud y
   * potencialmente sus recursos miembros, si el recurso es una colección que
   * tiene URI de miembros internos. Todos los recursos compatibles con DAV
   * DEBEN soportar el método PROPFIND y el elemento XML propfind junto con
   * todos los elementos XML definidos para su uso con ese elemento.
   *
   * @var string
   */
  const PROPFIND = "PROPFIND";

  /**
   * El método PROPPATCH procesa las instrucciones especificadas en el cuerpo de
   * la solicitud para establecer y/o eliminar propiedades definidas en el
   * recurso identificado por el URI de solicitud.
   *
   * @var string
   */
  const PROPPATCH = "PROPPATCH";

  /**
   * Un PUT realizado en un recurso existente que reemplaza la entidad de
   * respuesta GET del recurso.
   * Las propiedades definidas en el recurso pueden ser recalculadas durante el
   * procesamiento PUT pero no se ven afectadas de otra manera. Por ejemplo, si
   * un servidor reconoce el tipo de contenido del cuerpo de la solicitud, puede
   * extraer automáticamente información que podría exponerse de manera rentable
   * como propiedades.
   * Un PUT que resultaría en la creación de un recurso sin una colección
   * principal con el alcance adecuado DEBE fallar con un código 409.
   *
   * Como se define en la especificación HTTP/1.1 [RFC2068], el "método PUT
   * solicita que la entidad adjunta se almacene bajo el URI de solicitud
   * suministrado". Dado que el envío de una entidad que representa una
   * colección codificaría implícitamente la creación y eliminación de recursos,
   * esta especificación intencionalmente no define un formato de transmisión
   * para crear una colección usando PUT. En cambio, el método MKCOL se define
   * para crear colecciones.
   * Cuando la operación PUT crea un nuevo recurso que no es de colección, todos
   * los ancestros DEBEN existir. Si no existen todos los antepasados, el método
   * DEBE fallar con un código de estado 409 (Conflicto). Por ejemplo, si se va
   * a crear el recurso /a/b/c/d.html y /a/b/c/ no existe, la solicitud debe
   * fallar.
   *
   * @var string
   */
  const PUT = "PUT";

  /**
   * El método SEARCH inicia una búsqueda del lado del servidor.
   * El cuerpo de la solicitud define la consulta. El servidor DEBE emitir una
   * entidad que coincida con el formato de estado múltiple de WebDAV. El método
   * SEARCH desempeña el papel de mecanismo de transporte para la consulta y el
   * conjunto de resultados. No define la semántica de la consulta. El tipo de
   * consulta define la semántica. El método SEARCH es un método seguro; no
   * tiene ningún significado que no sea ejecutar una consulta y devolver un
   * resultado de consulta.
   *
   * @var string
   */
  const SEARCH = "SEARCH";

  /**
   * Este método solicita al servidor que introduzca en la respuesta todos los
   * datos que reciba en el mensaje de petición.
   * Se utiliza con fines de depuración y diagnóstico ya que el cliente puede
   * ver lo que llega al servidor y de esta forma ver todo lo que añaden al
   * mensaje los servidores intermedios.
   *
   * @var string
   */
  const TRACE = "TRACE";

  /**
   * El método UNLOCK elimina el bloqueo identificado por el token de bloqueo en
   * el encabezado de solicitud Lock-Token del Request-URI, y todos los demás
   * recursos incluidos en el bloqueo.
   * Si todos los recursos que se han bloqueado bajo el token de bloqueo enviado
   * no se pueden desbloquear, entonces la solicitud UNLOCK DEBE fallar.
   *
   * @var string
   */
  const UNLOCK = "UNLOCK";

  /**
   * @var string
   */
  const UPDATE = "UPDATE";

  /**
   */
  public function __construct () {

    // TODO - Insert your code here
  }
}
