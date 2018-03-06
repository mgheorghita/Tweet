<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Logging{
    
    private $log;
    static $_instance;
            
    function __construct() {
        $this->log = Logger::getLogger('tweet');
    }
    
    static function register(){
        if(!self::$_instance){
            self::$_instance = Logger::getLogger('tweet');
        }
        
        return self::$_instance;
    }
    
    
    /* Examples of loging messages
     * 
        Logging::register()->trace("test trace message.");
        Logging::register()->debug("test debug message.");
        Logging::register()->info("test info message.");
        Logging::register()->warn("test warn message.");
        Logging::register()->error("test error message.");
        Logging::register()->fatal("test fatal message.");    
     * 
     * 
     * 
     */
       
}