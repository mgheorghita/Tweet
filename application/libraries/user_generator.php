<?php

/**
 * Created by PhpStorm.
 * User: mgheorghita
 * Date: 4/29/2016
 * Time: 11:59 AM
 */
abstract class User_Generator
{
    public static function getNewFormattedUsers(User $userModel ){
        $fid="";
        $follow ="";
        if(isset($userModel->fid)){
          $fid = $userModel->fid;
        }
        if (isset($userModel->follow)){
            $follow = $userModel->follow;
        }
        $str = "<div class='col-md-4 usersFollowingRow ' id='".$fid."'><div class='card' id='".$userModel->getLogin()."'>"
                 ."<canvas class='header-bg' width='250' height='70' id='header-blur'></canvas><div class='avatar '>";
                     if(empty($userModel->getAvatar())){
                        $str .="<div id='defaultImage' > </div>";
                      }else{
                         $str .="<img src='".$userModel->getAvatar()."' alt='' />";
                         }
                $str .= "</div><div class='content'> <a href='user/userPage/".$userModel->getId()."'><p>". $userModel->getFullName()."</a>  <p>Email:". $userModel->getEmail()." <br>".$userModel->getBiography();

              if($follow == 1) {
                  $str .= " </p><p> <button type='button' class='btn btn-danger unfollow followingBtn' id='" . $userModel->getId() . "'> Unfollow  </button></p>";
              }else if($follow == 0){
                  $str .= " </p><p> <button type='button' class='btn btn-success follow followingBtn' id='" . $userModel->getId() . "'> Follow  </button></p>";
              }
        $str .="</div></div></div>";
        return $str;
    }

    public static function buildUserFromArray($data){
        $result = "";
        foreach ($data as $key => $value)
        {
            $result .= User_Generator::getNewFormattedUsers($value);
        }

        return $result;
    }

 }