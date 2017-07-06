<?php

/* 
 * Demo Framework Autoloader
 * @author Zackary Boarman
 * @version 1.0
 */

//Basic Autoloader
spl_autoload_register(function ($class_name) {
    
    if (preg_match("/^[A-Za-z0-9_\-]*$/", $class_name) !== 1){
        return false;
    }
    
    $class = str_replace("_", DIRECTORY_SEPARATOR, strtolower($class_name));
    
    try {
        @include_once PUBLIC_HTML.DIRECTORY_SEPARATOR.$class . '.php';
    } catch (Exception $e) {
        return false;
    }

    
});