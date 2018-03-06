<?php

/**
 * Created by PhpStorm.
 * User: mgheorghita
 * Date: 5/23/2016
 * Time: 8:34 AM
 */
class controller_api extends Controller
{
    public function action_user()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if($method){
            $user = new User();
            if ($method === 'GET')
            {
                $id = Route::getParam();
                if($id)
                {
                    $response = $user -> getUserById($id);
                    echo($response -> toJSON());
                 }
                else {
                    $response = $user -> listAllUsers();
                    echo json_encode($response);
                }
            }
            else if ($method === 'POST')
            {
                $login = $_POST['login'];
                $response = $user -> getUserByLogin($login);
                echo($response -> toJSON());
            }
            else if ($method === 'PUT')
            {
                $id = Route::getParam();
                if($id) {
                    parse_str(file_get_contents("php://input"), $values);
                    $firstName = ($values['firstName']);
                    $user->update('user', array('first_name' => $firstName), $id);
                    $response = $user->getUserById($id);
                    echo($response->toJSON());
                }
                else echo "not specified id";
            }
            else if($method === 'DELETE'){
                $id = Route::getParam();
                $response = $user ->deleteUser($id);
                if ($response) {
                    echo json_encode(array('id' => $id, 'status' => 'Deleted'));
                }
                else  echo json_encode(array('id' => $id, 'status' => 'Warning'));
            }
        }
    }
}