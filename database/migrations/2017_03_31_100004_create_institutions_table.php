<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institutions', function(Blueprint $table) {
          $table->increments('id');
          $table->integer('county_id')->unsigned();
          $table->string('name');
          $table->integer('type_id')->unsigned();
          $table->timestamps();

          $table->foreign('county_id')->references('id')->on('counties');
          $table->foreign('type_id')->references('id')->on('institution_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('institutions');
    }
}
