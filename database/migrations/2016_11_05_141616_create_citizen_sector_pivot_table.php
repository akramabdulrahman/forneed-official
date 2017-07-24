<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitizenSectorPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citizen_sector', function (Blueprint $table) {
            $table->integer('citizen_id')->unsigned()->index();
            $table->foreign('citizen_id')->references('id')->on('citizens')->onDelete('cascade');
            $table->integer('sector_id')->unsigned()->index();
            $table->foreign('sector_id')->references('id')->on('sectors')->onDelete('cascade');
            $table->primary(['citizen_id', 'sector_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('citizen_sector');
    }
}
