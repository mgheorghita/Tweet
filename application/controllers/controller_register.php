<?php

    class Controller_Register extends Controller
    {    
        protected $response;
        
        function action_index(){
            
            if(!empty($_POST)){
                $this->response = array();                
                
                $this->response[] = Validation::string($_POST['first_name'], 'first name');
                $this->response[] = Validation::string($_POST['last_name'], 'last name');
                $this->response[] = Validation::login($_POST['login'], 'login');
                $this->response[] = Validation::email($_POST['email'], 'email');
                $this->response[] = Validation::dateFormat($_POST['birthDate'], 'birth date');
                
                if($_POST['password'] !== $_POST['password_confirmation']){
                    $this->response[] = 'The passwords don\'t match';
                }else{
                    $this->response[] = Validation::password($_POST['password']);
                }
                
                $result = '';
                foreach($this->response as $key=>$value){
                    if(!empty($value) && !is_array($value)){
                        $result .= $value.'<br>'; 
                    }elseif(is_array($value)){
                        foreach($value as $val){
                            $result .= $val.'<br>';                            
                        }
                    }
                }
                
                
                if(!empty($result)){
                    $data['error'] = $result;
                    $this->view->generate('register_view.php', 'main_view.php', $data);
                }else{
                    $model = new User();
                
                    $result = $model->createUser($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['login'], md5($_POST['password']), $_POST['birthDate']);
                    if($result !== True && $result['1'] == 1062){                        
                        $data['error'] = 'There is already a user with the login and email specified. If you have an account, you can ask for a password reset';
                        $this->view->generate('register_view.php', 'main_view.php', $data);
                    }elseif(is_array($result)){
                        
                        $data['error'] = $result;
                        $this->view->generate('register_view.php', 'main_view.php', $data);
                        
                    }else{
                        
                        $data['success'] = 'You are sccesfully registered. <br> You can login now';
                        $data['registered'] = "True";
                        $this->view->generate('login_view.php', 'main_view.php', $data);
                        
                    }
                }              
            }else{
                $this->view->generate('register_view.php', 'main_view.php');
            }
            
            
        }
        
        
        public function action_test(){         
        
            $this->response = array();                
                
            $this->response[] = Validation::string($_POST['first_name'], 'first name');
            $this->response[] = Validation::string($_POST['last_name'], 'last name');
            $this->response[] = Validation::login($_POST['login'], 'login');
            $this->response[] = Validation::email($_POST['email'], 'email');
            $this->response[] = Validation::dateFormat($_POST['birthDate'], 'birth date');

            if($_POST['password'] !== $_POST['password_confirmation']){
                $this->response[] = 'The passwords don\'t match';
            }else{
                $this->response[] = Validation::password($_POST['password']);
            }
            
            foreach($this->response as $key=>$val){
                if(empty($val)){
                    unset($this->response[$key]);
                }
            }
            
            if(empty($this->response)){           
                $model = new User();
                $result = $model->createUser($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['login'], md5($_POST['password']), $_POST['birthDate']);

                if($result !== True && $result['1'] == 1062){
                    Logging::register()->debug('There is already a user with the login '.$_POST['login'].'and email '.$_POST['email']);
                    $this->response[] = 'There is already a user with the login and email specified. If you have an account, you can ask for a password reset';
                }elseif($result['0'] > 00000){
                    Logging::register()->debug('Registration process with login = '.$_POST['login'].', email '.$_POST['email'].', first_name '.$_POST['first_name'].', last_name '.$_POST['last_name'].', password '.$_POST['password']);
                    $this->response[] = $result;
                }
            }
            
            if(empty($this->response)){
                echo json_encode(array("success" => 'Ok', "error" => ''));
                Logging::register()->info("The user ".$_POST['login']." was created succesfully ");  
            }else{
                echo json_encode(array( "success" => 'False', "error" => $this->response));
            }
        }
    }
?>