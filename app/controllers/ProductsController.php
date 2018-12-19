<?php 
namespace app\controllers;
use app\core\App;
use app\core\Controller;
use app\models\ProductModel;

/**
 * 
 */
class ProductsController extends Controller 
{
	public function showAll() {
		$data = ProductModel::getAll();
		// var_dump($data);
		$this->render('Products', $data);
	}

	public function showOne($id = 0) {
		$data = array();
		if ($id != 0) {
			$Product = App::$base->getProduct($id);
			$data = $Product->getData();
		}
		$this->render('Product', $data);
	}

	public function save($id, $name, $UUID) {
		$obj = new ProductModel($id, $name, $UUID);
		$obj->save();
		header('Location: /Products');
		exit;
	}

	public function delete($str) {
		$json = json_decode($str);
		ProductModel::delete($json->id);
	}
}

?>