<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtraServiceProviderPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_service_provider', function (Blueprint $table) {
            $table->integer('extra_id')->unsigned()->unsigned()->index();
            $table->integer('service_provider_id')->unsigned()->index();

            $table->foreign('extra_id')->references('id')->on('extras')->onDelete('cascade');
            $table->foreign('service_provider_id')->references('id')->on('service_providers')->onDelete('cascade');


            $table->primary(['extra_id', 'service_provider_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('extra_service_provider');
    }
}
