<?php

class Controller_Update extends Controller{
        
    function action_index(){
        if(!empty($_POST)){
            $response = array();                

            $response[] = Validation::string($_POST['first_name'], 'first name');
            $response[] = Validation::string($_POST['last_name'], 'last name');
            $response[] = Validation::numeric($_POST['age'], 'age');
            $response[] = Validation::email($_POST['email'], 'email');

            $result = '';
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
                $model = new User();
                $result = $model->updateUser(Session::get('userId'), $_POST['first_name'], $_POST['last_name'], $_POST['age'], $_POST['email']);
                $this->view->generate('empty_view.php', 'main_view.php', $result);
            }
            /*
            if($result !== True){
                        $data['error'] = 'We allready have a user with the login and email specified. If you allready have an account, you can ask for   a password reset';
                        $this->view->generate('register_view.php', 'main_view.php', $data);
                    }elseif($result !== True && $result['1'] == 1062){
                        
                        $data['error'] = 'Your registration failed. Please try again';
                        $this->view->generate('register_view.php', 'main_view.php', $data);
                        
                    }else{
                        $data['success'] = 'You are sccesfully registered. <br> You can login now';
                        $data['registered'] = "True";
                        $this->view->generate('login_view.php', 'main_view.php', $data);
                    }
            */
        }else{
                $model = new User();
                $data['user'] = $model->getUserById(Session::getUserId());
                $this->view->generate('update_view.php', 'main_view.php', $data);
        }
    }
}