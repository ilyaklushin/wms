<?php 
namespace app\models;
use app\core\App;

/**
 * 
 */
class LocationModel
{
	private $id;
	private $name;
	private $UUID;
	private $type;
	private $parent;

	function __construct($id, $name, $UUID, $type, $parent) {
		$this->id = $id;
		$this->name = $name;
		$this->UUID = $UUID;
		$this->type = $type;
		$this->parent = $parent;
	}

	public function getId() {
		$id = (int) $this->id;
		return $id == 0 ? NULL : $id;
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

	public function getUUID() {
		return $this->UUID;
	}

	public function setUUID($UUID) {
		$this->UUID = $UUID;
	}

	public function getTypeId() {
		return (int) $this->type;
	}

	public function getParentId() {
		return (int) $this->parent;
	}

	public function getData() {
		// $data = array();
		// $data['id'] = $this->id;
		// $data['name'] = $this->name;
		// $data['UUID'] = $this->UUID;
		// $data['type'] = $this->type->getName();
		// $data['path'] = App::$base->getLocationPath($this->id);
		// return $data;
	}

	public function save() {
		return App::$base->insertUpdateLocation($this);
	}

	public static function delete($arr) {
		$result = App::$base->delete("Locations", (array) $arr);
		return $result;
	}

	public static function getAll() {
		$data['title'] = "Места хранения";
		$data['items'] = App::$base->getLocationTree();
		return $data;
	}

	public static function getOne($id) {
		// $Location = App::$base->getLocation($id);
		// $data = array();
		// $data['fields'] = array('name');
		// $data['fieldsdata'] = array($Location->getName());
		// $data['actions'] = array('cancel'=>'', 'save'=>'');
		// return $data;
	}

	public static function getLocationsList()
	{
		$tree = App::$base->getLocationTree();
		$arr = array();
		foreach ($tree as $item) {
		 	$arr[] = array('id' => $item['id'], 'path' => App::$base->getLocationPath($item['id']));
		} 
		return $arr;
	}

}
?>