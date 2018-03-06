<?php
/*
require_once 'core/model.php';
require_once 'core/view.php';   
require_once 'core/controller.php';

require_once 'core/route.php';
*/

include_once 'application/core/libs/log4php/Logger.php';
Logger::configure('application/core/libs/log4php/logconfig.xml');


if(!defined('CORE_PATH')){
    define('CORE_PATH', '/core/');
}

if(!defined('LIB_PATH')){
    define('LIB_PATH', '/core/libs');
}

if(!defined('CONTROLLER_PATH')){
    define('CONTROLLER_PATH', '/controllers/');
}

if(!defined('VIEW_PATH')){
    define('VIEW_PATH', '/views/');
}

if(!defined('MODEL_PATH')){
    define('MODEL_PATH', '/models/');
}

if(!defined('LIBS_PATH')){
    define('LIBS_PATH', '/libraries/');
}

set_include_path(get_include_path().PATH_SEPARATOR.__DIR__.CORE_PATH);
set_include_path(get_include_path().PATH_SEPARATOR.__DIR__.LIB_PATH);
set_include_path(get_include_path().PATH_SEPARATOR.__DIR__.CONTROLLER_PATH);
set_include_path(get_include_path().PATH_SEPARATOR.__DIR__.VIEW_PATH);
set_include_path(get_include_path().PATH_SEPARATOR.__DIR__.MODEL_PATH);
set_include_path(get_include_path().PATH_SEPARATOR.__DIR__.LIBS_PATH);

include_once ('core/libs/conf.php');


session_start();
  
function my_autoloader($class) {
    include_once (strtolower($class).'.php');
}
spl_autoload_register('my_autoloader');

Route::start();