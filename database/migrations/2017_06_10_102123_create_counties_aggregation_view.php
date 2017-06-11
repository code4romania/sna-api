<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountiesAggregationView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement(
            "CREATE VIEW code4_aggregated_counties_answers AS
            SELECT code4_counties.id AS county_id, code4_questions.id AS question_id, truncate(avg(code4_answers.value), 2) AS value,
                    YEAR(code4_answers.created_at) AS year, code4_questions.question_step AS question_step
            FROM code4_answers, code4_institutions, code4_counties, code4_questions
            WHERE code4_answers.institution_id = code4_institutions.id
            AND code4_institutions.county_id = code4_counties.id
            AND code4_answers.question_id = code4_questions.id
            AND code4_institutions.type_id = 3
            AND code4_questions.answer_is_numeric = 1
            GROUP BY year, code4_counties.id, code4_questions.id, code4_questions.question_step
            ORDER BY county_id, year, question_step"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW code4_aggregated_counties_answers");
    }
}
