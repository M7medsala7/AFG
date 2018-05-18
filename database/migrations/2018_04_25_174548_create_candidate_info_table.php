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
            $table->string('last_name')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('phone_number')->nullable();
            $table->integer('religion_id')->nullable();
            $table->string('visa_type');
            $table->date('visa_expire_date');
            $table->integer('job_id');
            $table->integer('industry_id')->nullable();
            $table->integer('country_id');
            $table->integer('gender');
            $table->string('martial_status')->nullable();
            $table->string('vedio_path')->nullable();
            $table->string('cv_path')->nullable();
            $table->string('descripe_yourself')->nullable();
            $table->integer('looking_for_job')->nullable();//0 false, 1 true
            $table->integer('coins')->nullable();
            $table->integer('nationality_id')->nullable();
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
