<?php

class User extends Model {

    private $id ;
    private $login ;
    private $password ;
    private $email ;
    private $first_name ;
    private $last_name;
    private $birthDate;
    private $avatar;
    private $biography;
    private $obj;

    function __construct()
    {
        parent::__construct();
    }



    public function setId($id)
    {
        $this->id = $id;
    }

    public function setEmail($email)
    {
        $this->isNew['email'] = True;
        $this->email = $email;
    }

    public function setSurname($surname)
    {
        $this->isNew['surname'] = True;
        $this->surname = $surname;
    }

    public function getId()
    {
        return $this->id;
    }

        public function getLogin()
    {
        return $this->login;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function getFullName()
    {
        return $this->getFirstName().' '.$this->getLastName();
    }
    
    public function getAvatar()
    {
        return $this->avatar;
    }
    
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    public function getBiography()
    {
        return $this->biography;
    }
    
    
    public function getPassword()
    {
        return $this->password;
    }
    
    public function setUserColumn()
    {
        return  array(  'login' => $this->getLogin(),
                        'email' => $this->getEmail(),
                        'first_name' => $this->getFirstName(),
                        'last_name' => $this->getLastName(),
                        'avatar' => $this->getAvatar,
                        'biography' => $this->getBiography()
                    );
    }


    public function insertUser()
    {
        $this->insert('users', $this->setUserColumn());
    }

    public function createUser($first_name, $last_name, $email, $login, $password, $birthDate)
    {
        $sql = "INSERT INTO user(first_name, last_name, email, login, password, birthDate) VALUES(:first_name, :last_name, :email, :login, :password, :birthDate)";
        
        $first_name = Filter::value($first_name);
        $last_name = Filter::value($last_name);
        $email = Filter::value($email);
        $login = Filter::value($login);
        $password = Filter::value($password);
        $birthDate = Filter::value($birthDate);
        
        $sth = $this->db->prepare($sql);
        $sth->bindParam(':first_name', $first_name, PDO::PARAM_STR);
        $sth->bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $sth->bindParam(':email', $email, PDO::PARAM_STR);
        $sth->bindParam(':login', $login, PDO::PARAM_STR);
        $sth->bindParam(':password', $password, PDO::PARAM_STR);
        $sth->bindParam(':birthDate', $birthDate, PDO::PARAM_STR);
        
        try {
            $sth->execute();                      
            return $sth->errorInfo();
        } catch (PDOException $e) {  
            Logging::register()->error($e->getMessage());
            return $sth->errorInfo();
        }
    }

    public function updateUser($userId, $first_name, $last_name, $birthDate, $email, $avatar){
        if($this->id == 0 ){
            $this->obj = $this->getUserById($userId);
        }
        $sql = "UPDATE users SET ";
        $querry = array();
        
        if ($this->obj->getEmail() !== $email) {
            $email = Filter::value($email);
            $querry['sql'][] = "email = :email";
            $querry['params']['email'] = $email;
        }

        if ($this->obj->getFirstName() !== $first_name) {
            $first_name = Filter::value($first_name);
            $querry['sql'][] = "first_name = :first_name";
            $querry['params']['first_name'] = $first_name;
        }

        if ($this->obj->getLastName() !== $last_name) {
            $last_name = Filter::value($last_name);
            $querry['sql'][] = "last_name = :last_name";
            $querry['params']['last_name'] = $last_name;
        }
        
        if ($this->obj->getBirthDate() !== $birthDate) {
            $birthDate = Filter::value($birthDate);
            $querry['sql'][] = "birthDate = :birthDate";
            $querry['params']['birthDate'] = $birthDate;
        }
        
        if ($this->obj->getAvatar() !== $avatar) {
            $avatar = Filter::value($avatar);
            $querry['sql'][] = "avatar = :avatar";
            $querry['params']['avatar'] = $avatar;            
        }
        
        $sql = "UPDATE user SET "; 
        
        foreach($querry['sql'] as $key=>$stmt){
            if($key > 0){
                $sql .= ', '.$stmt;
            }else{
                $sql .= $stmt;
            }
        }
        $sql .= " WHERE id = :userId";
        
        
        $sth = $this->db->prepare($sql);
        
        $sth->bindParam('userId', $userId, PDO::PARAM_INT);
        
        foreach($querry['params'] as $key=>$value){
            $sth->bindParam(":$key", $querry['params'][$key], PDO::PARAM_STR);
        }
        
        
        try {
            $sth->execute();
            Logging::register()->info("The user with id $userId was updated succesfully ".$sql);            
            Logging::register()->debug($sql);
            return True;
        } catch (PDOException $e) {            
            Logging::register()->error($e->getMessage());           
            return False;
        }
    }
    
    public function updateUserPassword($userId, $password){
        if($this->id == 0 ){
            $this->obj = $this->getUserById($userId);
        }
        $sql = "UPDATE user SET ";
        if ($this->obj->getPassword() !== $password) {
            $password = Filter::value($password);
            $sql .= "password = :password";
            $sql .= " WHERE id = :userId";
        }
        $sth = $this->db->prepare($sql);        
        $sth->bindParam('password', $password, PDO::PARAM_STR);
        $sth->bindParam('userId', $userId, PDO::PARAM_STR);
        
        try {
            $sth->execute();
            Logging::register()->info("The user with id $userId succesfully updated his password ".$sql);                        
            return True;
        } catch (PDOException $e) {            
            Logging::register()->error($e->getMessage());           
            return False;
        }
    }
    
    
    public function getUserById($id){
        //$this->db = Database::getInstance()->getDb();
        $sql = 'SELECT * FROM user WHERE id= :id';
        $sth = $this->db->prepare($sql);
        $sth->bindParam(':id', $id, PDO::PARAM_INT);
        
        try {
            $sth->execute();
            $result = $sth->fetchObject('User');  
            return $result;
        } catch (PDOException $e) {
            Logging::register()->error($e->getMessage());
            return False;
        }
    }
    
    
    public function getUserByLogin($login){
        
        $sql = 'SELECT * FROM user WHERE login= :login';
        $sth = $this->db->prepare($sql);
        $sth->bindParam(':login', $login, PDO::PARAM_INT);
        try {
            $sth->execute();
            $result = $sth->fetchObject('User');            
            return $result;
        } catch (PDOException $e) {            
            Logging::register()->error($e->getMessage());
            return False;
        }

    }
    
    
    public function deleteUser($id)
    {
        $sql = "DELETE FROM user WHERE id = :id";
        $sth = $this->db->prepare($sql);
        $sth->bindParam(':id', $id, PDO::PARAM_INT);
        $result = $sth->execute();
        if($result == True){
            return True ;
        }else{
            return $sth->errorInfo();
        }
    }
    
    public function listAllUsers($idStart = 0)
    {
        $sql="Select * FROM (SELECT user.id,login, first_name, last_name, birthDate, biography, avatar,email, false as follow, user.id as fid 
              From user where user.id <>".Session::get('userId')." and user.id NOT IN( Select user.id FROM user inner join follower on followerUserId = user.id WHERE follower.userId = ".Session::get('userId')." and user.id <> ".Session::get('userId').") 
              UNION SELECT user.id,login, first_name, last_name, birthDate, biography, avatar, email, true as follow, user.id as fid  
              FROM user INNER JOIN follower on follower.followerUserId = user.id WHERE follower.userId =".Session::get('userId').")a WHERE a.id > ".$idStart." order by a.id asc limit 6";
        //var_dump($sql);
        return $this->query($sql, __CLASS__);
//        $this->setOrder('id','desc');
//        $this->setLimit('1000');
//        return $this->select('user',__CLASS__,array('user.id','first_name','last_name','email','birthDate','avatar','biography'));
    }
    
