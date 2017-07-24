<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitizenExtraPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citizen_extra', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('citizen_id')->unsigned()->index();
            $table->foreign('citizen_id')->references('id')->on('citizens')->onDelete('cascade');
            $table->integer('extra_id')->unsigned()->index();
            $table->foreign('extra_id')->references('id')->on('extras')->onDelete('cascade');
//            $table->integer('extra_type_id')->unsigned()->index();
//            $table->foreign('extra_type_id')->references('id')->on('extra_types')->onDelete('cascade');

         //   $table->primary(['citizen_id', 'extra_id']);//,'extra_type_id'

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('citizen_extra');
    }
}
