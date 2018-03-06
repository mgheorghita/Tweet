<?php
/**
 * Created by PhpStorm.
 * User: mgheorghita
 * Date: 5/12/2016
 * Time: 11:00 AM
 */
?>

<!--<pre>--><?php // print_r($data)?><!--</pre>-->
<div class="main-feed col-md-9  ">
    <div class="usersBlock col-md-12 ">


        <?php
            echo User_Generator::buildUserFromArray($data['follower']);
        ?>
        
         </div>
    <?php if(count($data['followersNr']) >= 6){?>
    <div class="btn-group btn-group-lg loadMoreUser  " >
        <button type="button" class="btn btn-default loadMoreUser follower">Load more users </button>
    </div>
    <?php }
    else if(count($data['followersNr']) == 0){
    ?>
        <h1 class="text-center">No Followers</h1>
        <p class="text-center">
            <i class="fa fa-frown-o fa-5x"></i>
        </p>


    <?php }?>
</div>

