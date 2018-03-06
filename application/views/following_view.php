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
            echo User_Generator::buildUserFromArray($data['following']);
        ?>
        
         </div>
    <?php if(count($data['followingNr']) >= 6){?>
    <div class="btn-group btn-group-lg loadMoreUser  " >
        <button type="button" class="btn btn-default loadMoreUser following">Load more users </button>
    </div>
    <?php }else if(count($data['followingNr']) == 0){
        ?>
        <h1 class="text-center">You dont Follow someone</h1>
        <p class="text-center">
            <i class="fa fa-frown-o fa-5x"></i>
        </p>
    <?php }?>
</div>

