<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_id')->unsigned();
            $table->integer('created_by');
            $table->string('job_for');
            $table->string('job_descripton');
            $table->integer('country_id');
            $table->integer('num_of_candidates')->nullable();
            $table->string('phone')->nullable();
            $table->decimal('max_salary')->nullable();
            $table->integer('currency_id')->nullable();
            $table->decimal('min_salary')->nullable();
            $table->string('visa_statues')->nullable();
            $table->string('living_arrangments')->nullable();
            $table->string('educational_level')->nullable();
            $table->string('religion')->nullable();
            $table->string('experience')->nullable();
            $table->string('martial_status')->nullable();
            $table->string('request_status')->nullable();
            $table->string('nationality')->nullable();
            $table->integer('seen')->nullable();
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
        Schema::dropIfExists('post_jobs');
    }
}
