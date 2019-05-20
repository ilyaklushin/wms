<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_lines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('inventory_id')
                ->unsigned()
                ->index();
            $table->bigInteger('product_id')
                ->unsigned()
                ->index();
            $table->bigInteger('unit_id')
                ->unsigned()
                ->index();
            $table->integer('calculated_quantity')
                ->unsigned();
            $table->integer('actual_quantity')
                ->unsigned();
        });

        Schema::table('inventory_lines', function (Blueprint $table) {
            $table->foreign('inventory_id')
                ->references('id')
                ->on('inventories')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onUpdate('restrict')
                ->onDelete('restrict');

            $table->foreign('unit_id')
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
        Schema::dropIfExists('inventory_lines');
    }
}
