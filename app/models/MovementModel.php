<?php 
namespace app\models;
use app\core\App;

/**
 * 
 */
class MovementModel
{
	private $id;
	private $date;
	private $table;
	

	function __construct($id, $name, $table) {
		$this->id = $id;
		$this->name = $name;
		$this->table = $table;
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

	public function getTable() {
		return $this->table;
	}

	public function setTable($table) {
		$this->table = $table;
	}

	public function getData() {
		$data = array();
		$data['fieldsNames'] = array('Номер','Дата');
		$data['fieldsData'] = array(
			'id' => $this->id,
			'date' => $this->date,
		);
		$data['table'] = $this->table->getData();
		return $data;
	}

	public function save() {
		if (empty($this->id)) {
			$id = App::$base->insertMovement($this);
		 	$this->id = $id;
		} else {
			App::$base->updateMovement($this);
		}
	}

	public static function delete($arr) {
		$result = App::$base->delete("movements", (array) $arr);
		return $result;
	}

	public static function getAll() {
		$data = array();
		$data['title'] = "Перемещения";
		$data['cols'] = App::$base->getCols('movements');
		$data['rows'] = App::$base->getRows('movements');
		$data['actions'] = array('edit'=>'', 'delete'=>'');
		return $data;
	}

	public static function getOne($id) {
		$Movement = App::$base->getMovement($id);
		$data = $Movement->getData();
		return $data;
	}

}
?>