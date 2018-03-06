<?php
/**
 * Created by PhpStorm.
 * User: mgheorghita
 * Date: 5/16/2016
 * Time: 11:21 AM
 */
//var_dump($data);
?>
<!--<pre>--><?php // print_r($data['ifFollow'])?><!--</pre>-->

<div class="col-lg-9 col-sm-9">
    <div class="card hovercard">
        <div class="card-background">
            <img class="card-bkimg" alt="" src="../../img/userBackground.jpg">
            <!-- http://lorempixel.com/850/280/people/9/ -->
        </div>

        <?php if(empty($data['genericUser']->getAvatar())){ ?>
            <div class="useravatar" id='defaultImage' > </div>
        <?php }
        else{ ?>
        <div class="useravatar">
            <img alt="" src="<?php echo $data['genericUser']->getAvatar()?>">
        </div>
        <?php
               }?>


        <div class="card-info"> <span class="card-title"> <?php echo $data['genericUser']->getFullName()?></span>

        </div>
    </div>
    <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <button type="button" id="stars" class="btn btn-primary" href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                <div class="hidden-xs">Tweets</div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" id="favorites" class="btn btn-default" href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                <div class="hidden-xs">Profile data</div>
            </button>
        </div>
        <?php
        $status = "";
        if($data['genericUser']->getId() == Session::get('userId')){
         $status = "disabled='disabled'";
        }
        if($data['ifFollow']) {
            ?>
            <div class="btn-group" role="group">
                <button type="button" id="<?php echo $data['genericUser']->getId()?>" class="btn btn-default userGeneric unfollow followingBtn" <?php echo $status?> ><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    <div class="hidden-xs">Unfollow</div>
                </button>
            </div>

            <?php
        }else{?>
        <div class="btn-group" role="group">
            <button type="button" id="<?php echo $data['genericUser']->getId()?>" class="btn btn-default userGeneric follow followingBtn" <?php echo $status?> ><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                <div class="hidden-xs">Follow</div>
            </button>
        </div>
        <?php }?>
    </div>

    <div class="well">
        <div class="tab-content">
            <div class="tab-pane fade in active" id="tab1">

                <?php
                if(count($data['tweet']) == 0){
                    ?>
                    <h1 class="text-center">This user doesnt have any tweets</h1>
                    <p class="text-center">
                        <i class="fa fa-frown-o fa-5x"></i>
                    </p>
                    <?php
                }else {
                    echo Tweet_Generator::buildTweetsFromArray($data['tweet']);
                }
                ?>
            </div>
            <div class="tab-pane fade in" id="tab2">
                    <div class="panel panel-info">

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3 col-lg-3 " align="center">

                                    <?php if(empty($data['genericUser']->getAvatar())){ ?>
                                        <div  id='defaultImage' > </div>
                                    <?php }
                                    else{ ?>
                                        <div class="useravatar">
                                            <img alt="User Pic" src="<?php echo $data['genericUser']->getAvatar()?>" class="img-circle img-responsive">
                                        </div>
                                        <?php
                                    }?>
                                </div>
                                    <div class=" col-md-9 col-lg-9 ">
                                    <table class="table table-user-information">
                                        <tbody>
                                        <tr>
                                            <td>First Name:</td>
                                            <td><?php echo $data['genericUser']->getFirstName()?> </td>
                                        </tr>
                                        <tr>
                                            <td>Last Name</td>
                                            <td><?php echo $data['genericUser']->getLastName()?></td>
                                        </tr>
                                        <tr>
                                            <td>Birth Date</td>
                                            <td><?php echo $data['genericUser']->getBirthDate()?></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td><?php echo $data['genericUser']->getEmail()?></td>
                                        </tr>
                                        <tr>
                                            <td>Biography</td>
                                            <td><?php echo $data['genericUser']->getBiography()?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>

</div>



