<?php

namespace App\Api\V1\DataBuilders\Answers;

use App\AggregatedCounty;
use App\County;

class TownHallInstitutionBuilder extends Builder {
    public function getAnswersFor($county) {
        $output = array('countyId' => $county->id,
                        'name' => $county->name,
                        'answers' => array()
        );
        $aggregatedAnswers = AggregatedCounty::select('county_id', 'question_id', 'agregated_answer_value')->get()->all();
        dd($aggregatedAnswers);
        return $output;
    }
}