<?php

class App{

  /**
   * first, the app will check the controller; if it exists, then assign the url to the correct controller
   *    Normally, this is fall under $url[0]; unset url[0] when done
   * second, the app will check the method; if it exists, then do something
   *    Normally, this is fall under $url[1]; unset url[1] when done
  */

  protected $controller = "home";
  protected $method = "index";
  protected $params = [];

  public function __construct(){
    $url = $this->parseUrl();

    if(file_exists('../app/controllers/' . $url[0] . '.php')){
      // check if the file exist or not
      $this->controller = $url[0];
      unset($url[0]);
    }

    // immediately require the controller
    require_once '../app/controllers/' . $this->controller . '.php';

    $this->controller = new $this->controller;

    if(isset($url[1])){
      if(method_exists($this->controller, $url[1])){
        // if the method exists, do something here
        $this->method = $url[1];
        unset($url[0]);
      }
    }

    $this->params = $url ? array_values($url) : [];
    // rebase the parameter if there's any value, otherwise empty array

    call_user_func_array([$this->controller, $this->method], $this->params);
  }

  // it is better to have this to be protected
  public function parseUrl(){
    /**
     * security check in this function
    */

    if(isset($_GET["url"])){
      return $url = explode('/', filter_var(rtrim($_GET["url"], '/'), FILTER_SANITIZE_URL));
    }

  }
}