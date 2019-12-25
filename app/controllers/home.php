<?php

class Home extends Controller{

  // Note, below are controller methods
  public function index($name = ''){
   $user = $this->model('User');
   $user->name = $name;

   $this->view('home/index', ['name' => $user->name]);
   // NOTE: "home/index" has no relation with the url! This is just simply provide directory path of the php file
   // NOTE: ['name' => $user->name] is came from model
  }

  public function test(){
    echo "test";
  }

}