<?php 
namespace app\controllers;
use app\core\App;
use app\core\Controller;
use app\models\LocationModel;

/**
 * 
 */
class LocationsController extends Controller 
{

	public function showAll() {
		$data = LocationModel::getAll();
		$this->render('Locations', $data);
	}
	
	public function showOne($id = 0) {
		$data = array();
		if ($id != 0) {
			$Location = App::$base->getLocation($id);
			$data = $Location->getData();
		}
		$data['types'] = App::$base->getRows('location_types');
		$data['locations'] = LocationModel::getLocationsList();
		$this->render('Location', $data);
	}

	public function save($id, $name, $UUID, $idType, $idParent) {
		$Location = new LocationModel($id, $name, $UUID, $idType, $idParent);
		$Location->save();
		header('Location: /Locations');
		exit;
	}

	public function delete($str) {
		$json = json_decode($str);
		LocationModel::delete($json->id);
	}

}
?>