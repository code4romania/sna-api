<?php

namespace App\Api\V1\DataBuilders\Answers;

use App\Question;

class CentralInstitutionBuilder extends Builder {
    
    public function getAnswersFor($institution) {
        $output = parent::getAnswersFor($institution);    
        $output['employees'] = $this->getEmployeesFor($institution);
        return $output;
    }
        
    protected function getEmployeesFor($institution) {
        $employeesQuestion = Question::where('code', 'EMPLOYEES')->first();
        $employeesAnswers = $institution->answers->where('question_id', $employeesQuestion->id)->all();
        $employeesOutput = array();
        foreach ($employeesAnswers as $employeesAnswer) {
            $employeesOutput[] = array('value' => $employeesAnswer->value, 
                                       'year' => $this->getYearFromDate($employeesAnswer->updated_at));
        }
        return $employeesOutput;
    }
    
}