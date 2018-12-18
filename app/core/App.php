<?php 
namespace app\core;
use app\models\MySQLModel as Base; 

/**
* Main app class
*/
class App
{

	public static $base;

	public static function start() {

		ErrorHandler::register();

		try {

			self::$base = new Base(); 
			
			Request::getRequest();

			User::CurrentUser();

			Router::start(Request::$route, User::$routingTable);

		} catch (\Exception $e) {
			ErrorHandler::showError("Exception", $e->getMessage(), $e->getFile(), $e->getLine());
		}	
	}
}
?>