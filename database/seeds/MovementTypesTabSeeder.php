<?php

use Illuminate\Database\Seeder;
use App\Models\MovementType;

class MovementTypesTabSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$data = array(
			array('name'=>'Перемещение'),
			array('name'=>'Приходный ордер'),
			array('name'=>'Расходный ордер'),
			array('name'=>'Оприходование'),
			array('name'=>'Списание'),
		);

		MovementType::insert($data); // Eloquent approach
	}
}
