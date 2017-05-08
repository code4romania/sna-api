<?php

use Illuminate\Database\Seeder;
use App\Institution;
use App\Helpers\CsvHandler;
use App\Answer;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $answers = CsvHandler::convertToArray('resources/files/dummy_data/code4_questions.csv');
        array_shift($answers);
        $institutions = Institution::all();
        foreach ($institutions as $institution) {
            foreach ($answers as $answer) {
                //$answer[4] - is numeric
                //$answer[6] - min/str
                //$answer[7] - max
                //$answer[0] - id
                $answerDB = new Answer();
                $answerDB->question_id = $answer[0];
                $answerDB->institution_id = $institution->id;
                $answerDB->user_id = 1;
                if(intval($answer[4]) == 1) {
                    $answerDB->answer = rand(intval($answer[6]), intval($answer[7]));
                } else {
                    $answerDB->answer = $answer[6];
                }
                $answerDB->save();
            }
        }
    }
}
