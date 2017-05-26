<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumText('question_text');
            $table->integer('required')->nullable();
            $table->integer('type');
            $table->string('code');
            $table->string('unit_of_measurement', 100);
            $table->integer('max_length');
            $table->integer('answer_is_numeric')->nullable();
            $table->integer('chart')->nullable();
            $table->integer('question_step')->unsigned();
            $table->timestamps();

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
        Schema::drop('questions');
    }
}
