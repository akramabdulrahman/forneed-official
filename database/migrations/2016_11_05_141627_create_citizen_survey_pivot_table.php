<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitizenSurveyPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citizen_survey', function (Blueprint $table) {
            $table->integer('survey_id')->unsigned()->index();
            $table->foreign('survey_id')->references('id')->on('Surveys')->onDelete('cascade');
            $table->integer('citizen_id')->unsigned()->index();
            $table->foreign('citizen_id')->references('id')->on('citizens')->onDelete('cascade');
            $table->integer('step');
            $table->boolean('is_final_step');

            $table->primary(['survey_id', 'citizen_id','step','is_final_step']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('citizen_survey');
    }
}
