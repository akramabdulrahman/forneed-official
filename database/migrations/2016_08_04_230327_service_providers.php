<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServiceProviders extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_providers', function (Blueprint $table) {
            $table->increments('id');
            $table->text('mission_statement');
            $table->integer('user_id')->unsigned()->nullable()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->string('phone_number')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('fax')->nullable();
            $table->string('website')->nullable();
            $table->string('organization_name')->unique();
            $table->string('contact_person')->nullable();
            $table->string('contact_person_title')->nullable();
            $table->boolean('is_accepted')->default(false);


//            $table->integer('service_provider_meta_id')->unsigned()->index();
//            $table->foreign('service_provider_meta_id')->references('id')->on('service_provider_metas')->onDelete('SET NULL');
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
        Schema::drop('service_providers');
    }

}
