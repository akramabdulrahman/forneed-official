<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('targets', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('extra_type_id')->unsigned()->index();
            $table->foreign('extra_type_id')->references('id')->on('extra_types')->onDelete('cascade');

            $table->integer('extra_id')->unsigned()->nullable()->index();
            $table->foreign('extra_id')->references('id')->on('extras')->onDelete('cascade');

            $table->morphs('targetable');
            //project
            //survey
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('targets');
    }
}