    public function unfollowedUsers(){
        $sql = "SELECT user.id, first_name, last_name, birthDate, biography, avatar From user where user.id <>".Session::get('userId')." and user.id NOT IN( Select user.id FROM user inner join follower on followerUserId = user.id WHERE follower.userId = ".Session::get('userId')." and user.id <> ".Session::get('userId').") ORDER BY user.id limit 5";
      //var_dump($sql);
       return $this->query($sql, __CLASS__);
    }

    public function getCountOfFollowings()
    {
        $userId = Session::get('userId');
        $this->setJoin("INNER JOIN follower on follower.followerUserId = user.id ");
        $this->setWhere("WHERE follower.userId =".$userId);
        $this->setOrder('follower.id','desc');
        $this->setLimit('100');
        return $this->select('user',__CLASS__);
    }
    public function getCountOfFollowers()
    {
        $userId = Session::get('userId');
        $this->setJoin("INNER JOIN user on user.id = follower.userId ");
        $this->setWhere("WHERE follower.followerUserId =".$userId);
        $this->setOrder('user.id','asc');
        $this->setLimit('100');
        return $this->select('follower',__CLASS__);
    }
    public function getFollowingUsers($idStart = 0){
        $userId = Session::get('userId');
        $whereAdd="";
        if ($idStart !==0){
            $whereAdd="and follower.id < '".$idStart."'";
        }
        $this->setJoin("INNER JOIN follower on follower.followerUserId = user.id ");
        $this->setWhere("WHERE follower.userId =".$userId." ".$whereAdd);
        $this->setOrder('follower.id','desc');
        $this->setLimit('6');
        return $this->select('user',__CLASS__,array('user.id','first_name','last_name','email','birthDate','avatar','biography','follower.id as fid', 'true as follow'));

    }
    
    public function getFollowerUsers($idStart = 0){
        $userId = Session::get('userId');
        $sql = "SELECT *, if((SELECT id from follower where follower.userId = ".$userId." and follower.followerUserId = user.id ),true, false) 
                as follow FROM follower INNER JOIN user on user.id = follower.userId WHERE follower.followerUserId =".$userId."";
        return $this->query($sql,__CLASS__);
//        $whereAdd="";
//        if ($idStart !==0){
//            $whereAdd="and user.id > '".$idStart."'";
//        }
//        $this->setJoin("INNER JOIN user on user.id = follower.userId ");
//        $this->setWhere("WHERE follower.followerUserId =".$userId." ".$whereAdd);
//        $this->setOrder('follower.id','desc');
//        $this->setLimit('6');
//        return $this->select('follower',__CLASS__,array('user.id','first_name','last_name','email','birthDate','avatar','biography','follower.id as fid'));
    }

    public function insertUserFollower($userId, $followerId)
    {
       return $this->insert('follower', array('userId' => $userId, 'followerUserId' => $followerId));        
    }

    public function toJSON() {
        return json_encode([
            'id' => $this->id,
            'login' => $this->login ,
            'email' => $this->email,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'birthDate' => $this->birthDate,
            'avatar' => $this->avatar,
            'biography'=> $this->biography
        ]) ;
    }
   
}