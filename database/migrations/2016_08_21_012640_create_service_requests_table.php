<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceRequestsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('citizen_id')->unsigned()->nullable()->index();
            $table->foreign('citizen_id')->references('id')->on('citizens')->onDelete('SET NULL');

            $table->integer('sector_id')->unsigned()->nullable()->index();
            $table->foreign('sector_id')->references('id')->on('sectors')->onDelete('SET NULL');

            $table->integer('area_id')->unsigned()->nullable()->index();
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('SET NULL');
            $table->text('images')->nullable();
            $table->tinyInteger('state')->default(false); //0null 1pending 2complete
            $table->softDeletes();
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
        Schema::drop('service_requests');
    }

}
