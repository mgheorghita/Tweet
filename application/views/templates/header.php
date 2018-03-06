<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top color"  role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand text-color" href="//<?php echo URL::getHome(); ?>">Twitter</a>
        </div>
        
        <?php

        if(!empty(Session::get('logged_in'))){ ?>
            
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                </li>
                <li>
                     <a href="#" data-toggle="modal" id="newTweet" data-target="#myModalNorm" >New Tweet</a>
                </li>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Profile <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li align="center" class="well">
                                <div>
                                    <img src="
                        <?php if(empty($data['user']->getAvatar())){
                                        echo 'img/default_image.png';
                                    }else{
                                        echo $data['user']->getAvatar();
                                    }
                                    ?>
                         " class="img-responsive" alt="">
                                 </div>
<!--                                <a href="#" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-lock"></span> Security</a>-->
                                <a class="btn btn-sm btn-default"  data-toggle="modal" data-target="#myModal"><i class="fa fa-times"></i></span> Remove</a>
                                <a href="user/update" class="btn btn-sm btn-default"><i class="fa fa-pencil"></i></span> Update</a>
                                <a href="logout" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                            </li>
                        </ul>                       
                    </li>
                </ul>
            </ul>
                        
            <div class="col-sm-3 col-md-3 pull-right">
<!--                <form class="navbar-form" role="search">-->
<!--                    <div class="input-group">-->
<!--                        <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">-->
<!--                        <div class="input-group-btn">-->
<!--                            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </form>-->
            </div>
            
            
            
        </div>
        
        
        <?php } ?>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

 <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete account</h4>
      </div>
      <div class="modal-body">
        <p>
        <h4>Do you really want to delete your account? You will not be able to use your profile</h4>           
               
      </p>
      </div>
      <div class="modal-footer">
          <form method="POST" action="//<?php echo URL::getHome(); ?>/user/delete">
                   <input type="hidden" name="delete" value="True">
                   <input type="submit" class="btn btn-default pull-left" value="Delete">
               </form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>