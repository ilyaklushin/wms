<?php 
namespace app\controllers;
use app\core\App;
use app\core\Controller;
use app\models\UnitModel;

/**
 * 
 */
class UnitsController extends Controller 
{
	public function showAll() {
		$data = UnitModel::getAll();
		$this->render('List', $data);
	}

	public function showOne($id = 0) {
		$data = array();
		if ($id != 0) {
			$Unit = App::$base->getUnit($id);
			$data = $Unit->getData();
		}
		$this->render('Unit', $data);
	}

	public function save($id, $name) {
		$obj = new UnitModel($id, $name);
		$obj->save();
		header('Location: /Units');
		exit;
	}

	public function delete($str) {
		$json = json_decode($str);
		UnitModel::delete($json->id);
	}
}

?>