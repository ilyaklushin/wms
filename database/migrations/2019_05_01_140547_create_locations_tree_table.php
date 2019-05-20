<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTreeTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('locations_tree', function (Blueprint $table) {
			$table->bigInteger('id_ancestor')
				->unsigned()
				->index();
			$table->bigInteger('id_descendant')
				->unsigned()
				->index();
			$table->bigInteger('id_nearest_ancestor')
				->unsigned()
				->index();
			$table->integer('level')
				->unsigned();
		});

        Schema::table('locations_tree', function (Blueprint $table) {
           	$table->foreign('id_ancestor')
                ->references('id')
                ->on('locations');

			$table->foreign('id_descendant')
                ->references('id')
                ->on('locations');

			$table->foreign('id_nearest_ancestor')
                ->references('id')
                ->on('locations');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('locations_tree');
	}
}
