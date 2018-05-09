<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educational', function (Blueprint $table) {
            $table->increments('id');
            $table->string('university', 300)->nullable();
            $table->string('degree', 300)->nullable();
            $table->string('grade', 300)->nullable();
            $table->string('field',300)->nullable();
            $table->longtext('activities')->nullable();
            $table->dateTime('fromdate')->nullable();
            $table->dateTime('todate')->nullable();
            $table->integer('user_id')->unsigned();
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
        Schema::dropIfExists('educational');
    }
}
