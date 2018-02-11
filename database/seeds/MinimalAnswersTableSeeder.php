<?php

use Illuminate\Database\Seeder;
use App\Institution;
use App\Helpers\CsvHandler;
use App\Answer;
use App\AnswersCounty;
use App\County;

class MinimalAnswersTableSeeder extends Seeder
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
        $institutions = $this->getCentralAndMinistryInstitutions();
        foreach ($institutions as $institution) {
            foreach ($answers as $answer) {
                $answerDB = new Answer();
                $answerDB->question_id = $answer[0];
                $answerDB->institution_id = $institution->id;
                $answerDB->user_id = 1;
                if(intval($answer[4]) == 1) {
                    $answerDB->value = rand(intval($answer[6]), intval($answer[7]));
                } else {
                    $answerDB->value = $answer[6];
                }
                $answerDB->save();
            }
        }
        $countyInstitutions = $this->getCountyInstitutions();
        foreach ($countyInstitutions as $countyInstitution) {
            foreach ($answers as $answer) {
                $answerDB = new AnswersCounty();
                $answerDB->question_id = $answer[0];
                $answerDB->institution_id = $countyInstitution->id;
                $answerDB->question_step = $answer[5];
                $answerDB->year = 2017;
                if(intval($answer[4]) == 1) {
                    $answerDB->value = rand(intval($answer[6]), intval($answer[7]));
                    $answerDB->save();
                } else {
                }
            }
        }
    }
    
    private function getCentralAndMinistryInstitutions() {
        return Institution::select('*')->where('type_id', 2)->orWhere('type_id', 1)->get();
    }
    
    private function getCountyInstitutions() {
        return County::select('id')->limit(5)->get();
    }
}
