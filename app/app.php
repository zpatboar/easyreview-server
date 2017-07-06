<?php

/* 
 * EasyReview App Init
 * @author Zackary Boarman
 * @version 1.0
 */

class App{
    static $path;
    
    static function init(){
        $app = new App();
        $apppathraw = filter_input(INPUT_GET, "apppath", FILTER_SANITIZE_STRING);
        if ($apppathraw == FALSE || $apppathraw == NULL || $apppathraw == ""){
            $apppathraw = 'dashboard';
        }
        
        self::$path = @explode("/", $apppathraw);
        if(!class_exists("App_Controllers_".self::$path[0])){
            echo "Component not found";
            return false;
        }
        
        $app->load_component();
    }
    
    private function load_component(){
        $class = "App_Controllers_".self::$path[0];
        if(class_exists($class)){
            $class = new $class;
            if ($class instanceof App_Controller){
                $class->route_path();
                return true;
            }
        }
        return false;
    }
}