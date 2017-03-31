<?php

use Illuminate\Database\Seeder;
use App\Chestionar;
use App\Question;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = $this->getQuestions();
        
        foreach ($questions as $question) {
            $questionDB = new Question();
            $questionDB->question_text = $question->intrebare;
            $questionDB->required = $question->req;
            $questionDB->type = $question->type;
            $questionDB->unit_of_measurement = $question->valoare;
            $questionDB->max_length = intval($question->char);
            $questionDB->answer_is_numeric = $question->numeric;
            $questionDB->chart = $question->chart;
            $questionDB->question_step = $question->pas;
            $questionDB->save();
        }
    }
    
    private function getQuestions() {
        return Chestionar::all();
    }
}
