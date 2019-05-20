<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name', 255);
			$table->uuid('uuid')->index();
			$table->bigInteger('base_unit_id')
				->unsigned()
				->index();
			$table->timestamps();
			$table->softDeletes();
			$table->dateTime('synchronized_at')->index();
		});

		Schema::table('products', function (Blueprint $table) {
			$table->foreign('base_unit_id')
				->references('id')
				->on('units')
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
		Schema::dropIfExists('products');
	}
}
