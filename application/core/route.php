<?php

class Route
{
	static $param = '';
	static function start()
	{
		$controller_name = 'Main';
		$action_name = 'index';


		
		$routes = explode('/', $_SERVER['REQUEST_URI']);

		if ( !empty($routes[1]) )
		{	
			$controller_name = $routes[1];
		}
		
		if ( !empty($routes[2]) )
		{
			$action_name = $routes[2];
		}
		if ( !empty($routes[3]) )
		{
			self::$param = $routes[3];
		}
		
		if(empty(Session::get('logged_in')) && $controller_name != 'register'){
			$controller_name = 'login';
		}

		$controller_name = 'Controller_'.$controller_name;
		$action_name = 'action_'.$action_name;

		if(class_exists($controller_name)) {
			$controller = new $controller_name;
			$action = $action_name;
			if (method_exists($controller, $action)) {
				$controller->$action();
			} else {
				Route::ErrorPage404();
			}
		} else {
			Route::ErrorPage404();
		}
	
	}

	public static function getParam(){
		return self::$param;
	}
	function ErrorPage404()
	{
        $host = '//'.$_SERVER['SERVER_NAME'].'/404';
       /* header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host);*/
    }
    
}
