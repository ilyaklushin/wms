<?php

use Illuminate\Database\Seeder;
use App\Models\LocationType;

class LocationTypesTabSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$data = array(
			array('name'=>'Склад'),
			array('name'=>'Ряд'),
			array('name'=>'Стеллаж'),
			array('name'=>'Полка'),
			array('name'=>'Ячейка'),
		);

		LocationType::insert($data); // Eloquent approach
	}
}
