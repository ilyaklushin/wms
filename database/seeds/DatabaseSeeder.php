<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call(UsersTabSeeder::class);
		$this->call(MovementTypesTabSeeder::class);
		$this->call(LocationTypesTabSeeder::class);
	}
}
