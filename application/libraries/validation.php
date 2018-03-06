<?php

class Validation{
    
    static function email($field, $field_name, $required = True)
    {
        if(isset($field)){
            $field = trim($field);
        }
        
        if(!empty($field) && filter_var($field, FILTER_VALIDATE_EMAIL)){
                //return True;
            }else{
               $res = $field_name.' is not a valid email';
            }  
            
        if(!empty($res)){
            return $res;
        }    
    }
    
    static function numeric($field, $field_name, $required = True){
        $field = trim($field);
        if (!empty($field) && is_numeric($field) && $field > 0){
            //return True;
        }elseif(empty($field)){
            $res = $field_name.' can\'t be empty';
        }else{
            $res = $field_name.' must be a number';
        }
        
        if(!empty($res)){
            return $res;
        }
    }   
    
    static function string($field, $field_name, $required = True){
        
        if(isset($field)){
            $field = trim($field);
        }
        
        if (!empty($field) && is_string($field) && !is_numeric($field)){
            //return True;
        }elseif(empty($field)){
            $res = $field_name.' can\'t be empty';
        }else{
            $res = $field_name.' must be a string';
        }
        
        if(!empty($res)){
            return $res;
        }
        
    }
    
    static function password($field, $required = True){
        $res = array();
        
        if(isset($field)){
            $field = trim($field);
        }
        
        
        
        if (!empty($field) && strlen($field) > 5){
            preg_match("/[0-9]/", $field, $checkForNumbers);
            if(empty($checkForNumbers)){
               $res[] = ' Your password must contain at least one number'; 
            }
            preg_match("/[a-z]/", $field, $checkForLowercase);
            if(empty($checkForLowercase)){
                $res[] = ' Your password must contain at least one lowercase letter';
            }
            preg_match("/[A-Z]/", $field, $checkForUppercase);
            if(empty($checkForUppercase)){
                $res[] = ' Your password must contain at least one uppercase letter';
            }
                       
        }else{
            $res = 'The password can\'t be shorter than 6 symbols';
        }
        
        if(!empty($res)){
            return $res;
        }
    }
    
    static function login($field, $field_name, $required = True){
        
        if(isset($field)){
            $field = trim($field);
        }
        
        if (!empty($field) && is_string($field) && !is_numeric($field)){
            
            preg_match_all("/[[:word:]]/", $field, $checkPattern);
            $login_length = strlen($field);
            if(count($checkPattern[0]) < $login_length){
                $res[] = ' The only allowed characters for login are upper / lowercase letters and underscore';                
            }
                
        }elseif(empty($field)){
            $res = $field_name.' can\'t be empty';
        }else{
            $res = $field_name.' must be a string';
        }
        
        if(!empty($res)){
            return $res;
        }
        
    }
    
    static function dateFormat($field, $field_name, $required = True){
        
        if(isset($field)){
            $field = trim($field);
        }
        
        if(empty($field)){
            $res = $field_name.' can\'t be empty'; 
        }elseif(!empty($field)){
            $date = date_parse($field);
            $chechedDate = checkdate($date['month'], $date['day'], $date['year']);
            if($chechedDate == False){
                $res = 'Please choose a valid birthdate';
            }
        }
        
        if(!empty($res)){
            return $res;
        }
    }
    
}
