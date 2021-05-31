<?php
// this class is going to be called and create a new instance
// for every time the user acceesses the site
// therefore, this file acts as routing for the application
class App
{

    // default controller and method for the user to land the site
    protected $controller = "index";
    protected $method = "init";

    protected $params = array();

    public function __construct()
    {
        // print_r($this->parseURL());
        $url = $this->parseURL();

        // print_r($url);

        // if (isset($_POST['name']) && isset($_POST['email'])) {
        //     echo "This is POST DATA:<br>" . $_POST['name'] . " " . $_POST['email'];
        //     echo "<br>";
        // }

        // if the controller of the routing ever exist, then display that controller
        if (isset($url[0])) {
            if (file_exists('../app/controllers/' . $url[0] . '.php')) {
                $this->controller = $url[0];
                // unset so that params are able to pass to the controller
                unset($url[0]);
            } else {
                header("HTTP/1.0 404 Not Found");
                die("<center><h1>404 File not found</h1><br><p>Code: X0A1</p></center>");
            }
        }

        require_once '../app/controllers/' . $this->controller . '.php';
        // echo $this->controller;

        // create obj of that controller
        $this->controller = new $this->controller;

        // var_dump($this->controller);

        // now check if a method exists within the controller
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                // unset so that params are able to pass to the controller
                unset($url[1]);
            } else {
                header("HTTP/1.0 404 Not Found");
                die("<center><h1>404 File not found</h1><br><p>Code: X0B1</p></center>");
            }
        }

        // print_r($url);

        $request_type = ($_SERVER["REQUEST_METHOD"] == "POST") ? true : false;
        if ($request_type) {
            $this->params = $this->parsePOST();
        } else {
            // rebase the params from the URL
            $this->params = $url ? array_values($url) : [];
        }

        // print_r($this->params);

        // call the controller's method and pass params if any
        call_user_func_array([$this->controller, $this->method], $this->params);
    }


    protected function parseURL()
    {
        // URL routing
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }


    protected function parsePOST()
    {
        // POST data
        if (!empty($_POST)) {
            return filter_var_array($_POST, FILTER_SANITIZE_STRING);
        } else {
            return [];
        }
    }
}
