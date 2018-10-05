<?php
namespace pruebas;

use sys\core\Controller;

/**
 *
 * @author remizero
 *        
 */
class Index extends Controller {

  /**
   *
   * @once
   * @protected
   */
  public function init () {

    echo "init";
  }

  /**
   *
   * @protected
   */
  public function authenticate () {

    echo "authenticate";
  }

  /**
   *
   * @before init, authenticate, init
   * @after notify
   */
  public function home () {

    echo "hello world!";
  }

  /**
   *
   * @protected
   */
  public function notify () {

    echo "notify";
  }
}

