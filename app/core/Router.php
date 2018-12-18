<?php
namespace app\core;

/**
 * 
 */
class Router
{
	public static function start($url, $routingTable) { 

		$routeRecord = $routingTable[$url];

		$route = explode('::', $routeRecord);

		$controllerName = 'app\\controllers\\'.$route[0]."Controller";
		$controller = new $controllerName();

		$action = $route[1];

		call_user_func_array([$controller, $action], Request::$params);
	}
}
?>