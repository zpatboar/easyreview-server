<?php

/* 
 * Demo Framework Template Helper
 * @author Zackary Boarman
 * @version 1.0
 */

class Sys_Template{
    static $instant = null;
    private $title, $content;
    
    //See getTemplate to see why this is private
    private function __construct() {
        return $this;
    }
    
    //I only want one instant of this class at any time
    static function getTemplate(){
        if (self::$instant == NULL){
            self::$instant = new self;
        }
        return self::$instant;
    }
    
    public function setContent($content){
        $this->content = $content;
    }
    
    public function setTitle($title){
        $this->title = $title;
    }
    
    public function getContent(){
        return $this->content;
    }
    
    public function getTitle(){
        return $this->title;
    }
    
    public function display(){
        require_once PUBLIC_HTML.DIRECTORY_SEPARATOR."theme".DIRECTORY_SEPARATOR."layout.php";
    }
}
