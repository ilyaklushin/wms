<?php 
namespace app\models;
use app\models\ProductModel as Product;
use app\models\UnitModel as Unit;
use app\models\LocationTypeModel as LocationType;
use app\models\MovementModel as Movement;
use app\models\LocationModel as Location;

/**
 * Класс для получения данных из базы данных MySQL
 */
class MySQLModel
{
	private $db;

	public function __construct()
	{
		$user = 'root';
		$pass = '';
		$base = 'wms';
		$this->db = new \SafeMysql(array('user'=>$user, 'pass'=>$pass, 'db'=>$base, 'charset'=>'utf8'));
	}

	public function getCols($name) {
		$array = array(
			'units'				=> '#::Наименование',
			'products'			=> '#::Наименование::Код',
			'location_types'	=> '#::Наименование',
			'movements'			=> 'Номер::Дата'
		);
		$cols = explode('::', $array[$name]);
		return $cols;
	}

	public function getRows($name) {
		$array = array(
			'units'				=> '`id`, `name`',
			'products'			=> '`id`, `name`, `UUID`',
			'location_types'	=> '`id`, `name`',
			'movements'			=> '`id`, `date`'
		);
		$data = $this->db->getAll("SELECT $array[$name] FROM `$name`");
		return $data;
	}

	public function delete($tablename, $ids) {
		return $this->db->query("DELETE FROM ?n WHERE id IN (?a)", $tablename, $ids);
	}


	public function getUnit($id) {
		$data = $this->db->getRow("SELECT * FROM `Units` WHERE id=?i", $id);
		return new Unit($data['id'], $data['name']);
	}

	public function insertUnit($Unit) {
		$this->db->query("INSERT INTO `Units`(`name`) VALUES (?s)", $Unit->getName());
		return $this->db->insertId();
	}

	public function updateUnit($Unit) {
		return $this->db->query("UPDATE `Units` SET `name`=?s WHERE `id`=?i", $Unit->getName(), $Unit->getId());	
	}


	public function getProduct($id) {
		$data = $this->db->getRow("SELECT * FROM `products` WHERE id=?i", $id);
		return new Product($data['id'], $data['name'], $data['UUID']);
	}

	public function insertProduct($Product) {
		$this->db->query("INSERT INTO `products`(`UUID`, `name`) VALUES (?s, ?s)", $Product->getUUID(), $Product->getName());
		return $this->db->insertId();
	}

	public function updateProduct($Product) {
		return $this->db->query("UPDATE `products` SET `UUID`=?s,`name`=?s WHERE `id`=?i", $Product->getUUID(), $Product->getName(), $Product->getId());	
	}


	public function getLocationType($id) {
		$data = $this->db->getRow("SELECT * FROM `location_types` WHERE id=?i", $id);
		return new LocationType($data['id'], $data['name']);
	}

	public function insertLocationType($LocationType) {
		$this->db->query("INSERT INTO `location_types`(`name`) VALUES (?s)", $LocationType->getName());
		return $this->db->insertId();
	}

	public function updateLocationType($LocationType) {
		return $this->db->query("UPDATE `location_types` SET `name`=?s WHERE `id`=?i", $LocationType->getName(), $LocationType->getId());	
	}


	public function getMovement($id) {
		$table = new MovementTable();
		$query = "
			SELECT * FROM `movements` WHERE id=?i
		";
		$data = $this->db->getRow($query, $id);
		$Movement = new Movement($data['id'], $data['date'], "");
		return $Movement;
	}



	public function getLocation($id)
	{
		$Location = new Location();
		return $Location;
	}

	public function insertUpdateLocation($Location)
	{
		$this->db->query("
			INSERT INTO `locations` (`id`, `name`, `idLocationType`, `UUID`) VALUES (?i, ?s, ?i, ?s)
			ON DUPLICATE KEY UPDATE `name`=VALUES(`name`), `idLocationType`=VALUES(`idLocationType`), `UUID`=VALUES(`UUID`);
		", $Location->getId(), $Location->getName(), $Location->getTypeId(), $Location->getUUID());
		
		$lastId = $this->db->insertId();
		
		$this->db->query("
			INSERT INTO locations_tree (idAncestor, idDescendant, idNearestAncestor, level) 
			SELECT idAncestor, ?i, ?i, level + 1 
			FROM locations_tree 
			WHERE idDescendant = ?i
			UNION ALL SELECT ?i, ?i, ?i, 0
			ON DUPLICATE KEY UPDATE `idAncestor`=VALUES(`idAncestor`), `idDescendant`=VALUES(`idDescendant`), `idNearestAncestor`=VALUES(`idNearestAncestor`), `level`=VALUES(`level`);
		", $lastId, $Location->getParentId(), $Location->getParentId(), $lastId, $lastId, $Location->getParentId());
	}

	public function getLocationTree()
	{
		$data = $this->db->getAll("
			SELECT location.id, tree.idNearestAncestor AS pid, CONCAT(type.name, ' \"', location.name, '\"') AS name
			FROM locations AS location
			INNER JOIN location_types AS type 
			ON (location.idLocationType = type.id)
			INNER JOIN locations_tree AS tree 
			ON (location.id = tree.idDescendant)
			WHERE tree.idAncestor = 1
		");
		return $data;	
	}

	public function getLocationPath($id)
	{
		$data = $this->db->getCol("
			SELECT CONCAT(type.name, ' ', location.name) AS String
			FROM locations AS location
			INNER JOIN location_types AS type 
			ON (location.idLocationType=type.id)
			JOIN locations_tree AS tree
			ON (location.id = tree.idAncestor)
			WHERE tree.idDescendant = ?i
			GROUP BY tree.level
			ORDER BY tree.level DESC
		", $id);
		$str = implode(", ", $data);
		return $str;
	}
}
?>