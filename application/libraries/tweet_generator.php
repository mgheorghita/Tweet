<?php

/**
 * Created by PhpStorm.
 * User: mgheorghita
 * Date: 4/29/2016
 * Time: 11:59 AM
 */
abstract class Tweet_Generator
{
    public static function getNewFormattedTweet(Tweet $tweetModel, $hidden = false, $own = false){
        $class = '';
        if($hidden){
            $class = 'hidden';
        }
        $str = "<div class='content-style tweet ".$class."' id='".$tweetModel->getId()."'>  <p>";
//        if(empty($tweetModel->getAvatar())){
//
//          $str .="<div class='useravatar' id='defaultImage' > </div>";
//         }
//        else{
//
//       $str .=" <div class='useravatar'>
//                <img alt='' src='".$tweetModel->getAvatar()."'>
//            </div>";
//        }
        
        $str .= "<a href='user/userPage/".$tweetModel->getUserId()."'> "
                    .$tweetModel->getFirstName()." "
                    .$tweetModel->getLastName()." "
                    ."</a><span class='glyphicon glyphicon-time'></span> ";

        if ($tweetModel->getUserId() === Session::get('userId')){
            $own = true;
         }
        if($own === true  ) {
            $str .= "<button type='button' class='close deleteTweet' id='".$tweetModel->getId()."'>
                    <span class=''>x</span>
                    </button>";
        }
            $str .= $tweetModel->getDate()."<hr>";
                    if($tweetModel->getImage()) {
                      $str .="<img class='img-responsive img-size' src='".$tweetModel->getImage()."' alt=''><hr>";
                    }
                    $str .="<p>". $tweetModel->getTweet()."</p> <hr>
                    <div class='icons-bar'>";
                        if($tweetModel->getIfFavorite($tweetModel->getId())){
                            $str .=  "<i class='fa fa-heart unfavorite red' id='".$tweetModel->getId()."'></i>";
                        }else {
                            $str .= "<i class='fa fa-heart favorite' id='" . $tweetModel->getId() . "'></i>";
                        }
                     $str .="</div>
                </div>";
        return $str;
    }

    public static function buildTweetsFromArray($data, $hidden = false, $own = false){
        $result = "";
        foreach ($data as $key => $value)
        {
            $result .= Tweet_Generator::getNewFormattedTweet($value, $hidden, $own);
        }

        return $result;
    }

 }