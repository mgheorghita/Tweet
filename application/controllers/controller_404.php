<?php


class Controller_404 extends Controller
{
    function action_index()
    {     
        /*$model = new User();
        $user = $model->getUserById(Session::get('userId'));*/
        //$data['user'] = $user;
	$this->view->generate('home_404.php', 'main_view.php');  
    }
}