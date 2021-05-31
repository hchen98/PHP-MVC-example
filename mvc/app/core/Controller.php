<?php

class Controller 
{
    protected function model($model)
    {
        if (file_exists('../app/models/'.$model.'.php'))
        {
            require_once '../app/models/'.$model.'.php';

            // return/instantiate a new instance of that model
            return new $model();
        }
    }

    protected function view($view, $data)
    {
        // boot up the view inside ./app/views/
        // data will be automatically available for the view that we try to access
        require_once '../app/views/'.$view.'.php';
    }

    protected function indexing($view, $data)
    {
        // boot up the view inside ./public/
        require_once '../public/'.$view.'.php';
    }
}
