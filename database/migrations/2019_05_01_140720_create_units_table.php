<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('units', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name', 255);
			$table->uuid('uuid')->index();
			$table->timestamps();
			$table->softDeletes();
			$table->dateTime('synchronized_at')->index();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('units');
	}
}
