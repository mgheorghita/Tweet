<?php


class Controller_Home extends Controller
{
    function action_index()
    {
        //$this->view->generate('home_view.php', 'main_view.php');
        
        $this->model = new User();
		//$this->view = new View();
       // $user = new Controller_User();
        $user = $this->model->getUserById();
        $tweets = $this->getTweets();
		$this->view->generate('home_view.php', 'main_view.php', array('user' => $user, 'tweets' => $tweets));  
        
    }
    
   function getTweets(){
       $this->model = new Tweet();
       $tweet = $this->model->getTweets();
       return $tweet;
   }
    
}