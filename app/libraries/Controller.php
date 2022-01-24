<?php
class Controller{



    public function model($model)
    {
//          require model
        require_once '../app/models/'.$model.'.php';
//          return instants model
        return new $model;
    }

    public function view($view , $data = [])
    {
//          check and load view whit data
        if (file_exists('../app/views/'.$view.'.php')){
            require_once '../app/views/' . $view . '.php';
        }else{
            die('View does not exist');
        }
    }
}