<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_workers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->integer('area_id')->unsigned()->nullable()->index();
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('SET NULL');
            $table->string('address');
            $table->string('mobile');
            $table->string('telephone');
            $table->string('cv');
            $table->boolean('is_accepted')->default(false);

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
        Schema::dropIfExists('social_workers');
    }
}
