<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoriesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inventories', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->uuid('uuid')
				->index();
			$table->bigInteger('location_id')
				->unsigned()
				->index();
			$table->timestamps();
			$table->softDeletes();
			$table->dateTime('synchronized_at')->index();
		});

		Schema::table('inventories', function (Blueprint $table) {
			$table->foreign('location_id')
				->references('id')
				->on('locations')
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
		Schema::dropIfExists('inventories');
	}
}
