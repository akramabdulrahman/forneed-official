<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SurveyMetas extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('survey_metas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('questions_count');
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
        Schema::drop('survey_metas');
    }

}
