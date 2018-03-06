<?php
class Controller_Logout extends Controller
{
    function action_index()
    {        
        setcookie('PHPSESSID', '');
        session_destroy();
        header("Location: //".$_SERVER['SERVER_NAME']);
    }
}