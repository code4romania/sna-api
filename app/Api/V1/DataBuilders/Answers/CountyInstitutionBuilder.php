<?php

namespace App\Api\V1\DataBuilders\Answers;

use App\AnswersCounty;

class CountyInstitutionBuilder extends Builder {
    
    protected function getAnswerRowsFor($institutionId, $questionId) {
        return AnswersCounty::where('question_id', $questionId)->where('institution_id', $institutionId)
        ->get();
    }
    
    protected function getYearFor($answer) {
        return $answer->year;
    }
}