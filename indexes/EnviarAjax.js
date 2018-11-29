
function enviar () {
  
  let ajax = new Ajax ();
  ajax.send ( "POST", null, "sys/libs/common/PhpAjaxBridge.php" );
}
