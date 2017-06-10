<?php
namespace App\Api\V1\DataBuilders\Answers;

use App\Answer;
use App\Step;
use App\Question;

abstract class Builder {

    public function getAnswersFor($institution) {
        $output = array('institutionId' => $institution->id,
                        'name' => $institution->name,
                        'answers' => array()
        );
        $steps = Step::select('id', 'name')->where('id', '>', 0)->get();
        $output['answers'] = $this->getStepsOutput($steps, $institution->id);
        
        return $output;
    }
    
    protected function getYearFromDate($dateStr) {
        return date('Y', strtotime($dateStr));
    }
    
    private function getStepsOutput($steps, $institutionId) {
        $output = array();
        foreach ($steps as $step) {
            $stepOutput = array('stepId' => $step->id, 'indicators' => array());
            $questions = Question::where('question_step', $step->id)->get();
            $stepOutput['indicators'] = $this->getQuestionsOutput($questions, $institutionId);
            $output[] = $stepOutput;
        }
        return $output;
    }
    
    protected function getQuestionsOutput($questions, $institutionId) {
        $output = array();
        foreach ($questions as $question) {
            $questionOutput = array('indicatorId' => $question->id, 'values' => array());
            $answers = Answer::where('question_id', $question->id)->where('institution_id', $institutionId)->get();
            $questionOutput['values'] = $this->getAnswersOutput($answers);
            $output[] = $questionOutput;
        }
        return $output;
        
    }
    
    private function getAnswersOutput($answers) {
        $output = array();
        foreach ($answers as $answer) {
            $output[] = array('value' => $answer->value,
                              'year' => $this->getYearFromDate($answer->updated_at));
        }
        return $output;
    }
    
}