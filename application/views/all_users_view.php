<div class="main-feed col-md-9  ">
    <div class="usersBlock col-md-12 ">
            
<?php

//var_dump($data['users'])
            echo User_Generator::buildUserFromArray($data['allUser']);
?>
    </div>
    
    <?php
 if(count($data['allUser']) >= 6){?>
    <div class="btn-group btn-group-lg loadMoreUser  " >
        <button type="button" class="btn btn-default loadMoreUser allUser">Load more users</button>
    </div>
<?php }
else if(count($data['allUser']) == 0){
    ?>
    <h1 class="text-center">No users in the sistem</h1>
    <p class="text-center">
        <i class="fa fa-frown-o fa-5x"></i>
    </p>


<?php } ?>
    </div>
</div>