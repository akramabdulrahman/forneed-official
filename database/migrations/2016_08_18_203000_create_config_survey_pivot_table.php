<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigSurveyPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_survey', function (Blueprint $table) {
            $table->integer('config_id')->unsigned()->index();
            $table->integer('survey_id')->unsigned()->index();

            $table->foreign('config_id')->references('id')->on('configs')->onDelete('cascade');
            $table->foreign('survey_id')->references('id')->on('Surveys')->onDelete('cascade');
            $table->primary(['config_id', 'survey_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('config_survey');
    }
}
