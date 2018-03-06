<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="profile-sidebar">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img src="
                        <?php if(empty($data['user']->getAvatar())){
                            echo 'img/default_image.png';
                        }else{
                            echo $data['user']->getAvatar();
                        }
                        ?>
                         " class="img-responsive" alt="">
                </div>

                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                        <?php echo $data['user']->getFullName(); ?>
                    </div>
                    <div class="profile-usertitle-job">
                        <?php echo $data['user']->getBiography(); ?>
                    </div>
                </div>

                <div class="profile-userbuttons">

                </div>

                <div class="profile-usermenu">
                    <ul class="nav">


                        <li class="active">
                            <a href="user/ownTweets"">
                                <i class="glyphicon glyphicon-retweet"></i>
                                My Tweets </a>
                        </li>
                        <li>
                           <a href="user/following">
                                <i class="glyphicon glyphicon-flag"></i>
                                Following <span class="badge"><?php echo count($data['followingNr']);?></span></a>
                        </li>
                        <li>
                            <a href="user/followers">
                                <i class="glyphicon glyphicon-user"></i>
                                Followers <span class="badge"> <?php echo count($data['followersNr']);?></span></a>
                        </li>
                        <li>
                            <a href="user/favorite">
                                <i class="glyphicon glyphicon-heart "></i>
                                Favorites </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>