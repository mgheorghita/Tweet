<?php

class Controller_Login extends Controller
{
    function action_index()
    {         
        if(empty($_POST['login']) || empty($_POST['password'])){

            $this->view->generate('login_view.php', 'main_view.php');
        }
        elseif(!empty($_POST['login'])  && !empty($_POST['password'])){
            $login = $_POST['login'];
            $password = $_POST['password'];
            
            $this->model = new User();
            $user = $this->model->getUserByLogin($login);
            
            if(is_object($user)){
                if($login === $user->getLogin() && md5($password) === $user->getPassword()){
                    
                    Session::set('logged_in',True);
                    Session::set('userId',$user->getId());
                    Session::set('first_name', $user->getFirstName());
                    Session::set('last_name', $user->getLastName());
                    
                    $url = $_SERVER["SERVER_NAME"];
                    
                    header("location: //$url");
                }              
                else{
                    $data['error'] = 'Your password or login is wrong';
                    $this->view->generate('login_view.php', 'main_view.php', $data);
                }
            }else{
                $data['error'] = 'Your password or login is wrong';
                $this->view->generate('login_view.php', 'main_view.php', $data);
            }
        }
    }
    
    function getTweets(){
                    $this->model = new Tweet();
                    $tweet = $this->model->getTweets();
                    return $tweet;
                }
}