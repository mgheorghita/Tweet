<?php
/**
 * Created by PhpStorm.
 * User: mgheorghita
 * Date: 5/11/2016
 * Time: 12:43 PM
 */

class Session{


    public static function find($path) {
        $path = explode("/", $path) ;

        $element  = $_SESSION;

        foreach($path as $item) {
            if(isset($element[$item]))
                $element = $element[$item] ;
        }

        return $element ;

    }

    public static function get($path) {
        return self::find($path) ;
    }

    public static function set($path, $value) {
/*
        $path = explode("/", $path) ;

        $element  = $_SESSION;

        foreach($path as $item) {
            if(isset($element[$item]))
                $element = $element[$item] ;
        }

        $element = $value ;
        return $element ;*/
        $_SESSION[$path] = $value;
    }


    public static function delete($path) {
        if(self::find($path) != null)
            self::set($path, null) ;
    }

    public static function exists($path) {
        if(self::find($path)) return true ;
    }

    public static function setDateCheck($date){
        $_SESSION['dateCheck'] = $date;
    }

    public static function getDateCheck(){
        return $_SESSION['dateCheck'];
    }
//    public static function setUserId($id){
//        $_SESSION['userId'] = $id;
//    }
//    public static function getUserId(){
//        return $_SESSION['userId'];
//    }
//    public static function setLoggedIn($status){
//        $_SESSION['logged_in'] = $status;
//    }
//    public static function getLoggedIn(){
//        return !empty($_SESSION['logged_in']) ? $_SESSION['logged_in'] : null;
//    }
//    public static function setFirstName($fname){
//        $_SESSION['first_name'] = $fname;
//    }
//    public static function getFirstName(){
//        return $_SESSION['first_name'];
//    }
//    public static function setLastName($lname){
//        $_SESSION['last_name'] = $lname;
//    }
//    public static function getLastName(){
//        return $_SESSION['last_name'];
//    }
}