<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
*/
  class URL{
 
    public static function getHome() {
        return $_SERVER['SERVER_NAME'] ;
    }    
}