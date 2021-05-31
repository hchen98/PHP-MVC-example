<?php

class Contact extends Controller
{
    protected $contacters;

    public function __construct()
    {
        $this->contacters = $this->model('Contacters');
    }


    public function init()
    {
        // provide the dir path to the view
        $this->indexing('contact', []);
    }


    public function test($p1 = '', $p2 = '')
    {
        // echo $p1 . ' ' . $p2;

        // refer to the model method that we define in Controller class
        // $contacters = $this->model('Contact');
        $contacters = $this->contacters;
        $contacters->name = $p1;
        // echo $contacters->name;

        // provide the dir path to the view
        $this->view('contact', ['name' => $contacters->name]);

        // $db = $contacters->getSingleRecord("SELECT * FROM `demo` WHERE id_country = :p1 OR id_country = :p2", ["p1"=>"CA", "p2"=>"UK"]);
        // echo "<br>";
        // print_r($db);

    }


    public function results($p1 = '', $p2 = '')
    {
        // get POST data and then insert into db
        $contacters = $this->contacters;
        $contacters->name = $p1;
        $contacters->email = $p2;

        $contacters::insertContact("INSERT INTO `contacts`(`name`, `email`, `createdAt`) VALUES (:p1,:p2,NOW())", ["p1"=>$p1, "p2"=>$p2]);
        $this->view('contact', ['name' => $contacters->name, 'email' => $contacters->email]);
    }
}
