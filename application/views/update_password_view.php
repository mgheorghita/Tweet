<div class="col-md-4 col-md-offset-4">
    <div class="col-md-10" style="background-color:white; margin-right:5%; border-radius: 5%;padding-top: 15px;">
    <div style="color:red"><?php if(!empty($data['error'])){
        if(is_array($data['error'])){
        foreach($data['error'] as $out){
            if(!empty($out) && !is_array($out)){
                echo $out.'<br>'; 
            }elseif(is_array($out)){
                foreach($out as $val){
                    echo $val.'<br>';
                }
            }
        }
        }else{
            echo $data['error'];
        }        
    } 
    ?></div>
    <form method="POST" enctype="multipart/form-data">


        <div class="form-group row">
          <div class="col-sm-12">
                <label for="actual_password" class="form-control-label">The password that you use now</label>
                <input type="password" name="actual_password" class="form-control" placeholder="your actual password">
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-12">
                <label for="password" class="form-control-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="your new password">
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-12">
                <label for="password_confirmation" class="form-control-label">Password Confirm</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="repeat your password">
          </div>
        </div>


        <div class="form-group row">
            <div class="col-sm-12">
                <button type="submit" class="submit btn btn-secondary pull-left">Update password</button> 
                <!--<button class="btn btn-secondary pull-right"><a href="//<?php echo URL::getHome(); ?>" >Go to home page</a></button>-->
                <a class="btn btn-secondary pull-right" style="background-color: #d1d1d3;color: black;" href="//<?php echo URL::getHome(); ?>" >Go to home page</a>
            </div>
        </div>
    </form>        
        
       </div>
    
</div>