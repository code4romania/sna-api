<?php

namespace App\Api\V1\DataBuilders\Answers;

use App\Question;
use App\Api\V1\Institutions\Institution;

class CentralInstitutionBuilder extends Builder {
    
    public function getAnswersFor(Institution $institution) {
        $output = parent::getAnswersFor($institution);    
        $output['employees'] = $this->getEmployeesFor($institution);
        return $output;
    }
        
    protected function getEmployeesFor($institution) {
        $employeesQuestion = Question::where('code', 'EMPLOYEES')->first();
        $employeeAnswers = $institution->answers->where('question_id', $employeesQuestion->id)->all();
        $employeesOutput = array();
        foreach ($employeeAnswers as $employeeAnswer) {
            $employeesOutput[] = array('value' => intval($employeeAnswer->value), 
                                       'year' => $this->getYearFor($employeeAnswer));
        }
        return $employeesOutput;
    }
    
}