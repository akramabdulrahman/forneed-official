<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreaServiceProviderPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area_service_provider', function (Blueprint $table) {
            $table->integer('area_id')->unsigned()->index();
            $table->foreign('area_id','lId')->references('id')->on('areas')->onDelete('cascade');
            $table->integer('service_provider_id')->unsigned()->index();
            $table->foreign('service_provider_id','sId')->references('id')->on('service_providers')->onDelete('cascade');
            $table->primary(['area_id', 'service_provider_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('area_service_provider');
    }
}
