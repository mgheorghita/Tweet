<?php

class Controller_Main extends Controller
{
    function action_index()
    {
        Session::set('dateCheck',date("Y-m-d H:i:s"));
        $this->model = new User();
        $user = $this->model->getUserById(Session::get('userId'));
        $unfollowed = $this->model->unfollowedUsers();
        $followed = $this->model->getFollowingUsers();
        $followingCount = $this->model->getCountOfFollowings();
        $followerCount = $this->model->getCountOfFollowers();
        $tweets = $this->getTweets();
        $data =  array("user"=>$user, "tweet" => $tweets, "unfollowed" => $unfollowed, 'followed' => $followed,'followingNr' => $followingCount,'followersNr'=>$followerCount);
        $this->view->generate('home_view.php', 'main_view.php', $data);
    }

    
    function getTweets(){
        $this->model = new Tweet();
        $tweet = $this->model->getTweets(0);
        return $tweet;
    }
};