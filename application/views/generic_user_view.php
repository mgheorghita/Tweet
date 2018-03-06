<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="profile-sidebar">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic col-md-3">
                    <img src="
                        <?php if(empty($data['user']->getAvatar())){
                            echo 'img/no-image.png';
                        }else{
                            echo $data['user']->getAvatar();
                        }
                        ?>
                        " class="img-responsive" alt="">
                </div>

                <div class="profile-usertitle col-md-3">
                    <div class="profile-usertitle-name">
                        <?php echo $data['user']->getFullName(); ?>
                    </div>
                    <div class="profile-usertitle-job">
                        <?php echo $data['user']->getBiography(); ?>
                    </div>
                </div>

                <div class="profile-userbuttons">

                </div>

                
            </div>
        </div>