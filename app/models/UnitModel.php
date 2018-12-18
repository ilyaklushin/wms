<?php 
namespace app\models;
use app\core\App;

/**
 * 
 */
class UnitModel
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

	public function save() {
		if (empty($this->id)) {
			$id = App::$base->insertUnit($this);
		 	$this->id = $id;
		} else {
			App::$base->updateUnit($this);
		}
	}

	public static function delete($arr) {
		$result = App::$base->delete("Units", (array) $arr);
		return $result;
	}

	public static function getAll() {
		$data = array();
		$data['title'] = "Единицы измерения";
		$data['cols'] = App::$base->getCols('units');
		$data['rows'] = App::$base->getRows('units');
		$data['actions'] = array('edit'=>'', 'delete'=>'');
		return $data;
	}

	public static function getOne($id) {
		$Unit = App::$base->getUnit($id);
		$data = array();
		$data['fields'] = array('name');
		$data['fieldsdata'] = array($Unit->getName());
		$data['actions'] = array('cancel'=>'', 'save'=>'');
		return $data;
	}

}
?>