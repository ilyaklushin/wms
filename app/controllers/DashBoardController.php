<?php 
namespace app\controllers;
use app\core\App;
use app\core\Controller;

/**
 * Контроллер главной страницы
 */
class DashBoardController extends Controller 
{
	public function show()
	{
		$data = array();
		$data['title'] = "Главная страница";
		$this->render('DashBoard', $data);
	}

}
?>