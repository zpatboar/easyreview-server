<?php

/* 
 * Demo Framework Controller Base Class
 * @author Zackary Boarman
 * @version 1.0
 */

class App_Controller{
    public function route_path(){
        $method = App::$path[1];
        if ($method == ""){
            $method = "home";
        }
        if (method_exists($this,$method)){
            $this->$method();
        }
    }
    
    protected function load_view($view, $data = array()){
        ob_start();
        require_once __DIR__.DIRECTORY_SEPARATOR."view".DIRECTORY_SEPARATOR.$view.".php";
        return ob_get_clean();
    }
}

