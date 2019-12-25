<?php

class Controller{

  // to be protected function
  public function model($model){
    // model check is needed!
    require_once '../app/models/' . $model . '.php';
    return new $model();
  }

  // load the view
  public function view($view, $data = []){
    /**
     * first para pass the view, sec para pass the data
     * $data is an empty arr coz something we might not pass data to view
    */

    require_once '../app/views/' . $view . '.php';
    // NOTE: the var $data will automatically available for this view coz we passed with through this func
  }
}