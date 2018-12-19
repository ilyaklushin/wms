<?php 
namespace app\controllers;
use app\core\App;
use app\core\Controller;
use app\models\MovementModel;
use app\models\LocationModel;

/**
 * 
 */
class MovementsController extends Controller 
{
	public function showAll()
	{
		$data = MovementModel::getAll();
		$this->render('List', $data);
	}

	public function showOne($id = 0) {
		$data = array();
		if ($id != 0) {
			$Movement = App::$base->getMovement($id);
			$data = $Movement->getData();
		}
		$data['locations'] = LocationModel::getLocationsList();
		$data['products'] = App::$base->getRows('products');
		$this->render('Movement', $data);
	}

	public function save($id, $name, $table) {
		$obj = new MovementModel($id, $name, $table);
		$obj->save();
		header('Location: /Movements');
		exit;
	}

	public function delete($str) {
		$json = json_decode($str);
		MovementModel::delete($json->id);
	}
}

?>