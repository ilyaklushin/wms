<?php 
namespace app\models;
use app\core\App;

/**
 * 
 */
class ProductModel
{
	private $id;
	private $name;
	private $UUID;

	private $BaseUnit;
	private $Units;

	private $Locations;
	
	function __construct($id, $name, $UUID) {
		$this->id = $id;
		$this->name = $name;
		$this->UUID = $UUID;
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

	public function getUUID() {
		return $this->UUID;
	}

	public function setUUID($UUID) {
		$this->UUID = $UUID;
	}

	public function getData() {
		$data = array();
		$data['id'] = $this->getId();
		$data['name'] = $this->getName();
		$data['UUID'] = $this->getUUID();
		return $data;
	}

	public function save() {
		if (empty($this->id)) {
			$id = App::$base->insertProduct($this);
		 	$this->id = $id;
		} else {
			App::$base->updateProduct($this);
		}
	}

	public static function delete($arr) {
		$result = App::$base->delete("products", (array) $arr);
		return $result;
	}

	public static function getAll() {
		$data = array();
		$data['title'] = "Товары";
		$data['cols'] = App::$base->getCols('products');
		$data['rows'] = App::$base->getRows('products');
		$data['actions'] = array('edit'=>'', 'delete'=>'');
		return $data;
	}

	public static function getOne($id) {
		$product = App::$base->getProduct($id);
		$data = array();
		$data['fields'] = array('name');
		$data['fieldsdata'] = array($product->getName());
		$data['actions'] = array('cancel'=>'', 'save'=>'');
		return $data;
	}

}
?>