<style>body{background :url(img/party-full-hd-wallpaper_1.jpg);}</style>
<div class="col-md-3 offset-for-md3" style="background-color:white; margin-right:5%; border-radius: 5%;padding-top: 15px;">

    <p style="color:red"><?php if(!empty($data['error'])){
        echo $data['error'];        
    } ?></p>
    <p style="color:green"><?php if(!empty($data['success'])){
        echo $data['success'];        
    } ?></p>
 <form method="POST" action="http://<?php echo $_SERVER['SERVER_NAME']; ?>/login">
  <div class="form-group row">
    <label id="error" class="form-control-label" style="color:red" hidden></label>
    <div class="col-sm-12">
        <label for="inputEmail3" class="form-control-label">Login</label>
        <input type="text" name="login" class="form-control" required placeholder="Login">
    </div>
  </div>
  <div class="form-group row">    
    <div class="col-sm-12">
        <label for="inputPassword3" class="form-control-label">Password</label>
         <input type="password" name="password" class="form-control" id="inputPassword3"  placeholder="Password">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="submit btn btn-secondary" id="login" onclick="submitForm()">Sign in</button>
    </div>
  </div>
</form>
    <?php 
        if(empty($data['registered'])){
            echo '<p>If you don\'t have an account yet, you can <a id="registration_link" href="register">register</a> for free</p>';
        }
    ?>  
</div>