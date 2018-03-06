

<style>body{background :url(img/party-full-hd-wallpaper_1.jpg);}</style>
<div class="col-md-3 offset-for-md3" id="registrationSuccess" style="background-color:white; margin-right:5%; border-radius: 5%;padding-top: 15px; display:none"></div>
<div class="col-md-3 offset-for-md3" id ="registrationField" style="background-color:white; margin-right:5%; border-radius: 5%;padding-top: 15px;">
    
    <div id="error" style="color:red"><?php if(!empty($data)){
        foreach($data as $out){
            if(!empty($out) && !is_array($out)){
                echo $out.'<br>'; 
            }elseif(is_array($out)){
                /*foreach($out as $val){
                    echo $val.'<br>';
                }*/
                print_r($out);
            }
        }
        
    } ?></div>
 <form method="POST" id="registerForm">
     
  <div class="form-group row">
    <div class="col-sm-12">
        <label for="first_name" class="form-control-label">First Name</label>
        <input type="text" name="first_name" class="form-control"  placeholder="John">
    </div>
  </div>
     
  <div class="form-group row">
    <div class="col-sm-12">
        <label for="last_name" class="form-control-label">Last Name</label>
        <input type="text" name="last_name" class="form-control"  placeholder="Doe">
    </div>
  </div>
     
  <div class="form-group row">
    <div class="col-sm-12">
        <label for="age" class="form-control-label">Birth Date</label>
        <input type="date" name="birthDate" class="form-control"  max="<?php echo date("Y-m-d")?>" required placeholder="1969-10-15">
    </div>
  </div>   
  
  <div class="form-group row">
    <div class="col-sm-12">
        <label for="email" class="form-control-label">Email</label>
        <input type="email" name="email" class="form-control" required placeholder="j.doe@mail.com">
    </div>
  </div> 
  
 <div class="form-group row">
    <div class="col-sm-12">
        <label for="login" class="form-control-label">Login</label>
        <input type="text" name="login" class="form-control" required placeholder="j.doe">
    </div>
  </div> 
     
  <div class="form-group row">
    <div class="col-sm-12">
        <label for="password" class="form-control-label">Password</label>
        <input type="password" name="password" class="form-control" required placeholder="password">
    </div>
  </div>
  
    <div class="form-group row">
        <div class="col-sm-12">
            <label for="password confirm" class="form-control-label">Password Confirm</label>
            <input type="password" name="password_confirmation" class="form-control" required placeholder="retype your password">
        </div>
    </div> 
     
  
</form>
    
    <div class="form-group row">
    <div class="col-sm-12">
      <button type="submit" id="register" class="submit btn btn-secondary">Sign up</button>
      <a href="//<?php echo URL::getHome(); ?>" style="color:inherit"><button class="btn btn-secondary pull-right">Go to home page</button></a>
    </div>
  </div>
</div>