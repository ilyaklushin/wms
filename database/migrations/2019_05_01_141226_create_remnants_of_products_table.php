<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRemnantsOfProductsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('remnants_of_products', function (Blueprint $table) {
			$table->bigInteger('product_id')
				->unsigned()
				->index();
			$table->bigInteger('location_id')
				->unsigned()
				->index();
			$table->integer('quantity')
				->unsigned();
		});

		Schema::table('remnants_of_products', function (Blueprint $table) {
			$table->foreign('product_id')
				->references('id')
				->on('products')
				->onUpdate('cascade')
				->onDelete('cascade');
			$table->foreign('location_id')
				->references('id')
				->on('locations')
				->onUpdate('cascade')
				->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('remnants_of_products');
	}
}