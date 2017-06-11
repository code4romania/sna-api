<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersCountiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers_counties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('institution_id')->unsigned();
            $table->integer('question_id')->unsigned();
            $table->integer('question_step')->unsigned();
            $table->integer('year')->unsigned();
            $table->float('value');
            $table->timestamps();

            $table->foreign('question_id')->references('id')->on('questions');
            $table->foreign('institution_id')->references('id')->on('counties');
            $table->foreign('question_step')->references('id')->on('steps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('answers_counties');
    }
}
