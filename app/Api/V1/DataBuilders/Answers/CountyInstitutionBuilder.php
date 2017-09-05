<?php

namespace App\Api\V1\DataBuilders\Answers;

use App\AnswersCounty;
use App\County;
use App\CountyPopulation;
use App\Api\V1\Institutions\Institution;

class CountyInstitutionBuilder extends Builder {
    
    public function getAnswersFor(Institution $institution) {
        $output = parent::getAnswersFor($institution);
        $output['employees'] = $this->getEmployeesFor($institution);
        return $output;
    }
    
    protected function getEmployeesFor($institution) {
        $county = County::where('id', $institution->getId())->first();
        $employees = $this->getYearlyPopulation($county->id);
        return $employees;
    }
    
    protected function getAnswerRowsFor($institutionId, $questionId) {
        return AnswersCounty::where('question_id', $questionId)->where('institution_id', $institutionId)
        ->get();
    }
    
    protected function getYearFor($answer) {
        return $answer->year;
    }

    private function getYearlyPopulation($countyId) {
        $population = array();
        $rows = CountyPopulation::where('county_id', $countyId)->get()->all();
        foreach ($rows as $row) {
            $population[] = array('value' => intval($row->population),
                                'year' => intval($row->year));
        }
        return $population;
    }
}