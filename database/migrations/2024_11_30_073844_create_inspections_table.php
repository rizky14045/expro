<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspections', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('key')->nullable();
            $table->string('number_inspection')->nullable();
            $table->string('object_name')->nullable();
            $table->string('object_location')->nullable();
            $table->integer('user_id')->nullable();
            $table->date('inspection_date')->nullable();
            $table->string('inspection_file')->nullable();
            $table->string('status')->nullable();
            $table->integer('status_level')->nullable();
            $table->string('qrcode')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('inspections');
    }
}
