<?php 
namespace app\models;
use app\core\App;

/**
 * 
 */
class MovementTable
{
	private $rows;

	function __construct() {
		$this->rows = array();
	}

	public function getData()
	{
		$data['Cols'] = array('Номер', 'Товар', 'Откуда', 'Куда', 'Количество');
		$data['Rows'] = $this->rows;
	}

	public function addRow($Row)
	{
		$this->rows[] = $Row;
	}

}
?>