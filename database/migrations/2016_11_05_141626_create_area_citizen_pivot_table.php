<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreaCitizenPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area_citizen', function (Blueprint $table) {
            $table->integer('area_id')->unsigned()->index();
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
            $table->integer('citizen_id')->unsigned()->index();
            $table->foreign('citizen_id')->references('id')->on('citizens')->onDelete('cascade');
            $table->primary(['area_id', 'citizen_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('area_citizen');
    }
}
