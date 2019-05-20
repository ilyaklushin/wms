<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->bigInteger('id_location_type')
                ->unsigned()
                ->index();
            $table->uuid('uuid')
                ->index();
        });

        Schema::table('locations', function (Blueprint $table) {
            $table->foreign('id_location_type')
                ->references('id')
                ->on('location_types')
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
        Schema::dropIfExists('locations');
    }
}
