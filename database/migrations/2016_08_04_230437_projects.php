<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Projects extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('sponsor');
            $table->timestamp('expires_at')->nullable();
            $table->timestamp('starts_at')->nullable();
            $table->boolean('is_accepted')->default(false);
            $table->text('description');
            $table->integer('sector_id')->unsigned()->nullable()->index();
            $table->foreign('sector_id')->references('id')->on('sectors')->onDelete('SET NULL');
            $table->integer('service_provider_id')->unsigned()->nullable()->index();
            $table->foreign('service_provider_id')->references('id')->on('service_providers')->onDelete('SET NULL');
            $table->integer('area_id')->unsigned()->nullable()->index();
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('SET NULL');
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
        Schema::drop('projects');
    }

}
