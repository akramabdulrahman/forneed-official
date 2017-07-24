<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectorServiceProviderPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sector_service_provider', function (Blueprint $table) {
            $table->integer('sector_id')->unsigned()->index();
            $table->foreign('sector_id')->references('id')->on('sectors')->onDelete('cascade');
            $table->integer('service_provider_id')->unsigned()->index();
            $table->foreign('service_provider_id')->references('id')->on('service_providers')->onDelete('cascade');
            $table->primary(['sector_id', 'service_provider_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sector_service_provider');
    }
}
