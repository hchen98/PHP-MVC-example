<?php

class Index extends Controller
{

    protected $client;

    public function __construct()
    {
        $this->client = $this->model('Client');
    }

    public function init($p1 = '', $p2 = '')
    {
        // echo $p1 . ' ' . $p2;

        // refer to the model method that we define in Controller class
        // $client = $this->model('Client');
        $client = $this->client;
        $client->name = $p1;
        // echo $client->name;

        // provide the dir path to the view
        $this->view('index', ['name' => $client->name]);

        $db = $client->getSingleRecord("SELECT * FROM `demo` WHERE id_country = :p1 OR id_country = :p2", ["p1" => "CA", "p2" => "UK"]);
        echo "<br>";
        print_r($db);
    }
}
