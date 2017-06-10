<?php

use Illuminate\Database\Seeder;
use App\AggregatedCountiesAnswers;
use App\AnswersCounty;

class AnswersCountiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aggregatedCountiesAnswers = AggregatedCountiesAnswers::get()->all();
        foreach($aggregatedCountiesAnswers as $answer) {
            AnswersCounty::create([
                'institution_id' => $answer->county_id,
                'question_id' => $answer->question_id,
                'question_step' => $answer->question_step,
                'value' => $answer->value,
                'year' => $answer->year
            ]);
        }
    }
}
