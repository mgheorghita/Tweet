
    <div class="container">
    <div class="row">
        
        
        
        
        
                <div class="col-md-3">
            <div class="profile-sidebar">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img src="<?php echo $data->getAvatar(); ?>" class="img-responsive" alt="">
                </div>
                
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                        <?php echo $data->getFullName(); ?>
                    </div>
                    <div class="profile-usertitle-job">
                        <?php echo $data->getBiography(); ?>
                    </div>
                </div>
                
                <div class="profile-userbuttons">
                    <button type="button" class="btn btn-success btn-sm">Follow</button>
                </div>
                
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li class="active">
                            <a href="#">
                                <i class="glyphicon glyphicon-home"></i>
                                Followers </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="glyphicon glyphicon-user"></i>
                                Account Settings </a>
                        </li>
                        <li>
                            <a href="#" target="_blank">
                                <i class="glyphicon glyphicon-ok"></i>
                                My Tweets </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>