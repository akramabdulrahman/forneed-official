<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Questions extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('body');
            $table->integer('survey_id')->unsigned()->nullable();
            $table->foreign('survey_id')->references('id')->on('Surveys')->onDelete('cascade');
            $table->integer('step')->unsigned()->default(1);
            $table->integer('order')->unsigned();
            $table->string('rule')->default('');
            $table->softDeletes();	
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('questions');
    }

}
