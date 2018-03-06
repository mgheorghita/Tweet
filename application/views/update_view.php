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
            <div class="col-md-12">
                <label for="first_name" class="form-control-label">Login</label>
                <a class="pull-right" href="//<?php echo URL::getHome(); ?>/user/update_password">Update password</a>
                <input type="text" name="first_name" class="form-control" disabled value="<?php echo $data['user']->getLogin(); ?>">
              </div>
          </div>

        <div class="form-group row">
          <div class="col-sm-12">
                <label for="first_name" class="form-control-label">First Name</label>
                <input type="text" name="first_name" class="form-control" value="<?php echo $data['user']->getFirstName(); ?>">
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-12">
                <label for="last_name" class="form-control-label">Last Name</label>
                <input type="text" name="last_name" class="form-control"  value="<?php echo $data['user']->getLastName(); ?>">
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-12">
                <label for="age" class="form-control-label">Birth Date</label>
                <input type="date" name="birthDate" class="form-control"  max="<?php echo date("Y-m-d")?>" required value="<?php echo $data['user']->getBirthDate(); ?>">
          </div>
        </div> 

        <div class="form-group row">
          <div class="col-sm-12">
                <label for="email" class="form-control-label">Email</label>
                <input type="email" name="email" class="form-control" required value="<?php echo $data['user']->getEmail(); ?>">
          </div>
        </div>

       <div class="form-group row">
            <div class="col-sm-12">
                <label for="avatar" class="form-control-label">Avatar<img src="<?php echo $data['user']->getAvatar(); ?>" style="max-width:70px; margin-left: 5px"></label>
                <input type="file" name="avatar" class="form-control" value="">
            </div>
        </div>


        <div class="form-group row">
            <div class="col-sm-12">
                <button type="submit" class="submit btn btn-secondary pull-left">Update</button>
                <button href="//" class="btn btn-secondary pull-right">Go to home page</button>
            </div>
        </div>
    </form>        
       </div>
    
</div>