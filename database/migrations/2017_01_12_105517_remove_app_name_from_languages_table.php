<?php

use Illuminate\Database\Migrations\Migration;

class RemoveAppNameFromLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('languages', function ($table) {
            $table->dropColumn('app_name');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('languages', function ($table) {
            $table->string('appname', 100)->after('abbr');
        });
    }
}
