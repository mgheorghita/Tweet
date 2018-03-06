<?php
    class Controller_User extends Controller{
        
        function __construct() {
            parent::__construct();
        }
                
        static function createUser($first_name, $last_name, $email, $login, $password){
            //include_once '../models/user.php';
            $model = new User();
            $user = $model->createUser($first_name, $last_name, $email, $login, $password);
        }
        
        function action_update(){
            
            $model = new User();
            $user = $model->getUserById(Session::get('userId'));            
            $result = '';
            
            if(!empty($_POST)){
                $response = array();                
                
                if(isset($_POST['first_name'])){
                    $response[] = Validation::string($_POST['first_name'], 'first name');
                }else{
                    $result .= "first name can't be empty";
                }
                
                if(isset($_POST['last_name'])){
                    $response[] = Validation::string($_POST['last_name'], 'last name');
                }else{
                    $result .= "last name can't be empty";
                }
                
                if(isset($_POST['birthDate'])){
                    $response[] = Validation::dateFormat($_POST['birthDate'], 'birth date');
                }else{
                    $result .= "birth date can't be empty";
                }
                
                if(isset($_POST['email'])){
                    $response[] = Validation::email($_POST['email'], 'email');
                }else{
                    $result .= "email can't be empty";
                }
                
                                        
                    $avatar = new Upload();
                    $avatar_response = $avatar->image($_FILES['avatar'], Session::get('userId'));
                    
                    if(isset($avatar_response['error'])){
                        $response[] = $avatar_response['error'];
                    }
                    
                    if(!empty($avatar_response['success'])){
                        $avatar_name = $avatar_response['success'];
                    }else{
                        $avatar_name = $user->getAvatar();
                    }
                    
                    
                foreach($response as $key=>$value){
                    if(!empty($value) && !is_array($value)){
                        $result .= $value.'<br>';
                    }elseif(is_array($value)){
                        foreach($value as $val){
                            $result .= $val.'<br>';                        
                        }
                    }
                }
                
                
                if(empty($result)){

                    //$result = $model->updateUser($_SESSION['userId'], $_POST['first_name'], $_POST['last_name'], $_POST['birthDate'], $_POST['email'], $avatar_name);

                    $result = $model->updateUser(Session::get('userId'), $_POST['first_name'], $_POST['last_name'], $_POST['birthDate'], $_POST['email'], $avatar_name);

                    $url =  URL::getHome();
                    header("Location: //$url");
                }else{
                    $data['error'] = $result;
                    $data['user'] = $model->getUserById(Session::get('userId'));
                    $this->view->generate('update_view.php', 'main_view.php', $data);
                }
            }else{
                $data['user'] = $model->getUserById(Session::get('userId'));
                $this->view->generate('update_view.php', 'main_view.php', $data);
            }
        }        
        
        function action_update_password(){
            
            $model = new User();
            $user = $model->getUserById(Session::get('userId'));            
            $result = '';
            
            if(!empty($_POST)){
                $response = array(); 
                
                if(isset($_POST['password']) && isset($_POST['password_confirmation'])){
                    if($_POST['password'] !== $_POST['password_confirmation']){
                        $response[] = 'The passwords don\'t match';
                    }else{
                        if($user->getPassword() != md5($_POST['actual_password'])){
                            $result .= 'The actual password is not valid<br>';
                        }
                        $response[] = Validation::password($_POST['password']);
                    }
                }else{
                    $result .= "password can't be empty";
                }
                
                foreach($response as $key=>$value){
                    if(!empty($value) && !is_array($value)){
                        $result .= $value.'<br>';
                    }elseif(is_array($value)){
                        foreach($value as $val){
                            $result .= $val.'<br>';                        
                        }
                    }
                }
                
                
                if(empty($result)){

                    //$result = $model->updateUser($_SESSION['userId'], $_POST['first_name'], $_POST['last_name'], $_POST['birthDate'], $_POST['email'], $avatar_name);

                    $result = $model->updateUserPassword(Session::get('userId'), md5($_POST['password']));

                    $url =  URL::getHome();
                    header("Location: //$url");
                }else{
                    $data['error'] = $result;
                    $data['user'] = $model->getUserById(Session::get('userId'));
                    $this->view->generate('update_password_view.php', 'main_view.php', $data);
                }
            }else{
                $data['user'] = $model->getUserById(Session::get('userId'));
                $this->view->generate('update_password_view.php', 'main_view.php', $data);
            }
        }  
        
        
        function action_delete(){
            if(!empty($_POST) && $_POST['delete'] == 'True'){
                $model = new User();
                $model->deleteUser(Session::get('userId'));
                session_destroy();
                $url =  URL::getHome();
                header("Location: //$url");
            }
            
        }
        
        function action_list(){
            $model = new User();
            $user = $model->getUserById(Session::get('userId'));
            $followingCount = $user->getCountOfFollowings();
            $followerCount = $user->getCountOfFollowers();
            $allUser = $model->listAllUsers();
            $data =  array("user"=>$user, 'allUser'=>$allUser,'followingNr' => $followingCount,'followersNr'=>$followerCount);
            $this->view->generate('all_users_view.php', 'main_view.php', $data);
            
        }
        function getOwnTweets(){
            $this->model = new Tweet();
            $tweet = $this->model->getOwnTweets();
            return $tweet;
        }
        function getFavoriteTweets(){
            $this->model = new Tweet();
            $tweet = $this->model->getFavoriteTweets();
            return $tweet;
        }
        
        function action_ownTweets(){
            $this->model = new User();
            $user = $this->model->getUserById(Session::get('userId'));
            $tweets = $this->getOwnTweets();
            $followingCount = $user->getCountOfFollowings();
            $followerCount = $user->getCountOfFollowers();
            $data =  array("user"=>$user, "tweet" => $tweets,'followingNr' => $followingCount,'followersNr'=>$followerCount);
            $this->view->generate('own_tweets.php', 'main_view.php', $data);
        }
        function action_favorite(){
            $this->model = new User();
            $user = $this->model->getUserById(Session::get('userId'));
            $tweets = $this->getFavoriteTweets();
            $followingCount = $user->getCountOfFollowings();
            $followerCount = $user->getCountOfFollowers();
            $data =  array("user"=>$user, "tweet" => $tweets,'followingNr' => $followingCount,'followersNr'=>$followerCount);
            $this->view->generate('own_tweets.php', 'main_view.php', $data);
        }
        
        function action_follow(){
            $userId =Session::get('userId');
            $followerId = $_POST['followingUserId'];
            $this->model = new User();
            $this->model->setWhere("userId = ".$userId." and followerUserId =".$followerId);
            $checkFollowed = $this->model->select('follower',__CLASS__);

            if(empty($checkFollowed)) {
                //var_dump(!empty($checkFollowed));
                $follow = $this->model->insertUserFollower($userId, $followerId);
            } else $follow = false;
            echo json_encode(array( "success" => $follow));
        }

        function action_unfollow(){
            $userId = Session::get('userId');
            $followerId = $_POST['followingUserId'];
            $this->model = new User();

            $unfollow = $this->model->delete('follower', array('userId' => $userId, 'followerUserId' => $followerId));

            echo json_encode(array( "success" => $unfollow));
        }
        
        public function action_following()
        {
            $this->model = new User();
            $user = $this->model->getUserById(Session::get('userId'));
            $following = $this->model->getFollowingUsers();
            $followingCount = $this->model->getCountOfFollowings();
            $followerCount = $this->model->getCountOfFollowers();
            $data =  array("user"=>$user, "following" => $following,'followingNr' => $followingCount,'followersNr'=>$followerCount);
            $this->view->generate('following_view.php', 'main_view.php', $data);
        }
        
        public function action_moreUsers()
        {   
            $lastUserId = 0;
            $userClass = '';
            if(!empty($_POST['userId']))
            {
                $lastUserId= $_POST['userId'];
            }
            if(!empty($_POST['type']))
            {
                $userClass= $_POST['type'];
            }
            $this->model = new User();

            if($userClass === 'following') {
                $success = 'following';
                $user = $this->model->getFollowingUsers($lastUserId);
              }
            elseif ($userClass === 'follower'){
                $success = 'follower';
                $user = $this->model->getFollowerUsers($lastUserId);
            }
            elseif ($userClass === 'list'){
                $success = 'list';
                $user = $this->model->listAllUsers($lastUserId);
            }

            $success = false;
            $htmlUsers = "";
            $userCount = 0;

            if(!empty($user)){
                $success = true;
                $htmlUsers = User_Generator::buildUserFromArray($user, true);
                $userCount = count($user);
            }
            
            echo json_encode(array(
                "success" => $success,
                "count" => $userCount,
                "userContent" => $htmlUsers));
        }

        public function action_followers()
        {
            $this->model = new User();
            $user = $this->model->getUserById(Session::get('userId'));
            $follower = $this->model->getFollowerUsers();
            $followingCount = $this->model->getCountOfFollowings();
            $followerCount = $this->model->getCountOfFollowers();
            $data =  array("user"=>$user, "follower" => $follower,'followingNr' => $followingCount,'followersNr'=>$followerCount);
            $this->view->generate('followers_view.php', 'main_view.php', $data);
        }

        public function action_userPage()
        {

            $this->model = new User();
            $user = $this->model->getUserById(Session::get('userId'));
            $genericUserId = Route::getParam();
            $genericUser = $this->model->getUserById($genericUserId);
            $this->model = new Tweet();
            $tweet = $this->model->getOwnTweets($genericUserId);
            $ifFollow = $this->model->getIfFollow($genericUserId);
            if($ifFollow){
                    $ifFollow = true;
            }
            else $ifFollow = false;
            $followingCount = $user->getCountOfFollowings();
            $followerCount = $user->getCountOfFollowers();
            $data =  array("user"=>$user,'genericUser' => $genericUser, 'tweet'=> $tweet, 'ifFollow' => $ifFollow,'followingNr' => $followingCount,'followersNr'=>$followerCount);
            $this->view->generate('genericUserPage.php', 'main_view.php', $data);
        }

    }