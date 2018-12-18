<?php 
namespace app\core;

/**
 * 
 */
class Request
{
	public static $route;
	public static $ajax;
	public static $params;
	
	public static function getRequest() {
		self::$route = self::getRoute();
		self::$ajax = self::isAjax();
		self::$params = self::getParams();
	}

	private static function getRoute() {
		$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$url = urldecode($request);
		$cleanUrl = strtolower(filter_var($url, FILTER_SANITIZE_URL));
		return $cleanUrl;
	}

	private static function isAjax() {
		if (empty($_SERVER['HTTP_X_REQUESTED_WITH'])) return false;
		if (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') return false;
		return true;
	}

	private static function getParams() {
		if (!empty(self::$params)) return self::$params;
		self::$params = empty($_GET) ? $_POST : $_GET;
		return self::$params;
	}
}
?>