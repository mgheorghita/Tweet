<?php

/**
 * Created by PhpStorm.
 * User: mgheorghita
 * Date: 5/19/2016
 * Time: 3:20 PM
 */
class Session_Mock
{


    public static function find($path) {
        $path = explode("/", $path) ;

        $element  = $_SESSION;

        foreach($path as $item) {
            if(isset($element[$item]))
                $element = $element[$item] ;
        }

        return $element ;

    }

    public static function get($value) {
        return $value ;
    }

    public static function set($path, $value) {
        $path = explode("/", $path) ;

        $element  = $_SESSION;

        foreach($path as $item) {
            if(isset($element[$item]))
                $element = $value ;
        }

        return $value;
    }

    public static function delete($path) {
        if(self::find($path) != null)
            self::set($path, null) ;
    }

    public static function exists($path) {
        if(self::find($path)) return true ;
    }




}