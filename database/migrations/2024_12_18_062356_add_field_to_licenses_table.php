<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('licenses', function (Blueprint $table) {
            $table->string('personel_type')->nullable();
            $table->string('service_sector')->nullable();
            $table->string('tool_type')->nullable();
            $table->string('clasification')->nullable();
            $table->string('class')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('licenses', function (Blueprint $table) {
            $table->dropColumn('personel_type');
            $table->dropColumn('service_sector');
            $table->dropColumn('tool_type');
            $table->dropColumn('clasification');
            $table->dropColumn('class');
        });
    }
}
