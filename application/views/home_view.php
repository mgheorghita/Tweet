

<div class="col-md-6">
    <div class="btn-group btn-group-lg newTweets hidden" >
        <button type="button" class="btn btn-default newTweets">Show new Tweets <span class="badge newT"></span></button>
    </div>
    <div class="main-feed">
<!--    <pre>--><?php // print_r($data['followingNr'])?><!--</pre>-->



    <?php
        if(count($data['tweet']) == 0){
            ?>
            <h1 class="text-center">You dont have any tweets</h1>
            <p class="text-center">
                <i class="fa fa-frown-o fa-5x"></i>
            </p>
            <?php
        }else {
            echo Tweet_Generator::buildTweetsFromArray($data['tweet']);
        }
    ?>

    </div>
</div>
<div class="col-md-3 ">
    <!-- Blog Search Well -->
<div class="interest-box">
    <h4 class="text-center">Users to follow</h4>


    <?php
    //var_dump($data['userList']);
    foreach ($data['unfollowed'] as $key => $value){ ?>
        <hr>
    <div class="row userList">
        <div class="col-lg-12 ">

                <a href='user/userPage/<?php echo $value->getId()?>'>

                    <?php if(empty($value->getAvatar())){ ?>
                        <div class="useravatar col-lg-3 " id='defaultImageUserList' > </div>
                    <?php }
                    else{ ?>
                        <div class="useravatar col-lg-3">
                            <img alt="" src="<?php echo $value->getAvatar()?>" class="ImageUserList">
                        </div>
                        <?php
                    }?>

                 <div class="col-lg-6 ">   <?php echo $value->getFirstName().' '. $value->getLastName() ?></div></a>

            <div class="col-lg-3 followUserBtn ">    <button type="button" class="btn btn-success btn-sm follow" id="<?php echo $value->getId() ?>"> Follow  </button> </div>



            </div>

    <!-- /.input-group -->
    </div>

    
    <?php } ?>
    <hr>
  <div class="col-lg-12 text-center ">  <a href='user/list' >See all Users</a></div>
    <hr>
</div>
  
