<?php 
namespace app\models;
use app\core\App;

/**
 * 
 */
class LocationTypeModel
{
	private $id;
	private $name;

	function __construct($id, $name) {
		$this->id = $id;
		$this->name = $name;
	}

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getData() {
		$data = array();
		$data['id'] = $this->getId();
		$data['name'] = $this->getName();
		return $data;
	}

	public function fillById($id) {
		$data = App::$base->getLocationType($id);
		$this->id = $id;
		$this->name = $data['name'];
	}

	public function save() {
		if (empty($this->id)) {
			$id = App::$base->insertLocationType($this);
		 	$this->id = $id;
		} else {
			App::$base->updateLocationType($this);
		}
	}

	public static function delete($arr) {
		$result = App::$base->delete("location_types", (array) $arr);
		return $result;
	}

	public static function getAll() {
		$data = array();
		$data['title'] = "Типы мест хранения";
		$data['cols'] = App::$base->getCols('location_types');
		$data['rows'] = App::$base->getRows('location_types');
		$data['actions'] = array('update'=>'', 'delete'=>'');
		return $data;
	}

	public static function getOne($id) {
		$LocationType = App::$base->getLocationType($id);
		$data = array();
		$data['fields'] = array('name');
		$data['fieldsdata'] = array($LocationType->getName());
		$data['actions'] = array('cancel'=>'', 'save'=>'');
		return $data;
	}

}
?>