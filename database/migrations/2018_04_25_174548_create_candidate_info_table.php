<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('candidate_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_id');
            $table->integer('industry_id');
            $table->integer('country_id');
            $table->integer('gender');
            $table->string('martial_status')->nullable();
            $table->string('vedio_path')->nullable();
            $table->string('cv_path')->nullable();
            $table->integer('coins')->nullable();
            $table->string('nationality')->nullable();
            $table->integer('user_id');
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
        //
    }
}
