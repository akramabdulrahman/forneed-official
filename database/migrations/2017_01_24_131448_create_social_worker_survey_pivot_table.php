<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialWorkerSurveyPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_worker_survey', function (Blueprint $table) {
            $table->integer('social_worker_id')->unsigned()->index();
            $table->foreign('social_worker_id')->references('id')->on('social_workers')->onDelete('cascade');
            $table->integer('survey_id')->unsigned()->index();
            $table->foreign('survey_id')->references('id')->on('Surveys')->onDelete('cascade');
            $table->primary(['social_worker_id', 'survey_id']);
            $table->integer('count')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('social_worker_survey');
    }
}
