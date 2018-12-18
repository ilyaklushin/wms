<?php 
namespace app\controllers;
use app\core\App;
use app\core\Controller;
use app\models\LocationTypeModel;

/**
 * 
 */
class LocationTypesController extends Controller 
{
	public function showAll()
	{
		$data = LocationTypeModel::getAll();
		$this->render('List', $data);
	}

	public function showOne($id = 0) {
		$data = array();
		if ($id != 0) {
			$LocationType = App::$base->getLocationType($id);
			$data = $LocationType->getData();
		}
		$this->render('LocationType', $data);
	}

	public function save($id, $name) {
		$obj = new LocationTypeModel($id, $name);
		$obj->save();
		header('Location: /LocationTypes');
		exit;
	}

	public function delete($str) {
		$json = json_decode($str);
		LocationTypeModel::delete($json->id);
	}

}

?>