<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitizenExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citizen_extras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('citizen_id')->unsigned()->index();
            $table->foreign('citizen_id')->references('id')->on('citizens')->onDelete('cascade');
            $table->integer('extra_id')->unsigned()->index();
            $table->foreign('extra_id')->references('id')->on('extras')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('citizen_extras');
    }
}
