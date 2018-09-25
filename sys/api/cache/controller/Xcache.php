<?php
namespace sys\api\cache\controller;

use sys\api\cache\core\CacheAbs;

/**
 *
 * @author remizero
 *        
 */
class Xcache extends CacheAbs {
  
  /**
   * Constructor de la clase; inicializa los valores por omisión de la clase.
   *
   * @param array $options
   *
   * @return void
   */
  public function __construct ( array $options = array () ) {
    
    parent::__construct ( $options );
  }

  /**
   * (non-PHPdoc)
   *
   * @see \sys\api\cache\core\CacheAbs::disconnect()
   */
  public function disconnect () {

    // TODO - Insert your code here
  }

  /**
   * (non-PHPdoc)
   *
   * @see \sys\api\cache\core\CacheAbs::erase()
   */
  public function erase ( $key ) {

    // TODO - Insert your code here
  }

  /**
   * (non-PHPdoc)
   *
   * @see \sys\api\cache\core\CacheAbs::set()
   */
  public function set ( $key, $value, $duration = 120 ) {

    // TODO - Insert your code here
  }

  /**
   * (non-PHPdoc)
   *
   * @see \sys\api\cache\core\CacheAbs::get()
   */
  public function get ( $key, $default = null ) {

    // TODO - Insert your code here
  }

  /**
   * (non-PHPdoc)
   *
   * @see \sys\api\cache\core\CacheAbs::isValidService()
   */
  public function isValidService () {

    // TODO - Insert your code here
  }

  /**
   * (non-PHPdoc)
   *
   * @see \sys\api\cache\core\CacheAbs::connect()
   */
  public function connect () {

    // TODO - Insert your code here
  }

  /**
   */
  function __destruct () {

    // TODO - Insert your code here
  }
}

