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
		$this->render('DashBoard', $data);
	}

}
?>