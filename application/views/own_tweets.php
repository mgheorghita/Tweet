
<div class="main-feed col-md-9 ">
    
<?php
    if(count($data['tweet']) == 0){
        ?>
        <h1 class="text-center">You dont have any tweets</h1>
        <p class="text-center">
            <i class="fa fa-frown-o fa-5x"></i>
        </p>
        <?php
    }else {
        echo Tweet_Generator::buildTweetsFromArray($data['tweet'], '', true);
    }
?>
  
</div>

