<?php
/**
 * Created by PhpStorm.
 * User: mgheorghita
 * Date: 4/26/2016
 * Time: 3:45 PM
 */

class Controller_Tweet extends Controller
{
    function action_index()
    {
        $this->model = new Tweet();
        $tweet = $this->model->getTweets();
        $this->view->generate('home_view.php', 'main_view.php', $tweet);
    }


    public function action_newTweets()
    {
        $data = date("Y-m-d H:i:s");
        $this->model = new Tweet();
        $tweet = $this->model->getFollowingNewTweets();
        $tweetContent = $this->model;

        $success = false;
        $htmlTweets = "";
        $tweetCount = 0;

        if(!empty($tweet)){
            $success = true;
            $htmlTweets = Tweet_Generator::buildTweetsFromArray($tweet, true);
            $tweetCount = count($tweet);
        }

        Session::set('dateCheck',$data);
        echo json_encode(array(
            "success" => $success,
            "count" => $tweetCount,
            "tweetContent" => $htmlTweets));
    }

    public function action_add()
    { 
        $error="";
        if(!empty($_POST)) {
            $content = $_POST['tweetContent'];
            if (!empty($content)) {
                $image = false;

                if (strlen($content) <= 140) {

                    if (!empty($_POST['imageFile'])) {
                        $image = $_POST['imageFile'];
                    }
                    $userId = Session::get('userId');
                    $data = date("Y-m-d H:i:s");
                    $this->model = new Tweet();
                    $tweet = $this->model->addTweet($content, $data, $userId, $image,Session::get('first_name'),Session::get('last_name'));
                    $tweetContent = $this->model;
                } else $error = "tweet is to long. max length is 140";
            } else $error = "empty content";
        }
     echo json_encode(array( "success" => $tweet,
                                "error" => $error,
                                "tweetContent" => Tweet_Generator::getNewFormattedTweet($tweetContent,'',true)));
    }
    public function action_delete()
    {
        $error='';
        if(!empty($_POST)) {
            $tweetId = $_POST['tweetId'];
            if (is_numeric ($tweetId)) {
                $this->model = new Tweet();
                    $tweet = $this->model->delete('tweet', array('id' => $tweetId));
                } else $error = "something wrong";

        }
        echo json_encode(array( "success" => $tweet,
            "error" => $error,
        ));
    }

    public function action_moreTweets()
    {
        $lastTweetId = 0;
        if(!empty($_POST['tweetId']))
        {
            $lastTweetId = $_POST['tweetId'];
        }

        $this->model = new Tweet();
        $tweet = $this->model->getTweets($lastTweetId);
        $tweetContent = $this->model;

        $success = false;
        $htmlTweets = "";
        $tweetCount = 0;

        if(!empty($tweet)){
            $success = true;
            $htmlTweets = Tweet_Generator::buildTweetsFromArray($tweet, true);
            $tweetCount = count($tweet);
        }
        echo json_encode(array(
            "success" => $success,
            "count" => $tweetCount,
            "tweetContent" => $htmlTweets));
    }
    function action_favorite(){
        $userId =Session::get('userId');
        $tweetId = $_POST['favoriteTweetId'];
        $this->model = new Tweet();
        $this->model->setWhere("userId = ".$userId." and tweetId =".$tweetId);
        $checkFavorite = $this->model->select('favorites',__CLASS__);

        if(empty($checkFavorite)) {
            //var_dump(!empty($checkFollowed));
            $favorite = $this->model->insertFavoriteTweet($userId, $tweetId);
        } else $favorite = false;
        echo json_encode(array( "success" => $favorite));
    }

    function action_unfavorite(){
        $userId = Session::get('userId');
        $tweetId = $_POST['favoriteTweetId'];
        $this->model = new Tweet();

        $unfavorite = $this->model->delete('favorites', array('userId' => $userId, 'tweetId' => $tweetId));

        echo json_encode(array( "success" => $unfavorite));
    }
}