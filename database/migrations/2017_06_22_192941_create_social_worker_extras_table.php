<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialWorkerExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_worker_extras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('extra_id')->unsigned()->unsigned()->index();
            $table->integer('social_worker_id')->unsigned()->index();
            $table->foreign('extra_id')->references('id')->on('extras')->onDelete('cascade');
            $table->foreign('social_worker_id')->references('id')->on('social_workers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_worker_extras');
    }
}
