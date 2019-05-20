<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovementLinesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('movement_lines', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->bigInteger('movement_id')
				->unsigned()
				->index();
			$table->bigInteger('location_from_id')
				->unsigned()
				->nullable()
				->index();
			$table->bigInteger('location_to_id')
				->unsigned()
				->nullable()
				->index();
			$table->bigInteger('product_id')
				->unsigned()
				->index();
			$table->integer('quantity')
				->unsigned();
		});

		Schema::table('movement_lines', function (Blueprint $table) {
			$table->foreign('movement_id')
				->references('id')
				->on('movements')
				->onUpdate('cascade')
				->onDelete('cascade');

			$table->foreign('location_from_id')
				->references('id')
				->on('locations')
				->onUpdate('restrict')
				->onDelete('restrict');

			$table->foreign('location_to_id')
				->references('id')
				->on('locations')
				->onUpdate('restrict')
				->onDelete('restrict');

			$table->foreign('product_id')
				->references('id')
				->on('products')
				->onUpdate('restrict')
				->onDelete('restrict');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('movement_lines');
	}
}
