<?php

namespace App\Api\V1\DataBuilders\Answers;

use App\AnswersCounty;
use App\County;
use App\Api\V1\Institutions\Institution;

class CountyInstitutionBuilder extends Builder {
    
    public function getAnswersFor(Institution $institution) {
        $output = parent::getAnswersFor($institution);
        $output['employees'] = $this->getEmployeesFor($institution);
        return $output;
    }
    
    protected function getEmployeesFor($institution) {
        $county = County::where('id', $institution->getId())->first();
        return $county->population;
    }
    
    protected function getAnswerRowsFor($institutionId, $questionId) {
        return AnswersCounty::where('question_id', $questionId)->where('institution_id', $institutionId)
        ->get();
    }
    
    protected function getYearFor($answer) {
        return $answer->year;
    }
}