<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswerCitizenPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_citizen', function (Blueprint $table) {
            $table->integer('answer_id')->unsigned()->index();
            $table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade');
            $table->integer('citizen_id')->unsigned()->index();
            $table->foreign('citizen_id')->references('id')->on('citizens')->onDelete('cascade');
            $table->primary(['answer_id', 'citizen_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('answer_citizen');
    }
}
