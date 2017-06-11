<?php
namespace App\Api\V1\DataBuilders\Answers;

use App\Answer;
use App\Step;
use App\Question;
use App\Api\V1\Institutions\Institution;

abstract class Builder {

    public function getAnswersFor(Institution $institution) {
        $output = array('institutionId' => $institution->getId(),
                        'name' => $institution->getName(),
                        'answers' => array()
        );
        $steps = Step::select('id', 'name')->where('id', '>', 0)->get();
        $output['answers'] = $this->getStepsOutput($steps, $institution->getId());
        
        return $output;
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
    
    private function getQuestionsOutput($questions, $institutionId) {
        $output = array();
        foreach ($questions as $question) {
            $questionOutput = array('indicatorId' => $question->id, 'values' => array());
            $answers = $this->getAnswerRowsFor($institutionId, $question->id);
            $questionOutput['values'] = $this->getAnswersOutput($answers);
            $output[] = $questionOutput;
        }
        return $output;
        
    }
    
    protected function getAnswerRowsFor($institutionId, $questionId) {
        return Answer::where('question_id', $questionId)->where('institution_id', $institutionId)
               ->get();
    }
    
    private function getAnswersOutput($answers) {
        $output = array();
        foreach ($answers as $answer) {
            $output[] = array('value' => $answer->value,
                    'year' => $this->getYearFor($answer));
        }
        return $output;
    }
    
    protected function getYearFor($answer) {
        return date('Y', strtotime($answer->updated_at));
    }
    
}