<?php

/* 
 * Demo Framework Index.php
 * @author Zackary Boarman
 * @version 1.0
 */

define("PUBLIC_HTML",__DIR__);
require_once 'sys/autoloader.php';
require_once 'app/config.php';
require_once 'app/app.php';

App::init();