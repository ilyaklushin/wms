<?php
namespace app\core;

/**
* Базовый класс контроллера
*/
class Controller
{

	/**
	 * Show data
	 * @param string $layoutName 
	 * @param array $params 
	 */
	public function render($layoutName, $params) {
		if (Request::$ajax) return ajax($params);
			
		$loader = new \Twig_Loader_Filesystem(__DIR__.'/../views/');
		$twig = new \Twig_Environment($loader);
		echo $twig->render($layoutName.".twig", $params);
	}

	/**
	 * Show json
	 * @param array $params 
	 */
	public function ajax($params) {
		echo json_encode($params);
	}
}
?>