<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovementsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('movements', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->bigInteger('movement_type_id')
				->unsigned()
				->index();
			$table->uuid('uuid')
				->index();
			$table->timestamps();
			$table->softDeletes();
			$table->dateTime('synchronized_at')->index();
		});
		
		Schema::table('movements', function (Blueprint $table) {
			$table->foreign('movement_type_id')
				->references('id')
				->on('movement_types')
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
		Schema::dropIfExists('movements');
	}
}
