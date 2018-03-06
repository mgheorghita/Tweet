<?php
/**
 * Created by PhpStorm.
 * User: mgheorghita
 * Date: 4/21/2016
 * Time: 11:40 AM
 */

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <base href="//<?php echo $_SERVER['SERVER_NAME']; ?>">
    <title>Twitter</title>
     <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">




</head>

<body>
 <?php
    include_once "templates/header.php";
 if($content_view !== 'login_view.php' && $content_view !== 'register_view.php' && $content_view !=='update_view.php' && $content_view !=='update_password_view.php' && $content_view !=='home_404.php' ) {
     //echo $content_view;
     include_once 'user_view.php';
 }
    include "templates/newTweet.php";
    include 'application/views/'.$content_view;
?>
    </div>
</div>


 <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
 <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
 <!--[if lt IE 9]>
 <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
 <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
 <![endif]-->

 <!-- jQuery -->
 <script src="../js/jquery.js"></script>
  <!-- Bootstrap Core JavaScript -->
 <script src="js/bootstrap.min.js"></script>
 <script type="text/javascript" src="js/scripts.js"></script>
<?php

//var_dump($content_view);

if($content_view == 'home_view.php' || $content_view == 'genericUserPage.php' || $content_view == 'own_tweets.php'){?>
    <script type="text/javascript" src="js/mainFeed.js"></script>
    <script type="text/javascript" src="js/deleteTweet.js"></script>
<?php }else if($content_view == 'own_tweets.php' ) {?>
    <script type="text/javascript" src="js/deleteTweet.js"></script>
<?php }else if($content_view == 'following_view.php' || $content_view == 'followers_view.php' ||  $content_view == 'all_users_view.php' ) {?>
 <script type="text/javascript" src="js/mainFeed.js"></script>
<?php }?>

</body>
</html>
